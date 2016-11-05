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

var symbolSearch = document.getElementById("symbolSearch").value;

function processApiData(array)
{
    if(array.Name != null)
        {
            // '<br><li>Company : '+array.Name+'</li><li>Price &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : '+array.Ask+'</li><li>Currency  : '+array.Currency+'</li><li>Change   &nbsp;&nbsp; : '+array.Change+'</li>';
    
            var row1 = '<table style="width:100%"><tr><th><h5>Company:</h5></th><td>'+array.Name+ '</td></tr>';
			var row2 = '<tr><th><h5>Share Value:</h5></th><td>$'+array.Ask+'</td></tr>';
			var row3 = '<tr><th><h5>Change:</h5></th><td>$'+array.Change+'</td></tr></table>';
			var newContent = row1+row2+row3;
            document.getElementById("companyData").innerHTML = newContent;
            document.getElementById('numberOfSharesBuy').disabled=false;   
            document.getElementById('buySharesButton').disabled=false;
            document.getElementById('sharePrice').value = array.Ask;
        }
    else
        {
            var newContent = '<table style="width:100%"><tr><th><h5>Company not found</h5></th></tr></table>';
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
            
		}
	};
	xmlhttp.open("GET", "{{ action('ApiRequestController@index') }}"+"?q=" + str, true);
	xmlhttp.send();
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

        chart.draw(data, options);

    };
    oReq.open("get", "{{ action('ChartController@index') }}"+"?q=" + str, true);
    oReq.send();
      }
    }
</script>




	<div id="body">	

<div class="container"><!--second container-->
	<div class="col-md-4 content-left"><!--Search Live Stock-->
		<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
			<h3><b>Search Live Stock</b></h3><br>
				<form name="APIsearchForm" onsubmit="return false";>						
								{{ Form::open() }}
								{{ Form::select('symbol', $companies, null, array('placeholder' => 'Select a company...', 'onchange' => 'ajaxSearch(this.value)', 'class' => 'ASXList')) }}
								{{ Form::close() }}
								{{ csrf_field() }}
							</form>
							<br>
							<p>Or search by company symbol</p>
							<form  name="APIsearchForm" onsubmit="return false"> 
								<input name="symbol" id="symbolSearch" placeholder="eg. ASX.AX" type="text" style="width: 260px" > 
								<button class="submitButt" type="submit" onclick="ajaxSearch(symbolSearch.value);" value="submit">Search</button>
								{{ csrf_field() }}
							</form>

				
				<p> <span id="companyData"></span></p> 

		
				
		</div>	
	</div><!--//Search Live Stock-->

	<div class="col-md-4 content-middle"><!--Current Holdings-->
		<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
			<h3><b>Current Holdings</b></h3><br>
			
			
			<table style="width:100%">
				<tr>
					<th><h5>Initial Cash Balance:</h5></th>
					<td>$20000</td>
				</tr>
				<tr>
					<th><h5>Current Cash Balance:</h5></th>
					<td>${{ Auth::user()->balance }}</td>
				</tr>
				<tr>
					<th><h5>Shares Value:</h5></th>
					<td>$</td>
				</tr>
				<tr>
					<th><h5>Total Holdings Value:</h5></th>
					<td>$</td>
				</tr>
				<tr>
					<th><h5>Profit:</h5></th>
					<td>$</td>
				</tr>
			</table>
				
		</div>
	</div><!--//Current Holdings-->
 
	<div class="col-md-4 content-right">
		<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
			<h3><b>Leaderboard</b></h3><br>
			
			<table style="width:100%">
				<?php 
				$i = 0;
            foreach ($users as $row)
            {
            	$i++;
            echo 
                "<tr>
                  <td>" .$i. ". ".$row."</td>
                </tr>";
            } ?>				
			</table>

			<!--<div id="table_div"></div>Leaderboard-->
		</div>
	</div>
</div><!--//second container-->

		<div class="container">
			<div class="col-md-12 content-left">
				<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
					<h3><b>Watch List</b></h3>
					<!--TODO: Add favourites-->
					<form  name="APIgraphForm" action="{{ action('DashboardController@index') }}" method="post">
					<select name="searchText" style="width: 12em" onchange="createChart(this.value)">
					<option value="">Select From Favourites</option>
					<option value="ASX.AX">ASX</option>
					<option value="AGX.AX">Agenix</option>
					<option value="MGS.AX">MGT Resources</option>
					<option value="fav4">Favourite4</option>
					<option value="fav5">Favourite5</option>
					<option value="fav6">Favourite6</option>
					<option value="fav7">Favourite7</option>
					<option value="fav8">Favourite8</option>
					<option value="fav9">Favourite9</option>
					<option value="fav10">Favourite10</option>
					</select>
					</form><br>
    				<div id="curve_chart"></div>
					</div>
	
				</div>
			</div>

	</div><!--//body-->

	
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
