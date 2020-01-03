@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          @foreach($drivers as $driver)
            <div class="card">
              <div class="card-header">
                {{$driver->name}}
              </div>
              <div class="card-body">
              <form action="{{route('savePriority')}}" method="POST">


                    <table id="table-1" cellspacing="0" cellpadding="2" width="100%">

                      @foreach($driver->orders('waiting') as $order)
                        <tr id="{{$order->id}}">
                          <td>{{$order->customer()->address}}<br>
                            <sup>{{ $order->created_at->diffForHumans() }}<sup>
                          </td>
                          <td>
                            {{$order->customer()->name}}
                          </td>
                          <td>
                            {{$order->order}}
                          </td>
                          <td>
                            {{$order->value}}
                          </td>
                          <td>
                            <button type="button" class="btn btn-primary assignDriver" data-orderid="{{$order->id}}" data-toggle="modal" data-target="#assignDriver">
                              {{ $order->driver()->isAdmin() ? 'Unassigned' : $order->driver()->name}}
                            </button>

                            <button type="button" class="btn btn-primary up" data-direction="up">Up</button>
                            <button type="button" class="btn btn-primary down" data-direction="down">Down</button>

                            <input type="hidden" name="orders[{{$driver->id}}][]" value="{{$order->id}}">
                          </td>
                        </tr>
                      @endforeach
                    </table>
                  


              </div>
            </div>

          @endforeach
            <div class="card">
                <div class="card-header">
                  Outstanding Orders
                  <button type="submit" class="btn btn-success save float-right">Save Changes</button>
                </div>

                <div class="card-body">
                  <!-- <div class="row">
                    <div class="col-md-2">
                      Address
                    </div>
                    <div class="col-md-2">
                      Name
                    </div>
                    <div class="col-md-4">
                      Order
                    </div>
                    <div class="col-md-2">
                      Value
                    </div>
                    <div class="col-md-2">
                      Driver
                    </div>
                  </div>
 -->
                  <table id="table-1" cellspacing="0" cellpadding="2" width="100%">

                    @foreach($orders as $order)
                      <tr id="{{$order->id}}">
                        <td>{{$order->customer()->address}}<br>
                          <sup>{{ $order->created_at->diffForHumans() }}<sup>
                        </td>
                        <td>
                          {{$order->customer()->name}}
                        </td>
                        <td>
                          {{$order->order}}
                        </td>
                        <td>
                          {{$order->value}}
                        </td>
                        <td>
                          <button type="button" class="btn btn-primary assignDriver" data-orderid="{{$order->id}}" data-toggle="modal" data-target="#assignDriver">
                            {{ $order->driver()->isAdmin() ? 'Unassigned' : $order->driver()->name}}
                          </button>

                          <button type="button" class="btn btn-primary up" data-direction="up">Up</button>
                          <button type="button" class="btn btn-primary down" data-direction="down">Down</button>

                          <!-- <input type="hidden" name="orders[]" value="{{$order->id}}"> -->
                        </td>
                      </tr>
                    @endforeach
                  </table>


                      <script type="text/javascript">
$('.assignDriver').on('click', function () {
  $('[name="orderID"]').val($(this).data('orderid'));
})

                      </script>
                </div>
            </div>
            @csrf
          </form>

            <div class="card">
                <div class="card-header">Done Orders</div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      Address
                    </div>
                    <div class="col-md-2">
                      Name
                    </div>
                    <div class="col-md-4">
                      Order
                    </div>
                    <div class="col-md-2">
                      Value
                    </div>
                    <div class="col-md-2">
                      
                    </div>
                  </div>

                  @foreach($doneOrders as $order)
                    <div class="row">
                      <div class="col-md-2">
                        {{$order->customer()->address}}<br>
                        <sup>{{ $order->created_at->diffForHumans() }}<sup>
                      </div>
                      <div class="col-md-2">
                        {{$order->customer()->name}}
                      </div>
                      <div class="col-md-4">
                        {{$order->order}}
                      </div>
                      <div class="col-md-2">
                        {{$order->value}}
                      </div>
                      <div class="col-md-2">
                        
                      </div>
                    </div>

                  @endforeach


                      <script type="text/javascript">
$('.assignDriver').on('click', function () {
  $('[name="orderID"]').val($(this).data('orderid'));
})
$(document).ready(function() {
    // Initialise the table
    $("#table-1").tableDnD();

    $(".up,.down").click(function(){
        var row = $(this).parents("tr:first");
        if ($(this).is(".up")) {
            row.insertBefore(row.prev());
        } else {
            row.insertAfter(row.next());
        }
    });
});

                      </script>
                </div>

                
            </div>
        </div>

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
