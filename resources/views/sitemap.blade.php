@extends('layouts.app')

@section('content')

<div id="body">	
	<div class="container">
		<div class="col-md-12 content-middle">
			<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
				<h3><b>Site Map</b></h3>
				<ul>
					<li><a href="{{ url('/register') }}">Register</a></li>
					<li><a href="{{ url('/login') }}">Login</a></li>
					<li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
					<li><a href="{{ url('/transactions') }}">Transactions</a></li>
                    <li><a href="{{ url('/history') }}">History</a></li>
					<li><a href="{{ url('/profile') }}">Profile</a></li>
					<li><a href="#termsofuse">Terms of Use</a></li>
                    <li><a href="#privacy">Privacy</a></li>
                    <li><a href="{{ url('/sitemap') }}">Sitemap</a></li>
                    <li><a href="#aboutus">About Us</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

@endsection
