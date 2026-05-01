<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $fillable = [
        'booking_id',
        'puja_id',
        'puja_name',
        'date',
        'priest',
        'price',
    ];
}

