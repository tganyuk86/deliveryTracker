@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Home Stock</div>

                <div class="card-body">
					<a href="{{ route('movestock/allHome') }}" class="btn" >Bring all home</a>
					<hr />
                    <form action="{{ route('performMove') }}" method="post">

                        <select name="destination">
                            <option value="0">Into Home Stock</option>
                            @foreach($drivers as $driver)
                                <option value="{{$driver->id}}">Home -> {{$driver->name}}</option>
                            @endforeach
                        </select>
                        <!-- <div class="row justify-content-center">
                            <div class="col-md-4">Product</div>
                            <div class="col-md-4">Type</div>
                            <div class="col-md-4">Price</div>
                        </div> -->

                    @foreach($products as $product)
                        
                    <div class="row justify-content-center">
                            <div class="col-md-4">
                                {{$product->name}}
                            </div>
                           
                            <div class="col-md-4">
                                <input type="text" name="amount[{{$product->id}}]" value="0" data-value="{{$product->homeStock()}}" >
								({{$product->homeStock()}})
                            </div>
                        </div>

                    @endforeach


                   
                    @csrf



                      
                </div>
            </div>


        </div>
    </div>
                   
                    <input type="submit" class="form-control btn" name="" value="Save/Add">
                    </form>
</div>


<script type="text/javascript">
	$("input").on('dblclick', function(){
		$(this).val($(this).data('value'));
		console.log('hit');
	});
</script>
@endsection
