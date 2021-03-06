<!--

Blade for the profile

Contains interface to view list of transactions with ability to sort and filter by date

-->

@extends('layouts.app')

@section('content')

<div id="body">	
	<div class="container">
		<div class="col-md-12 content-middle">
			<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">
				<h3><b>Personal details</b></h3>
				
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
					
				</table>
				
				<form action = "{{url('/edit-profile')}}" method = "post">
					<button type="submit" class = "btn btn-primary pull-right">Edit Profile</button>
					{{ csrf_field() }}
				</form>

				<br>
                <h3><b>Trading details</b></h3>
				<table style="width:100%">
					<tr>
						<th><h5>Initial Cash Balance:</h5></th>
						<td>$20000.00</td>
					</tr>
					<tr>
						<th><h5>Current Cash Balance:</h5></th>
						<td>${{ number_format((float)$user->balance, 2, '.', '') }}</td>
					</tr>
					<tr>
						<th><h5>Total Share Value:</h5></th>
						<td>$<?php echo number_format((float)$shareValue, 2, '.', '') ?></td>
					</tr>
                    <tr>
						<th><h5>Average Share Value:</h5></th>
						<td>$<?php echo number_format((float)$avgShareValue, 2, '.', '') ?></td>
					</tr>
					<tr>
						<th><h5>Total Holdings Value:</h5></th>
						<td>$<?php echo number_format((float)Auth::user()->balance+$shareValue, 2, '.', '') ?> </td>
					</tr>
					<tr>
						<th><h5>Profit:</h5></th>
						<?php 
							$profit = $user->balance+$shareValue-20000;

							if ($profit > 0){
								echo "<td style='color:green'>$" . number_format((float)$profit, 2, '.', '') . "</td>";
							}
							else {
								echo "<td style='color:red'>$" . number_format((float)$profit, 2, '.', '') . "</td>";
						}?>
					</tr>
					
                    
				</table>
			</div>
		</div>
	</div>
</div>

@endsection
