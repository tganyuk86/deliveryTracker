@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Todays Report</div>

                <div class="card-body">

                    <form action="{{ route('loadReport') }}" method="post">

						<input type="hidden" name="repDate" value="{{ Carbon\Carbon::now() }}" />
                   
                    @csrf

                   
                    <input type="submit" class="form-control btn" name="" value="Load">
                    </form>


                      
                </div>
            </div>
			
			<div class="card">
                <div class="card-header">Select Date</div>

                <div class="card-body">

                    <form action="{{ route('loadReport') }}" method="post">

						<input type="date" name="repDate" />
                   
                    @csrf

                   
                    <input type="submit" class="form-control btn" name="" value="Load">
                    </form>


                      
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript"></script>
@endsection
