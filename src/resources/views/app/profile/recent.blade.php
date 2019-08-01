@extends('layouts.app.layout')

@section('content')

<div class="profile-nav">
	<ul class="nav">
	    	<li class="profile-nav-link active "><a class="link active" href="recent">RECENT ACTIVITY</a></li>
		
	    	<li class="profile-nav-link "><a class="link "href="profile">PROFILE</a></li>
		
	    
	    	<li class="profile-nav-link"><a class="link" href="matches">MATCHES</a></li>
		
	</ul>
</div> 

@foreach($activities as $activity)
	<div class="page-container-profile {{$loop->first?'add-margin':''}} {{$activity->old()?'old':'recent'}}">
		<div class="row">
			<div class="recent-container">
				<div class="recent-top">
					<div class="recent-time">
						<i class="far fa-clock"></i>
						<span> {{ $activity->convertDate() }} {!!load_icon('ellipsis-h')!!}</span>
					</div>
				</div>
				<div class="recent-content">

					<span><a href="{{url('userprofile/'.$activity->user->id)}}">{{$activity->user->name}}</a></span><span>{{$activity->message}}</span>
					@if($activity->image_path!=null)

					<div class="input-image" style="background-image:url({{asset('/images/taskentries/'.$activity->image_path)}})">
						
					</div>

					@endif
				</div>
				
				<div class="recent-footer{{$loop->last?'-last':''}}">
					
				</div>
				
			</div>
			
		</div>
	</div>
@endforeach

@endsection
