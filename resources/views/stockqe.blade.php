@extends('layouts.app')

@section('content')

<div class="container">
                    <form action="{{ route('savestockqe') }}" method="post">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">


                    @foreach($items as $item)
                        
                    <div class="row justify-content-center">
                            <div class="col-md-4">
                                {{$item->product()->name}}
                            </div>
                            <div class="col-md-4">
                                
                            </div>
                           
                            <div class="col-md-4">
                                <input type="number" name="items[{{$item->id}}]" value="{{$item->amount}}" />
                            </div>
                        </div>

                    @endforeach


                   
                    @csrf



                      
                </div>
            </div>


         
        </div>
    </div>
                   
                    <!-- <input type="submit" class="form-control btn" name="" value="Save/Add"> -->
                    </form>
</div>


<script type="text/javascript"></script>
@endsection
