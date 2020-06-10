<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use App\Product;
use App\StockType;

class Stock extends Model
{
    protected $table = 'stock';

    protected $fillable = [
        'productID', 'typeID', 'price', 'amount',
    ];


    public function products()
    {
    	return Product::allActive();
    }

    public function types()
    {
    	return StockType::all();
    }

    public function product()
    {
    	return Product::find($this->productID);
    }

    public function type()
    {
        return StockType::find($this->typeID);
    }

    public static function allActiveSorted()
	{
		$stocks = Stock::orderBy('price', 'asc')->get();

        foreach ($stocks as $stock) 
        {
			if(!$stock->product()->isActive())
				continue;
			
            $out[$stock->product()->name][$stock->type()->name] = $stock;
        }

        return $out;
	}
	
    public static function allActive()
	{
		$stocks = Stock::all();

        foreach ($stocks as $key => $stock) 
        {
			if(!$stock->product()->isActive())
				unset($stocks[$key]);
			
        }

        return $stocks;
	}
	
    public static function allSorted()
    {
    	$stocks = Stock::orderBy('price', 'asc')->get();

        foreach ($stocks as $stock) 
        {
            $out[$stock->product()->name][$stock->type()->name] = $stock;
        }

        return $out;
    }

    public function reduceAvailable($driverID, $multiply = 1)
    {
        $prodStock = ProductStock::where('driverID', $driverID)
                                 ->where('productID', $this->productID)
                                 ->first();
// dd($this->type());
        if(!$prodStock) return;

        $prodStock->amount -= $this->type()->amount*$multiply;
        $prodStock->save();
    }
    public function increaseAvailable($driverID, $multiply = 1)
    {
        $prodStock = ProductStock::where('driverID', $driverID)
                                 ->where('productID', $this->productID)
                                 ->first();
// dd($this->type());
        if(!$prodStock) return;

        $prodStock->amount += $this->type()->amount*$multiply;
        $prodStock->save();
    }

}
