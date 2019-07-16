@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="question-add">
        <div class="block-header">
            <div class="block-title">Add Message</div>
        </div>
        <div class="block-body">
            <div class="form message-add">
                <form method="POST" action="" enctype="multipart/form-data" id="message-add">
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
                                <textarea name="message_message">{{$message->message}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-input select message-type">
                            <div class="input-label">
                                <label>Type</label>
                            </div>
                            @if($errors != null && $errors->has('message_type'))
                                <div class="input-errors">
                                    - {{$errors->first('message_type')}}
                                </div>
                            @endif
                            <div class="input">
                                <select name="message_type">
                                    <option></option>
                                    @foreach($message_types as $key=>$type)
                                    <option value="{{$type}}"type="{{$type}}">{{$key}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row" id='form-row-level'>
                        
                    </div>
                    <div class="form-row" id='form-row-date'>
                        
                    </div>
                    <div class="form-row">
                        <div class="form-submit level-submit">
                            <button class="submit" type="submit" name="level_submit">CREATE MESSAGE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
