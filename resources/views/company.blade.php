@extends('layouts.app')

@section('content')

	<div id="body">	
		<div class="container">
			<div class="col-md-16 content-left">
				<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
					<h3><b>Stockmarket Information</b></h3><br>

					<!-- TradingView Widget BEGIN -->
					<form method="post">
					<select id="dropdown" name="dropdown" onchange="changeHiddenInput(this)"> 
					<option value="">Select Company</option>
					<option value="AAPL">APPLE</option>
					<option value="GOOGL">GOOGLE</option>
					<option value="MSFT">MICROSOFT</option>
					<option value="FB">FACEBOOK</option>
					<option value="AMZN">AMAZON</option>
					<option value="XOM">Exxon Mobil Corporation</option>
					<option value="BRK.B">Berkshire Hathaway Inc. Class B</option>
					<option value="JNJ">Johnson & Johnson </option>
					<option value="GE">General Electric</option>
					<option value="TCEHY">Tencent</option>
					</select>
    				<input type="hidden" name="hiddenInput" id="hiddenInput" value="" />

					{{ csrf_field() }}
				</form>
				<br>
				<div id="result"></div>
					<div id="tv-medium-widget-f0442">
					</div>
				</div>
			</div>
		</div>

		<script>var symbol = document.getElementById('gadget').value;</script>
		<script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
		<script type="text/javascript">
		function changeHiddenInput (objDropDown)
		{
		    var objHidden = document.getElementById("hiddenInput");
		    objHidden.value = objDropDown.value; 
		    var a = objHidden.value;
		     result = a || "";
		     new TradingView.MediumWidget({
			  "container_id": "tv-medium-widget-f0442",
			  "symbols": [
				[
				  , result
				],
			  ],
			  "gridLineColor": "#e9e9ea",
			  "fontColor": "#83888D",
			  "underLineColor": "#dbeffb",
			  "trendLineColor": "#4bafe9",
			  "width": "100%",
			  "height": "400px",
			  "locale": "en"
			});
		}

			</script>
			<!-- TradingView Widget END -->
	</div><!--//body-->	
		
	

@endsection
