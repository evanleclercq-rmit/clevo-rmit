@extends('layouts.app')

@section('content')

<div id="body">	
	<div class="container">
		<div class="col-md-12 content-left">
			<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
				<h3><b>Profile</b></h3>
				<p>Name  &nbsp; &nbsp;:&nbsp;{{ $user->name }}</p>
				<p>Email &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;{{ $user->email }}</p>
				<p>Balance :&nbsp;${{ $user->balance}}</p>
				<p>Bio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;{{ $user->bio}} </p>
			</div>
		</div>
	</div>
</div>

@endsection
