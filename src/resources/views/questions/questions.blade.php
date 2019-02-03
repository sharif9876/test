@extends('layouts.questions.layout')

@section('content')
    <div class="question">
        <div class="question-inner">
            <div class="question-image">
                <div class="image-inner background-contain" style="background-image: url({{asset('/images/splash-levelup.png')}});">
                </div>
            </div>
            <div class="question-title">
                {{$question->question}}
            </div>
            <div class="question-answers {{$question->type}}">
                <form method="POST" action="" class="form">
                @csrf
                <input type="hidden" name="question-id" value="{{$question->id}}">
                @if($question->answer_type == 'text')
                    <div class="form-input text">
                        <input type="text" name="question-answer">
                    </div>
                @elseif($question->answer_type == 'select')
                    <div class="form-input select">
                        <input type="hidden" name="question-answer" class="select-hidden">
                        <div class="select-field">
                        @foreach($answers as $option)
                            <div class="select-option" select-value="{{$option[1]}}">
                                <div class="select-option-inner">
                                    {{$option[0]}}
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                @elseif($question->answer_type == "multiple")
                    <div class="form-input multiple">
                        <input type="hidden" name="question-answer" class="select-hidden">
                        <div class="select-field">
                        @foreach($answers as $option)
                            <div class="select-option" select-value="{{$option[1]}}">
                                <div class="select-option-inner">
                                    {{$option[0]}}
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                @else
                    <div class="form-input text">
                        <input type="text" name="question-answer">
                    </div>
                @endif
                    <div class="form-submit">
                        <div class="question-submit">
                            <button class="form-submit-button" type="submit">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
