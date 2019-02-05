@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="task-add">
        <div class="block-header">
            <div class="block-title">New Task</div>
        </div>
        <div class="block-body">
            <div class="form task-add">
                <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="form-input text task-title">
                            <div class="input-label">
                                <label>title</label>
                            </div>
                            <div class="input">
                                <input type="text" name="task_title">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input textarea task-description">
                            <div class="input-label">
                                <label>description</label>
                            </div>
                            <div class="input">
                                <textarea name="task_description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input select task-type">
                            <div class="input-label">
                                <label>type</label>
                            </div>
                            <div class="input">
                                <select name="task_type">
                                    @foreach($task_types as $type)
                                        <option type="{{$type->name}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input num task-level">
                            <div class="input-label">
                                <label>level</label>
                            </div>
                            <div class="input">
                                <input type="number" name="task_level_min"  min="0" max="{{$level_max}}">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-row">
                        <div class="form-input num task-rewardpoints">
                            <div class="input-label">
                                <label>reward points</label>
                            </div>
                            <div class="input">
                                <input type="number" name="task_reward_points">
                            </div>
                        </div>
                    </div> --}}
                    <div class="form-row">
                        <div class="form-input image task-rewardpoints">
                            <div class="input-label">
                                <label>background</label>
                            </div>
                            <div class="input">
                                <div class="button">
                                    SELECT IMAGE
                                </div>
                                <input type="file" name="task_image">
                            </div>
                            <div class="preview background-cover">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-submit user-submit">
                            <button class="submit" type="submit" name="task_submit">CREATE TASK</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
