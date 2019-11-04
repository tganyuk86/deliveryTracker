@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Map</div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      Called @
                    </div>
                    <div class="col-md-4">
                      Name
                    </div>
                    <div class="col-md-4">
                      Order
                    </div>
                    <div class="col-md-2">
                      Value
                    </div>
                  </div>

                  @foreach($locations as $location)
                    <div class="row">
                      <div class="col-md-2">
                        {{ \Carbon\Carbon::parse($location->called_at)->diffForHumans()}}

                      </div>
                      <div class="col-md-4">
                        {{$location->name}}
                      </div>
                      <div class="col-md-4">
                        {{$location->order}}
                      </div>
                      <div class="col-md-2">
                        {{$location->value}}
                      </div>
                    </div>

                  @endforeach


                      <script type="text/javascript">


                    

                      </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
