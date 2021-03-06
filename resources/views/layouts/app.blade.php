<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/TableDnD/0.9.1/jquery.tablednd.js" integrity="sha256-d3rtug+Hg1GZPB7Y/yTcRixO/wlI78+2m08tosoRn7A=" crossorigin="anonymous"></script>

    <script src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        body {
          font-family: 'Helvetica Neue', 'arial', sans-serif;
          font-size: 15px;
        }


        div.myMap {
          height: 500px;
          width: 100%;
          padding: 0px;
          margin: 0px;
          border: 1px solid red;
        }

    </style>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            // jQuery('#ajaxSubmit').click(function(e){
               // e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
            // });
          });

    </script>
    @if(Auth::user() && !Auth::user()->isAdmin())
        <script type="text/javascript">
            if (navigator.geolocation) 
            {
                navigator.geolocation.getCurrentPosition(updatePosition);
            }else{
				console.log('no nav');
			}

            function updatePosition(position)
            {
                $.ajax({
                    url: "{{ route('updatePosition') }}",
                    type:'POST',
                    headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                    data: {

                        lat: position.coords.latitude,
                        lon: position.coords.longitude
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
            }
        </script>
    @endif
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
@if(env('APP_BRAND') == 'sams')
                    @guest
                    @else
                    <ul class="navbar-nav mr-auto">
                            @if(Auth::user()->isAdmin())
                                
							<li class="nav-item">
                                <a class="nav-link" href="/quicksale">
                                    <button class="btn btn-info">Quick Sale</button>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/finances">
                                    <button class="btn btn-info">${{App\Balance::balance()}}</button>
                                </a>
                            </li>
                            @endif
                    </ul>
                    @endguest
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders') }}">
                                    <button class="btn btn-info">Orders</button>
                                </a>
                            </li>
                            @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('neworder') }}">
                                    <button class="btn">New Order</button>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin">
                                    <button class="btn">Admin</button>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/driverhome">
                                    <button class="btn">Driver View</button>
                                </a>
                            </li>
							@endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->isAdmin())
                                    <a class="dropdown-item" href="{{ route('home') }}">Dashboard</a>
                                    <a class="dropdown-item" href="/admin">Admin</a>
                                    <a class="dropdown-item" href="{{ route('orders') }}">Orders</a>
                                    <a class="dropdown-item" href="{{ route('neworder') }}">New Order</a>
                                    <a class="dropdown-item" href="{{ route('map') }}">Map</a>
                                    <a class="dropdown-item" href="{{ route('customers') }}">Customers</a>
                                    <a class="dropdown-item" href="{{ route('stock') }}">Stock Prices</a>
                                    <a class="dropdown-item" href="{{ route('stockqe') }}">Stock QE</a>
                                    <a class="dropdown-item" href="{{ route('allstock') }}">Stock</a>
                                    <a class="dropdown-item" href="{{ route('movestock') }}">Move Stock</a>
                                    <a class="dropdown-item" href="{{ route('purchase') }}">Purchase</a>
                                    <a class="dropdown-item" href="{{ route('report') }}">Report</a>
                                    <a class="dropdown-item" href="{{ route('finances') }}">Finances</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
@elseif(env('APP_BRAND') == 'litphast')

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders') }}">
                                    <button class="btn">Orders</button>
                                </a>
                            </li>
                            @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('neworder') }}">
                                    <button class="btn">New Order</button>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/driverhome">
                                    <button class="btn">Driver View</button>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    More <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->isAdmin())
                                    <a class="dropdown-item" href="{{ route('home') }}">Dashboard</a>
                                    <a class="dropdown-item" href="/admin">Admin</a>
                                    <a class="dropdown-item" href="{{ route('orders') }}">Orders</a>
                                    <a class="dropdown-item" href="{{ route('neworder') }}">New Order</a>
                                    <a class="dropdown-item" href="{{ route('map') }}">Map</a>
                                    <a class="dropdown-item" href="{{ route('customers') }}">Customers</a>
                                    <a class="dropdown-item" href="{{ route('stock') }}">Stock Prices</a>
                                    <a class="dropdown-item" href="{{ route('stockqe') }}">Stock QE</a>
                                    <a class="dropdown-item" href="{{ route('allstock') }}">Stock</a>
                                    <a class="dropdown-item" href="{{ route('movestock') }}">Move Stock</a>
                                    <a class="dropdown-item" href="{{ route('report') }}">Report</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

@endif
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
          $(".myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("[data-filtered="+$(this).data('filter')+"]").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
    </script>
</body>
</html>
