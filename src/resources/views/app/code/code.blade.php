@extends('layouts.app.layout')

@section('content')

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


<br>
Insert ninja code here:

 
<form action="sendCode" method="POST">
    @csrf
 <input type="text" name="code">
<input type="submit" value="send">


</form>
@endsection
