@extends('layouts.app')

@section('content')

<?php
                    
	$company = "";
	$price = "";
	$currency = "";
	$change = "";
                    
	if(isset($_POST)&&!empty($_POST))
	{
		$stockSymbol = $_POST['companies'];
		$stockData = search_stock($stockSymbol);
		$company = $stockData['name'];
		$price = $stockData['price'];
		$currency = $stockData['currency'];
		$change = $stockData['change'];

		//foreach ($stockData as $key => $value)
		//{
		//   echo $key, " :", $value, "<br>";      
		//}
	}
        
        
    function search_stock($stockSymbol)
    {
		$cSession = curl_init(); 
		$queryURL = 
"http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22".$stockSymbol."%22)&format=json&env=store://datatables.org/alltableswithkeys";
            
		curl_setopt($cSession,CURLOPT_URL,$queryURL);
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false);    
            
		$result = curl_exec($cSession);
		curl_close($cSession);
		$json = json_decode($result, true);
        
		$stockData = array	(
							"name" => $json['query']['results']['quote']['Name'],
							"price" => $json['query']['results']['quote']['Ask'],
							"currency" => $json['query']['results']['quote']['Currency'],
							"change" => $json['query']['results']['quote']['Change'],
							);
           
		return $stockData;
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


				<ul>
					<li>Company: <?php echo $company ?></li>
					<li>Price: <?php echo $price ?></li>
					<li>Currency: <?php echo $currency ?></li>
					<li>Change: <?php echo $change ?></li>					
				</ul>
				<img src="images/graph.png" alt="Mountain View">
				</div>
			</div>
		</div>
	</div><!--//body-->	
		

@endsection
