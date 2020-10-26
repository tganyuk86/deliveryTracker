@extends('layouts.app')

@section('content')

<div class="container">
                    <form action="{{ route('savestock') }}" method="post">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Update Balace</div>

                <div class="card-body">
					<form >
						
					

                        <div class="row justify-content-center">
                            <div class="col-md-4">Product</div>
                            <div class="col-md-4">Type</div>
                            <div class="col-md-4">Price</div>
                        </div>

						@csrf
					</form>
                  

                   



                      
                </div>
            </div>


           
        </div>
    </div>
</div>


<script type="text/javascript"></script>
@endsection
