@extends('layouts.app')

@section('content')


<div id="body">	
	<div class="container">
		<div class="col-md-12 content-middle">
			<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
				<h3><b>Settings</b></h3><br>
				<form name="deleteUser" action="{{ action('SettingsController@deleteCurrentUser') }}" method="post">
					<button style="width:200px" class="btn btn-primary" id="deleteButton" type="submit" value="submit" >Delete Account</button>
					<input name="deleteID" type="hidden" id="deleteID" placeholder="deleteID" value="">
					{{ csrf_field() }}
				</form>
					<form name="clearWatchlist" action="{{ action('SettingsController@clearWatchlist') }}" method="post">
					<button style="width:200px" class="btn btn-primary" id="clearButton" type="submit" value="submit" >Clear Watchlist</button>
					<input name="clearWatchlist" type="hidden" id="clearWatchlist" placeholder="deleteID" value="">
					{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
