@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Profile<h2>
			<h2>{{ $user->name }}'s Profile</h2>
            <h2>{{ $user->email }} </h2>
		    <h2>{{ $user->balance}} </h2>
			<h2>{{ $user->bio}} </h2>	
        </div>
    </div>

@endsection
