@extends('layouts/layout')

@section('content')

   <h1> {{ $user->username }} | {{ $user->profile-location }} </h1>
   
   <div class="bio">
      <p>
	  
	  {{ $user->profile->bio }}
	  
	  </p>
    
	</div>
	
   
@stop
