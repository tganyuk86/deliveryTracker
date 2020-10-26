@extends('layouts.app')

@section('content')

<div class="container">
                    <form action="{{ route('savestock') }}" method="post">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Update Balace</div>

                <div class="card-body">
					<form action="" method="POST" >
						
						                    
						<input type="number" class="form-control" name="value" value="" placeholder="Update Balance"  required>
						<input type="text" class="form-control" name="note" value="" placeholder="Note"  required>
						<input type="submit" class="form-control" value="Update Balance">

						

						@csrf
					</form>
                  

                   
                        <div class="row justify-content-center">
                            <div class="col-md-4">Product</div>
                            <div class="col-md-4">Type</div>
                            <div class="col-md-4">Price</div>
                        </div>



                      
                </div>
            </div>


           
        </div>
    </div>
</div>


<script type="text/javascript"></script>
@endsection
