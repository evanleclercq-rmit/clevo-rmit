<!--

Blade for admin settings

Contains interface to grant/revoke admin status, reset and delete accounts.
If current user is not an admin they will be redirected to settings.blade instead.

-->

@extends('layouts.app')

@section('content')

<script type="text/javascript">

// Keeps buttons disabled until a user is selected from dropdown menu
function getID(id)
{
		document.getElementById('deleteButton').disabled=false;
		document.getElementById('deleteID').value = id;
		document.getElementById('resetButton').disabled=false;
		document.getElementById('restID').value = id;
		document.getElementById('addAdminButton').disabled=false;
		document.getElementById('addAdminID').value = id;
		document.getElementById('removeAdminButton').disabled=false;
		document.getElementById('removeAdminID').value = id;
}
</script>


<div id="body">	
	<div class="container">

		<div class="col-md-12 content-middle">
			<div class="contact-form wow fadeInUp animated" data-wow-delay=".1s">

				<h3><b>Admin Settings</b></h3><br>
				{{ Form::open() }}
				{{ Form::select('users', $users, null, array('placeholder' => 'Select a user...', 'onchange' => 'getID(this.value)', 'class' => 'UserList')) }}
				{{ Form::close() }}
				{{ csrf_field() }}
				
				<form name="addAdmin" action="{{ action('SettingsController@addAdmin') }}" method="post">
					<button style="width:200px" class="btn btn-primary" id="addAdminButton" type="submit" value="submit" disabled>Grant Admin Privileges</button>
					<input name="addAdminID" type="hidden" id="addAdminID" placeholder="addAdminID" value="">
					{{ csrf_field() }}
				</form>
				
				<form name="removeAdmin" action="{{ action('SettingsController@removeAdmin') }}" method="post">
					<button style="width:200px" class="btn btn-primary" id="removeAdminButton" type="submit" value="submit" disabled>Revoke Admin Privileges</button>
					<input name="removeAdminID" type="hidden" id="removeAdminID" placeholder="removeAdminID" value="">
					{{ csrf_field() }}
				</form>
		
				<form name="resetUser" action="{{ action('SettingsController@resetUser') }}"  method="post" onsubmit="return confirm('This will reset the balance, holdings and watchlist for this user. Are you sure?')">
					<button style="width:200px" class="btn btn-primary" id="resetButton" type="submit" value="submit" disabled>Reset Account</button>
					<input name="restID" type="hidden" id="restID" placeholder="restID" value="">
					{{ csrf_field() }}
				</form>
				
				<form name="deleteUser" action="{{ action('SettingsController@deleteUser') }}" method="post" onsubmit="return confirm('Are you sure you want to delete this user?')">
					<button style="width:200px" class="btn btn-primary" id="deleteButton" type="submit" value="submit" disabled>Delete Account</button>
					<input name="deleteID" type="hidden" id="deleteID" placeholder="deleteID" value="">
					{{ csrf_field() }}
				</form>
		
			</div>
		</div>
	</div>
</div>

@endsection
