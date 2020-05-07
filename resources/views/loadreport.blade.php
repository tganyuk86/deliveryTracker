@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
			
			<div class="card">
                <div class="card-header">Report</div>

                <div class="card-body">

					<h2>Num of Orders: {{$totalOrders}}</h2>
                    <h2>Total: {{$total}}</h2>
					<h2>Cash: {{$totalCash}}</h2>
					<h2>E-Transfer: {{$totalemt}}</h2>

					Orders:
					
					
                      
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript"></script>
@endsection
