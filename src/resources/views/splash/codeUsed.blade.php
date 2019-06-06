@extends('layouts.splash.layout')

@section('content')
    <div class="splash" id="task-complete">
        <div class="splash-inner">
            <div class="splash-image">
                <div class="splash-image-inner background-contain" style="background-image: url({{asset('/images/splash-levelup.png')}});">
                </div>
            </div>
            <div class="splash-title">
                Cheers!
            </div>
            <div class="splash-desc">
                <p class="desc-name">{{Auth::user()->name}}</p>
                <p class="desc-text">You've inserted a code</p>
            </div>
            <div class="splash-continue">
                <div class="button-continue">
                    <a href="{{url('code')}}">
                        Continue
                    </a>
                </div>
            </div>
            <div class="splash-cloud1">
            </div>
            <div class="splash-cloud2">
            </div>
        </div>
    </div>
@endsection
