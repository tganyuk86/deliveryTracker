@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Send SMS
                  <input data-filter="customers" placeholder="Filter" class="myInput" />
                </div>
                <div class="card-body">
			<form action="{{route('sendSMS')}}" method="POST" >
				<label>Message</label>
				<textarea>myTest</textarea>
				
				<label>Customers</label>
                  <div class="row">
					  <div class="col-md-2">
					  Select
					  </div>
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
                  </div>

                  @foreach($Customers as $customer)
                    <div class="row" data-filtered="customers">
                      <div class="col-md-2">
						<input type="checkbox" name='users[]' value="{{$customer->id}}" />
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
                    </div>
                  @endforeach
				  <input type='submit' >
				</form>


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
