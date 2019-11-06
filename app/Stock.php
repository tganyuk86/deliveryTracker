<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use App\Product;
use App\StockType;

class Stock extends Model
{
    protected $table = 'stock';

    protected $fillable = [
        'productID', 'typeID', 'price',
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

}
