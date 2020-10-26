<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class Order extends Model
{
    protected $fillable = [
        'name', 'lat', 'lon', 'value', 
        'order', 'status', 'dfee',
        'phone', 'customerID', 'notes', 
        'driverID', 'priority', 'payType',
		'locationID', 'outstanding'
    ];


    public function driver()
    {
    	if($this->driverID == 0)
    		return \Auth::user();
    	return User::find($this->driverID);
    }
    public function customer()
    {
    	
    	return Customer::find($this->customerID);
    }

    public function items()
    {
    	$items = OrderItem::where('orderID',$this->id)->get();
    	$out = [];
    	foreach($items as $item)
    	{
    		$out[] = Stock::find($item->stockID);
    	}

    	return $out;
    }

    public static function permaDel()
    {
    	OrderItem::where('orderID',$this->id)->delete();
    	$this->delete();
    }

    public static function getCurrent()
    {
    	if(\Auth::user()->isAdmin())
            return Order::where('status', 'on-route')->get();
        else
            return Order::where('status', 'on-route')
                            ->where('driverID', \Auth::user()->id)
                            ->get();
    }

    public static function getWaiting()
    {
    	if(\Auth::user()->isAdmin())
            return Order::where('status', 'waiting')
						->orderBy('priority')
            		    ->get()
            		    ;
        else
            return Order::where('status', 'waiting')
                            ->where('driverID', \Auth::user()->id)
							->orderBy('priority')
                            ->get()
                            ;
    }

    public static function getDone()
    {
    	if(\Auth::user()->isAdmin())
            return Order::where('status', 'done')
						->whereDate('created_at', Carbon::today())
						->get();
        else
            return Order::where('status', 'done')
        					->whereDate('created_at', Carbon::today())
                            ->where('driverID', \Auth::user()->id)
                            ->get();
    }

    public static function getPending()
    {
    	if(\Auth::user()->isAdmin())
            return Order::where('status', 'pending')
						//->whereDate('created_at', Carbon::today())
						->get();
        else
            return Order::where('status', 'pending')
        					//->whereDate('created_at', Carbon::today())
                            ->where('driverID', \Auth::user()->id)
                            ->get();
    }

}
