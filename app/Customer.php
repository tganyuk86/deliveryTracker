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
	
	
	public function sendSMS($message)
	{
		$method = "sendSMS";

		$did = '6478128291';
		$dst = $this->phone;
		if(substr($dst,0,2) == '+1') $dst = substr($dst,2,10);
		if(substr($dst,0,1) == '1') $dst = substr($dst,1,10);
		
		$url = "https://voip.ms/api/v1/rest.php?api_username=".env('VOIP_USER')."&api_password=".env('VOIP_PASS')."&method=".$method."&did=".$did."&dst=".$dst."&message=".$message;
		//dump($url);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		curl_close($ch);

		$response=json_decode($result,true);

		/* Get Errors - Invalid_Client */
		if($response['status']!='success'){
			dd($response['status']);
			
		}

	}
}
