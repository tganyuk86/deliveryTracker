@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Customers
                  <input data-filter="customers" placeholder="Filter" class="myInput" />
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      Address
                    </div>
                    <div class="col-md-2">
                      Phone
                    </div>
                    <div class="col-md-2">
                      # of Orders
                    </div>
                    <div class="col-md-4">
                      Name
                    </div>
                    <div class="col-md-2">
                      Buttons
                    </div>
                  </div>

                  @foreach($Customers as $customer)
                    <div class="row" data-filtered="customers">
                      <div class="col-md-2">
                        {{$customer->address}}
                        
                      </div>
                      <div class="col-md-2">
                        {{$customer->phone}}
                      </div>
                      <div class="col-md-2">
                        {{count($customer->orders())}}
                      </div>
                      <div class="col-md-4">
                        {{$customer->name}}
                      </div>
                      <div class="col-md-2">
<a href="/admin/customers/{{$customer->id}}/edit" class="btn btn-info">Edit</a>
<a href="/neworder/{{$customer->id}}" class="btn btn-info">Order</a>
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

<script>


</script>
@endsection
