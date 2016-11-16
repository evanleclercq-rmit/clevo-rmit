@extends('layouts.app')

@section('content')

	<div id="body">
        <div class="container">
            <div class="col-md-12 content-left">
                <div class="contact-form wow fadeInUp animated">
                    <h3><b>Edit Your Profile</b></h3><br>

                    <form class="form-horizontal" action="{{action('editProfileController@changeName')}}" method="post">
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="name">Name:</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" name="name" id="name" placeholder="Enter New Name" required>
					    </div>
					  </div>
					  <div class="form-group"> 
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-primary pull-right">Change Name</button>
					    </div>
					  </div>
					  {{ csrf_field() }}
					</form>

					<br>

					<form class="form-horizontal" action="{{action('editProfileController@changeEmail')}}" method="post">
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="email">Email:</label>
					    <div class="col-sm-10">
					      <input type="email" class="form-control" id="email" name="email" placeholder="Enter New Email" required>
					    </div>
					  </div>
					  <div class="form-group"> 
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-primary pull-right">Change Email</button>
					    </div>
					  </div>
					  {{ csrf_field() }}
					</form>

					<br>

					<form class="form-horizontal" action="{{action('editProfileController@changeCity')}}" method="post">
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="city">City:</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="city" name="city" placeholder="Enter New City" required>
					    </div>
					  </div>
					  <div class="form-group"> 
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-primary pull-right">Change City</button>
					    </div>
					  </div>
					  {{ csrf_field() }}
					</form>

					<br>

					<form class="form-horizontal" action="{{action('editProfileController@changeAge')}}" method="post">
					  <div class="form-group {{ $errors->has('age') ? ' has-error' : '' }}">
					    <label class="control-label col-sm-2" for="age">Age:</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="age" name="age" placeholder="Enter New Age" required>
					      @if ($errors->has('age'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('age') }}</strong>
                                </span>
                            @endif
					    </div>
					  </div>
					  <div class="form-group"> 
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-primary pull-right">Change Age</button>
					    </div>
					  </div>
					  {{ csrf_field() }}
					</form>

					<br>

					<h3><b>Change Password:</b></h3>
					<form class="form-horizontal" action="{{action('editProfileController@changePassword')}}" method="post">
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="currentPass">Current Password:</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="currentPass" name="currentPass" placeholder="Enter Current Password" required>
					    </div>
					  </div>
					  <div class="form-group {{ $errors->has('newPass') ? ' has-error' : '' }}">
					    <label class="control-label col-sm-2" for="newPass">New Password:</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="newPass" name="newPass" placeholder="Enter New Password" required>
					        @if ($errors->has('newPass'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('newPass') }}</strong>
                                </span>
                            @endif
					    </div>
					  </div>
					  <div class="form-group {{ $errors->has('confirmPass') ? ' has-error' : '' }}">
					    <label class="control-label col-sm-2" for="confirmPass">Confirm Password:</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="confirmPass" name="confirmPass" placeholder="Confirm New Password" required>
						    @if ($errors->has('confirmPass'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('confirmPass') }}</strong>
                                </span>
	                        @endif
					    </div>
					  </div>
					  <div class="form-group"> 
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-primary pull-right">Change Password</button>
					  </div>
					  {{ csrf_field() }}
					</form>

                </div>
            </div>
        </div>
    </div>
@endsection