<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Stock;
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
        $locations = Location::where('status', 'waiting')->get();
        $donelocations = Location::where('status', 'done')->get();

        return view('home',[
            'locations' => $locations, 
            'donelocations' => $donelocations,
            'stocks' => Stock::all()
        ]);
    }

    public function markDone($id)
    {
        $Location = Location::find($id);
        $Location->update(['status'=>'done']);

        return redirect()->back();
    }

    public function savestock(Request $request)
    {
        // dd($request);

        foreach($request['stock'] as $row)
        {
            $stock = Stock::find($row['id']);

            if($row['productID'] == 0)
                $stock->delete();
            else
                $stock->update([
                    'productID' => $row['productID'],
                    'typeID' => $row['typeID'],
                    'price' => $row['price'],
                ]);
        }

        if($request['productID'])
        {
            Stock::create([
                'productID' => $request['productID'],
                'typeID' => $request['typeID'],
                'price' => $request['price'],
            ]);
        }

        return redirect('stock');

    }

    public function locations()
    {
        $locations = Location::all();

        return view('locations', ['locations' => $locations]);
    }

    public function stock()
    {
        return view('stock', [ 'stocks' => Stock::all() ]);

    }
    public function newlocation()
    {
        $products = Stock::all();
        foreach($products as $p)
        {
            $out[$p->product()->name][$p->type()->name] = $p;
        }
        return view('newlocation', [ 'products' => $out]);
    }

    public function savelocation(Request $request)
    {
        $value = 0;
        $order = '';
        foreach ($request['order'] as $stockID) {
            $stock = Stock::find($stockID);
            $value += $stock->price;
            $order .= $stock->type()->name.' of '.$stock->product()->name.', ';
        }
        Location::create([
            'lat' => $request['lat'],
            'lon' => $request['lon'],
            'called_at' => $request['called_at'],
            'value' => $value,
            'order' => $order,
            'name' => $request['address'],
        ]);
        return redirect('newlocation');
    }

    public function gmaps()
    {
        $locations = Location::all();
        return view('map',compact('locations'));
    }
}
