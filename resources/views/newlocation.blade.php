@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Map</div>

                <div class="card-body">

<form action="{{ route('savelocation') }}" method="post">
    
<input type="text" class="form-control" name="address" placeholder="Address">
<input type="button" class="form-control btn" id="getLocation" value="Fill">
<label>Called @</label>
<input type="time" class="form-control" name="called_at" value="{{ date("H:i:s") }}">
<hr >
<input type="text" class="form-control" name="lat">
<input type="text" class="form-control" name="lon">
@csrf
<input type="submit" class="form-control btn" name="" value="Save">
</form>

 <div id="mymap"></div>


                      <script type="text/javascript">


                        


                       

            $('#getLocation').click(function(){
                address = $('[name="address"]').val();

                var geocoder = new google.maps.Geocoder();

                geocoder.geocode({'address': address}, function(results, status) 
                {
                    console.log(address,results);

                    lat = results[0].geometry.location.lat();
                    lon = results[0].geometry.location.lng();
                    add = results[0].formatted_address;

                    city = '';
                    //results[0].address_components[2].long_name+', '+results[0].address_components[4].short_name;
                    $(results[0].address_components).each(function(){
                        console.log(this);
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

                    // $('[name="city"]').val(city);
                  // if (status === 'OK') {
                  //   resultsMap.setCenter(results[0].geometry.location);
                  //   var marker = new google.maps.Marker({
                  //     map: resultsMap,
                  //     position: results[0].geometry.location
                  //   });
                  // } else {
                  //   alert('Geocode was not successful for the following reason: ' + status);
                  // }
                });
            })


                      </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
