@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customers</div>
<input id="myInput" placeholder="filter" />
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      Address
                    </div>
                    <div class="col-md-4">
                      Phone
                    </div>
                    <div class="col-md-4">
                      Name
                    </div>
                    <div class="col-md-2">
                      Buttons
                    </div>
                  </div>

                  @foreach($Customers as $customer)
                    <div class="row filtered">
                      <div class="col-md-2">
                        {{$customer->address}}
                        
                      </div>
                      <div class="col-md-4">
                        {{$customer->phone}}
                      </div>
                      <div class="col-md-4">
                        {{$customer->name}}
                      </div>
                      <div class="col-md-2">
<a href="/neworder/{{$customer->id}}"><button>Go</button></a>
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

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".filtered").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>
@endsection
