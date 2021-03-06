<!--

Blade for the dashboard page
www.clevo-rmit.space/public/dashboard

Contains interface for user's holdings info, leaderboard,
quick stock lookup and viewing companies on watchlist.

-->

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

// Displays company data to corresponding html elements. Called from AJAX API function
function processApiData(array)
{
	if(array.Name != null)
	{
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

// Makes the API request 
function ajaxSearch(str)
{
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
		if (this.readyState == 4)
		{
			var json = JSON.parse(this.responseText);
			processApiData(json);

		}
	};
	xmlhttp.open("GET", "{{ action('ApiRequestController@index') }}"+"?q=" + str, true);
	xmlhttp.send();
}

// Generates price chart. Called from AjaxSearch()
function createChart(str) {

	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {

		var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
		function reqListener () {
			console.log(this.responseText);
		}
    var oReq = new XMLHttpRequest();
    oReq.onload = function() {
       	var json = JSON.parse(this.responseText);
       	var date = 0;
       	var high = 0;
       	var low = 0;
       	var rows = new Array();
       	var data = new google.visualization.DataTable();
    
    // removes year from date and changes format to DD/MM
     for(var i = 1; i < 8 ; i++) {
       	date = json[i].date.slice(5,10);
       	var [month, day] = date.split('-');
       	day = day.concat('-');
       	date = day.concat(month);
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
  			}, title: "Date",
  		      direction: '-1'},
  			vAxis: {textStyle: {
			    fontSize: 12
  			}, format: '$#.###', title: "Price",
},
          legend: { position: 'bottom'},
          chartArea: {'left': '10%', 'right': '2%',  'width': '100%', 'height': '80%'},
        };

       		var chart = new google.visualization.AreaChart(document.getElementById('curve_chart'));
       		document.getElementById('removeWatch').disabled=false;
       		document.getElementById('removeWatch').style="display: ";
       		document.getElementById('curve_chart').style="height: 500px";
       		chart.draw(data, options);


       	};
     document.getElementById('companySym').value = str;
     oReq.open("get", "{{ action('ChartController@index') }}"+"?q=" + str, true);
     oReq.send();
	}
}
</script>

<div id="body">
	<div class="container"><!--//First Container-->
		<div class="col-md-4 content-left"><!--Search Live Stock-->
			<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
				<h3><b>Search Live Stock</b></h3><br>
				<form name="APIsearchForm" onsubmit="return false";>
					{{ Form::open() }}
					{{ Form::select('symbol', $companies, null, array('placeholder' => 'Select a company...', 'onchange' => 'ajaxSearch(this.value);resetSymbolSearch();','id' =>'companyDropDown' , 'class' => 'ASXList')) }}
					{{ Form::close() }}
					{{ csrf_field() }}
				</form>
				<br>
				<p>Or search by company symbol</p>
				<form  name="APIsearchForm" onsubmit="return false">
					<input name="symbol" id="symbolSearch" placeholder="eg. ASX.AX" type="text" style="width: 200px" >
					<button class="btn btn-primary pull-right" type="submit" onclick="ajaxSearch(symbolSearch.value);resetDropDown();" value="submit" id="symbolSearchField">Search</button>
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
						<td>$20000.00</td>
					</tr>
					<tr> 
						<th><h5>Current Cash Balance:</h5></th>
						<td>${{ number_format((float)Auth::user()->balance, 2, '.', '') }}</td>
					</tr>
					<tr>
						<th><h5>Shares Value:</h5></th>
						<td>$<?php echo number_format(($shareValue), 2, '.', '')  ?></td>
					</tr>
					<tr>
						<th><h5>Total Holdings Value:</h5></th>
						<td>$<?php echo number_format((float)Auth::user()->balance+$shareValue, 2, '.', '') ?> </td>
					</tr>
					<tr>
						<th><h5>Profit:</h5></th>
						<?php 
							$profit = Auth::user()->balance+$shareValue-20000;

							if ($profit > 0){
								echo "<td style='color:green'>$" . number_format((float)$profit, 2, '.', '') . "</td>";
							}
							else {
								echo "<td style='color:red'>$" . number_format((float)$profit, 2, '.', '') . "</td>";
						}?>
					</tr>
				</table>

			</div>
		</div><!--//Current Holdings-->

		<div class="col-md-4 content-right"><!--//Leaderboard-->
			<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
				<h3><b>Leaderboard</b></h3><br>
				<table style="width:100%">
					<?php
					$i = 0;
					//echo "<tr><td><b>#</td><td><b>Name</td><td><b>Total value</td></tr>";
					foreach ($leaders as $leader)
					{
						$i++;
						
						if ($leader[0]==Auth::user()->name) {
						echo "<tr><td><b>" .$i. ". </b></td><td><b>".$leader[0]."</b></td><td><b>$".round($leader[1])."</b></td></tr>";
						}
						else {
						echo "<tr><td>" .$i. ". </td><td>".$leader[0]."</td><td>$".round($leader[1])."</td></tr>";
						}

						if ($i > 9){ // limits the leaderboard to a total of 10 users
							break;
						}
					 } 
					 ?>
				</table>
			</div>
		</div><!--//Leaderboard-->
	</div><!--//First Container-->

	<div class="container"><!--//Second Container-->
		<div class="col-md-12 content-left"><!--//Watch List-->
			<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s"  style="min-height: 50px">
				<h3><b>Watch List</b></h3>
				<form name="APIgraphForm" onsubmit="return false">
					{{ Form::open() }}
					{{ Form::select('symbol', $watchlist, null, array('placeholder' => 'Select a company...', 'onchange' => 'createChart(this.value)', 'class' => 'ASXList')) }}
					{{ Form::close() }}
					{{ csrf_field() }}
				</form>
				<form name="removeWatch" action="{{ action('WatchlistController@remove') }}" method="post">
					<button style="display: none;" class="btn btn-primary" id="removeWatch" type="submit" value="submit" disabled>Unwatch</button>
					<input name="companySym" type="hidden" id="companySym" placeholder="symbol" value="">
					{{ csrf_field() }}
				</form>
				<div id="curve_chart" ></div>
			</div>
		</div><!--//Watch List-->
	</div>
</div><!--//body-->


@endsection
