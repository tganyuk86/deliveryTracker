@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
			
			<div class="card">
                <div class="card-header">Report</div>

                <div class="card-body">

					<h2>Num of Orders: {{$totalOrders}}</h2>
                    <h2>Total: {{$total}}</h2>
					<h2>Cash: {{$totalCash}}</h2>
					<h2>E-Transfer: {{$totalemt}}</h2>

					Orders:
					
					<table id="table-1" cellspacing="0" cellpadding="2" width="100%">

                    @foreach($orders as $order)
                      <tr id="{{$order->id}}">
                        <td>{{$order->customer()->address}}<br>
                          <sup>{{ $order->created_at->diffForHumans() }}<sup>
                        </td>
                        <td>
                          {{$order->customer()->name}}
                        </td>
                        <td>
                          {{$order->order}}
                        </td>
                        <td>
                          {{$order->value}}
                        </td>
                        <td>
                          <button type="button" class="btn btn-primary assignDriver" data-orderid="{{$order->id}}" data-toggle="modal" data-target="#assignDriver">
                            {{ $order->driver()->isAdmin() ? 'Unassigned' : $order->driver()->name}}
                          </button>

                          <button type="button" class="btn btn-primary up" data-direction="up">Up</button>
                          <button type="button" class="btn btn-primary down" data-direction="down">Down</button>

                          <!-- <input type="hidden" name="orders[]" value="{{$order->id}}"> -->
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
