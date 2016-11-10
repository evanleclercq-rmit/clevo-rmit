@extends('layouts.app')

@section('content')
<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<script type="text/javascript">
$(function() {
    $('input[name="daterange"]').daterangepicker();
});
</script>

<div id="body">	
			<div class="container">
			<div class="col-md-12 content-left" >
				<div class="contact-form wow fadeInUp animated" id="holdings" data-wow-delay=".1s" >
					<h3><b>Transaction History</b></h3><br>
					<p>Select a date range: 
					<input type="text" name="daterange" style="width:200px"  /></p>

			<table style="width:100%" >
			
			<tr><td><b>Date</td><td><b>Type</td><td><b>Company</td><td><b>Units Traded</td><td><b>Price Per Unit</td><td><b>Total Price</td></tr>
		
		<?php 

					foreach ($history as $transaction) {
						echo 
						"<tr><td>".$transaction['date']. "</td>
						<td>".$transaction['type']. "</td> 
						<td>".$transaction['symbol']. "</td> 
						<td>".$transaction['number']."</td>
						<td>$".$transaction['price']."</td>
						<td>$".$transaction['total']."</td>
						</tr>";
					}

         ?>				
			</table>
				</div>
	
				</div> <!--container-->
			</div> <!--body-->

			@endsection