@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="user-add">
        <div class="block-header">
            <div class="block-title">Edit User: {{$user->name}}</div>
        </div>
        <div class="block-body">
            <div class="form user-add">
                <form method="POST" action="">
                @csrf
                    <div class="form-row">
                        <div class="form-input text user-name">
                            <div class="input-label">
                                <label>name</label>
                            </div>
                            <div class="input">
                                <input type="text" name="user_name" value="{{$user->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input text user-email">
                            <div class="input-label">
                                <label>e-mail</label>
                            </div>
                            <div class="input">
                                <input type="email" name="user_email" value="{{$user->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input num user-level">
                            <div class="input-label">
                                <label>level</label>
                            </div>
                            <div class="input">
                                <input type="number" name="user_level" min="0" max="{{$level_max}}" value="{{$user->level}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input password user-password">
                            <div class="input-label">
                                <label>password</label>
                            </div>
                            <div class="input">
                                <input type="password" name="user_password"><span class="password-toggle"><i class="far fa-eye"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input select user-email">
                            <div class="input-label">
                                <label>user level</label>
                            </div>
                            <div class="input">
                                <select name="user_userlevel">
                                    <option></option>
                                @foreach(['member', 'admin', 'owner'] as $user_level)
                                    <option type="{{$user_level}}" {{$user->userlevel == $user_level ? "selected" : ""}}>{{$user_level}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-submit user-submit">
                            <button class="submit" type="submit" name="task_submit">SAVE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
