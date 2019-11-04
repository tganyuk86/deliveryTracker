<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;

class HomeController extends Controller
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
        return view('home');
    }

    public function locations()
    {
        $locations = Location::all();

        return view('locations', ['locations' => $locations]);
    }

    public function newlocation()
    {
        return view('newlocation');
    }

    public function savelocation(Request $request)
    {
        Location::create([
            'lat' => $request['lat'],
            'lon' => $request['lon'],
            'called_at' => $request['called_at'],
            'value' => $request['value'],
            'name' => $request['address'],
        ]);
        return redirect('locations');
    }

    public function gmaps()
    {
        $locations = Location::all();
        return view('map',compact('locations'));
    }
}
