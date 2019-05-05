@extends('layouts.app.layout')

@section('content')
<div class="page-container nopadding timeline">
    <div class="row">
        <div class="timeline-container">
            <div class="timeline-header">
                My Timeline
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
@endsection
