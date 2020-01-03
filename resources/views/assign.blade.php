@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Assign Driver</div>

                <div class="card-body">
                    <form action="{{ route('assign') }}" method="post">
                        <input type="hidden" name="orderID" value="{{$order->id}}">
                        <select name="driverID">
                            <option value="0">Unassign</option>
                            @foreach($drivers as $driver)
                                <option value="{{$driver->id}}" {{ $driver->id == $order->driverID ? 'selected' : ''  }}>{{$driver->name}}</option>
                            @endforeach
                        </select>
                       
                   
                    @csrf



                      
                </div>
            </div>


        </div>
    </div>
                   
                    <input type="submit" class="form-control btn" name="" value="Assign">
                    </form>
</div>


<script type="text/javascript"></script>
@endsection
