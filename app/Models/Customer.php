<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone_number'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
