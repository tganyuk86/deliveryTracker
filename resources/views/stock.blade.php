@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Stock Prices</div>

                <div class="card-body">

                    <form action="{{ route('savestock') }}" method="post">

                        <div class="row justify-content-center">
                            <div class="col-md-4">Product</div>
                            <div class="col-md-4">Type</div>
                            <div class="col-md-4">Price</div>
                        </div>


                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <select class="form-control" name="productID">
                                    <option value="0">Select Product</option>
                                    @foreach($stocks->first()->products() as $prod)
                                        <option value="{{$prod->id}}"  >{{$prod->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="typeID">
                                    <option value="0">Select Type</option>
                                    @foreach($stocks->first()->types() as $prod)
                                        <option value="{{$prod->id}}"  >{{$prod->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4">
                                <input type="text" name="price" value="" >
                            </div>
                        </div>

                    @foreach($stocks as $stock)
                        <input type="hidden" name="stock[{{$stock->id}}][id]" value="{{$stock->id}}">
                         <div class="row justify-content-center">
                            <div class="col-md-4">
                                <select class="form-control" name="stock[{{$stock->id}}][productID]">
                                    <option value="0">REMOVE</option>
                                    @foreach($stock->products() as $prod)
                                        <option value="{{$prod->id}}" {{$prod->id == $stock->productID ? 'selected' : '' }} >{{$prod->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="stock[{{$stock->id}}][typeID]">
                                    @foreach($stock->types() as $prod)
                                        <option value="{{$prod->id}}" {{$prod->id == $stock->typeID ? 'selected' : '' }} >{{$prod->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-4">
                                <input type="text" name="stock[{{$stock->id}}][price]" value="{{ $stock->price }}" >
                            </div>
                        </div>

                    @endforeach
                        


                   
                    @csrf

                   
                    <input type="submit" class="form-control btn" name="" value="Save/Add">
                    </form>


                      
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript"></script>
@endsection
