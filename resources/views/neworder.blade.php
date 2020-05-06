@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Info</div>

                <div class="card-body">

                    <form action="{{ route('saveorder') }}" method="post">
                        
                    <input type="text" class="form-control" name="address" placeholder="Address" value="{{$customer->address}}">
                    
                     <!-- <label>Phone</label> -->
                    <input type="text" class="form-control" name="phone" value="{{$customer->phone}}" placeholder="Phone">
                    
                     <!-- <label>Name</label> -->
                    <input type="text" class="form-control" name="name" value="{{$customer->name}}" placeholder="Name">
                    <input type="button" class="form-control btn btn-info" id="getorder" value="Fill">
                    
                     <label>Delivery fee</label>
                     <select class="form-control" name="deliveryFee">
                       <option value="auto">Auto</option>
                       <option value="1">Yes</option>
                       <option value="0">No</option>
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
                    <label>Lat/Lon</label>
                    <input type="hidden" name="lat">
                    <input type="hidden" name="lon">
                    @if($customer->id)
                      <input type="hidden" name="customerID" value="{{$customer->id}}">
                    @endif

                    @csrf
                    <input type="submit" class="form-control btn btn-info" name="" value="Save">
                    </form>


                      
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Map</div>

                <div class="card-body">

                   

                     <div id="address"></div>
                     <div class="myMap" id="mymap"></div>
                     <div class="myMap" id="mymap-out"></div>


                      
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
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
                    $('[name="address"]').val(add);
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