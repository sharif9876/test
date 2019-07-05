@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="question-add">
        <div class="block-header">
            <div class="block-title">Add User Message</div>
        </div>
        <div class="block-body">
            <div class="form message-add">
                <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <div class="form-input text message-title">
                            <div class="input-label">
                                <label>Title</label>
                            </div>
                            @if($errors != null && $errors->has('userMessage_title'))
                                <div class="input-errors">
                                    - {{$errors->first('userMessage_title')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="text" name="userMessage_title" value="{{$userMessage->title}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input textarea userMessage-message">
                            <div class="input-label">
                                <label>Message</label>
                            </div>
                            @if($errors != null && $errors->has('userMessage_message'))
                                <div class="input-errors">
                                    - {{$errors->first('userMessage_message')}}
                                </div>
                            @endif
                            <div class="input">
                                <textarea name="userMessage_message">{{$userMessage->message}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input num userMessage-user">
                            <div class="input-label">
                                <label>User : id</label>
                            </div>
                            @if($errors != null && $errors->has('userMessage_user'))
                                <div class="input-errors">
                                    - {{$errors->first('userMessage_user')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="text" name="userMessage_user" value="{{$userMessage->user_id}}">
                            </div>
                        </div>
                    </div>
        
                    <div class="form-row">
                        <div class="form-submit level-submit">
                            <button class="submit" type="submit" name="level_submit">CREATE USER MESSAGE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
