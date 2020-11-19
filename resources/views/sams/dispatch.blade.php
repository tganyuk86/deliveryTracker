@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Orders</div>

                <div class="card-body">
                 

                  @foreach($Orders as $key => $Order)
                    <div class="row">
                     <!--  <div class="col-md-2">
                        {{ $Order->called_at}}

                      </div> -->
                      <div class="col-md-4">
                        <b>#{{$key++}}: {{$Order->customer()->name}}</b><br>
                        <sup>{{ $Order->created_at->diffForHumans() }}<sup>
                      </div>
                      <div class="col-md-4">
                        <ul>
                          {!! $Order->order !!}
                          <li>Total: ${{$Order->outstanding}}({{$Order->payType}})</li>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        
                        <button type="button" class="btn btn-primary assignDriver" data-orderid="{{$Order->id}}" data-toggle="modal" data-target="#assignDriver">
                          {{ $Order->driver()->isAdmin() ? 'House' : $Order->driver()->name}}
                        </button>
                        <!-- <a href="{{ route('editOrder', $Order->id) }}">
                          <button type="button" class="btn btn-warning editOrder" data-orderid="{{$Order->id}}">
                            Edit
                          </button>
                        </a>

                        <button type="button" class="btn btn-danger cancelOrder" data-orderid="{{$Order->id}}">
                          Cancel
                        </button> 
						<a href="{{ route('mark.done', ['id' => $Order->id]) }}" class="btn btn-success">Done</a>
						-->
						<a href="#" class="btn btn-outline-success doneButton" data-oid="{{$Order->id}}">Done</a>
						<a href="/admin/orders/{{$Order->id}}/edit" class="btn btn-warning">Edit</a>
						<a href="{{ route('cancelOrder', ['id' => $Order->id]) }}" class="btn btn-danger">Cancel</a>

                      </div>
					  
						<form action="{{ route('updateOrder') }}" method="post">
					  <div class="row doneInfo doneInfo-{{$Order->id}}">
							@csrf
							<input type="hidden" name="orderID" value="{{ $Order->id }}" />
							<div class="col-md-4">
							<select name="payType" class="form-control">
								<option value="cash" {{ $Order->payType == 'cash' ? 'selected' : '' }} >Cash</option>
								<option value="emt" {{ $Order->payType == 'emt' ? 'selected' : '' }} >E-Transfer</option>
							</select>
							</div>
							<div class="col-md-4">
							<select name="status" class="form-control">
								<option value="waiting" {{ $Order->status == 'waiting' ? 'selected' : '' }} >Waiting</option>
								<option value="pending" {{ $Order->status == 'pending' ? 'selected' : '' }} >Pending Payment</option>
								<option value="done" {{ $Order->status == 'done' ? 'selected' : '' }} >Done</option>
							</select>
							</div>
							<div class="col-md-4">
							<input type="number" name="outstanding" value="{{ $Order->outstanding }}" class="form-control" />
							</div>
							<div class="col-md-4">
							<textarea name="customerNotes" placeholder="Customer Notes" class="form-control" >{{ $Order->customer()->notes }}</textarea>
							</div>
							<button class="btn btn-success" >Finish</button>
							
						</div>
						</form>
                    </div>

				<hr />
                  @endforeach


                  @foreach($pendingOrders as $Order)
                    <div class="row pending" >
                      
                      <div class="col-md-4">
                        {{$Order->customer()->name}}
                        <sup>{{ $Order->created_at->diffForHumans() }}<sup>
                      </div>
                      <div class="col-md-4">
                        <ul>
                          {!! $Order->order !!}
                          <li>Total: ${{$Order->outstanding}}({{$Order->payType}})</li>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        
                      	<a href="#" class="btn btn-outline-success doneButton" data-oid="{{$Order->id}}" >Done</a>

						<!-- <a href="{{ route('mark.done', ['id' => $Order->id]) }}" class="btn btn-success">Done</a> -->
						<a href="/admin/orders/{{$Order->id}}/edit" class="btn btn-warning">Edit</a>
						<a href="{{ route('cancelOrder', ['id' => $Order->id]) }}" class="btn btn-danger">Cancel</a>

                      </div>

                    </div>
					
					<form action="{{ route('updateOrder') }}" method="post">
						<div class="row doneInfo doneInfo-{{$Order->id}}">
							@csrf
							<input type="hidden" name="orderID" value="{{ $Order->id }}" />
							<div class="col-md-4">
							<select name="payType" class="form-control">
								<option value="cash" {{ $Order->payType == 'cash' ? 'selected' : '' }} >Cash</option>
								<option value="emt" {{ $Order->payType == 'emt' ? 'selected' : '' }} >E-Transfer</option>
							</select>
							</div>
							<div class="col-md-4">
							<select name="status" class="form-control">
								<option value="waiting" {{ $Order->status == 'waiting' ? 'selected' : '' }} >Waiting</option>
								<option value="pending" {{ $Order->status == 'pending' ? 'selected' : '' }} >Pending Payment</option>
								<option value="done" {{ $Order->status == 'done' ? 'selected' : '' }} >Done</option>
							</select>
							</div>
							<div class="col-md-4">
							<input type="number" name="outstanding" value="{{ $Order->outstanding }}" class="form-control" />
							</div>
							<div class="col-md-4">
							<textarea name="customerNotes" placeholder="Customer Notes" class="form-control" >{{ $Order->customer()->notes }}</textarea>
							</div>
							<button class="btn btn-success" >Finish</button>
							
						</div>
					</form> 
					
					<div class="row done" >
						<div class="col-md-12">{{$Order->notes}}</div>
					</div>
					<div class="row done" >
						<div class="col-md-12">{{$Order->customer()->notes}}</div>
					</div>

                  @endforeach
                  @foreach($doneOrders as $Order)
                    <div class="row done" >
                      
                      <div class="col-md-4">
                        {{$Order->customer()->address}}
                        <sup>{{$Order->customer()->name}}</sup>
                        <sup>{{$Order->customer()->phone}}</sup>
                        <sup>{{ $Order->created_at->diffForHumans() }}<sup>
                      </div>
                      <div class="col-md-4">
                        <ul>
                          {!! $Order->order !!}
                          <li>Total: ${{$Order->value}}({{$Order->payType}})</li>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        
                      
						<a href="/admin/orders/{{$Order->id}}/edit" class="btn btn-warning">Edit</a>
						<a href="{{ route('cancelOrder', ['id' => $Order->id]) }}" class="btn btn-danger">Cancel</a>

                      </div>

                    </div>
					
					
					
						
					<div class="row done" >
						<div class="col-md-12">{{$Order->notes}}</div>
					</div>
					<div class="row done" >
						<div class="col-md-12">{{$Order->customer()->notes}}</div>
					</div>

                  @endforeach


                  <script type="text/javascript">
                    $('.doneInfo').hide();
                   
                    $('.doneButton').on('click', function(){
                      //$(this).parent().parent().find('.doneInfo').show(); 
                      id = $(this).data('oid');
                      $('.doneInfo-'+id).show();
                    });

                

                  </script>
                </div>
            </div>
            
        </div>
        
    </div>
</div>


@endsection
