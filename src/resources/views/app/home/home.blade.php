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

@if($levels_previous!=[])


<div id="chevrondown" class="chevron-down">
    {!!load_icon('chevron-down')!!}
</div>
<div id="{{count($levels_previous)}}" class="chevron-up"> 
    {!!load_icon('chevron-up')!!}
</div>



    <div class="page-container previous-levels" id="previous-levels">
        <div class="row">
            <div class="previous-levels">
            @foreach($levels_previous as $level)

            @if(in_array($level->level, $arraySkipped))
                <div class="level-container-next" style="background-image: url({{asset($level->container_background_image_path)}})">
                    <div class="level-container-inner"  style="background-color: {{$level->container_background_color}};" >
                    @if(Auth::user()->entriesPending($level->level)->count())
                        <a href="{{url('tasks/'.Auth::user()->entriesPending($level->level)->first()->task_id)}}" class="level-container-link">
                            <div class="level-left">
                                <div class="level-info">
                                    <div class="level-name">
                                        Level {{$level->level}}
                                    </div>
                                    <div class="level-task">
                                        <div class="task-title">
                                            {{Auth::user()->entriesPending($level->level)->first()->task->title}}
                                        </div>
                                        <div class="task-info">
                                            Status: {{Auth::user()->entriesPending($level->level)->first()->status}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="level-right">
                               
                                {!!load_icon('chevron-right')!!}
                            </div>
                        </a>
                    @elseif($level->highestRewardTaskAvailable()->count())
                        <a href="{{url('tasks/'.$level->highestRewardTaskAvailable()->id)}}" class="level-container-link">
                            <div class="level-left">
                                <div class="level-info">
                                    <div class="level-name">
                                        Level {{$level->level}}
                                    </div>
                                    <div class="level-task">
                                        <div class="task-title">
                                            {{$level->highestRewardTaskAvailable()->title}}
                                        </div>
                                        <div class="task-info">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="level-right">
                                <div class="icon-locked">
                                {!!load_icon('user-ninja')!!}
                                </div>
                            </div>
                        </a>
                    @else
                        <div class="level-empty">
                            <div class="level-name">
                                Level {{$level->level}}
                            </div>
                            <div class="level-text">
                                No tasks available<br />
                                <span>check again soon!</span>
                            </div>

                        </div>


                    @endif
                    </div>
                </div>
           
            @else
             <div class="level-container-next" style="background-image: url({{asset($level->container_background_image_path)}})">
                    <div class="level-container-inner"  style="background-color: {{$level->container_background_color}};" >
                    @if(Auth::user()->entriesPending($level->level)->count())
                        <a href="{{url('tasks/'.Auth::user()->entriesPending($level->level)->first()->task_id)}}" class="level-container-link">
                            <div class="level-left">
                                <div class="level-info">
                                    <div class="level-name">
                                        Level {{$level->level}}
                                    </div>
                                    <div class="level-task">
                                        <div class="task-title">
                                            {{Auth::user()->entriesPending($level->level)->first()->task->title}}
                                        </div>
                                        <div class="task-info">
                                            Status: {{Auth::user()->entriesPending($level->level)->first()->status}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="level-right">
                               
                                {!!load_icon('chevron-right')!!}
                            </div>
                        </a>
                    @elseif($level->highestRewardTaskAvailable()->count())

                        <a href="{{url('tasks/'.$level->highestRewardTaskAvailable()->id)}}" class="level-container-link">
                            <div class="level-left">
                                <div class="level-info">
                                    <div class="level-name">
                                        Level {{$level->level}}
                                    </div>
                                    <div class="level-task">
                                        <div class="task-title">
                                            {{$level->highestRewardTaskAvailable()->title}}
                                        </div>
                                        <div class="task-info">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="level-right">
                                <div class="icon-locked">
                                {!!load_icon('check-circle')!!}
                                </div>
                            </div>
                        </a>
                    @else
                        <div class="level-empty">
                            <div class="level-name">
                                Level {{$level->level}}
                            </div>
                            <div class="level-text">
                                No tasks available<br />
                                <span>check again soon!</span>
                            </div>

                        </div>


                    @endif
                </div>
            </div>

            @endif
            @endforeach
             </div>
        </div>
    </div>



    @endif



<div class="page-container upcoming-levels" id="upcoming-levels">
    <div class="row">
        <div class="upcoming-levels">
        @foreach($levels_next as $level)
        @if($loop->first)
            <div class="level-container-next" style="background-image: url({{asset($level->container_background_image_path)}});   @if($levels_previous==[])margin-top:30px;   @endif">
                <div class="level-container-inner">
                @if(Auth::user()->entriesPending($level->level)->count())
                    <a href="{{url('tasks/'.Auth::user()->entriesPending($level->level)->first()->task_id)}}" class="level-container-link">
                        <div class="level-left">
                            <div class="level-info">
                                <div class="level-name">
                                    Level {{$level->level}}
                                </div>
                                <div class="level-task">
                                    <div class="task-title">
                                        {{Auth::user()->entriesPending($level->level)->first()->task->title}}
                                    </div>
                                    <div class="task-info">
                                        Status: {{Auth::user()->entriesPending($level->level)->first()->status}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="level-right">
                            {!!load_icon('chevron-right')!!}
                        </div>
                    </a>
                @elseif($level->highestRewardTaskAvailable()->count())
                    <a href="{{url('tasks/'.$level->highestRewardTaskAvailable()->id)}}" class="level-container-link">
                        <div class="level-left">
                            <div class="level-info">
                                <div class="level-name">
                                    Level {{$level->level}}
                                </div>
                                <div class="level-task">
                                    <div class="task-title">
                                        {{$level->highestRewardTaskAvailable()->title}}
                                    </div>
                                    <div class="task-info">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="level-right">
                            {!!load_icon('chevron-right')!!}
                        </div>
                    </a>
                @else
                    <div class="level-empty">
                        <div class="level-name">
                            Level {{$level->level}}
                        </div>
                        <div class="level-text">
                            No tasks available<br />
                            <span>check again soon!</span>
                        </div>
                    </div>
                @endif
                </div>
            </div>
       
        @else
        <div class="level-container" style="background-image: url({{asset($level->container_background_image_path)}})">
                <div class="level-container-inner" style="background-color: {{$level->container_background_color}};">
                    <div class="level-left">
                        LEVEL {{$level->level}}
                    </div>
                    <div class="level-right">
                        <div class="icon-locked">
                            {!!load_icon('lock')!!}
                        </div>
                    </div>
                </div>
            </div>

        @endif
        @endforeach
        </div>
    </div>
</div>

@endsection
