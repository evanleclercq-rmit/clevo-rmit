<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Sharemarket Budding Investor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Sharemarket Budding Investor, sharemarket" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link href="../resources/views/dashboard/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--// bootstrap-css -->
<!-- css -->
<link rel="stylesheet" href="../resources/views/dashboard/css/style.css" type="text/css" media="all" />
<!--// css -->
<!-- font-awesome icons -->
<link href="../resources/views/dashboard/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- font -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- //font -->
<script src="../resources/views/dashboard/js/jquery-1.11.3.min.js"></script>
<script src="../resources/views/dashboard/js/bootstrap.js"></script>


<script src="../resources/views/dashboard/js/easyResponsiveTabs.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#horizontalTab').easyResponsiveTabs({
			type: 'default', //Types: default, vertical, accordion           
			width: 'auto', //auto or any width like 600px
			fit: true   // 100% fit in a container
		});
	});
</script>

<!-- chart-grid-left -->
<link rel="stylesheet" href="../resources/views/dashboard/css/master.css">
<script src="../resources/views/dashboard/js/d3.min.js"></script>
<script src="../resources/views/dashboard/js/xcharts.min.js"></script>
<script src="../resources/views/dashboard/js/rainbow.min.js"></script>
<!-- //chart-grid-left -->
<!-- fabochart -->
<link href="../resources/views/dashboard/css/fabochart.css" rel="stylesheet" type="text/css">
<!-- //fabochart -->
<!--animate-->
<link href="../resources/views/dashboard/css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="../resources/views/dashboard/js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->


</head>
<body>
	<div class="content-top">
		<div class="container">
			<div class="logo">
				<h1 class="wow fadeInDown animated" data-wow-delay=".5s">Sharemarket Budding Investor</h1>
								<ul>
									<div class="dropdown wow fadeInUp animated" data-wow-delay=".5s" style="go-right; float:right;  color:white;">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style = "go-right; float:right; padding:0px; color:white;">
										{{ Auth::user()->name }} <span class="caret"></span>
										</a>

										<ul class="dropdown-menu" role="menu" >
											<li><a href='#'>Settings</a></li>
											<li><a href="{{ url('/logout') }}"
												onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">Logout</a>
												<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
												{{ csrf_field() }}
												</form>
											</li>
										</ul>
									</div>
								</ul>
				
			</div>
			<!-- header -->
			
			<!-- //header -->
			<div class="content-grids">
				<!-- content-top-grids -->
				<div class="content-top-grids">
					<div class="col-md-4 content-left">
						<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
							<div class="skills-heading">
								<h3>Stockmarket</h3>
								<!-- TradingView Widget BEGIN -->
								<div id="tv-miniwidget-9e196"></div>
								<script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
								<script type="text/javascript">
								new TradingView.MiniWidget({
								  "container_id": "tv-miniwidget-9e196",
								  "tabs": [
									"Equities"
								  ],
								  "symbols": {
									"Equities": [
									  "NASDAQ:AAPL|1d",
									  "NASDAQ:GOOGL|1d",
									  "NASDAQ:MSFT|1d",
									  "NASDAQ:AMZN|1d",
									  "NASDAQ:FB|1d",
									  "NYSE:XOM|1d",
									  "NYSE:BRK.B|1d",
									  "NYSE:JNJ|1d",
									  "NYSE:GE|1d",
									  "OTC:TCEHY|1d"
									]
								  },
								  "gridLineColor": "#e9e9ea",
								  "fontColor": "#83888d",
								  "underLineColor": "#dbeffb",
								  "trendLineColor": "#4bafe9",
								  "activeTickerBackgroundColor": "#edf0f3",
								  "large_chart_url": "https://www.tradingview.com/chart/",
								  "noGraph": false,
								  "width": "300px",
								  "height": "500px",
								  "locale": "en"
								});
								</script>
								<!-- TradingView Widget END -->
								
							</div>
						</div>
					</div>
<?php
                    
	$company = "";
	$price = "";
	$currency = "";
	$change = "";
                    
	if(isset($_POST)&&!empty($_POST))
	{
		$stockSymbol = $_POST['searchText'];
		$stockData = search_stock($stockSymbol);
		$company = $stockData['name'];
		$price = $stockData['price'];
		$currency = $stockData['currency'];
		$change = $stockData['change'];

		//foreach ($stockData as $key => $value)
		//{
		//   echo $key, " :", $value, "<br>";      
		//}
	}
        
        
    function search_stock($stockSymbol)
    {
		$cSession = curl_init(); 
		$queryURL = 
"http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22".$stockSymbol."%22)&format=json&env=store://datatables.org/alltableswithkeys";
            
		curl_setopt($cSession,CURLOPT_URL,$queryURL);
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false);    
            
		$result = curl_exec($cSession);
		curl_close($cSession);
		$json = json_decode($result, true);
        
		$stockData = array	(
							"name" => $json['query']['results']['quote']['Name'],
							"price" => $json['query']['results']['quote']['Ask'],
							"currency" => $json['query']['results']['quote']['Currency'],
							"change" => $json['query']['results']['quote']['Change'],
							);
           
		return $stockData;
    }
?>
                  
					<div class="col-md-4 content-middle"><!--Search Stock by Symbol-->
						<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
							<div class="skills-heading">
								<h3>Search Live Stock Value</h3>
								<form  name="APIsearchForm" action="/public/dashboard" method="post">
                                  {{ csrf_field() }}   
								<input name="searchText" placeholder=" search by stock symbol" type="text"> 
								<button class="submitButt" type="submit" value="submit">Search</button>
								</form>
								<br>
								
								<form  name="APIsearchForm" action="/public/dashboard" method="post">
                                  {{ csrf_field() }}   
							
									<select name="searchText" onchange="this.form.submit();"> 
									<option value="">select company</option>
									<option value="AAPL">APPLE</option>
									<option value="GOOGL">GOOGLE</option>
									<option value="MSFT">MICROSOFT</option>
									<option value="FB">FACEBOOK</option>
									<option value="AMZN">AMAZON</option>
									<option value="XOM">Exxon Mobil Corporation</option>
									<option value="BRK.B">Berkshire Hathaway Inc. Class B</option>
									<option value="JNJ">Johnson & Johnson </option>
									<option value="GE">General Electric</option>
									<option value="TCEHY">Tencent</option>
									</select>
									<br><br>
			
								</form>
								<ul>
								<br>
									<li>Company : <?php echo $company ?></li>
									<li>Price    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $price ?></li>
									<li>Currency  : <?php echo $currency ?></li>
									<li>Change   &nbsp;&nbsp; : <?php echo $change ?></li>
									
								</ul>
							</div>
						</div>
					</div><!--//Search Stock by Symbol-->
        
                 
					<div class="col-md-4 content-right"><!--Account Summary-->
						<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
							<div class="skills-heading">
								<h3>Account Summary</h3>
								<ul>
								<li>Current Ballance:</li>
								<li>Shares Bought:</li>
								<li>Shares Sold:</li>
								<li>Profit:</li>
								<li>Initial Ballance: $1,000,000</li>
								</ul>  
							</div>
						</div>
					</div><!--//Account Summary-->
                </div><!--//top grids-->
            </div><!--//content grids-->
		</div><!--//container-->	
	</div><!--//content-top-->
		
			<div class="container">
				<div class="col-md-4 content-left"><!--Leaderboard-->
					<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
						<div class="contact-form-heading">
							<h3>Leaderboard</h3>
							<ul>
                               <li> 1. C</li>
                               <li> 2. L</li>
                               <li> 3. E</li>
                               <li> 4. V</li>
                               <li> 5. O</li>
							   <li> 6. A</li>
							   <li> 7. B</li>
							   <li> 8. C</li>
							   <li> 9. D</li>
							   <li>10. E</li>
							</ul>
						</div>
					</div>
				</div><!--//Leaderboard-->
				
				<div class="col-md-4 content-middle"><!--Some-->
					<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
						<div class="skills-heading">
							<h3>Some</h3>
			
						</div>
					</div>
                </div><!--//Some-->
				
				<div class="col-md-4 content-right"><!--Box-->
					<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
						<div class="skills-heading">
							<h3>Box</h3>
						</div>
					</div>
                </div><!--//Box-->
				
			</div><!--//Container-->
		
	
    
    <!-- copyright -->
				<div class="copyright wow fadeInRight animated" data-wow-delay=".5s">
					<p>© 2016 Statistics UI Kit . All Rights Reserved . Design by <a href="http://w3layouts.com/">W3layouts</a></p>
				</div>
	<!-- //copyright -->
    
</body>

</html>