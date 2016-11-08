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
						<th><h5>City:</h5></th>
						<td>{{ $user->city }}</td>
					</tr>
					<tr>
						<th><h5>Age:</h5></th>
						<td>{{ $user->age }}</td>
					</tr>
					<tr>
						<th><h5>Email:</h5></th>
						<td>{{ $user->email }}</td>
					</tr>
					
					<tr>
						<th><h5>Bio:</h5></th>
						<td>{{ $user->bio}}</td>
					</tr>
				</table>
                <h3><b>Trading details</b></h3>
				<table style="width:100%">
				
				
					<tr>
						<th><h5>Current balance:</h5></th>
						<td>${{ number_format((float)$user->balance, 2, '.', '') }}</td>
					</tr>
					<tr>
						<th><h5>Total share value:</h5></th>
						<td><?php echo $shareValue ?></td>
					</tr>
                    <tr>
						<th><h5>Average share value:</h5></th>
						<td><?php echo $avgShareValue ?></td>
					</tr>
                    <tr>
						<th><h5>Profit:</h5></th>
						<td>{{ $user->bio}}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection
