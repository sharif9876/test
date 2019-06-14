@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="task-add">
        <div class="block-header">
            <div class="block-title">New Task Entrie</div>
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
                                <label>entrie status</label>
                            </div>
                            @if($errors != null && $errors->has('entry_status'))
                                <div class="input-errors">
                                    - {{$errors->first('entry_status')}}
                                </div>
                            @endif
                            <div class="input">
                                <select name="entrie_status" class="answer-type">
                                    <option></option>
                                    @foreach($entry_status as $status)
                                        @if($status==$entry->status)
                                             <option selected type="{{$status}}">{{$status}}</option>
                                        @else
                                             <option type="{{$status}}">{{$status}}</option>
                                        @endif
                                        
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
                           <div class="preview background-cover shown" style="background-image: url({{asset('images/taskentries/'.$entry->answer)}})">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input text entrie_date">
                            <div class="input-label">
                                <label>user : id</label>
                            </div>
                           
                            @if($errors != null && $errors->has('entry_user'))
                                <div class="input-errors">
                                    - {{$errors->first('entry_user')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="text" name="entry_user" value="{{$entry->user_id}}">
                            </div>
                        </div>
                    </div>
                      <div class="form-row">
                        <div class="form-input text entrie_date">
                            <div class="input-label">
                                <label>task : id</label>
                            </div>
                            
                            @if($errors != null && $errors->has('entry_task'))
                                <div class="input-errors">
                                    - {{$errors->first('entry_task')}}
                                </div>
                            @endif
                            
                            <div class="input">
                                <input type="text" name="entry_task" value="{{$entry->task_id}}">
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
