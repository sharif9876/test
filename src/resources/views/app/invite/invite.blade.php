@extends('layouts.app.layout')

@section('content')
<style type="text/css">
	.contact-title {
  text-align: center;
  margin-top: 20px;
  color:black;
  text-transform: uppercase;
  -webkit-transition: all 4s ease-in-out;
  transition: all 4s ease-in-out;
}
.contact-title h1 {
 
 font-size:32px;
 line-height:30px;


}

.contact-title h2 {
 font-size:16px;
 margin-top:20px;


}

.contact-form{
	margin-top:20px;
}

.form-control-submit{
	background:#ff5722;
	border-color:transparent;
	color:#fff;
	font-size: 20px;
	font-weight:bold;
	letter-spacing: 2px;
	height:50px;

}
.form-control-submit:hover{
	background-color: #f44336;
	cursor:pointer;

}


.form-control{
	width :600px;
	background:transparent;
	border:none;
	
	border-bottom: 1px solid grey;
	color:black;
	font-size: 18px;
	margin-bottom:16px;
}



</style>
<div class="page-container user" style="background-image: url({{asset('/images/loremipsum-background.jpg')}});">
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
                            {{Auth::user()->name}}
                        </div>
                        <div class="user-level">
                            lvl: <span class="user-level-level">{{Auth::user()->level}}</span>
                        </div>
                    </div>
                    <div class="user-progress">
                        <div class="user-points">

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
    </div>
</div>

<div class="contact-title">
	<h1>Invite someone</h1>
	<h2>Send them an email!</h2>
</div>
 @if ($errors->has('email'))
<span class="invalid-feedback" role="alert">
  <strong>{{ $errors->first('email') }}</strong>
</span>
@endif
<div class="contact-form">
	<form id="contact-form" action="send" method="POST"   >
		@csrf
		<input type="text" name="email" class="form-control" placeholder="Enter email">
		<input type="submit" class="form-control-submit" value="Go!">
	</form>
</div>
@endsection
