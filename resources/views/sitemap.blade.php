@extends('layouts.app')

@section('content')

<div id="body">	
	<div class="container">
		<div class="col-md-12 content-middle">
			<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
				<h3><b>Site Map</b></h3>
				<ul>
					<li><i><a href="{{ url('/register') }}">Register</a></i></li>
					<li><i><a href="{{ url('/login') }}">Login</a></i></li>
					<li><i><a href="{{ url('/dashboard') }}">Dashboard</a></i></li>
					<li><i><a href="{{ url('/transactions') }}">Transactions</a></i></li>
                    <li><i><a href="{{ url('/history') }}">History</a></i></li>
					<li><i><a href="{{ url('/profile') }}">Profile</a></i></li>
					<li><i><a href="{{ url('/termsofuse') }}">Terms of Use</a></i></li>
                    <li><i><a href="{{ url('/privacy') }}">Privacy</a></i></li>
                    <li><i><a href="{{ url('/sitemap') }}">Sitemap</a></i></li>
                    <li><i><a href="#aboutus">About Us</a></i></li>
				</ul>
			</div>
		</div>
	</div>
</div>

@endsection
