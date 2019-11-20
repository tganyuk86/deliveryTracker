@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Orders</div>

                <div class="card-body">
                  <!-- <div class="row">
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
                  </div> -->
                  @if($currentLocation)
                  <div class="row active">
                     <!--  <div class="col-md-2">


                      </div> -->
                      <div class="col-md-4">
                        {{$currentLocation->name}}
                      </div>
                      <div class="col-md-4">
                        <ul>
                          {!! $currentLocation->order !!}
                          <li>Total: ${{$currentLocation->value}}</li>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        <a href="{{ route('mark.done', ['id' => $currentLocation->id]) }}" class="btn btn-outline-success">Done</a>
                        <a href="tel:{{ $currentLocation->phone }}" class="btn btn-outline-info">Call</a>
                        <a href="sms:{{ $currentLocation->phone }}&body=Hi" class="btn btn-outline-info">SMS</a>
                      </div>

                    </div>
                    @endif

                    <hr />
                    <hr />

                  @foreach($locations as $location)
                    <div class="row">
                     <!--  <div class="col-md-2">
                        {{ $location->called_at}}

                      </div> -->
                      <div class="col-md-4">
                        {{$location->name}}
                      </div>
                      <div class="col-md-4">
                        <ul>
                          {!! $location->order !!}
                          <li>Total: ${{$location->value}}</li>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        @if(!$currentLocation)
                          <a href="{{ route('mark.onRoute', ['id' => $location->id]) }}" class="btn btn-outline-info">Start</a>
                        @endif
                        <a href="tel:{{ $location->phone }}" class="btn btn-outline-info">Call</a>
                        <a href="sms:{{ $location->phone }}&body=Hi" class="btn btn-outline-info">SMS</a>
                      </div>

                    </div>
<hr />
                  @endforeach


                  @foreach($donelocations as $location)
                    <div class="row done" >
                      
                      <div class="col-md-4">
                        {{$location->name}}
                      </div>
                      <div class="col-md-4">
                        <ul>
                          {!! $location->order !!}
                          <li>Total: ${{$location->value}}</li>
                        </ul>
                      </div>
                      <div class="col-md-2">

                      </div>

                    </div>

                  @endforeach


                      <script type="text/javascript">


                    

                      </script>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Stock</div>

                <div class="card-body">



                @foreach($stocks as $product => $data)
                    <h2>{{$product}}</h2>
                     <div class="row ">
                        @foreach($data as $type => $stock)
                          <div class="col-md-3">
                            {{$type}} (${{$stock->price}})
                          </div>
                        @endforeach
                      </div>
                @endforeach
                        
                       


                </div>
            </div>
        </div>
        <div class="col-md-6">
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
                        @if(!Auth::user()->isAdmin())
                            mymap.addMarker({
                              lat: {{ Auth::user()->lat }},
                              lng: {{ Auth::user()->lon }},
                              title: '{{ Auth::user()->name }}',
                              label: '{{ substr(Auth::user()->name, 0, 1) }}',
                              click: function(e) {
                                alert('This is a driver.');
                              }
                            });

                          @endif
                      </script>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            
        </div>

    </div>
</div>
@endsection
