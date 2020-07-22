@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">


                    @foreach($drivers as $driver)
                        <a href="/stockqe/{{$driver->id}}" class="btn btn-info" >{{ $driver->name}}</a>
                    @endforeach


                   
                </div>
            </div>


         
        </div>
    </div>
                   
                    <!-- <input type="submit" class="form-control btn" name="" value="Save/Add"> -->
                    </form>
</div>


<script type="text/javascript"></script>
@endsection
