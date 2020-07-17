<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Purchases extends Model
{
	protected $fillable = [
        'productID', 'cost', 'units', 'supplier',
    ];
	
    protected $table = 'purchases';
}
