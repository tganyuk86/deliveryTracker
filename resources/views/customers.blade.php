@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customers</div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      Address
                    </div>
                    <div class="col-md-4">
                      Phone
                    </div>
                    <div class="col-md-4">
                      Name
                    </div>
                    <div class="col-md-2">
                      Buttons
                    </div>
                  </div>

                  @foreach($Customers as $customer)
                    <div class="row">
                      <div class="col-md-2">
                        {{$customer->address}}
                        
                      </div>
                      <div class="col-md-4">
                        {{$customer->phone}}
                      </div>
                      <div class="col-md-4">
                        {{$customer->name}}
                      </div>
                      <div class="col-md-2">
<a href="/neworder/{{$customer->id}}"><button>Place Order</button></a>
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
