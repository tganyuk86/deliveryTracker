<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    protected $fillable = [
        'name', 'lat', 'lon', 'notes', 'phone', 'status', 'address'
    ];
	
	public function orders()
	{
		return Order::where('customerID', $this->id)->get();
	}
}
