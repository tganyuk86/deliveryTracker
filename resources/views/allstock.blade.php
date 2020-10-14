@extends('layouts.app')

@section('content')

<div class="container">
                    <form action="{{ route('savestock') }}" method="post">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Home Stock</div>

                <div class="card-body">


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
                                {{$product->homeStock()}}
                            </div>
                            <div class="col-md-4">
                                {{$product->cost()}}
                            </div>
                        </div>

                    @endforeach


                   
                    @csrf



                      
                </div>
            </div>


            @foreach($drivers as $driver)
            
                <div class="card">
                    <div class="card-header">{{$driver->name}}'s Stock</div>

                    <div class="card-body">
                        @foreach($driver->stock() as $stock)
                            <div class="row justify-content-center" style="color: {{$stock->amount < 8 ? 'red' : 'green' }}">
                                <div class="col-md-4">
                                    {{$stock->product()->name}}
                                </div>
                               
                                <div class="col-md-4">
                                    {{$stock->amount}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            @endforeach
        </div>
    </div>
                   
                    <!-- <input type="submit" class="form-control btn" name="" value="Save/Add"> -->
                    </form>
</div>


<script type="text/javascript"></script>
@endsection
