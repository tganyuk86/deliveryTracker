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

                  @foreach($locations as $location)
                    <div class="row">
                      <div class="col-md-2">
                        {{ $location->called_at}}

                      </div>
                      <div class="col-md-4">
                        {{$location->name}}
                      </div>
                      <div class="col-md-4">
                        {{$location->order}}(${{$location->value}})
                      </div>
                      <div class="col-md-2">
                        <a href="{{ route('mark.done', ['id' => $location->id]) }}">Done</a>
                      </div>

                    </div>

                  @endforeach
<hr />

                  @foreach($donelocations as $location)
                    <div class="row done" >
                      <div class="col-md-2">
                        {{ $location->called_at}}

                      </div>
                      <div class="col-md-4">
                        {{$location->name}}
                      </div>
                      <div class="col-md-4">
                        {{$location->order}}(${{$location->value}})
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



                    <div class="row justify-content-center">
                        <div class="col-md-4">Product</div>
                        <div class="col-md-4">Type</div>
                        <div class="col-md-4">Price</div>
                    </div>

                @foreach($stocks as $stock)
                    <input type="hidden" name="stock[{{$stock->id}}][id]" value="{{$stock->id}}">
                     <div class="row justify-content-center">
                        <div class="col-md-4">
                            <select class="form-control" name="stock[{{$stock->id}}][productID]">
                                <option value="0">REMOVE</option>
                                @foreach($stock->products() as $prod)
                                    <option value="{{$prod->id}}" {{$prod->id == $stock->productID ? 'selected' : '' }} >{{$prod->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="stock[{{$stock->id}}][typeID]">
                                @foreach($stock->types() as $prod)
                                    <option value="{{$prod->id}}" {{$prod->id == $stock->typeID ? 'selected' : '' }} >{{$prod->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-4">
                            <input type="text" name="stock[{{$stock->id}}][price]" value="{{ $stock->price }}" >
                        </div>
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
