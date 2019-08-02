@extends('layouts.app.layout')

@section('content')

<div class="profile-nav">
	<ul class="nav">
	    <li class="profile-nav-link "><a class="link" href="{{url('profile/recent')}}">RECENT ACTIVITY</a></li>
	    <li class="profile-nav-link active"><a class="link active"href="{{url('profile')}}">PROFILE</a></li>
	    <li class="profile-nav-link"><a class="link" href="{{url('profile/matches')}}">MATCHES</a></li>		
	</ul>
</div>

<div class="page-container add-margin-profile profile">
	<div class="row">
		<div class="user-profile">
			<div class="user-inner">
				<div class="user-left">
					<div class="user-initial">
						 {{strtoupper(substr(Auth::user()->name,0,1))}}	
					</div>
				</div>
				<div class="user-right">
					<div class="user-info">
						<div class="user-name">
							{{explode(' ',Auth::user()->name)[0]}}
						</div>
						<div class="user-level">
							Level: <span class="user-level-level">{{Auth::user()->level}}</span>
						</div>	
					</div>
					<div class="user-progress">
						<div class="user-points">
							Points: {{$display_points}}

						</div>
						<div class="user-bar">
                            <div class="points-bar">
                                <div class="points-progress" style="width: {{$bar_width.'%'}};">
                                </div>
                            </div>
                        </div>
					</div>
					
				</div>
			</div>
			
		</div>
		<div class="profile-footer">
		
	</div>
	<div class="user-all-infos add-margin-infos">
		<div class="user-left">
			<div class="user-name">
					<span class="info-text">Public account:</span> {{Auth::user()->public?'Yes':'No'}}

			</div>
			<div class="user-all-infos-separation">
				
			</div>
			<div class="user-location">
				<span class="info-text">Location:</span> {{Auth::user()->location}}
			</div>
			<div class="user-all-infos-separation">
				
			</div>
		</div>
		<div class="user-right">
			<div class="user-age">
				<span class="info-text">Age:</span> {{Auth::user()->age}} 
			</div>
			<div class="user-all-infos-separation">
				
			</div>
			<div class="user-mobile">
				<span class="info-text">Mobile:</span>{{Auth::user()->mobile}}
			</div>
			<div class="user-all-infos-separation">
				
			</div>
		</div>
		<div class="user-bottom">
			<div class="user-email">
				<span class="info-text">Email:</span> <br>{{Auth::user()->email}}
			</div>
			<div class="user-all-infos-separation">
				
			</div>
			<div class="user-bio">
				<span class="info-text">Bio:</span> <br> {{Auth::user()->bio}}
			</div>
		</div>
	</div>

	</div>
	<div class="edit-profile">
		<a href="{{url('profile/edit')}}" class="edit-profile-link">
		<span class="edit-profile-text" >edit profile</span>
		</a>
	</div>
</div>

@endsection
