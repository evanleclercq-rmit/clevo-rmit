@extends('layouts.app')

@section('content')
<?php require(app_path().'/financeWebService.php') ?>

		<script type="text/javascript">
			function calculateTotalShareCostBuy(numShares)
                {
                    document.getElementById("totalCostOfSharesBuy").value=numShares.value*document.getElementById("sharePrice").value;
                }
				
			function calculateTotalShareCostSell(numShares)
                {
                    document.getElementById("totalCostOfSharesSell").value=numShares.value*document.getElementById("sharePrice").value;
                }
			
		</script>


<?php
    require_once('../app/financeWebService.php');

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
		$changeFromYearHigh = $stockData['changeFromYearHigh'];
		$graph = $stockData['graph'];

	}
	    if(isset($_POST['totalCostOfSharesBuy']))
        {
            $user = Auth::user();
            $user->decrement('balance',$_POST['totalCostOfSharesBuy']);
        }
?>


	<div id="body">	
		<div class="container">
			<div class="col-md-16 content-left">
				<div class="contact-form wow fadeInUp animated" >
					<h3><b>Stockmarket Information</b></h3><br>
					<div class="form-group">
					{{ Form::open() }}
					{{ Form::select('symbol', $companies, null, ['placeholder' => 'Select a company...']) }}
					{{ Form::button('Submit', array('type' => 'submit', )) }}
					{{ Form::close() }}
				</div>
				<br>
				<section>

 				<div id="info">

				<table>
				  <tr>
				    <th>Company:</th>
				    <td><?php echo $company ?></td>
				  </tr>
				  <tr>
				  	<th>Price:</th> 
				    <td><?php echo $price ?></td> 
				  </tr>
				  <tr>
				  	<th>Currency:</th> 
				    <td><?php echo $currency ?></td> 
				  </tr>
				   <tr>
				  	<th>Change: </th> 
				    <td><?php echo $change ?></td> 
				  </tr>
				    <tr>
				  	<th>Change from year high:</th> 
				    <td><?php echo $changeFromYearHigh ?></td> 
				  </tr>
				</table>
				</div>
				<div id="graph">
				 	<?php echo $graph ?>
				</div>
 				</section>
				<form  name="buySharesForm" action="{{ action('DashboardController@index') }}" method="post">
                    <input name="searchText" type="hidden" type="text" value="<?php echo isset($_POST['symbol']) ? $_POST['symbol'] : '' ?>">
					
					Shares to Buy :<input name="sharePrice" type="hidden" id="sharePrice" value="<?php echo $price ?>" ><br>
					<input name="numberOfSharesBuy" id="numberOfSharesBuy" style="width: 4.5em" placeholder="#" type="number" min="1" step="1"
                       onchange="calculateTotalShareCostBuy(this)" disabled><br>
					Total Value: <input name="totalCostOfSharesBuy" style="width: 6em;" id="totalCostOfSharesBuy" value="" readonly> <?php echo $currency ?><br>
					
					<button class="submitButt" id="buySharesButton" type="submit" value="submit" disabled>Buy Shares</button>
					<br>
				{{ csrf_field() }}	
				</form>
				</div>
			</div>
		</div>
	</div><!--//body-->	
		
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
