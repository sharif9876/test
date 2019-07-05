@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="task-add">
        <div class="block-header">
            <div class="block-title">New Task Entry</div>
        </div>
        <div class="block-body">
            <div class="form task-add">
                <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="form-input text entry_date">
                            <div class="input-label">
                                <label>submitted date</label>
                            </div>
                            @if($errors != null && $errors->has('entry_date'))
                                <div class="input-errors">
                                    - {{$errors->first('entry_date')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="datetime-local" name="entry_date">
                            </div>
                        </div>
                    </div>
                     <div class="form-row">
                        <div class="form-input select question-answer-type">
                            <div class="input-label">
                                <label>entry status</label>
                            </div>
                            @if($errors != null && $errors->has('entry_status'))
                                <div class="input-errors">
                                    - {{$errors->first('entry_status')}}
                                </div>
                            @endif
                            <div class="input">
                                <select name="entry_status" class="answer-type">
                                    <option></option>
                                    @foreach($entry_status as $status)

                                       
                                             <option type="{{$status}}">{{$status}}</option>
                                        
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                      <div class="form-row">
                        <div class="form-input image question-image">
                            <div class="input-label">
                                <label>image</label>
                            </div>
                            @if($errors != null && $errors->has('entry_answer'))
                                <div class="input-errors">
                                    - {{$errors->first('entry_answer')}}
                                </div>
                            @endif
                            <div class="input">
                                <div class="button">
                                    SELECT IMAGE
                                </div>
                                <input type="file" name="entry_answer">
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input text entry_date">
                            <div class="input-label">
                                <label>user : email</label>
                            </div>
                           
                            @if($errors != null && $errors->has('entry_user'))
                                <div class="input-errors">
                                    - {{$errors->first('entry_user')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="text" name="entry_user">
                            </div>
                        </div>
                    </div>
                      <div class="form-row">
                        <div class="form-input text entry_date">
                            <div class="input-label">
                                <label>task : title</label>
                            </div>
                            
                            @if($errors != null && $errors->has('entry_task'))
                                <div class="input-errors">
                                    - {{$errors->first('entry_task')}}
                                </div>
                            @endif
                            
                            <div class="input">
                                <input type="text" name="entry_task">
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
                        <div class="form-submit user-submit">
                            <button class="submit" type="submit" name="task_submit">CREATE TASK ENTRY</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
