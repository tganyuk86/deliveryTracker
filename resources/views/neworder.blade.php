@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Info</div>

                <div class="card-body">

                    <form action="{{ route('saveorder') }}" method="post">
                        
                    <input type="text" class="form-control" name="address" placeholder="Address" value="{{$customer->address}}" id="myInput">
                    
                     <!-- <label>Phone</label> -->
                    <input type="text" class="form-control" name="phone" value="{{$customer->phone}}" placeholder="Phone"  required>
                    
                     <!-- <label>Name</label> -->
                    <input type="text" class="form-control" name="name" value="{{$customer->name}}" placeholder="Name"  required>
                    <input type="button" class="form-control btn btn-info" id="getorder" value="Fill">
                    
                     <label>Delivery fee</label>
                     <select class="form-control" name="deliveryFee">
                       <option value="auto">Auto</option>
                       <option value="1">Yes</option>
                       <option value="0">No</option>
                     </select>
					 
					 
                     <label>Payment Type</label>
                     <select class="form-control" name="payType" required>
					 <option value="" >Choose...</option>
                       <option value="cash">Cash</option>
                       <option value="emt">E-Transfer</option>
                     </select>
                    
                    <label>Order</label>
                    @foreach($products as $prod => $row)
                      <h3>{{ $prod }}</h3>
                      @foreach($row as $type => $data)
                        <span>
                          {{$type}}
                          <input type="checkbox" name="order[{{$data->id}}]" value="{{$data->id}}" class="" />
                          @if($type == 'Single Pack')
                          <input type="number" name="orderquantity[{{$data->id}}]" value="1">
                          @endif
                        </span>

                      @endforeach
                    @endforeach
                    <br />
                    <label>Order Notes</label>
                    <textarea class="form-control" name="orderNotes"></textarea>

					
                    <br />
                    <label>Order Total</label>
                    <input type='number' class="form-control" name="orderTotal" value="0" />


                    <label>Customer Notes</label>
                    <textarea class="form-control" name="customerNotes">{{$customer->notes}}</textarea>

                    <hr >
                    
                    <input type="hidden" name="locationID">
                    <input type="hidden" name="lat">
                    <input type="hidden" name="lon">
                    @if($customer->id)
                      <input type="hidden" name="customerID" value="{{$customer->id}}">
                    @endif

                    @csrf
					
					<label>Assigne to</label>
					<select name="driverID" class="form-control" required>
						<option value='' >Choose Driver</option>
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
                    <div class="row filtered">
                      <div class="col-md-4">
                        {{$customer->address}}<br>
                        <sup>{{$customer->phone}}</sup>
                      </div>
                      <div class="col-md-4">
                        {{count($customer->orders())}}
                      </div>
                      <div class="col-md-4">
<a href="/neworder/{{$customer->id}}"><button>Go</button></a>
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

$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".filtered").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
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
