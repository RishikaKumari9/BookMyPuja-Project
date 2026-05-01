<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart; // Add this line to import the Cart class

class RazorpayController extends Controller
{
    public function pay()
    {
        return view('razorpay.pay');
    }

    public function payment(Request $request)
    {
        $api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );

        $payment = $api->payment->fetch($request->razorpay_payment_id);

        $payment->capture([
            'amount' => $payment['amount']
        ]);
        //dd($payment['amount']);
        $cart = session()->get('cart', []);

        $address = Auth::user()->address ?? null;

        $order = DB::table('orders')->insertGetId([
            'user_id' => Auth::id(),
            'total_amount' => $payment['amount']/100, // Convert back to rupees
            'status' => 'paid',
            'razorpay_payment_id' => $request->razorpay_payment_id,
            '_token' => $request->_token,
            'address' => $address,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert order details
        foreach ($cart as $productId => $item) {
            DB::table('order_details')->insert([
                'order_id' => $order,
                'product_id' => $productId,
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        session()->forget('cart');

        /*Order::where('id', $request->order_id)->update([
            'status' => 'paid',
            'razorpay_payment_id' => $request->razorpay_payment_id,
            '_token' => $request->_token,
            'updated_at' => now(),
        ]);*/

        return redirect('/my-orders')->with('success', 'Payment successful');

        //return redirect('chirag')->with('success', 'Payment Successful');
    }
}

