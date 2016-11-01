@extends('layouts.app')

@section('content')

<?php require(app_path().'/financeWebService.php') ?>
<script type="text/javascript">

<?php
$company = "";
$price = 1;
$currency = "";
$change = "";
$changeFromYearHigh = "";
$graph = "";
$symbol = "";

if(isset($_POST)&&!empty($_POST))
{
	$stockSymbol = $_POST['symbol'];
	$stockData = search_stock($stockSymbol);
	$company = $stockData['name'];
	$price = $stockData['price'];
	$currency = $stockData['currency'];
	$change = $stockData['change'];


}

if(isset($_POST['totalCostOfSharesBuy']))
{
	$user = Auth::user();
	$user->decrement('balance',$_POST['totalCostOfSharesBuy']);
}
?>

var symbolSearch = document.getElementById("symbolSearch").value;

function processApiData(array)
{
    var row1col1 = "<h3><b>Stock Information for " +array.Name+"</b></h3>";
	var row2col1 = "<label><input type='checkbox' id='cbox1' value='first_checkbox'> Add to watch list</label>";
    var row3col1 = '<table style="width:100%"><tr><th><h5>Symbol:</h5></th><td>'+array.Symbol+ '</td>';
    var row3col2 = '<th><h5>Currency:</h5></th><td>'+array.Currency+'</td></tr>';
	var row4col1 = '<tr><th><h5>Current Price:</h5></th><td>$'+array.Ask+'</td>';
	var row4col2 = '<th><h5>Change:</h5></th><td>$'+array.Change+'</td></tr>';
	var row5col1 = '<tr><th><h5>Year High:</h5></th><td>$'+array.YearHigh+'</td>';
	var row5col2 = '<th><h5>Year Low:</h5></th><td>$'+array.YearLow+'</td></tr></table>';
	var newContent = row1col1+row2col1+row3col1+row3col2+row4col1+row4col2+row5col1+row5col2;
    document.getElementById("companyData").innerHTML = newContent;

    document.getElementById('numberOfSharesBuy').disabled=false;
    document.getElementById('buySharesButton').disabled=false;
    document.getElementById('sharePrice').value = array.Ask;

    document.getElementById('companyName').value = array.symbol;

    //Set Limits for buying shares based on the users current balance
    var maxPurchaseable = (<?php echo Auth::User()->balance; ?>) / array.Ask;
    document.getElementById('maxAmount').innerHTML = "Maximum with current funds: " + maxPurchaseable.toFixed(3);
    document.getElementById('numberOfSharesBuy').max = maxPurchaseable;

    //Set Limis for selling shares based on number currently owned

}

function ajaxSearch(str)
{

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if (this.readyState == 4)
		{
			//document.getElementById("companyData").innerHTML = this.responseText;
            var json = JSON.parse(this.responseText);
            processApiData(json);
            createChart(str);
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


// Script to generate chart
function createChart(str) {

google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

     var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
    function reqListener () {
      console.log(this.responseText);
    }
    var oReq = new XMLHttpRequest(); //New request object
    oReq.onload = function() {

       	//alert(this.responseText);
        var json = JSON.parse(this.responseText);
        var date = 0;
        var high = 0;
        var low = 0;
        var rows = new Array();
        var data = new google.visualization.DataTable();

     for(var i = 1; i < json.length ; i++) {
        date = json[i].date;
        high = parseFloat(json[i].high)
        low = parseFloat(json[i].low);
        rows.push([date, high, low]);
      }

      data.addColumn('string', 'Date');
      data.addColumn('number', 'High');
      data.addColumn('number', 'Low');
      data.addRows(rows);

        var options = {
          title: 'Company Performance - Last 7 Days',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('curve_chart'));

        chart.draw(data, options);

    };
    oReq.open("get", "{{ action('HistoricController@index') }}"+"?q=" + str, true);
    oReq.send();
      }
    }
</script>
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
				<h3><b>Transactions</b></h3><br>

				<!--Loads either buying or selling menu and boxes-->
				<p>What would you like to do?</p>
				<label><input type="radio" name="transactionType" value="buy">Buy</label>&nbsp;&nbsp;
				<label><input type="radio" name="transactionType" value="sell">Sell</label>

				<!--Loads menu with complete ASX list for buying-->
				<div class="buy box" style="display:none">
					<section>
						<div id="left">
							<form  name="APIsearchForm" onsubmit="return false";>
								{{ Form::open() }}
								{{ Form::select('symbol', $companies, null, ['placeholder' => 'Select a company...', 'onchange' => 'ajaxSearch(this.value);']) }}
								{{ Form::close() }}
								{{ csrf_field() }}
							</form>
							<br>
							<p>Or search by company symbol</p>
							<form  name="APIsearchForm" onsubmit="return false">
								<input name="symbol" id="symbolSearch" placeholder="eg. ASX.AX" type="text" style="width: 250px" >
								<button class="submitButt" type="submit" onclick="ajaxSearch(symbolSearch.value);" value="submit">Search</button>
								{{ csrf_field() }}
							</form>
						</div>

						<div id="right">
							<form  name="buySharesForm" action="{{action('TransactionsController@buy')}}" method="post">
								<input name="searchText" type="hidden" type="text" value="<?php echo isset($_POST['symbol']) ? $_POST['symbol'] : '' ?>">
								<!-- 					Company : <?php echo $company ?>-->
								<p>Shares to Buy :<input name="sharePrice" type="hidden" id="sharePrice" value="<?php echo $price ?>" >
									<input name="numberOfSharesBuy" id="numberOfSharesBuy" style="width: 4.5em" placeholder="#" type="number" min="1" max = ""step="1"
									onchange="calculateTotalShareCostBuy(this)" disabled>
									<p id='maxAmount' style="color:red; font-size: 11px;"></p></p>
									<p>Total Value: $<input name="totalCostOfSharesBuy" style="width: 6em; border: 0"  id="totalCostOfSharesBuy" value="" readonly> <?php echo $currency ?></p>
									<input name="companyName" type="hidden" id="companyName" placeholder="symbol" value="">
									<br>
									<button class="submitButt" id="buySharesButton" type="submit" value="submit" disabled>Buy Shares</button>
									<br><br>
									{{ csrf_field() }}
								</form>
								<br>
							</div>
						</section>
					</div><!--Buy box-->

					<!--Loads menu with all owned shares for selling-->
					<div class="sell box" style="display:none">
						<section>
							<div id="left">
								<form  name="APIsearchForm" onsubmit="return false";>
									<!--TODO: Load in owned shares-->
									<select name="ownedShares" style=" width:513px">
										<option value="" disabled selected hidden>Select a company...</option>
										<?php
											$currentHoldings = getHoldings(Auth::User()->id);
											if (count($currentHoldings) > 0) {
												foreach ($currentHoldings as $key=>$value) {
													echo ('<option value="'.$key.'">'.strtoupper($key).'    (' .$value. 'Currently Owned)</option>');
												}
											} else {
												echo ('<option value = "empty">No Current Shares Owned</option>');
											}
										?>
									</select>
									<br>
									{{ csrf_field() }}
								</form>
								<br>
								<p>Or search by company symbol</p>
								<!--TODO: Search box to use Ajax function-->
								<form  name="APIsearchForm" action="{{ action('TransactionsController@index') }}" method="post">
									<input name="symbol" placeholder="eg. ASX.AX" type="text" style="width: 250px" value="<?php echo isset($_POST['symbol']) ? $_POST['symbol'] : '' ?>">
									<button class="submitButt" type="submit" value="submit">Search</button>
									{{ csrf_field() }}
								</form>
							</div>

							<div id="right">
								<form  name="sellSharesForm" action="{{ action('TransactionsController@index') }}" method="post">
									<!-- <p>Company : <?php echo $company ?></p> -->
									<p>Shares to Sell :<input name="sharePrice" type="hidden" id="sharePrice" value="<?php echo $price ?>" >
										<input name="numberOfSharesSell" id="numberOfSharesSell" style="width: 4.5em"  placeholder="#" type="number" min="1" step="1"
										onchange="calculateTotalShareCostSell(this)" disabled></p>
										<p>Total Value: $<input name="totalCostOfSharesSell" style="width: 6em; border: 0" id="totalCostOfSharesSell" value="" readonly> <?php echo $currency ?></p>
										<input name="companyName" type="hidden" id="companyName" placeholder="symbol" value="">
										<br>
										<button class="submitButt" id="sellSharesButton" type="submit" value="submit" disabled>Sell Shares</button>
									<br><br>
									{{ csrf_field() }}
								</form>
									<br>
								</div>
							</section>
						</div><!--Sell box-->

						<div class="stock box" style="display:none">
							<p> <span id="companyData"></span></p>
    						<div id="curve_chart" style="width: 1000px; height: 500px"></div>
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