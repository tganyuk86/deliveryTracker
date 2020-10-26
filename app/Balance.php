<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Balance extends Model
{
	protected $fillable = [
        'productID', 'cost', 'units', 'supplier',
    ];
	
    protected $table = 'balance';
}
