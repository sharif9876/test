@extends('layouts.app.layout')

@section('content')

<div class="profile-nav">
	<ul class="nav">
	    	<li class="profile-nav-link "><a class="link" href="{{url('profile/recent')}}">RECENT ACTIVITY</a></li>
		
	    	<li class="profile-nav-link "><a class="link "href="{{url('profile')}}">PROFILE</a></li>
		
	    
	    	<li class="profile-nav-link active"><a class="link active" href="{{url('profile/matches')}}">MATCHES</a></li>
		
	</ul>
	 </div>   

@endsection
