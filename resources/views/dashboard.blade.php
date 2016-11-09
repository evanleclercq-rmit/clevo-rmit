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
					<input name="symbol" id="symbolSearch" placeholder="eg. ASX.AX" type="text" style="width: 260px" >
					<button class="submitButt" type="submit" onclick="ajaxSearch(symbolSearch.value);resetDropDown();" value="submit" id="symbolSearchField">Search</button>
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
						<td>${{ number_format((float)Auth::user()->balance, 2, '.', '') }}</td>
					</tr>
					<tr>
						<th><h5>Shares Value:</h5></th>
						<td>$<?php echo $shareValue ?></td>
					</tr>
					<tr>
						<th><h5>Total Holdings Value:</h5></th>
						<td>$<?php echo number_format((float)Auth::user()->balance+$shareValue, 2, '.', '') ?> </td>
					</tr>
					<tr>
						<th><h5>Profit:</h5></th>
						<td>$</td>
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
					echo "<tr><td><b>#</td><td><b>Name</td><td><b>Total value</td></tr>";

					foreach ($leaders as $leader)
					{
						$i++;
						echo
						"<tr>
						<td>" .$i. ". </td><td>".$leader[0]."</td><td>$".round($leader[1])."</td></tr>";
					 } 
					 ?>
				</table>
			</div>
		</div><!--//Leaderboard-->
	</div><!--//First Container-->

	<div class="container"><!--//Second Container-->
		<div class="col-md-12 content-left"><!--//Watch List-->
			<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
				<h3><b>Watch List</b></h3>
				<form name="APIgraphForm" onsubmit="return false">
					{{ Form::open() }}
					{{ Form::select('symbol', $watchlist, null, array('placeholder' => 'Select a company...', 'onchange' => 'createChart(this.value)', 'class' => 'ASXList')) }}
					{{ Form::close() }}
					{{ csrf_field() }}
				</form>
				<form name="buySharesForm" action="{{ action('WatchlistController@remove') }}" method="post">
					<button class="submitButt" id="buySharesButton" type="submit" value="submit" >Unwatch</button>
					<input name="companySym" type="hidden" id="companySym" placeholder="symbol" value="">
					{{ csrf_field() }}
				</form>
				<div id="curve_chart"></div>
			</div>
		</div><!--//Watch List-->
	</div>
</div><!--//body-->


@endsection
