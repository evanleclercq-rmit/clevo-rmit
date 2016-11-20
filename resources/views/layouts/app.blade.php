<!--<!DOCTYPE html>-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <!-- Font -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

    @yield('styles')

    <!-- Scripts -->

    <!-- chart-grid-left -->
    <script src="js/d3.min.js"></script>
    <script src="js/xcharts.min.js"></script>
    <script src="js/rainbow.min.js"></script>
    <!-- //chart-grid-left -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
    <!--animate-->
    <script src="js/app.js"></script>
    <script src="js/wow.min.js"></script>
    <!--Google Charts-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
    new WOW().init();
    </script>
    <!--//end-animate-->
    <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
        ]); ?>
    </script>    
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

    <script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true   // 100% fit in a container
        });
    });
    </script>

    <style>
    table, th, td {
    border: 1px solid #ededed;
    border-collapse: collapse;
    }
    th, td {
    padding: 5px;
    text-align: left;
    }
    </style>
    
    
</head>

<body>
    <!--header-->       
    <div id="header">
        <div id="topBar"> 
            <!--Navbar if not logged in-->        
            @if (Auth::guest())
            <ul class="toptitle">
                <li><h1><a href="{{ url('/dashboard') }}">CLEVO</a></h1></li>
            </ul>
            <ul class="topnav">
                <!--Left menu items-->
                <li><a href="{{ url('/gettingstarted') }}">Getting Started</a></li>
                <!--Right menu items-->
                <li class="right"><a href="{{ url('/login') }}">Login</a></li>
                <li class="right"><a href="{{ url('/register') }}">Register</a></li>

                <!--Navbar if logged in-->
                @else

                <ul class="toptitle">
                    <li><h1><a href="{{ url('/dashboard') }}">CLEVO</a></h1></li>
                    <li class="right"><h4 class='welcome'>Welcome {{ Auth::user()->name }}!</h4></li>
                </ul>
                <ul class="topnav">
                    <!--Left menu items-->
                    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ url('/transactions') }}">Transactions</a></li>
                    <li><a href="{{ url('/history') }}">History</a></li>
                    <!--Right menu items-->
                    <li class="right"><a href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a></li>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <li class="right"><a href="{{ url('/settings') }}">Settings</a></li>
                         <li class="right"><a href="{{ url('/profile') }}">Profile</a></li>
                        @endif
                    </ul>   
                </div>
            </div>
            <!--//header--> 

            @yield('content')

            <!--footer-->
            <div id="footer">
                <ul class="footernav">
                    <li><a href="{{ url('/termsofuse') }}">Terms of Use</a></li>
                    <li><a href="{{ url('/privacy') }}">Privacy</a></li>
                    <li><a href="{{ url('/sitemap') }}">Sitemap</a></li>
                    <li><a href="{{ url('/aboutus') }}">About Us</a></li>
                </ul>
                <h5 class="footer">© 2016 Statistics UI Kit . All Rights Reserved . Design by <a href="http://w3layouts.com/">W3layouts</a></h5>
                <h5 class="footer">Disclaimer: This Site has been made for educational purposes by students of RMIT University towards
                    the completion of CPT331 - Programming Project</h5>
                </div>
                <!--//footer--> 

            </body>
        </html>
