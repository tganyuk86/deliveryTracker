<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class OrderItem extends Model
{
    protected $fillable = [
        'orderID', 'stockID'
    ];

    // protected $table = 'orderItems';
}
