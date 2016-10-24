<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
    <link href = "css/master.css" rel = "stylesheet">
    <link href = "css/style.css" rel = "stylesheet">
    <link href = "css/font-awesome.css" rel = "stylesheet">
    <link href = "css/animate.css" rel = "stylesheet">
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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!--new chart-->		
 <script type="text/javascript">
      
google.charts.load('current', {'packages':['corechart', 'table']});
google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data1 = new google.visualization.arrayToDataTable([
          ['Time', '$Value'],
          ['-10h', 10],
          ['-9h',  8.20],
          ['-8h',  5],
          ['-7h',  9],
		  ['-6h',  12.1],
		  ['-5h',  13],
		  ['-4h',  5.52],
		  ['-3h',  7.8],
		  ['-2h',  8.7],
		  ['-1h',  6.4],
		  ['now',  12.5]
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Time',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
	  };
function resize () {
        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data1, options);
      }
	window.onload = resize();
	  window.onresize = resize;}
   </script>
<!--//new chart-->

<!--leaderboard table script-->
<script type="text/javascript">
//google.charts.load('current', {'packages':['table']});
google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data2 = new google.visualization.DataTable();
        data2.addColumn('string', 'Name');
        data2.addColumn('number', 'Holdings');
        data2.addRows([
          ['Mike',	{v: 10000,	f: '10,000'}],
          ['Jim',	{v: 8000,	f: '8,000'}],
          ['Alice',	{v: 12500, 	f: '12,500'}],
          ['Bob',	{v: 7000,  	f: '7,000'}],
		  ['Bob1',	{v: 8000,  	f: '6,000'}],
		  ['Bob2',	{v: 90000,  f: '8,000'}],
		  ['Bob3',	{v: 10000,  f: '5,000'}],
		  ['Bob4',	{v: 72000,  f: '3,000'}],
		  ['Bob5',	{v: 7000,  	f: '11,000'}],
		  ['Bob6',	{v: 7000,  	f: '12,000'}],
		  ['Bob7',	{v: 7000,  	f: '7,500'}],
		  ['Bob8',	{v: 7000,  	f: '4,400'}],
		  ['Bob9',	{v: 7000,  	f: '5,700'}],
		  ['Bob10',	{v: 7000,  	f: '8,200'}],
		  ['Bob11',	{v: 7000,  	f: '10,100'}],
		  ['Bob12',	{v: 7000,  	f: '11,000'}],
		  ['Bob13',	{v: 7000,  	f: '2,000'}]
        ]);
		
		var table = new google.visualization.Table(document.getElementById('table_div'));
        table.draw(data2, {showRowNumber: true, width: '100%', height: '280px'});
      }

   </script>
<!--//leaderboard table script-->
	
</head>

<body>
    <!--header-->       
    <div id="header">
        <div id="topBar"> 
            <!--Navbar if not logged in-->        
            @if (Auth::guest())
            <ul class="toptitle">
                <li><h1>CLEVO</h1></li>
            </ul>
            <ul class="topnav">
                <!--Left menu items-->
                <li><a href="#gettingstarted">Getting Started</a></li>
                <!--Right menu items-->
                <li class="right"><a href="{{ url('/login') }}">Login</a></li>
                <li class="right"><a href="{{ url('/register') }}">Register</a></li>

                <!--Navbar if logged in-->
                @else
                <ul class="toptitle">
                    <li><h1>CLEVO</h1></li>
                    <li class="right"><h4 class='welcome'>Welcome back {{ Auth::user()->name }}!</h4></li>
                </ul>
                <ul class="topnav">
                    <!--Left menu items-->
                    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ url('/transactions') }}">Transactions</a></li>
                    <li><a href="{{ url('/company') }}">Companies</a></li>
                    <li><a href="#gettingstarted">Getting Started</a></li>
                    <!--Right menu items-->
                    <li class="right"><a href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a></li>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
						 <li class="right"><a href="{{ url('/profile') }}">Profile</a></li>
                        <li class="right"><a href="#settings">Settings</a></li>
                        @endif
                    </ul>   
                </div>
            </div>
            <!--//header--> 

            @yield('content')

            <!--footer-->
            <div id="footer">
                <ul class="footernav">
                    <li><a href="#termsofuse">Terms of Use</a></li>
                    <li><a href="#privacy">Privacy</a></li>
                    <li><a href="#sitemap">Sitemap</a></li>
                    <li><a href="#aboutus">About Us</a></li>
                </ul>
                <h5 class="footer">© 2016 Statistics UI Kit . All Rights Reserved . Design by <a href="http://w3layouts.com/">W3layouts</a></h5>
                <h5 class="footer">Disclaimer: This Site has been made for educational purposes by students of RMIT University towards
                    the completion of CPT331 - Programming Project</h5>
                </div>
                <!--//footer--> 

            </body>
            </html>
