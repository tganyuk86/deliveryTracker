<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = [
        'amount', 'status'
    ];

    public function moveStock($driverID, $amount)
    {
    	$stock = ProductStock::where('driverID', $driverID)->where('productID', $this->id);

    	if($stock->exists())
    	{
    		$stock = $stock->first();
    	}else{
    		$stock = ProductStock::create([
    			'driverID' => $driverID,
    			'productID' => $this->id
    		]);
    	}
		$homeStock = ProductStock::where('driverID', 0)->where('productID', $this->id)->first();
    	
    	if($driverID != 0)
    	{
    		//increase driver
			$stock->amount += $amount;
			$stock->save();

    		//reduce home
			$homeStock->amount -= $amount;
    	}else{
    		//increase home
			$homeStock->amount += $amount;
    	}
		$homeStock->save();
    }

    public function driverStock($driverID)
    {
    	$stock = ProductStock::where('driverID', $driverID)->where('productID', $this->id)->get();

    	return isset($stock[0]) ? $stock[0]->amount : 0;

    }

    public function cost()
	{
		$purchase = Purchases::where('productID', $this->id)->last();
		if($purchase)
			return $purchase->cost/$purchase->units;
		
		return 'na';
	}
    public function homeStock()
    {
    	$stock = ProductStock::where('driverID', 0)->where('productID', $this->id)->get();

    	return isset($stock[0]) ? $stock[0]->amount : 0;

    }
    public function isActive()
	{
		return $this->status ? true : false;
	}
	
    public static function allActive()
    {
    	$stock = Product::where('status', 1)->get();

    	return $stock;

    }


}
