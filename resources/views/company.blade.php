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

function resetDropDown()
    {
        
        document.getElementById("companyDropDown").selectedIndex=0;
    }
    
function resetSymbolSearch()
    {
        
        var x =document.getElementById("symbolSearch");
        
        x.value = "";
        
    }
    
var symbolSearch = document.getElementById("symbolSearch").value;

function processApiData(array)
{
    if(array.Name != null)
        {
            var newContent = '<br><li>Company : '+array.Name+'</li><li>Price &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : '+array.Ask+'</li><li>Currency  : '+array.Currency+'</li><li>Change   &nbsp;&nbsp; : '+array.Change+'</li>';
    
            document.getElementById("companyData").innerHTML = newContent;

            document.getElementById('numberOfSharesBuy').disabled=false;   
            document.getElementById('buySharesButton').disabled=false;
            document.getElementById('sharePrice').value = array.Ask;

        }
    else
        {
            var newContent = '<br><li> Company not found </li>';
            document.getElementById("companyData").innerHTML = newContent;
        }

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


function createChart(str) {

google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

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
      // This line is commented out because it should be deleted
      // data.addColumn('string', 'Subject');

      // These lines should be added for column headers
      data.addColumn('string', 'Date');
      data.addColumn('number', 'High');
      data.addColumn('number', 'Low');

      data.addRows(rows);


        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('curve_chart'));

        chart.draw(data, options);

    };
    oReq.open("get", "{{ action('HistoricController@index') }}"+"?q=" + str, true);
    //                               ^ Don't block the rest of the execution.
    //                                 Don't wait until the request finishes to 
    //                                 continue.
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
				<h3><b>This is a test page</b></h3><br>

				<!--Loads either buying or selling menu and boxes-->
				<p>What would you like to do?</p>
				<label><input type="radio" name="transactionType" value="buy">Buy</label>&nbsp;&nbsp;
				<label><input type="radio" name="transactionType" value="sell">Sell</label>

				<!--Loads menu with complete ASX list for buying-->
				<div class="buy box" style="display:none">
					<section>
						<div id="left">
							<form  name="APIsearchForm" onsubmit="return false">						
								{{ Form::open() }}
								{{ Form::select('symbol', $companies, null, ['placeholder' => 'Select a company...', 'onchange' => 'ajaxSearch(this.value);resetSymbolSearch();','id' =>'companyDropDown']) }}
								{{ Form::close() }}
								{{ csrf_field() }}
							</form>
							<br>
							<p>Or search by company symbol</p>
							<form  name="APIsearchForm" onsubmit="return false"> 
								<input name="symbol" id="symbolSearch" placeholder="eg. ASX.AX" type="text" style="width: 250px" > 
								<button class="submitButt" type="submit" onclick="ajaxSearch(symbolSearch.value);resetDropDown();" value="submit" id="symbolSearchField">Search</button>
								{{ csrf_field() }}
							</form>
						</div>

						<div id="right">
							<form  name="buySharesForm" action="{{ action('TransactionsController@index') }}" method="post">
								<input name="searchText" type="hidden" type="text" value="<?php echo isset($_POST['symbol']) ? $_POST['symbol'] : '' ?>">
								<!-- 					Company : <?php echo $company ?>-->							
								<p>Shares to Buy :<input name="sharePrice" type="hidden" id="sharePrice" value="<?php echo $price ?>" >
									<input name="numberOfSharesBuy" id="numberOfSharesBuy" style="width: 4.5em" placeholder="#" type="number" min="1" step="1"
									onchange="calculateTotalShareCostBuy(this)" disabled> </p>
									<p>Total Value: <input name="totalCostOfSharesBuy" style="width: 6em; border: 0"  id="totalCostOfSharesBuy" value="" readonly> <?php echo $currency ?></p>
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
							</div>
							
							<div id="right">
								<form  name="sellSharesForm" action="{{ action('TransactionsController@index') }}" method="post">
									<!-- <p>Company : <?php echo $company ?></p> -->
									<p>Shares to Sell :<input name="sharePrice" type="hidden" id="sharePrice" value="<?php echo $price ?>" >
										<input name="numberOfSharesSell" id="numberOfSharesSell" style="width: 4.5em"  placeholder="#" type="number" min="1" step="1"
										onchange="calculateTotalShareCostSell(this)" disabled></p> 
										<p>Total Value: <input name="totalCostOfSharesSell" style="width: 6em; border: 0" id="totalCostOfSharesSell" value="" readonly> <?php echo $currency ?></p> 
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
							<hr class="style1">
							<h3><b>Stockmarket Information</b></h3>
							<p> <span id="companyData"></span></p> 
							  
    						<div id="curve_chart" style="width: 900px; height: 500px"></div>

							<!--TODO: chart to be refreshed to currently selected company-->
							<!--<div id="chart_div" style="width: 100%; height: 250px;"></div>-->
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