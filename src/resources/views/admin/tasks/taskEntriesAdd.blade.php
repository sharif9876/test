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
                                <input type="date" name="entrie_date">
                            </div>
                        </div>
                    </div>
                     <div class="form-row">
                        <div class="form-input select question-answer-type">
                            <div class="input-label">
                                <label>entrie status</label>
                            </div>
                            @if($errors != null && $errors->has('question_answer_type'))
                                <div class="input-errors">
                                    - {{$errors->first('question_answer_type')}}
                                </div>
                            @endif
                            <div class="input">
                                <select name="question_answer_type" class="answer-type">
                                    <option></option>
                                    @foreach($entrie_status as $value=>$status)
                                        <option value="{{$value}}">{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                     <div class="form-row">
                        <div class="form-input text entrie_date">
                            <div class="input-label">
                                <label>answer</label>
                            </div>
                            @if($errors != null && $errors->has('entrie_answer'))
                                <div class="input-errors">
                                    - {{$errors->first('entrie_answer')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="text" name="entrie_answer">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input text entrie_date">
                            <div class="input-label">
                                <label>user</label>
                            </div>
                            @if($errors != null && $errors->has('entrie_user'))
                                <div class="input-errors">
                                    - {{$errors->first('entrie_user')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="text" name="entrie_answer">
                            </div>
                        </div>
                    </div>
                      <div class="form-row">
                        <div class="form-input text entrie_date">
                            <div class="input-label">
                                <label>task</label>
                            </div>
                            @if($errors != null && $errors->has('entrie_task'))
                                <div class="input-errors">
                                    - {{$errors->first('entrie_user')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="text" name="entrie_answer">
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
