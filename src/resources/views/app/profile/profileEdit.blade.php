@extends('layouts.app.layout')

@section('content')


<div class="page-container profile">
	<div class="row">
		<form action="" method="POST">
			@csrf
			<div class="user-all-infos">
				<div class="user-left">
					<div class="user-name">
							<span class="info-text">Public account:</span> <br><select name="user_public" >
								<option {{Auth::user()->public?'selected':''}} value="1">Yes</option>
								<option  {{Auth::user()->public?'':'selected'}} value="0">No</option>
							</select> 

					</div>
					<div class="user-all-infos-separation">
						
					</div>
					<div class="user-location">
						<span class="info-text">Location:</span><br><input type="text" name="user_location" value="{{Auth::user()->location}}"> 
					</div>
					<div class="user-all-infos-separation">
						
					</div>
				</div>
				<div class="user-right edit">
					<div class="user-age">
						<span class="info-text">Age:</span> <br><input type="text" name="user_age" value="{{Auth::user()->age}}"> 
					</div>
					<div class="user-all-infos-separation">
						
					</div>
					<div class="user-mobile">
						<span class="info-text">Mobile:</span><br><input type="text" name="user_mobile" value="{{Auth::user()->mobile}}"> 
					</div>
					<div class="user-all-infos-separation">
						
					</div>
				</div>
				<div class="user-bottom">
					<div class="user-email">
						<span class="info-text">Email:</span> <br><br><input type="text" name="user_email" value="{{Auth::user()->email}}"> 
					</div>
					<div class="user-all-infos-separation">
						
					</div>
					<div class="user-bio">
						<span class="info-text">Bio:</span> <br> <br><input type="text" name="user_bio" value="{{Auth::user()->bio}}"> 
					</div>
				</div>
			</div>

			</div>
		<div class="edit-profile">
			<button type="submit"  class="edit-profile-button">
			<span class="edit-profile-text" >save changes</span>
			</button>
		</div>
	</div>
</form>

@endsection
