@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
			
			<div class="card">
                <div class="card-header">Report for {{$date}}</div>

                <div class="card-body">

					<h2>Num of Orders: {{$totalOrders}}</h2>
                    <h2>Total: ${{$total}}</h2>
					<h2>Cash: ${{$totalCash}}</h2>
					<h2>E-Transfer: ${{$totalemt}}</h2>
					<h2>Total Delivery Fee: ${{$totalDFee}}</h2>

					Orders:
					
					<table id="table-1" cellspacing="0" cellpadding="2" width="100%">

                    @foreach($orders as $order)
                      <tr id="{{$order->id}}">
                        <td>{{$order->customer()->address}}<br>
                          
                        </td>
                        <td>
                          {{$order->order}}
                        </td>
                        <td>
                          ${{$order->value}}({{$order->payType}})
                        </td>
                        <td>
                          <a href='/admin/orders/{{$order->id}}/edit'>Edit</a>
                        </td>
						<td>
							<sup>Delivered in {{ $order->updated_at->diffInMinutes($order->created_at) }} Minutes</sup>
						</td>
                       
                      </tr>
                    @endforeach
					
					</table>
                      
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript"></script>
@endsection
