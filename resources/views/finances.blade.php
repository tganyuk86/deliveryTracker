@extends('layouts.app')

@section('content')

<div class="container">
                    <form action="{{ route('savestock') }}" method="post">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Update Balance</div>

                <div class="card-body">
					<form action="" method="POST" >
						
						                    
						<input type="number" class="form-control" name="value" value="" placeholder="Update Balance"  required>
						<input type="text" class="form-control" name="note" value="" placeholder="Note"  required>
						<input type="submit" class="form-control" value="Update Balance">

						

						@csrf
					</form>
                  

                </div>
            </div>   
			
			<div class="card">
                <div class="card-header">Set Balance</div>

                <div class="card-body">
					<form action="" method="POST" >
						
						                    
						<input type="number" class="form-control" name="value" value="" placeholder="Set Balance"  required>
						<input type="text" class="form-control" name="note" value="" placeholder="Note"  required>
						<input type="submit" class="form-control" value="Set Balance">

						

						@csrf
					</form>
                  
                </div>
            </div>
            
			
			<div class="card">
                <div class="card-header">Recent Activity</div>

                <div class="card-body">
				@foreach($Orders as $order)
                        <div class="row justify-content-center">
                            <div class="col-md-4">{{order->created_at}}</div>
                            <div class="col-md-4">{{order->value}}</div>
                            <div class="col-md-4">{{order->note}}</div>
                            
                        </div>

				@endforeach
                </div>
            </div>
            


                      


           
        </div>
    </div>
</div>


<script type="text/javascript"></script>
@endsection
