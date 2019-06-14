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
                        <div class="form-input text entrie_date">
                            <div class="input-label">
                                <label>submitted date</label>
                            </div>
                            @if($errors != null && $errors->has('entrie_date'))
                                <div class="input-errors">
                                    - {{$errors->first('entrie_date')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="datetime-local" name="entrie_date">
                            </div>
                        </div>
                    </div>
                     <div class="form-row">
                        <div class="form-input select question-answer-type">
                            <div class="input-label">
                                <label>entrie status</label>
                            </div>
                            @if($errors != null && $errors->has('entrie_status'))
                                <div class="input-errors">
                                    - {{$errors->first('entrie_status')}}
                                </div>
                            @endif
                            <div class="input">
                                <select name="entrie_status" class="answer-type">
                                    <option></option>
                                    @foreach($entrie_status as $status)

                                       
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
                            @if($errors != null && $errors->has('entrie_answer'))
                                <div class="input-errors">
                                    - {{$errors->first('entrie_answer')}}
                                </div>
                            @endif
                            <div class="input">
                                <div class="button">
                                    SELECT IMAGE
                                </div>
                                <input type="file" name="entrie_answer">
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input text entrie_date">
                            <div class="input-label">
                                <label>user : email</label>
                            </div>
                           
                            @if($errors != null && $errors->has('entrie_user'))
                                <div class="input-errors">
                                    - {{$errors->first('entrie_user')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="text" name="entrie_user">
                            </div>
                        </div>
                    </div>
                      <div class="form-row">
                        <div class="form-input text entrie_date">
                            <div class="input-label">
                                <label>task : title</label>
                            </div>
                            
                            @if($errors != null && $errors->has('entrie_task'))
                                <div class="input-errors">
                                    - {{$errors->first('entrie_task')}}
                                </div>
                            @endif
                            
                            <div class="input">
                                <input type="text" name="entrie_task">
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
                            <button class="submit" type="submit" name="task_submit">CREATE TASK ENTRIE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
