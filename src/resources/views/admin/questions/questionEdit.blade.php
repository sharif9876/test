@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="question-edit">
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
                            <div class="input">
                                <input type="text" name="question_name" value="{{$question->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input textarea question-question">
                            <div class="input-label">
                                <label>Question</label>
                            </div>
                            <div class="input">
                                <textarea name="question_question">{{$question->question}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input num question-name">
                            <div class="input-label">
                                <label>Level</label>
                            </div>
                            <div class="input">
                                <input type="number" name="question_level" min="0" max="{{$level_max}}" value="{{$question->level_min}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input select question-answer-type">
                            <div class="input-label">
                                <label>answer type</label>
                            </div>
                            <div class="input">
                                <select name="question_answer_type" class="answer-type">
                                    <option></option>
                                    @foreach($answer_types as $type)
                                        <option type="{{$type}}" <?= $type == $question->answer_type ? "selected" : "" ?>>{{$type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input answers question-answer-type">
                            <input type="hidden" class="answers-input" name="question_answers">
                            <div class="input-label">
                                <label>answers</label>
                            </div>
                            <div class="input">
                                <div class="type-answer text <?= $question->answer_type == "text" ? "active" : "" ?>" >
                                    any
                                </div>
                                <div class="type-answer select multiple <?= $question->answer_type == "multiple" || $question->answer_type == "select" ? "active" : "" ?>">
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
                                    @if($question->answer_type == "select" || $question->answer_type == "multiple")
                                    @foreach($answers as $answer)
                                        <li class="answer-field">
                                            <input type="text" class="answer-compile" value="{{$answer}}"><span class="remove-button"><i class="fas fa-times"></i></span>
                                        </li>
                                    @endforeach
                                    @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input image question-image">
                            <div class="input-label">
                                <label>image</label>
                            </div>
                            <div class="input">
                                <div class="button">
                                    SELECT IMAGE
                                </div>
                                <input type="file" name="question_image">
                            </div>
                            <div class="preview background-cover shown" style="background-image: url({{asset('images/questions/'.$question->background_image_path)}})">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-submit level-submit">
                            <button class="submit" type="submit" name="level_submit">SAVE QUESTION</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
