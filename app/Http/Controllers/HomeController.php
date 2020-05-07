<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\Product;
use App\Stock;
use App\User;
use App\Order;
use App\OrderItem;

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
        $currentOrder = Order::getCurrent();

        if(isset($currentOrder[0]))
        {
            $currentOrder = $currentOrder[0];

            $order = explode(', ', $currentOrder->order);
            $out = '';
            foreach($order as $o)
            {
                if($o == '') continue;
                $out .= "<li>$o</li>";
            }
            $currentOrder->order = $out;
        }
        else
            $currentOrder = false;


        $Orders = Order::getWaiting();
        $doneOrders = Order::getDone();

        foreach ($Orders as $Order) 
        {
            $order = explode(', ', $Order->order);
            $out = '';
            foreach($order as $o)
            {
                if($o == '') continue;
                $out .= "<li>$o</li>";
            }
            $Order->order = $out;
        }

        foreach ($doneOrders as $Order) 
        {
            $order = explode(', ', $Order->order);
            $out = '';
            foreach($order as $o)
            {
                if($o == '') continue;
                $out .= "<li>$o</li>";
            }
            $Order->order = $out;
        }

        if(Auth::user()->isAdmin())
            $view = 'dispatch';
        else
            $view = 'home';
// dd($Orders);
        return view($view,[
            'Orders' => $Orders, 
            'currentOrder' => $currentOrder, 
            'doneOrders' => $doneOrders,
            'drivers' => User::all(),
            'stocks' => Stock::allActiveSorted()
        ]);
    }

    public function updatePosition(Request $request)
    {

        Auth::user()->update([
            'lat' => $request['lat'],
            'lon' => $request['lon'],
        ]);
    }

    public function assignDriver(Request $request)
    {
        $order = Order::find($request['orderID']);
// dump($request);
// dd($order);
        $order->update([
            'driverID' => $request['driverID']
        ]);
        
        return redirect('orders');
    }

    public function markOnRoute($id)
    {

        $Order = Order::find($id);
        $Order->update(['status'=>'on-route']);
        activity()->on($Order)->log('Marked On Route');

        return redirect()->back();
    }

    public function savePriority(Request $request)
    {

        foreach ($request['orders'] as $driverID => $orderlist) 
        {
            foreach ($orderlist as $priority => $orderID) 
            {
                Order::find($orderID)->update([
                    'priority' => $priority
                ]); 
            }
        }
        return redirect()->back();
    }
    public function performMove(Request $request)
    {
        // dd($request);

        foreach ($request['amount'] as $productID => $amount) 
        {
            $amount = intval($amount);
            if($amount == 0) continue;

            $product = Product::find($productID);

            $product->moveStock($request['destination'], $amount);
            
        }

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

    public function Orders()
    {
        // $data = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=40.6655101,-73.89188969999998&destinations=40.6905615%2C-73.9976592&key=AIzaSyAkfSv50NPZZJJ25fuuwFE8cWI_TMFqqJc'));

        // dd($data);
        $Orders = Order::getWaiting();
        $doneOrders = Order::getDone();

        return view('orders', [
            'orders' => $Orders,
            'doneOrders' => $doneOrders,
            'drivers' => User::drivers(),
        ]);
    }
    public function OrdersFor($driverID)
    {

        // dd($data);
        $Orders = Order::where('driverID', $driverID)->get();

        $numOrders = count($Orders);
        $orderNum = 0;

        while(isset($Orders[$orderNum+1]))
        {
            $source = "{$Orders[$orderNum]->lat},{$Orders[$orderNum]->lon}";
            $destination = "{$Orders[$orderNum+1]->lat}%2C{$Orders[$orderNum+1]->lon}";
            $data = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins={$source}&destinations={$destination}&key=AIzaSyAkfSv50NPZZJJ25fuuwFE8cWI_TMFqqJc'));
            $Orders[$orderNum+1]->distance = 
            $orderNum++;
        }

        return view('orders', ['orders' => $Orders]);
    }

    public function Customers()
    {
        $Customers = Customer::all();

        return view('customers', ['Customers' => $Customers]);
    }

    public function stock()
    {
        return view('stock', [ 'stocks' => Stock::allActive()->sortByDesc('id') ]);

    }

    public function allstock()
    {
        return view('allstock', [ 
            'products' => Product::allActive(),
            'drivers' => User::drivers(),

        ]);

    }
    public function movestock()
    {
        return view('movestock', [ 
            'products' => Product::allActive(),
            'drivers' => User::drivers(),

        ]);

    }
    public function newOrder()
    {
        $products = Stock::allActiveSorted();
        
        return view('neworder', [ 'products' => $products, 'customer' => new Customer() ]);
    }
    public function newOrderFor($customerID)
    {
        $products = Stock::allActiveSorted();
        
        return view('neworder', [ 'products' => $products, 'customer' => Customer::find($customerID)]);
    }

    public function saveOrder(Request $request)
    {
        // dd($request);
        $value = 0;
        $order = '';
        $dfee = 0;
        foreach ($request['order'] as $stockID => $data) 
        {
            $stock = Stock::find($stockID);

            if($stock->type()->id != 5)
            {
                $value += $stock->price;
                $order .= $stock->type()->name.' of ';
            }
            else
            {

            
                $order .= $request['orderquantity'][$stockID].'x ';
                $value += $stock->price*$request['orderquantity'][$stockID];
            }
            $order .= $stock->product()->name.', ';
            // $stock->reduceAvailable();
        }

        $customer = Customer::firstOrCreate([
            'name' => $request['name'],
            'phone' => $request['phone'],
            'address' => $request['address'],
        ]);

        if($request['deliveryFee'] == 'auto')
        {
            if($value < 100)
            {
                $value += 5;
                $dfee = 1;
            }
        }elseif($request['deliveryFee'] == '1')
        {
            $value += 5;
            $dfee = 1;
        }
		
		if($request['orderTotal'] > '0')
		{
			$value = $request['orderTotal'];
		}

        $new = Order::create([
            'lat' => $request['lat'],
            'lon' => $request['lon'],
            'value' => $value,
            'order' => $order,
            'dfee' => $dfee,
            'phone' => $request['phone'],
            'address' => $request['address'],
            'payType' => $request['payType'],
            'customerID' => $customer->id

        ]);
        activity()->on($new)->log('Order Added - '.$customer->name);

        foreach ($request['order'] as $stockID => $data) 
        {
            // $stock = Stock::find($stockID);
            $updatedata = [
                'stockID' => $stockID,
                'orderID' => $new->id
            ];

            if(isset($request['orderquantity'][$stockID]))
                $updatedata['quantity'] = $request['orderquantity'][$stockID];
            OrderItem::create($updatedata);
            
        }

        return redirect('neworder');
    }


    public function cancelOrder($id)
    {

    }

    public function markDone($id)
    {

        $Order = Order::find($id);
        $Order->update(['status'=>'done']);
        $driver = $Order->driver();
        foreach ($Order->items() as $item) 
        {
// dd($item);
            $item->reduceAvailable($driver->id);
            // $prodStock = ProductStock::where('driverID', $driver->id)
            //                          ->where('productID', $item->productID)
            //                          ->get();

            // $prodStock->amount -= $item->amount;
            // $prodStock->save();
        }
        activity()->on($Order)->log('Marked Done');

        return redirect()->back();
    }

    public function showAssign($OrderID)
    {
        return view('assign', [
            'drivers' => User::drivers(),
            'order' => Order::find($OrderID)
        ]);
    }

    // public function assign(Request $request)
    // {
    //     $order = Order::find($request['orderID']);
    //     $order->driverID = $request['driverID'];
    //     $order->save();

    //     return redirect('orders');
    // }
	
	
	public function report()
	{
		return view('report');

	}
	
	public function loadReport(Request $request)
	{
		
		$orders = Order::whereDate('created_at', '=', $request['repDate'])->get();
		$total = 0;
		$totalCash = 0;
		$totalemt = 0;
		$totalOrders = 0;
		
		foreach($orders as $order)
		{
			$totalOrders++;
			if($order->payType == 'cash')
			{
				$totalCash += $order->value;
			}else{
				$totalemt += $order->value;
			}
			
			$total += $order->value;
			
		}
		
		return view('loadreport', [
			'orders' => $orders,
			'totalCash' => $totalCash,
			'totalOrders' => $totalOrders,
			'total' => $total,
			'totalemt' => $totalemt
			]);
	}

    public function gmaps()
    {
        $Orders = Order::all();
        return view('map',compact('Orders'));
    }
}
