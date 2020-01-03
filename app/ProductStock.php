<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProductStock extends Model
{
	protected $table = 'product_stock';

	protected $fillable = [
        'driverID', 'productID', 'amount',
    ];
    
    public function product()
    {
    	return Product::find($this->productID);
    }

    public function reduceAvailable($reduceBy)
    {
        if(($this->amount - $reduceBy) < 0)
        {
            dd('Not Enough Stock of '.$this->product()->name);
        }
        $this->update([
            'amount' => ($this->amount - $reduceBy)
        ]);
    }
}
