<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Balance extends Model
{
	protected $fillable = [
        'value', 'note'
    ];
	
    protected $table = 'Balance';
	
	public static function balance()
	{
		return Balance::all()->latest()->first()->value;
	}
	
	public static function add($amount, $note)
	{
		$value = Balance::balance();
		Balance::insert([
			'value' => $value+$amount,
			'note' => $note
		]);
	}
}
