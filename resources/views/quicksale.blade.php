@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Info</div>

                <div class="card-body">

                    <form action="{{ route('saveQuickSale') }}" method="post">
                    <label>Customer</label>
                    <select name="customerID" class="form-control">
                    	<option value="0">General</option>
                    	@foreach($Customers as $customer)
                    	<option value="{{$customer->id}}">{{$customer->name}}</option>
                    	@endforeach
                    </select>

                     <label>Payment Type</label>
                     <select class="form-control" name="payType" required>
					 <option value="" >Choose...</option>
                       <option value="cash">Cash</option>
                       <option value="emt">E-Transfer</option>
                     </select>
                    
                    <label>Order</label>
                    @foreach($products as $cat => $prods)
                    {{$cat}}
                    @foreach($prods as $prod => $row)

                    <div class="accordion" id="accordionExample">
					  <div class="card">
					    <div class="card-header" id="headingOne">
					      <h2 class="mb-0">
					        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$loop->iteration}}{{$loop->parent->iteration}}" aria-expanded="true" aria-controls="collapseOne">
					          {{$prod}}
					        </button>
					      </h2>
					    </div>

					    <div id="collapse{{$loop->iteration}}{{$loop->parent->iteration}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
					      <div class="card-body">
						@foreach($row as $type => $data)
                        <div class="row" style="color: {{$data->isAvailable(0) ? 'green' : 'red'}}" >
							<div class="col-md-1">
							  <input 		 type="checkbox" 
											 name="order[{{$data->id}}]" 
											value="{{$data->id}}" 
											class="" 
									  data-toggle="popover"
									  data-action="calcTotal"								  
									 data-content="${{ $data->price }}"  
									   data-value="{{ $data->price }}" 
									   data-product-id="{{ $data->product()->id }}" 
							  />
							
							</div>
							<div class="col-md-4">
							
							  {{$type}}
							 </div>
							 <div class="col-md-1">
								X
							 </div>
							<div class="col-md-4">
                         
								<input type="number" name="orderquantity[{{$data->id}}]" value="1">
                          
							</div>
                        </div>

                      @endforeach
					  Value:
					  <input type="text" value="0" name="ordervalue[{{$data->product()->id}}]" />
					  
					      </div>
					    </div>
					  </div>
					</div>
                      
                    @endforeach
                    @endforeach
                    <br />
                    @csrf
					
					<label>Assigne to</label>
					<select name="driverID" class="form-control" required>
						<!-- <option value='' >Choose Driver</option> -->
						<option value='0' >House</option>
						@foreach(Auth::user()->drivers() as $driver)
						  <option value="{{$driver->id}}">{{$driver->name}}</option>
						@endforeach
					</select>
					  
                    <input type="submit" class="form-control btn btn-info staticButton" name="" value="Save">
                    </form>


                      
                </div>
            </div>
        </div>
       
    </div>
</div>


<script type="text/javascript">
$(function () {
  $('[data-toggle="popover"]').popover({
	trigger: 'hover'
  })
});

$(document).ready(function(){
  
  
  $('[data-action="calcTotal"]').on("click", function() {
	  id = $(this).data('product-id');
	  price = parseInt($(this).data('value'));
	  
	  //curPrice = parseInt($('[name="ordervalue['+id+']"').val());
	  orderquantity = parseInt($('[name="orderquantity['+$(this).val()+']"').val());
	  if(!isNaN(orderquantity))
		  price *= orderquantity;
	  $('[name="ordervalue['+id+']"').val(price);
	  
  });
});



</script>
                    
@endsection
