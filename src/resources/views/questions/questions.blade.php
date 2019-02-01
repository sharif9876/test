@extends('layouts.questions.layout')

@section('content')
    <div class="question">
        <div class="question-inner">
            <div class="question-image">
                <div class="image-inner background-cover" style="background-image: url({{asset('/images/splash-levelup.png')}});">
                </div>
            </div>
            <div class="question-title">
                {{$question->question}}
            </div>
            <div class="question-answers {{$question->type}}">
                <form class="form">
                    @if($question->type == 'text')
                    <div class="form-input">
                        <input type="text" name="question-answer">
                    </div>
                    @endif
                    <div class="form-submit">
                        <div class="question-submit">
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
