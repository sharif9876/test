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
                            @if($errors != null && $errors->has('task_title'))
                                <div class="input-errors">
                                    - {{$errors->first('task_title')}}
                                </div>
                            @endif
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
                            @if($errors != null && $errors->has('task_description'))
                                <div class="input-errors">
                                    - {{$errors->first('task_description')}}
                                </div>
                            @endif
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
                            @if($errors != null && $errors->has('task_type'))
                                <div class="input-errors">
                                    - {{$errors->first('task_type')}}
                                </div>
                            @endif
                            <div class="input">
                                <select name="task_type">
                                    <option></option>
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
                            @if($errors != null && $errors->has('task_level_min'))
                                <div class="input-errors">
                                    - {{$errors->first('task_level_min')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="number" name="task_level_min"  min="0" max="{{$level_max}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input relation task-requirements">
                            <input type="hidden" class="input-requirements" name="task_requirements">
                            <div class="input-label">
                                <label>requirements</label>
                            </div>
                            @if($errors != null && $errors->has('task_requirements'))
                                <div class="input-errors">
                                    - {{$errors->first('task_requirements')}}
                                </div>
                            @endif
                            <div class="relation-add">
                                <div class="add-button">
                                    <div class="add-left">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="add-right">
                                        ADD
                                    </div>
                                </div>
                            </div>
                            <ul class="relations">
                            </ul>
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
                        <div class="form-input image task-image">
                            <div class="input-label">
                                <label>background</label>
                            </div>
                            @if($errors != null && $errors->has('task_image'))
                                <div class="input-errors">
                                    - {{$errors->first('task_image')}}
                                </div>
                            @endif
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
