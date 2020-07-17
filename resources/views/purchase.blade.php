@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Home Stock</div>

                <div class="card-body">
                    <form action="{{ route('performPurchase') }}" method="post">

                      <select class="form-control" name="productID">
                                    <option value="0">Select Product</option>
                                    @foreach($products as $prod)
                                        <option value="{{$prod->id}}"  >{{$prod->name}}</option>
                                    @endforeach
                                </select>

                   
                    @csrf


					<input type="text" class="form-control" value="" placeholder="Supplier" name="supplier" />
					<input type="text" class="form-control" value="" placeholder="Cost" name="cost" />
					<input type="text" class="form-control" value="" placeholder="Units" name="units" />
					
                    <input type="submit" class="form-control btn" name="" value="Save/Add">
                    </form>
                      
                </div>
            </div>


        </div>
    </div>
                   
</div>


<script type="text/javascript"></script>
@endsection
