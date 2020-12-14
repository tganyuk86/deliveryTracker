<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\Product;
use App\ProductStock;
use App\Stock;
use App\Purchases;
use App\User;
use App\Order;
use App\OrderItem;
use App\Balance;

use Auth;

class VoipController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
	}
	
	public function testVoip()
	{
		
		
		$method = "sendSMS";

		$did = '6478128291';
		$dst = '4169907119';
		$message = 'test';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_URL, 
			"https://voip.ms/api/v1/rest.php?api_username=".env('VOIP_USER')."&api_password=".env('VOIP_PASS')."&method=".$method."&did=".$did."&dst=".$dst."&message=".$message);
		$result = curl_exec($ch);
		curl_close($ch);

		$response=json_decode($result,true);

		/* Get Errors - Invalid_Client */
		if($response[status]!='success'){
			echo $response[status];
			exit;
		}

		/* Get Clients Array */
		$clients = $response[clients];
		dd($clients);
	}
}
