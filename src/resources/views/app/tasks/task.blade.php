@extends('layouts.app.layout')

@section('content')
<div class="page-container nopadding task">
    <div class="row">
        <div class="task-background background-cover" style="background-image: url({{asset('/images/tasks/'.$task->background_image_path)}})">
        </div>
        <div class="task-block">
            <div class="task-info">
                <div class="task-header">
                    <div class="task-title">
                        Task {{$task->id}}
                    </div>
                </div>
                <div class="task-body">
                    <div class="task-description">
                        {{$task->description}}
                    </div>
                </div>
                <div class="task-footer">
                    <div class="task-hint">
                    </div>
                    <div class="form form-task-submit" id="formTaskSubmit">
                        <form method="POST" action="" enctype="multipart/form-data" class=" task-type-{{$task->type}}">
                        @csrf
                        @if($task->type == 'image')
                            <div class="form-row row-task-answer">
                                <div class="form-input task-answer">
                                {{-- CAN BE ANYTHING, MAKE IF ELSE STATEMENTS FOR EACH TASK TYPE --}}
                                    <div class="button">
                                        SELECT IMAGE
                                    </div>
                                    <input type="file" name="task_answer" id="imageInput">
                                </div>
                            </div>
                            <div class="form-row row-task-submit" id="imageRowSubmit">
                                <div class="form-input task-submit-background background-cover" id="imageResult">
                                </div>
                                <div class="form-input submit task-submit">
                                    <button class="form-submit" type="submit">SUBMIT IMAGE</button>
                                </div>
                            </div>
                        @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
