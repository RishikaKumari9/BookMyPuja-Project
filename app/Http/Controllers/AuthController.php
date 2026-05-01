<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Puja;
use App\Models\Priest;
use Illuminate\Support\Facades\Hash;
use Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\BookingDetail;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.home');
    }

    public function aboutUs()
    {
        return view('auth.aboutUs');
    }

    public function contactUs()
    {
        return view('auth.contactUs');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'phone'=> 'required|string|max:12',
            'gender' => 'required|string|in:male,female,other',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'string|max:500',

        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->address = $request->input('address');

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/photos'), $imageName);
            $user->photo = 'uploads/photos/' . $imageName;
        }

        $user->save();

        // This method will handle the registration logic
        // Validate the request, create a new user, etc.
        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        //dd($request->all());
        $request->validate([
                'email'=> 'required|email|string',
                'password' => 'required|string|min:4',
        ]);
        $credentials=$request->only('email', 'password');
        if(auth()->attempt($credentials)){
            return redirect()->route('home')->with('success', 'Login successful.');
        }
            return back()->withErrors([
                        'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        // This method will handle the logout logic
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }

    public function showProfile()
    {
        // This method will return the user profile view
        $user = auth()->user();
        return view('auth.profile', compact('user'));

    }

    public function showEditProfileForm()
    {
        // This method will return the edit profile view
        $user = auth()->user();
        return view('auth.editprofile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone'=> 'required|string|max:12',
            'gender' => 'required|string|in:male,female,other',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'string|max:500',

        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->address = $request->input('address');

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }
            $image = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/photos'), $imageName);
            $user->photo = 'uploads/photos/' . $imageName;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function showChangePasswordForm()
{
    // This method will return the change password view
    return view('auth.changepassword');
}

public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|string|min:4',
        'new_password' => 'required|string|min:4|confirmed',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->input('current_password'), $user->password)) {
        return back()->withErrors(['current_password' => 'The provided password does not match our records.']);
    }

    $user->password = bcrypt($request->input('new_password'));
    $user->save();

    return redirect()->route('profile')->with('success', 'Password changed successfully.');
}

    public function showProducts()
    {
    //  $products = DB::table('products')->get();
        $products = Product::all();
        return view('auth.products', compact('products'));
    }

    public function showPujas()
    {
    //  $products = DB::table('products')->get();
        $pujas = Puja::all();
        return view('auth.pujas', compact('pujas'));
    }

    public function showPriests()
    {
    //  $priests = DB::table('priests')->get();
        $priests = Priest::all();
        return view('auth.priests', compact('priests'));
    }

    public function addToCart(Request $request, $id)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            // If not logged in, redirect to login page
            return redirect()->route('login')->with('error', 'Please login to add items to your cart.');
        }

      $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
        ];
        session()->put('cart', $cart);
        return redirect()->route('cart.view')->with('success', 'Product added to cart successfully.');
    }


     public function addToBooking(Request $request, $id)
    {
        if (!Auth::check()) {
            // If not logged in, redirect to login page
            return redirect()->route('login')->with('error', 'Please login to add items to your cart.');
        }

        $puja = Puja::findOrFail($id);
        $Booking = session()->get('booking', []);
        $Booking[$id] = [
            'name' => $puja->name,
            'price' => $puja->price,
            'quantity' => 1,
        ];
        session()->put('booking', $Booking);
        return redirect()->route('booking.view')->with('success', 'Puja added to booking successfully.');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('auth.myCart', compact('cart'));
    }

    public function viewBooking()
    {
        $booking = session()->get('booking', []);
        return view('auth.myBooking', compact('booking'));
    }



    public function removeFromCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.view')->with('success', 'Product removed from cart successfully.');
    }



     public function removeFromBooking(Request $request, $id)
    {
        $booking = session()->get('booking', []);
        if (isset($booking[$id])) {
            unset($booking[$id]);
            session()->put('booking', $booking);
        }
        return redirect()->route('booking.view')->with('success', 'Puja removed from booking successfully.');
    }

    // public function updateCart(Request $request, $id)
    // {
    //     $request->validate([
    //         'quantity' => 'required|integer|min:1',
    //     ]);

    //     $cart = session()->get('cart', []);
    //     if (isset($cart[$id])) {
    //         $cart[$id]['quantity'] = $request->input('quantity');
    //         session()->put('cart', $cart);
    //     }
    //     return redirect()->route('cart.view')->with('success', 'Cart updated successfully.');
    // }

     public function updateCart(Request $request, $rowId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$rowId])) {
            $cart[$rowId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated successfully.');
    }


    public  function updateBooking(Request $request, $rowId)
    {
        $request->validate([
            'booking_date' => 'required|date',
        ]);

        $booking = session()->get('booking', []);

        if (isset($booking[$rowId])) {
            $booking[$rowId]['booking_date'] = $request->booking_date;
            session()->put('booking', $booking);
        }

        return redirect()->back()->with('success', 'Booking updated successfully.');
    }

    // public function updateAddress(Request $request)
    // {
    //     $request->validate([
    //         'address' => 'required|string|max:500',
    //     ]);

    //     $user = auth()->user();
    //     $user->address = $request->input('address');
    //     $user->save();

    //     return redirect()->route('profile')->with('success', 'Address updated successfully.');
    // }

    public function selectPriest(Request $request)
    {
        $request->validate([
            'priest_id' => 'required|integer|exists:priests,id',
        ]);

        $priestId = $request->input('priest_id');
        session()->put('selected_priest', $priestId);

        return redirect()->route('booking.view')->with('success', 'Priest selected successfully.');
    }

    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.view')->withErrors('Your cart is empty.');
        }

        // Here you would typically handle payment processing and order creation
        $order = new \App\Models\Order();
        $order->user_id = auth()->id();
        $order->total_amount = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });
        $order->status = 'pending';
        $order->save();

        foreach ($cart as $productId => $item) {
            $orderDetail = new \App\Models\OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $productId;
            $orderDetail->quantity = $item['quantity'];
            $orderDetail->price = $item['price'];
            $orderDetail->save();
        }
        // Clear the cart after checkout
        session()->forget('cart');

        return redirect()->route('products')->with('success', 'Checkout processed successfully. Thank you for your purchase!');
    }
    public function showMyOrders()
    {
        $orders = DB::table('orders')->where('user_id', Auth::id())->get();
        return view('auth.myOrders', compact('orders'));
    }
    public function viewOrderDetail($id)
    {
        $order = DB::table('orders')->where('id', $id)->where('user_id', Auth::id())->first();

        if (!$order) {
            return redirect()->route('my')->with('error', 'Order not found.');
        }

        $orderDetails = DB::table('order_details')
            ->where('order_id', $id)
            ->get();

        return view('auth.orderDetail', compact('order', 'orderDetails'));
    }



    public function processBooking(Request $request)
    {
        $booking = session()->get('booking', []);
        if (empty($booking)) {
            return redirect()->route('Booking.view')->withErrors('Your booking is empty.');
        }

        // Here you would typically handle payment processing and order creation
        $booking = new \App\Models\Booking();
        $booking->user_id = auth()->id();
        $booking->total_amount = collect($booking)->sum(function($item) {
            return $item['price'];
        });
        $booking->status = 'pending';
        $booking->save();

        foreach ($booking as $pujaId => $item) {
            $bookingDetail = new \App\Models\BookingDetail();
            $bookingDetail->booking_id = $booking->id;
            $bookingDetail->puja_id = $pujaId;
            $bookingDetail->date = $item['date'];
            $bookingDetail->priest = $item['priest'];
            $bookingDetail->price = $item['price'];
            $bookingDetail->save();
        }
        // Clear the cart after checkout
        session()->forget('booking');

        return redirect()->route('pujas')->with('success', 'Checkout processed successfully. Thank you for your purchase!');
    }

    public function showMyBookings()
    {
        $bookings = DB::table('bookings')->where('user_id', Auth::id())->get();
        return view('auth.bookings', compact('bookings'));
    }

     public function viewBookingDetail($id)
    {
        $booking = DB::table('bookings')->where('id', $id)->where('user_id', Auth::id())->first();

        if (!$booking) {
            return redirect()->route('my')->with('error', 'Booking not found.');
        }

        $bookingDetails = DB::table('booking_details')
            ->where('booking_id', $id)
            ->get();

        return view('auth.bookingDetails', compact('booking', 'bookingDetails'));

    //      $booking = DB::table('bookings')
    //     ->where('id', $id)
    //     ->where('user_id', Auth::id())
    //     ->first(); // single record

    // if (!$booking) {
    //     return redirect()->route('my-bookings')->with('error', 'Booking not found.');
    // }

    // return view('auth.bookingDetails', compact('booking'));
    }

}
