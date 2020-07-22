@extends('layouts.app')

@section('content')

<div class="container-fluid">
                    <form action="{{ route('savestockqe') }}" method="post">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">

					<input type="submit" />

                    @foreach($items as $item)
                        @if($item->driverID > 0)
                    <div class="row justify-content-center" style="border-bottom: 1px solid black" 
				>
                            <div class="col-md-8">
                                <input type="number" name="items[{{$item->id}}]" value="{{$item->amount}}" />
								{{$item->product()->name}}
                            </div>
                            <div class="col-md-2">
                                {{$item->driver()->name}}
                            </div>
                            <div class="col-md-2">
                                <input type="checkbox" name="remove[{{ $item->id }}]" value=1/>Remove
                            </div>
                           
                        </div>
						@endif
                    @endforeach


                   
                    @csrf

					<input type="submit" />

                      
                </div>
            </div>


         
        </div>
    </div>
                   
                    <!-- <input type="submit" class="form-control btn" name="" value="Save/Add"> -->
                    </form>
</div>


<script type="text/javascript"></script>
@endsection
