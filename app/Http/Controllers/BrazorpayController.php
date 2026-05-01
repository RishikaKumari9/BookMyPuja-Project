<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart; // Add this line to import the Cart class

class BrazorpayController extends Controller
{
     public function bpay()
    {
        return view('razorpay.pay');
    }

    public function bpayment(Request $request){
        $api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );
// dd($request->all());
        $payment = $api->payment->fetch($request->razorpay_payment_id);

        $payment->capture([
            'amount' => $payment['amount']

        ]);
      //dd($payment['amount']);
    $bookingData = json_decode($request->booking_data, true);
    //dd($bookingData);
foreach ($bookingData as $pujaId => $data) {

    $booking_id = DB::table('bookings')->insertGetId([
        'user_id' => Auth::id(),
        'total_amount' => $payment['amount']/100,
        'booking_date' => $data['date'],
        'priest_name' => $data['priest'],
        'status' => 'paid',
        'razorpay_payment_id' => $request->razorpay_payment_id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // DB::table('booking_details')->insert([
    //     'booking_id' => $booking_id,
    //     'puja_id' => $pujaId,
    //     // 'puja_name' => $data['name'] ?? null,
    //     'date' => $data['date'],
    //     'priest' => $data['priest'],
    //     'price' => $data['price'] ?? 0,
    //     'created_at' => now(),
    //     'updated_at' => now(),
    // ]);
     }


     session()->forget('booking');

    return redirect('/my-bookings')->with('success', 'Payment successful');

     //return redirect('chirag')->with('success', 'Payment Successful');
   // return "Payment Success";
}

}
