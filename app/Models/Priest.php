<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Priest extends Model
{
    protected $fillable = [
        'name',
        'age',
        'rating',
        'image',
        'phone',
        'email',
        'gotra',
        'specialization',
        'experience_years',
        'availability',
        'address',

    ];
}
