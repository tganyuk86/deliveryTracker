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
                  @if($currentOrder)
                  <div class="row active">
                     <!--  <div class="col-md-2">


                      </div> -->
                      <div class="col-md-4">
                        {{$currentOrder->customer()->address}}<br>
                        <sup>{{$currentOrder->customer()->name}}<br>
                        {{$currentOrder->customer()->phone}}</sup>
                      </div>
                      <div class="col-md-4">
                        <ul>
                          {!! $currentOrder->order !!}
                          <li>Total: ${{$currentOrder->value}}</li>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        <a href="{{ route('mark.done', ['id' => $currentOrder->id]) }}" class="btn btn-outline-success">Done</a>
                        <a href="tel:{{ $currentOrder->phone }}" class="btn btn-outline-info">Call</a>
                        <a href="sms:{{ $currentOrder->phone }}&body=Hi" class="btn btn-outline-info">SMS</a>
                      </div>

                    </div>
                    @endif

                    <hr />
                    <hr />

                  @foreach($Orders as $Order)
                    <div class="row">
                     <!--  <div class="col-md-2">
                        {{ $Order->called_at}}

                      </div> -->
                      <div class="col-md-4">
						<!--<a href="maps://maps.google.com/maps?daddr={{$Order->lat}},{{$Order->lon}}&amp;ll=???">{{$Order->customer()->address}}</a>-->
						<a href="comgooglemaps://?daddr={{urlencode($Order->customer()->address.', toronto')}}&amp;ll=Here">{{$Order->customer()->address}}</a>
                        <br>
                        <sup>{{$Order->customer()->name}}<br>
                        {{$Order->customer()->phone}}</sup>
                      </div>
                      <div class="col-md-4">
                        <ul>
                          {!! $Order->order !!}
                          <li>Total: ${{$Order->value}}({{$Order->payType}})</li>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        <a href="{{ route('mark.done', ['id' => $Order->id]) }}" class="btn btn-outline-success">Done</a>
                        
                        <a href="tel:{{ $Order->phone }}" class="btn btn-outline-info">Call</a>
                        <a href="sms:{{ $Order->phone }}&body=Hi" class="btn btn-outline-info">SMS</a>
                      </div>

                    </div>
<hr />
                  @endforeach


                  @foreach($doneOrders as $Order)
                    <div class="row done" >
                      
                      <div class="col-md-4">
                        {{$Order->customer()->address}}<br>
                        <sup>{{$Order->customer()->name}}<br>
                        {{$Order->customer()->phone}}</sup>
                      </div>
                      <div class="col-md-4">
                        <ul>
                          {!! $Order->order !!}
                          <li>Total: ${{$Order->value}}</li>
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


                        var Orders = <?php print_r(json_encode($Orders)) ?>;


                        var mymap = new GMaps({
                          el: '#mymap',
                          lat: 43.6532,
                          lng: -79.3832,
                          zoom:10
                        });


                        $.each( Orders, function( index, value ){
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
