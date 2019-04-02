@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="question-add">
        <div class="block-header">
            <div class="block-title">Add Question</div>
        </div>
        <div class="block-body">
            <div class="form question-add">
                <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="form-input text question-name">
                            <div class="input-label">
                                <label>name</label>
                            </div>
                            @if($errors != null && $errors->has('question_name'))
                                <div class="input-errors">
                                    - {{$errors->first('question_name')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="text" name="question_name">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input textarea question-question">
                            <div class="input-label">
                                <label>Question</label>
                            </div>
                            @if($errors != null && $errors->has('question_question'))
                                <div class="input-errors">
                                    - {{$errors->first('question_question')}}
                                </div>
                            @endif
                            <div class="input">
                                <textarea name="question_question"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input num question-level">
                            <div class="input-label">
                                <label>Level</label>
                            </div>
                            @if($errors != null && $errors->has('question_level'))
                                <div class="input-errors">
                                    - {{$errors->first('question_level')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="number" name="question_level" min="0" max="{{$level_max}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input select question-answer-type">
                            <div class="input-label">
                                <label>answer type</label>
                            </div>
                            @if($errors != null && $errors->has('question_answer_type'))
                                <div class="input-errors">
                                    - {{$errors->first('question_answer_type')}}
                                </div>
                            @endif
                            <div class="input">
                                <select name="question_answer_type" class="answer-type">
                                    <option></option>
                                    @foreach($answer_types as $type)
                                        <option type="{{$type}}">{{$type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input answers question-answers">
                            <input type="hidden" class="answers-input" name="question_answers">
                            <div class="input-label">
                                <label>answers</label>
                            </div>
                            @if($errors != null && $errors->has('question_answers'))
                                <div class="input-errors">
                                    - {{$errors->first('question_answers')}}
                                </div>
                            @endif
                            <div class="input">
                                <div class="type-answer text active">
                                    any
                                </div>
                                <div class="type-answer select multiple">
                                    <div class="answer-add">
                                        <div class="add-button">
                                            <div class="add-left">
                                                <i class="fas fa-plus"></i>
                                            </div>
                                            <div class="add-right">
                                                ADD
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="answers-list">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input relation question-requirements">
                            <input type="hidden" class="input-requirements" name="question_requirements">
                            <div class="input-label">
                                <label>requirements</label>
                            </div>
                            @if($errors != null && $errors->has('question_requirements'))
                                <div class="input-errors">
                                    - {{$errors->first('question_requirements')}}
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
                    <div class="form-row">
                        <div class="form-input image question-image">
                            <div class="input-label">
                                <label>image</label>
                            </div>
                            @if($errors != null && $errors->has('question_image'))
                                <div class="input-errors">
                                    - {{$errors->first('question_image')}}
                                </div>
                            @endif
                            <div class="input">
                                <div class="button">
                                    SELECT IMAGE
                                </div>
                                <input type="file" name="question_image">
                            </div>
                            <div class="preview background-cover">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-submit level-submit">
                            <button class="submit" type="submit" name="level_submit">CREATE QUESTION</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
