<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class OrderItem extends Model
{
    protected $fillable = [
        'orderID', 'stockID', 'quantity', 'value', 'markup'
    ];

    // protected $table = 'orderItems';
}
