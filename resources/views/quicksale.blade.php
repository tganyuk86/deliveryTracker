@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Info</div>

                <div class="card-body">

                    <form action="{{ route('saveQuickSale') }}" method="post">
                        
                    <select name="customerID">
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
					        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$prod}}" aria-expanded="true" aria-controls="collapseOne">
					          {{$prod}}
					        </button>
					      </h2>
					    </div>

					    <div id="collapse{{$prod}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
					      <div class="card-body">
						@foreach($row as $type => $data)
                        <div class="row" style="color: {{$data->isAvailable(5) ? 'green' : 'red'}}" >
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
					  
                    <input type="submit" class="form-control btn btn-info" name="" value="Save">
                    </form>


                      
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Map</div>

                <div class="card-body">

                   

                     <div id="address"></div>
                     <div class="myMap" id="mymap"></div>
                     <div class="myMap" id="mymap-out"></div>


                      
                </div>
            </div>
        </div>
		
		<div class="col-md-4">
            <div class="card">
                <div class="card-header">Customers</div>

                <div class="card-body">
                  

                  @foreach($Customers as $customer)
                    <div class="row filtered ">
                      <div class="col-md-4">
                        {{$customer->name}}<br>
                        <sup>{{$customer->phone}}</sup>
                      </div>
                      <div class="col-md-8 alignRight">
					<a href="/neworder/{{$customer->id}}" class="">
					  {{$customer->address}}<br>
                       <sup> {{count($customer->orders())}} Orders</sup>
					  </a>
                      </div>
                     
                    </div>

                  @endforeach


                      <script type="text/javascript">


                    

                      </script>
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
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".filtered").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  
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


            $('#getorder').click(function(){
                address = $('[name="address"]').val();

                var geocoder = new google.maps.Geocoder();

                geocoder.geocode({'address': address}, function(results, status) 
                {
                    console.log(address,results);

                    lat = results[0].geometry.location.lat();
                    lon = results[0].geometry.location.lng();
                    addFull = results[0].formatted_address;
                    add = results[0].address_components[0].long_name+' '+results[0].address_components[1].short_name;

                    city = '';
                    //results[0].address_components[2].long_name+', '+results[0].address_components[4].short_name;
                    $(results[0].address_components).each(function(){
                        // console.log(this);
                        if(this.types.includes('locality'))
                        {
                            city += this.long_name;
                        }
                        if(this.types.includes('administrative_area_level_1'))
                        {
                            city += ', '+this.short_name;
                        }
                    });

                    $('[name="lat"]').val(lat);
                    $('[name="lon"]').val(lon);
                    $('[name="locationID"]').val(results[0].place_id);
                    $('[name="address"]').val(add+', '+city);
                    $('#address').html(addFull);
                    
                    var mymap = new GMaps({
                          el: '#mymap',
                          lat: lat,
                          lng: lon,
                          zoom:15
                        });

                    mymap.addMarker({
                              lat: lat,
                              lng: lon,
                              title: address,
                              click: function(e) {
                                // alert('This is '+value.name+'.');
                              }
                            });

                    var mymap2 = new GMaps({
                          el: '#mymap-out',
                          lat: lat,
                          lng: lon,
                          zoom:10
                        });

                    mymap2.addMarker({
                              lat: lat,
                              lng: lon,
                              title: address,
                              click: function(e) {
                                // alert('This is '+value.name+'.');
                              }
                            });

                    // $('[name="city"]').val(city);
                  // if (status === 'OK') {
                  //   resultsMap.setCenter(results[0].geometry.order);
                  //   var marker = new google.maps.Marker({
                  //     map: resultsMap,
                  //     position: results[0].geometry.order
                  //   });
                  // } else {
                  //   alert('Geocode was not successful for the following reason: ' + status);
                  // }
                });
            });

            @if($customer->id)
                $('#getorder').trigger('click');
            @endif

</script>
                      </script>
@endsection
