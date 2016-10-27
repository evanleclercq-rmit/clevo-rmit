@extends('layouts.app')

@section('content')

<?php require(app_path().'/financeWebService.php') ?>
<script type="text/javascript">

<?php
$company = "";
$price = "";
$currency = "";
$change = "";
$changeFromYearHigh = "";
$graph = "";

if(isset($_POST)&&!empty($_POST))
{
	$stockSymbol = $_POST['symbol'];
	$stockData = search_stock($stockSymbol);
	$company = $stockData['name'];
	$price = $stockData['price'];
	$currency = $stockData['currency'];
	$change = $stockData['change'];
;

}
if(isset($_POST['totalCostOfSharesBuy']))
{
	$user = Auth::user();
	$user->decrement('balance',$_POST['totalCostOfSharesBuy']);
}
?>


function ajaxSearch(str)
{
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if (this.readyState == 4)
		{
			document.getElementById("companyData").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "{{ action('ApiRequestController@index') }}"+"?q=" + str, true);
	xmlhttp.send();

}

function calculateTotalShareCostBuy(numShares)
{
	document.getElementById("totalCostOfSharesBuy").value=numShares.value*document.getElementById("sharePrice").value;
}

function calculateTotalShareCostSell(numShares)
{
	document.getElementById("totalCostOfSharesSell").value=numShares.value*document.getElementById("sharePrice").value;
}

</script>



<!--Script to show/hide DIV depending on box checked-->
<script type="text/javascript">
$(document).ready(function(){
	$('input[type="radio"]').click(function(){
		if($(this).attr("value")=="buy"){
			$(".box").not(".buy").hide();
			$(".buy").show();
			$(".stock").show();

		}
		if($(this).attr("value")=="sell"){
			$(".box").not(".sell").hide();
			$(".sell").show();
			$(".stock").show();
		}
	});
});
</script>

<div id="body">	
	<div class="container">
		<div class="col-md-12 content-left">
			<div class="contact-form wow fadeInUp animated">
				<h3><b>Company Lookup</b></h3><br>

				<!--Loads either buying or selling menu and boxes-->
				<p>What would you like to do?</p>
				<label><input type="radio" name="transactionType" value="buy">Buy</label>&nbsp;&nbsp;
				<label><input type="radio" name="transactionType" value="sell">Sell</label>

				<!--Loads menu with complete ASX list for buying-->
				<div class="buy box" style="display:none">
					<br><p>Select a company</p>
					<form  name="APIsearchForm" onsubmit="return false";>						
						{{ Form::open() }}
						{{ Form::select('symbol', $companies, null, ['onchange' => 'ajaxSearch(this.value);'], ['placeholder' => 'Select a company...']) }}
						{{ Form::close() }}
						{{ csrf_field() }}
					</form>
					<br>
					<p>Or search by company symbol</p>
					<form  name="APIsearchForm" onsubmit="ajaxSearch(this.value);"> 
						<input name="symbol" placeholder="eg. ASX.AX" type="text" style="width: 250px" > 
						<button class="submitButt" type="submit" value="submit">Search</button>
						{{ csrf_field() }}
					</form>
					<br>

				</div>

				<!--Loads menu with all owned shares for selling-->
				<div class="sell box" style="display:none">
					<br><p>Select a company</p>
					<form  name="APIsearchForm" onsubmit="return false";>
						<!--TODO: Load in owned shares-->						
						<select name="ownedShares">
							<option value="1">TODO: Load companies</option>
							<option value="2">the user currently</option>
							<option value="3">owns shares of</option>
						</select>
						<br>
						{{ csrf_field() }}
					</form>
					<br>
					<p>Or search by company symbol</p>

					
					<!--TODO: Search box to use Ajax function-->
					<form  name="APIsearchForm" action="{{ action('CompanyController@index') }}" method="post"> 
						<input name="symbol" placeholder="eg. ASX.AX" type="text" style="width: 250px" value="<?php echo isset($_POST['symbol']) ? $_POST['symbol'] : '' ?>"> 
						<button class="submitButt" type="submit" value="submit">Search</button>
						{{ csrf_field() }}
					</form>
					<br>
				</div>
				<div class="stock box" style="display:none">
					<br><hr class="style1">
					<h3><b>Stockmarket Information</b></h3>
					<p> <span id="companyData"></span></p> 
					<p>TODO: Chart to go here</p><br>
					<!--TODO: chart to be refreshed to currently selected company-->
					<!--<div id="chart_div" style="width: 100%; height: 250px;"></div>-->
				</div>

				<!--Buying section-->
				<div class="buy box" style="display:none">
					<hr class="style1"><h3><b>Buy Shares</b></h3><br>
					<form  name="buySharesForm" action="{{ action('TransactionsController@index') }}" method="post">
						<input name="searchText" type="hidden" type="text" value="<?php echo isset($_POST['symbol']) ? $_POST['symbol'] : '' ?>">
<!-- 					Company : <?php echo $company ?>-->							
						<p>Shares to Buy :<input name="sharePrice" type="hidden" id="sharePrice" value="<?php echo $price ?>" >
						<input name="numberOfSharesBuy" id="numberOfSharesBuy" style="width: 4.5em" placeholder="No." type="number" min="1" step="1"
								onchange="calculateTotalShareCostBuy(this)" disabled> units</p>
							<p>Total Value: <input name="totalCostOfSharesBuy" style="width: 6em;" id="totalCostOfSharesBuy" value="" readonly> <?php echo $currency ?></p>
							<br>
							<button class="submitButt" id="buySharesButton" type="submit" value="submit" disabled>Buy Shares</button>
							<br><br>
							{{ csrf_field() }}	
						</form>
					</div><!--//Buy Shares-->

					<!--Selling section-->
					<div class="sell box" style="display:none">
						<hr class="style1"><h3><b>Sell Shares</b></h3><br>
						<form  name="sellSharesForm" action="{{ action('TransactionsController@index') }}" method="post">
								<!-- <p>Company : <?php echo $company ?></p> -->
								<p>Shares to Sell :<input name="sharePrice" type="hidden" id="sharePrice" value="<?php echo $price ?>" >
									<input name="numberOfSharesSell" id="numberOfSharesSell" style="width: 4.5em" placeholder="No." type="number" min="1" step="1"
									onchange="calculateTotalShareCostSell(this)" disabled> units</p>
									<p>Total Value: <input name="totalCostOfSharesSell" style="width: 6em;" id="totalCostOfSharesSell" value="" readonly> <?php echo $currency ?></p>
								<br>
								<button class="submitButt" id="sellSharesButton" type="submit" value="submit" disabled>Sell Shares</button>
								<br><br>
							</form>
						</div><!--//Sale Shares-->
					</div>
		</div>
	</div>
</div> <!--body-->

<?php
	if(isset($_POST['symbol']))
	{
		echo "<script type=\"text/javascript\"> document.getElementById('numberOfSharesBuy').disabled=false;
		document.getElementById('buySharesButton').disabled=false;</script>";

	}
	else
	{
		echo "";
	}
	if(isset($_POST['symbol']))
	{
		echo "<script type=\"text/javascript\"> document.getElementById('numberOfSharesSell').disabled=false;
		document.getElementById('sellSharesButton').disabled=false;</script>";

	}
	else
	{
		echo "";
	}
?>

@endsection