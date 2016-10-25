@extends('layouts.app')

@section('content')

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
		$stockSymbol = $_POST['companies'];
		$stockData = search_stock($stockSymbol);
		$company = $stockData['name'];
		$price = $stockData['price'];
		$currency = $stockData['currency'];
		$change = $stockData['change'];
		$changeFromYearHigh = $stockData['changeFromYearHigh'];
		$graph = $stockData['graph'];

	}
?>

	<div id="body">	
		<div class="container">
			<div class="col-md-16 content-left">
				<div class="contact-form wow fadeInUp animated" >
					<h3><b>Stockmarket Information</b></h3><br>
					<div class="form-group">
					{{ Form::open() }}
					{{ Form::select('companies', $companies, null, ['placeholder' => 'Select a company...']) }}
					{{ Form::button('Submit', array('type' => 'submit', )) }}
					{{ Form::close() }}
				</div>
				<br>
				<section>

 				<div id="info">
<!--  					<ul>
					<li>Company: <?php echo $company ?></li>
					<li>Price: <?php echo $price ?></li>
					<li>Currency: <?php echo $currency ?></li>
					<li>Change: <?php echo $change ?></li>
					<li>Change from year high: <?php echo $changeFromYearHigh ?></li> 
					</ul>-->
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

				

				</div>
			</div>
		</div>
	</div><!--//body-->	
		

@endsection
