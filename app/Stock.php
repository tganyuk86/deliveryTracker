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
    	return Product::all();
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

    public static function allSorted()
    {
    	$stocks = Stock::orderBy('price', 'asc')->get();

        foreach ($stocks as $stock) 
        {
            $out[$stock->product()->name][$stock->type()->name] = $stock;
        }

        return $out;
    }

    public function reduceAvailable($driverID)
    {
        $prodStock = ProductStock::where('driverID', $driverID)
                                 ->where('productID', $this->productID)
                                 ->first();
// dd($this->type());
        if(!$ProductStock) return;
        
        $prodStock->amount -= $this->type()->amount;
        $prodStock->save();
    }

}
