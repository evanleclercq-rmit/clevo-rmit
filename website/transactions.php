<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Transactions</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Sharemarket Budding Investor, sharemarket, buy shares, sell shares" />
<link rel="stylesheet" type="text/css" href="style.css" />	





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




<?php require("financeWebService.php"); ?>
</head>




<body>



<div id="container">
	




<div id="body">	
	<div class="container">
		<div class="stockmarket-information">
			<div class="contact-form-heading">
				<div class="content-top-grids">	
		<div class="col-md-16 content-left">
		<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
		<h3>Stockmarket Information</h3>
		<!-- TradingView Widget BEGIN -->
			<div id="tv-medium-widget-f0442"></div></div></div></div>
			<script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
			<script type="text/javascript">
            
            function calculateTotalShareCost(numShares)
                {
                    document.getElementById("totalCostOfShares").value=numShares.value*document.getElementById("sharePrice").value;
                }
            
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
		</div>			
	</div>		
		
<?php
                    
	$company = "";
	$price = "";
	$currency = "";
	$change = "";
    $buySharePrice= "";
    
    
                    
	if(isset($_POST)&&!empty($_POST))
	{
		$stockSymbol = $_POST['searchText'];
		$stockData = search_stock($stockSymbol);
		$company = $stockData['name'];
		$price = $stockData['price'];
		$currency = $stockData['currency'];
		$change = $stockData['change'];
    }
?>		

<div class="container">
<div class="content-grids">
				<!-- content-top-grids -->
	<div class="content-top-grids">	
		<div class="col-md-4 content-left">
		<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
			<div class="stockmarket-search">
			<div class="skills-heading">
			<h3>Search Live Stock</h3>
			<form  name="APIsearchForm" action="../website/transactions.php" method="post"> 
	<!--		{{ csrf_field() }} -->
				<input name="searchText" placeholder=" search by stock symbol" type="text"> 
				<button class="submitButt" type="submit" value="submit">Search</button>
			</form>
				<br>
							
			<form  name="APIsearchForm" action="../website/transactions.php" method="post">
	
	<!--		{{ csrf_field() }} -->
						
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
            
		</div>	</div>
	</div>
</div>

	<div class="col-md-4 content-middle"><!--Buy Shares-->
		<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
			<div class="skills-heading">
				<h3>Buy Shares</h3>
				<form  name="buySharesForm" action="../website/transactions.php" method="post">
				<input name="sharePrice" type="hidden" id="sharePrice" value="<?php echo $price ?>" >
				<input name="numberOfShares" id="numberOfShares" placeholder="Number of Shares" type="number" min="1" step="1"
                       onchange="calculateTotalShareCost(this)" disabled>
					
				<br><br>
				<ul>
				<li>Company : <?php echo $company ?></li>
				<li>Total Value: <input name="totalCostOfShares" style="width: 4em;" id="totalCostOfShares" value="" readonly> <?php echo $currency ?></li>
				</ul><br>
				<button class="submitButt" id="buySharesButton" type="submit" value="submit" disabled>Buy Shares</button>
				<br>
				</form>
			</div>
		</div>
	</div>
 
	<div class="col-md-4 content-right"><!--Sale Shares-->
		<div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
			<div class="skills-heading">
				<h3>Sell Shares</h3>
				<form  name="APIsearchForm" action="../website/transactions.php" method="post">
				<select name="searchText" onchange="this.form.submit();" > 
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
				</select><br><br>
				<input name="numberOfShares" placeholder="Number of Shares" type="number" min="1" step="1" value="">
				<button class="submitButt" type="submit" value="submit">Calculate</button>	
				<br><br>
				<ul>
				<li>Company : <?php echo $company ?></li>
				<li>Total Value: <?php echo ($price * 2) ?> <?php echo $currency ?></li>
				</ul><br>
				<button class="submitButt" type="submit" value="submit">Sell Shares</button>
				<br>
				</form>
		</div>
	</div><!--//Leaderboard-->

 
</div>
	</div>
		
<!--header-->		
	<div id="header">
		<div class="content-top">
			<div class="container">
				
				<div class="logo">
				
					<div id="topBar">
						<!--<div class="textTop">-->
						<ul class="toptitle">
						<li><h1>CLEVO</h1></li>
						<li><h2 style="color:#ffffff">...a budding sharemarket investor application</h2></li>
						<li class="right"><h4 style="color:#ffffff">Welcome Back, "user"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4></li>
						
						</ul>
						<!--</div>-->
							<ul class="topnav">
								<li><a href="../website/index.php">Dashboard</a></li>
								<li><a class="active" href="">Transactions</a></li>
								<li><a href="#gettingstarted">Getting Started</a></li>
								<li><a href="#aboutus">About Us</a></li>
								<li class="right"><a href="../website/login.php">Logout&nbsp;&nbsp;</a></li>
							</ul>	
					</div>
				</div>
			</div>
		</div>
	</div>
<!--//header-->		
		
		
		
		
			<div id="footer">
				<ul class="footernav">
					<li><a href="#termsofuse">Terms of Use</a></li>
					<li><a href="#privacy">Privacy</a></li>
					<li><a href="#sitemap">Sitemap</a></li>
				</ul>
				<p style="text-align: center;">© 2016 Statistics UI Kit . All Rights Reserved . Design by <a href="http://w3layouts.com/">W3layouts</a></p>
			<p style="text-align: center;">Disclaimer:<br>
This Site has been made for educational purposes by students of RMIT University towards
the completion of CPT331 - Programming Poject</p>
			</div>
		

 </div>

<?php
    
     if(isset($_POST['searchText']))
        {
            echo "<script type=\"text/javascript\"> document.getElementById('numberOfShares').disabled=false;
                    document.getElementById('buySharesButton').disabled=false;</script>";
                
        }
        else
        {
            echo "testtt";
        }
?>

</body>
</html>
