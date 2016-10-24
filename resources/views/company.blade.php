@extends('layouts.app')

@section('content')


	<div id="body">	
		<div class="container">
			<div class="col-md-16 content-left">
				<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
					<h3><b>Stockmarket Information</b></h3><br>
					<div class="form-group">
					{{ Form::open() }}
					{{ Form::select('companies', $companies, null, ['placeholder' => 'Select a company...'], array('symbol' => 'symbol')) }}
					{{ Form::button('Submit', array('type' => 'submit', )) }}
					{{ Form::close() }}
				</div>


				<ul>
					<li>Company: </li>
					<li>Price: </li>
					<li>Currency:</li>
					<li>Change: </li>				
				</ul>
				<img src="images/graph.png" alt="Mountain View">
				</div>
			</div>
		</div>
	</div><!--//body-->	
		

@endsection
