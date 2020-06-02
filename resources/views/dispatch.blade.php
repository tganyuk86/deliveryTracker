@extends('layouts.app')

@section('content')
<div class="container-fluid">
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
                 

                  @foreach($Orders as $key => $Order)
                    <div class="row">
                     <!--  <div class="col-md-2">
                        {{ $Order->called_at}}

                      </div> -->
                      <div class="col-md-4">
                        <b>#{{$key++}}:</b><br>
                        {{$Order->customer()->address}}<br>
                        <sup>{{$Order->customer()->name}}</sup>
                        <sup>{{$Order->customer()->phone}}</sup>
                        <sup>{{ $Order->created_at->diffForHumans() }}<sup>
                      </div>
                      <div class="col-md-4">
                        <ul>
                          {!! $Order->order !!}
                          <li>Total: ${{$Order->value}}</li>
                        </ul>
                      </div>
                      <div class="col-md-4">
                        
                        <button type="button" class="btn btn-primary assignDriver" data-orderid="{{$Order->id}}" data-toggle="modal" data-target="#assignDriver">
                          {{ $Order->driver()->isAdmin() ? 'Unassigned' : $Order->driver()->name}}
                        </button>
                        <!-- <a href="{{ route('editOrder', $Order->id) }}">
                          <button type="button" class="btn btn-warning editOrder" data-orderid="{{$Order->id}}">
                            Edit
                          </button>
                        </a>

                        <button type="button" class="btn btn-danger cancelOrder" data-orderid="{{$Order->id}}">
                          Cancel
                        </button> -->
						<a href="{{ route('mark.done', ['id' => $Order->id]) }}" class="btn btn-outline-success">Done</a>
						<a href="/admin/orders/{{$Order->id}}/edit"><button>Edit</button></a>

                      </div>

                    </div>
<hr />
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
                        </ul>
                      </div>
                      <div class="col-md-2">
                          ${{$Order->value}}

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
                          zoom:11
                        });

						ind = -1;
                        $.each( Orders, function( index, value ){
							ind++;
                            mymap.addMarker({
                              lat: value.lat,
                              lng: value.lon,
                              title: value.customerData.address,
                              label: '('+ind+')',
                              click: function(e) {
                                alert('This is '+value.lat+'.');
                              }
                            }); 

                       });

                        $('.assignDriver').on('click', function () {
                          $('[name="orderID"]').val($(this).data('orderid'));
                        });
						
						setTimeout(function() {
						  location.reload();
						}, 180000);
						
						@foreach(Auth::user()->drivers() as $driver)
						@if($driver->lat)
						 mymap.addMarker({
                              lat: {{ $driver->lat }},
                              lng: {{ $driver->lon }},
                              title: '{{ $driver->name }}',
                              label: '{{ substr($driver->name, 0, 1) }}',
                              click: function(e) {
                                alert('{{ $driver->updated_at->diffForHumans()}}');
                              }
                            });
						@endif
                        @endforeach
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


<!-- Modal -->
<div class="modal fade" id="assignDriver" tabindex="-1" role="dialog" aria-labelledby="assignDriverLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="/assign" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign to</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          @csrf
          <select name="driverID">
            @foreach($drivers as $driver)
              <option value="{{$driver->id}}">{{$driver->name}}</option>
            @endforeach
          </select>
          <input type="hidden" name="orderID">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
        </form>
    </div>
  </div>
</div>
@endsection
