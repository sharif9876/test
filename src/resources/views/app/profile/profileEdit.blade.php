@extends('layouts.app.layout')

@section('content')


<div class="page-container profile">
	<div class="row">
		<form>
			<div class="user-all-infos">
				<div class="user-left">
					<div class="user-name">
							<span class="info-text">Public account:</span> {{Auth::user()->public?'Yes':'No'}}

					</div>
					<div class="user-all-infos-separation">
						
					</div>
					<div class="user-location">
						<span class="info-text">Location:</span>
					</div>
					<div class="user-all-infos-separation">
						
					</div>
				</div>
				<div class="user-right">
					<div class="user-age">
						<span class="info-text">Age:</span> <div class="form-input text"> <input type="text" name="user_age" value="{{Auth::user()->age}}"></div>  
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
			<button type="submit"  class="edit-profile-button">
			<span class="edit-profile-text" >save changes</span>
			</button>
		</div>
	</div>
</form>

@endsection
