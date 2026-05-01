<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use App\Models\Puja;
use App\Models\Priest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
  public function showAdminLoginForm()
  {
    return view('admin.login');
  }
//   public function adminDashboard()
//   {
//     return view('admin.dashboard');
//   }

  public function adminLogin(Request $request)
  {
        $credentials = $request->only('email', 'password');
         if (auth()->guard('admin')->attempt($credentials)) {
             // Authentication passed, redirect to admin dashboard
                return redirect()->route('admin.dashboard')->with('status', 'Logged in successfully');
         } else {
             // Authentication failed, redirect back with error
             return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
         }
    }

    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login')->with('status', 'Logged out successfully');
    }
    public function showAdminDashboard()
    {
        // Show admin dashboard
       // return view('admin.dashboard');
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalPujaServices = Puja::count();
        $totalEarnings = Order::where('status', 'paid')->sum('total_amount');
        $orders = Order::where('status', 'paid')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'totalPujaServices', 'totalEarnings', 'orders'));
    }
    public function showAdminRegisterForm()
    {
        return view('admin.register');
    }

// ---------------------------------------------------------------------

    public function showUsers()
    {
        // Fetch all users and return view
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function showEditUserForm($id)
    {
        // Fetch user by ID and return edit form view
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,

        ]);
        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email'));

            $user->save();
        return redirect()->route('admin.users')->with('status', 'User updated successfully');
    }
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('status', 'User deleted successfully');
    }
    public function addUser()
    {
        return view('admin.adduser');
         }
    public function postUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'phone' => 'required|string|max:12',
            'gender' => 'required|string|in:male,female,other',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional photo upload validation
        ]);
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        } else {
            $photoPath = null; // Handle case where no photo is uploaded
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'gender' => $request->gender,
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.users')->with('status', 'User added successfully');
    }
// ------------------------------------------------------------------------------------------------------------
    public function showAdminProducts()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

     public function editProduct($id)
    {
        // Fetch product by ID and return edit form view
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
           'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $product = Product::findOrFail($id);
        $product->update($request->only('name', 'description', 'price'));
            $product->save();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = null; // Handle case where no image is uploaded
        }
        if ($imagePath) {
            $product->image = $imagePath;
            $product->save();
        }
        return redirect()->route('admin.products')->with('status', 'Product updated successfully');
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products')->with('status', 'Product deleted successfully');
    }

    public function addProduct()
    {
        return view('admin.addproduct');
    }
    public function postProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = null; // Handle case where no image is uploaded
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products')->with('status', 'Product added successfully');
    }

 //public function editProduct($id)

// ------------------------------------------------------------------------------------------------------------

    public function showAdminPujas()
    {
        $pujas = Puja::all();
        return view('admin.pujas', compact('pujas'));
    }
    public function editPuja($id)
    {
        // Fetch puja by ID and return edit form view
        $puja = Puja::findOrFail($id);
        return view('admin.edit_puja', compact('puja'));
    }
    public function updatePuja(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $puja = Puja::findOrFail($id);
        $puja->update($request->only('name', 'description', 'price', 'image'));
            $puja->save();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pujas', 'public');
        } else {
            $imagePath = null; // Handle case where no image is uploaded
        }
        if ($imagePath) {
            $puja->image = $imagePath;
            $puja->save();
        }
        return redirect()->route('admin.pujas')->with('status', 'Puja updated successfully');
    }



    public function destroyPuja($id)
    {
        $puja = Puja::findOrFail($id);
        $puja->delete();
        return redirect()->route('admin.pujas')->with('status', 'Puja deleted successfully');
    }
    public function addPuja()
    {
        return view('admin.addpuja');
    }
    public function postPuja(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = null; // Handle case where no image is uploaded
        }

        Puja::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.pujas')->with('status', 'Puja added successfully');
    }

// -------------------------------------------------------------------------------------------------------------

    public function showAdminPriests()
    {
        $priests = Priest::all();
        return view('admin.priests', compact('priests'));
    }
     public function editPriest($id)
    {
        // Fetch priest by ID and return edit form view
        $priest = Priest::findOrFail($id);
        return view('admin.edit_priest', compact('priest'));
    }
    public function updatePriest(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer',
            'rating' => 'nullable|numeric|between:0,5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:12',
            'email' => 'nullable|string|email|max:255',
            'gotra' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer',
            'availability' => 'nullable|boolean',
            'address' => 'nullable|string',
        ]);

        $priest = Priest::findOrFail($id);
        $priest->update($request->only('name', 'age', 'rating','phone', 'email', 'gotra', 'specialization', 'experience_years', 'availability', 'address'));
            $priest->save();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('priests', 'public');
        } else {
            $imagePath = null; // Handle case where no image is uploaded
        }
        if ($imagePath) {
            $priest->image = $imagePath;
            $priest->save();
        }
        return redirect()->route('admin.priests')->with('status', 'Priest updated successfully');
    }

    public function destroyPriest($id)
    {
        $priest = Priest::findOrFail($id);
        $priest->delete();
        return redirect()->route('admin.priests')->with('status', 'Priest deleted successfully');
    }
    public function addPriest()
    {
        return view('admin.addpriest');
    }
    public function postPriest(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer',
            'rating' => 'nullable|numeric|between:0,5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:12',
            'email' => 'nullable|string|email|max:255',
            'gotra' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer',
            'availability' => 'nullable|boolean',
            'address' => 'nullable|string',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('priests', 'public');
        } else {
            $imagePath = null; // Handle case where no image is uploaded
        }

        Priest::create([
            'name' => $request->name,
            'age' => $request->age,
            'rating' => $request->rating,
            'image' => $imagePath,
            'phone' => $request->phone,
            'email' => $request->email,
            'gotra' => $request->gotra,
            'specialization' => $request->specialization,
            'experience_years' => $request->experience_years,
            'availability' => $request->availability == 'available' ? 1 : 0,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.priests')->with('status', 'Priest added successfully');
    }

//--------------------------------------------------------------------------------------------------------------


}
