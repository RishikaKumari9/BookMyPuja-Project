<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Puja extends Model
{
   // protected $table = 'pujas';
     protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];
}
