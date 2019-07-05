@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="question-add">
        <div class="block-header">
            <div class="block-title">Edit Message</div>
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
                            @if($errors != null && $errors->has('message_title'))
                                <div class="input-errors">
                                    - {{$errors->first('message_title')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="text" name="message_title" value="{{$message->title}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input textarea message-message">
                            <div class="input-label">
                                <label>Message</label>
                            </div>
                            @if($errors != null && $errors->has('message_message'))
                                <div class="input-errors">
                                    - {{$errors->first('message_message')}}
                                </div>
                            @endif
                            <div class="input">
                                <textarea name="message_message" >{{$message->message}}</textarea>
                            </div>
                        </div>
                    </div>
                   <div class="form-row">
                        <div class="form-input select message-global">
                            <div class="input-label">
                                <label>Global</label>
                            </div>
                            @if($errors != null && $errors->has('message_global'))
                                <div class="input-errors">
                                    - {{$errors->first('message_global')}}
                                </div>
                            @endif
                            <div class="input">
                                <select name="message_global">
                                    <option></option>
                                    @foreach($message_types as $key=>$type)
                                    <option @if($type==1 and $message->global)selected @endif value="{{$type}}"type="{{$type}}">{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-input num message-level">
                            <div class="input-label">
                                <label>Level</label>
                            </div>
                            @if($errors != null && $errors->has('message_level'))
                                <div class="input-errors">
                                    - {{$errors->first('message_level')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="number" name="message_level" min="0" max="{{$level_max}}"value="{{$message->level_min}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-submit level-submit">
                            <button class="submit" type="submit" name="level_submit">EDIT MESSAGE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
