<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CLEVO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Sharemarket Budding Investor, sharemarket, CLEVO" />
<link rel="stylesheet" type="text/css" href="style.css" />	

</head>

<body>
<div id="wrapper">
	<div id="header">
		<div id="topBar">
			<div class="textTop"><h1>CLEVO</h1>
            </div>
		</div>

		<ul class="topnav">
  			<li><a class="active" href="#">Dashboard</a></li>
  			<li><a href="#transactions">Transactions</a></li>
  			<li><a href="#gettingstarted">Getting Started</a></li>
  			<li><a href="#aboutus">About Us</a></li>
 			<li class="right"><a href="#logout">Logout</a></li>
			
		</ul>
	</div>
	
	
	
	
	
	<div id="content">
		<div class="stockmarket-information">
        <h3>Stockmarket Information</h3>
        
		<!-- TradingView Widget BEGIN -->
			<div id="tv-medium-widget-f0442"></div>
			<script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
			<script type="text/javascript">
			new TradingView.MediumWidget({
			  "container_id": "tv-medium-widget-f0442",
			  "symbols": [
				[
				  "Apple",
				  "AAPL|1d"
				],
				[
				  "Google",
				  "GOOGL|1d"
				],
				[
				  "Microsoft",
				  "MSFT|1d"
				],
				[
				  "Facebook",
				  "FB|1d"
				],
				[
				  "Amazon",
				  "AMZN|1d"
				],
				[
				  "Exxon Mobil Corporation",
				  "XOM|1d"
				],
				[
				  "Berkshire Hathaway",
				  "BRK.B|1d"
				],
				[
				  "Johnson & Johnson",
				  "JNJ|1d"
				],
				[
				  "GE",
				  "General Electric|1d"
				],
				[
				  "Tencent",
				  "TCEHY|1d"
				],
				[
				  "Yahoo",
				  "YHOO|1d"
				]
			  ],
			  "gridLineColor": "#e9e9ea",
			  "fontColor": "#83888D",
			  "underLineColor": "#dbeffb",
			  "trendLineColor": "#4bafe9",
			  "width": "100%",
			  "height": "400px",
			  "locale": "en"
			});
			</script>
			<!-- TradingView Widget END -->

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

		<div class="stockmarket-search">
			<h3>Search Live Stock Value</h3>
			<form  name="APIsearchForm" action="../website/index.php" method="post"> 
			{{ csrf_field() }} 
				<input name="searchText" placeholder=" search by stock symbol" type="text"> 
				<button class="submitButt" type="submit" value="submit">Search</button>
			</form>
				<br>
							
			<form  name="APIsearchForm" action="../website/index.php" method="post">
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
		
		

	
 
 
 
 
 
 
	<div id="footer">
	
		<ul class="footernav">
  			<li><a href="#termsofuse">Terms of Use</a></li>
  			<li><a href="#privacy">Privacy</a></li>
  			<li><a href="#sitemap">Sitemap</a></li>
		</ul>
	</div>



</div>

</body>
</html>
