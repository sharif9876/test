@extends('layouts.guest.layout')

@section('content')
    <div class="page-container user background-cover" style="background-image: url({{asset('/images/loremipsum-background.jpg')}});">
        <div class="container-inner">
            <div class="row">
                <div class="user-profile">
                    <div class="user-inner">
                        <div class="user-left">
                            <div class="user-initial">
                                {{strtoupper(substr($user->name,0,1))}}
                            </div>
                        </div>
                        <div class="user-right">
                            <div class="user-info">
                                <div class="user-name">
                                    {{$user->name}}
                                </div>
                                <div class="user-level">
                                    lvl: <span class="user-level-level">{{$user->level}}</span>
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
    </div>

    <div class="page-container nopadding timeline">
        <div class="container-inner">
            <div class="row">
            </div>
        </div>
    </div>

    <div class="page-container nopadding timeline">
        <div class="container-inner">
            <div class="row">
                <div class="timeline-container">
                    <div class="timeline-header">
                        {{$user->name}}'s Timeline
                    </div>
                    <div class="timeline">
                        <div class="timeline-inner" id="timeline">
                        @foreach($timeline as $item)
                            <div class="timeline-item">
                                <div class="item-header">
                                    <div class="item-profile">
                                        <profile-left>{{$item->user->name}}</div>
                                </div>
                                <div class="item-content">
                                    <div class="item-text">
                                        <span class="text-action">Completed a task</span><br>{{$item->task->title}}
                                    </div>
                                    <div class="background-cover" width="30%" style="background-image: url({{asset('images/taskentries/'.$item->answer)}})">
                                    </div>
                                </div>
                                <div class="item-footer">
                                    {{Carbon\Carbon::parse($item->updated_at)->format('l F jS Y')}}<br>{{Carbon\Carbon::parse($item->updated_at)->format('h:i:s')}}
                                </div>
                            </div>

                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
