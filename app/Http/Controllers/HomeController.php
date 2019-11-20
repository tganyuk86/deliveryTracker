<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Stock;
use App\Location;

use Auth;

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
        $currentLocation = Location::where('status', 'on-route')->get();

        if(isset($currentLocation[0]))
        {
            $currentLocation = $currentLocation[0];

            $order = explode(', ', $currentLocation->order);
            $out = '';
            foreach($order as $o)
            {
                if($o == '') continue;
                $out .= "<li>$o</li>";
            }
            $currentLocation->order = $out;
        }
        else
            $currentLocation = false;



        $locations = Location::where('status', 'waiting')->get();
        $donelocations = Location::where('status', 'done')->get();

        foreach ($locations as $Location) 
        {
            $order = explode(', ', $Location->order);
            $out = '';
            foreach($order as $o)
            {
                if($o == '') continue;
                $out .= "<li>$o</li>";
            }
            $Location->order = $out;
        }

        foreach ($donelocations as $Location) 
        {
            $order = explode(', ', $Location->order);
            $out = '';
            foreach($order as $o)
            {
                if($o == '') continue;
                $out .= "<li>$o</li>";
            }
            $Location->order = $out;
        }

        return view('home',[
            'locations' => $locations, 
            'currentLocation' => $currentLocation, 
            'donelocations' => $donelocations,
            'stocks' => Stock::allSorted()
        ]);
    }

    public function updatePosition(Request $request)
    {

        Auth::user()->update([
            'lat' => $request['lat'],
            'lon' => $request['lon'],
        ]);
    }
    public function markDone($id)
    {

        $Location = Location::find($id);
        $Location->update(['status'=>'done']);
        activity()->on($Location)->log('Marked Done');

        return redirect()->back();
    }

    public function markOnRoute($id)
    {

        $Location = Location::find($id);
        $Location->update(['status'=>'on-route']);
        activity()->on($Location)->log('Marked On Route');

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
        foreach ($request['order'] as $stockID) 
        {
            $stock = Stock::find($stockID);
            $value += $stock->price;
            $order .= $stock->type()->name.' of '.$stock->product()->name.', ';
            $stock->reduceAvailable();
        }
        $new = Location::create([
            'lat' => $request['lat'],
            'lon' => $request['lon'],
            'called_at' => $request['called_at'],
            'value' => $value,
            'order' => $order,
            'phone' => $request['phone'],
            'name' => $request['address'],
        ]);
        activity()->on($new)->log('Order Added - '.$new->name);

        return redirect('newlocation');
    }

    public function gmaps()
    {
        $locations = Location::all();
        return view('map',compact('locations'));
    }
}
