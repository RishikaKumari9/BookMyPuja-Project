<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BookingDetail;

class Booking extends Model
{
     protected $fillable = [
        'user_id',
        'total_amount',
        'booking_date',
        'priest_name',
        'status',
        '_token',
        'razorpay_payment_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function puja()
    {
        return $this->belongsTo(Puja::class, 'puja_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(BookingDetail::class);
    }
}
