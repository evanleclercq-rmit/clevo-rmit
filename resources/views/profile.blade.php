@extends('layouts.app')

@section('content')

<div id="body">	
	<div class="container">
		<div class="col-md-12 content-middle">
			<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
				<h3><b>Profile</b></h3>
				<table style="width:100%">
					<tr>
						<th><h5>Name:</h5></th>
						<td>{{ $user->name }}</td>
					</tr>
					<tr>
						<th><h5>Email:</h5></th>
						<td>{{ $user->email }}</td>
					</tr>
					<tr>
						<th><h5>Balance:</h5></th>
						<td>${{ $user->balance}}</td>
					</tr>
					<tr>
						<th><h5>Bio:</h5></th>
						<td>{{ $user->bio}}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection
