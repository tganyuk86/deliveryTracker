@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Map</div>

                <div class="card-body">


                      <div class="myMap" id="mymap"></div>




                      <script type="text/javascript">


                        var locations = <?php print_r(json_encode($locations)) ?>;


                        var mymap = new GMaps({
                          el: '#mymap',
                          lat: 43.6532,
                          lng: -79.3832,
                          zoom:10
                        });


                        $.each( locations, function( index, value ){
                            mymap.addMarker({
                              lat: value.lat,
                              lng: value.lon,
                              title: value.name,
                              click: function(e) {
                                alert('This is '+value.name+'.');
                              }
                            });
                       });


                      </script>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Map</div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      Called @
                    </div>
                    <div class="col-md-4">
                      Name
                    </div>
                    <div class="col-md-4">
                      Order
                    </div>
                    <div class="col-md-2">
                      Value
                    </div>
                  </div>

                  @foreach($locations as $location)
                    <div class="row">
                      <div class="col-md-2">
                        {{ $location->called_at }}

                      </div>
                      <div class="col-md-4">
                        {{$location->name}}
                      </div>
                      <div class="col-md-4">
                        {{$location->order}}
                      </div>
                      <div class="col-md-2">
                        {{$location->value}}
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
@endsection
