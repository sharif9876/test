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
                    @endif
                    <div class="question-submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
