@extends('layouts.app')

@section('content')

	<div id="body">	
		<div class="container">
			<div class="col-md-16 content-left">
				<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
					<h3><b>Stockmarket Information</b></h3><br>
					<!-- TradingView Widget BEGIN -->
					<div id="tv-medium-widget-f0442">
					</div>
				</div>
			</div>
		</div>
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
	</div><!--//body-->	
		
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

<div class="container"><!--second container-->
	<div class="col-md-4 content-left"><!--Search Live Stock-->
		<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
			<h3><b>Search Live Stock</b></h3><br>
				<form  name="APIsearchForm" action="{{ action('DashboardController@index') }}" method="post"> 
					<input name="searchText" placeholder=" search by stock symbol" type="text"> 
					<button class="submitButt" type="submit" value="submit">Search</button>
					{{ csrf_field() }}
				</form>
				<br>
				<form  name="APIsearchForm" action="{{ action('DashboardController@index') }}" method="post">
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
					<br>
					{{ csrf_field() }}
				</form>
				<ul>
				<br>
					<li>Company : <?php echo $company ?></li>
					<li>Price    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $price ?></li>
					<li>Currency  : <?php echo $currency ?></li>
					<li>Change   &nbsp;&nbsp; : <?php echo $change ?></li>				
				</ul>
		</div>	
	</div><!--//Search Live Stock-->

	<div class="col-md-4 content-middle"><!--Current Holdings-->
		<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
			<h3><b>Current Holdings</b></h3><br>
				<ul>
					<li>Current Balance: ${{ Auth::user()->balance }}</li>
					<li>Shares Bought:</li>
					<li>Shares Sold:</li>
					<li>Profit:</li>
					<li>Initial Balance: $20000</li>
				</ul>  
		</div>
	</div><!--//Current Holdings-->
 
	<div class="col-md-4 content-right"><!--Leaderboard-->
		<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
			<h3><b>Leaderboard</b></h3><br>
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
	</div><!--//Leaderboard-->
</div><!--//second container-->

	
<?php
    
     if(isset($_POST['searchText']))
        {
            echo "<script type=\"text/javascript\"> document.getElementById('numberOfShares').disabled=false;
                    document.getElementById('buySharesButton').disabled=false;</script>";
                
        }
        else
        {
            echo "";
        }
?>		

@endsection
