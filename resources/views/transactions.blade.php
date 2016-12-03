@extends('layouts.app')

@section('content')

<script type="text/javascript">



    
function resetDropDown()
    {
        
        document.getElementById("companyDropDown").selectedIndex=0;
    }
    
function resetSymbolSearch()
    {
        
        var x =document.getElementById("symbolSearch");
        
        x.value = "";
        
    }
    

var symbolSearch = document.getElementById("symbolSearchField").value;

function processApiData(array)
{

    var row1col1 = "<h3><b>Stock Information for " +array.Name+"</b></h3>";
    var row3col1 = '<table style="width:100%"><tr><th><h5>Symbol:</h5></th><td>'+array.Symbol+ '</td>';
    var row3col2 = '<th><h5>Currency:</h5></th><td>'+array.Currency+'</td></tr>';
	var row4col1 = '<tr><th><h5>Current Price:</h5></th><td>$'+array.Ask+'</td>';
	var row4col2 = '<th><h5>Change:</h5></th><td>$'+array.Change+'</td></tr>';
	var row5col1 = '<tr><th><h5>Year High:</h5></th><td style="color:green">$'+array.YearHigh+'</td>';
	var row5col2 = '<th><h5>Year Low:</h5></th><td style="color:red";>$'+array.YearLow+'</td></tr>';
	var newContent = row1col1+row3col1+row3col2+row4col1+row4col2+row5col1+row5col2;

    document.getElementById("companyData").innerHTML = newContent;
    document.getElementById('numberOfSharesBuy').disabled=false;
    document.getElementById('numberOfSharesSell').disabled=false;
    document.getElementById('sharePrice').value = array.Ask;
    document.getElementById('companyName').value = array.Name;
    document.getElementById('companySymbol').value = array.symbol;

    //Set values used for Watchlist
    document.getElementById('companySym').value = array.symbol;
    document.getElementById('companyNm').value = array.Name;

    //Set Limits for buying shares based on the users current balance
    var maxPurchaseable = (<?php echo Auth::User()->balance; ?>) / array.Ask;
    document.getElementById('maxAmount').innerHTML = "Maximum with current funds: " + maxPurchaseable.toFixed(0);
    document.getElementById('numberOfSharesBuy').max = maxPurchaseable;

    //Set Limis for selling shares based on number currently owned
    document.getElementById('companySymbolSell').value = array.symbol;
    document.getElementById('companyNameSell').value = array.Name;
    document.getElementById('sharePriceSell').value = array.Ask;
    document.getElementById('companySell').innerHTML = "Company: " + array.Name;
}


function ajaxSearch(str)
{
	var [str, number] = str.split('-');
	document.getElementById('numberOfSharesSell').max = number;

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if (this.readyState == 4)
		{
            var json = JSON.parse(this.responseText);
            if (json.Ask != null){
				processApiData(json);
	            createChart(str);
	            document.getElementById('stockBox').style.display = 'block';
            }
            else {
            	alert("Company not found!");
            }
            
		}
	};
	xmlhttp.open("GET", "{{ action('ApiRequestController@index') }}"+"?q=" + str, true);
	xmlhttp.send();

}

function calculateTotalShareCostBuy(numShares)
{
	document.getElementById("totalCostOfSharesBuy").value=parseFloat(numShares.value*document.getElementById("sharePrice").value).toFixed(2);
	document.getElementById('buySharesButton').disabled=false;
}

function calculateTotalShareCostSell(numShares)
{
	document.getElementById("totalCostOfSharesSell").value=parseFloat(numShares.value*document.getElementById("sharePrice").value).toFixed(2);
	document.getElementById('sellSharesButton').disabled=false;
}


// Script to generate chart
function createChart(str) {
google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

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

     for(var i = 1; i < 8 ; i++) {
       	date = json[i].date.slice(5,10);
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
        	titleTextStyle: {
    		color: '#636B6F',
    		fontSize: '10px'},
          curveType: 'function',
            hAxis: {textStyle: {
			    fontSize: 12
  			}},
  			vAxis: {textStyle: {
			    fontSize: 12
  			}},
          legend: { position: 'bottom'},
          chartArea: {'left': '5%', 'right': '2%',  'width': '100%', 'height': '80%'},
        };

        var chart = new google.visualization.AreaChart(document.getElementById('curve_chart'));
        document.getElementById('curve_chart').style="height: 500px";
        chart.draw(data, options);

    };
    oReq.open("get", "{{ action('ChartController@index') }}"+"?q=" + str, true);
    oReq.send();
      }
    }

</script>


<!--Script to show/hide DIV depending on box checked-->
<script type="text/javascript">
$(document).ready(function(){
	$('input[type="radio"]').click(function(){
		if($(this).attr("value")=="buy"){
			$(".box").not(".buy").hide();
			$(".buy").show();
			//$(".stock").show();

		}
		if($(this).attr("value")=="sell"){
			$(".box").not(".sell").hide();
			$(".sell").show();
			//$(".stock").show();
		}
	});
});


</script>

<div id="body">
	<div class="container">
		<div class="col-md-12 content-left">
			<div class="contact-form wow fadeInUp animated">
				<h3><b>Place an order</b></h3><br>

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
								{{ Form::select('symbol', $companies, null, ['placeholder' => 'Select a company...', 'onchange' => 'ajaxSearch(this.value);resetSymbolSearch();','id' =>'companyDropDown']) }}				
								{{ Form::close() }}
								{{ csrf_field() }}
							</form>
							<br>
							<p>Or search by company symbol</p><br>
							<form  name="APIsearchForm" onsubmit="return false">
								<input name="symbol" id="symbolSearch" placeholder="eg. ASX.AX" type="text" style="width: 200px" >
								<button class="btn btn-primary"  type="submit" onclick="ajaxSearch(symbolSearch.value);resetDropDown();" value="submit" id="symbolSearchField">Search</button>

								{{ csrf_field() }}
							</form>
						</div>

						<div id="right">
							<form  name="buySharesForm" action="{{action('TransactionsController@buy')}}" method="post">
								<input name="searchText" type="hidden" type="text" value="<?php echo isset($_POST['symbol']) ? $_POST['symbol'] : '' ?>">
								<p>Shares to Buy :<input name="sharePrice" type="hidden" id="sharePrice" value="" >
									<input name="numberOfSharesBuy" id="numberOfSharesBuy" style="width: 4.5em" placeholder="#" type="number" min="1" max = ""step="1"
									onchange="calculateTotalShareCostBuy(this)">
									<p id='maxAmount' style="color:red; font-size: 11px;"></p>
									<p>Total Value: $<input name="totalCostOfSharesBuy" style="width: 6em; border: 0"  id="totalCostOfSharesBuy" value="" readonly></p>
									<input name="companySymbol" type="hidden" id="companySymbol" placeholder="symbol" value="">
									<input name="companyName" type="hidden" id="companyName" placeholder="name" value="">
									<p id = "buyTransactionFee"><i>Transaction Fees: $50 plus 1% of Purchase Price</i></p>
									<br>
									<button class="btn btn-primary" id="buySharesButton" type="submit" value="submit" disabled>Buy Shares</button>
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
									<select name="ownedShares" style=" width:513px" onchange="ajaxSearch(this.value)";>
										<option value="" disabled selected hidden>Select a company...</option>
										<?php
											$currentHoldings = getHoldings(Auth::User()->id);
											if (count($currentHoldings) > 0) {
												foreach ($currentHoldings as $key=>$value) {
													echo ('<option value="'.$value[0].'-'.$value[1].'">'.strtoupper($key).'    (' .$value[1]. ' Currently Owned)</option>');
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
								
								
							</div>

							<div id="right">
								<form  name="sellSharesForm" action="{{ action('TransactionsController@sell') }}" method="post">
									<p id = "companySell" >Company: </p>
									<p>Shares to Sell :<input name="sharePriceSell" type="hidden" id="sharePriceSell" value="" >
										<input name="numberOfSharesSell" id="numberOfSharesSell" style="width: 4.5em"  placeholder="#" type="number" min="1" max=""step="1"
										onchange="calculateTotalShareCostSell(this)" disabled></p>
										<p id='maxToSell' style="color:red; font-size: 11px;"></p>
										<p>Total Value: $<input name="totalCostOfSharesSell" style="width: 6em; border: 0" id="totalCostOfSharesSell" value="" readonly> </p>
										<p id = 'sellTransactionFee'><i>Transaction Fees: $50 plus 0.25% of Sale Price </i></p>
										<input name="companySymbolSell" type="hidden" id="companySymbolSell" placeholder="symbol" value="">
										<input name="companyNameSell" type="hidden" id="companyNameSell" placeholder="name" value="">
										<br>
										<button class="btn btn-primary" id="sellSharesButton" type="submit" value="submit" disabled>Sell Shares</button>
									<br><br>
									{{ csrf_field() }}
								</form>
									<br>
								</div>
							</section>
						</div><!--Sell box-->

						<div class="stock box" id="stockBox" style="display:none">
							<p> <span id="companyData"></span></p>
							<h3><span id="chart_title"></span></h3>
								<form  name="buySharesForm" action="{{action('WatchlistController@add')}}" method="post">
									<button class="btn btn-primary" id="buySharesButton" type="submit" value="submit" >Add to Watchlist</button>
									<input name="companySym" type="hidden" id="companySym" placeholder="symbol" value="">
									<input name="companyNm" type="hidden" id="companyNm" placeholder="name" value="">

									{{ csrf_field() }}
								</form>
    						<div id="curve_chart"></div>
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