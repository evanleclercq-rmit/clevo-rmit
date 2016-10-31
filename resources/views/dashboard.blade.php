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
			var row3 = '<tr><th><h5>Currency:</h5></th><td>'+array.Currency+'</td></tr>';
			var row4 = '<tr><th><h5>Change:</h5></th><td>$'+array.Change+'</td></tr>';
			var row5 = '<tr><th><h5>Add to Favourites?</h5></th><td><form action=""><input type="radio" name="favourite" value="favourite"> Yes<br></td></form></tr></table>';
			var newContent = row1+row2+row3+row4+row5;
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

</script>


	<div id="body">	
		<div class="container">
			<div class="col-md-12 content-left">
				<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
					<h3><b>Stockmarket Information</b></h3>
					<form  name="APIgraphForm" action="{{ action('DashboardController@index') }}" method="post">
					<select name="searchText" style="width: 12em" onchange="">
					<option value="">Select From Favourites</option>
					<option value="fav1">Favourite1</option>
					<option value="fav2">Favourite2</option>
					<option value="fav3">Favourite3</option>
					<option value="fav4">Favourite4</option>
					<option value="fav5">Favourite5</option>
					<option value="fav6">Favourite6</option>
					<option value="fav7">Favourite7</option>
					<option value="fav8">Favourite8</option>
					<option value="fav9">Favourite9</option>
					<option value="fav10">Favourite10</option>
					</select>
					</form><br>
					<div id="chart_div" style="width: 100%; height: 250px;"><!--stockmarket chart-->
					</div>
	
				</div>
			</div>
		</div>
	</div><!--//body-->

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
					<tr>
						<th><h5>{{ Auth::user()->name }}</h5></th>
						<td>${{Auth::user()->balance}}</td>
					</tr>
					<tr>
						<th><h5>Bob</h5></th>
						<td>$15000</td>
					</tr>
					<tr>
						<th><h5>Mike</h5></th>
						<td>$13500</td>
					</tr>
					
			</table>
			
			<div id="table_div"></div><!--Leaderboard-->
		</div>
	</div>
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
