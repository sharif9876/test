@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="user-add">
        <div class="block-header">
            <div class="block-title">New User</div>
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
                            @if($errors != null && $errors->has('user_name'))
                                <div class="input-errors">
                                    - {{$errors->first('user_name')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="text" name="user_name">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input text user-email">
                            <div class="input-label">
                                <label>e-mail</label>
                            </div>
                            @if($errors != null && $errors->has('user_email'))
                                <div class="input-errors">
                                    - {{$errors->first('user_email')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="email" name="user_email">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input num user-level">
                            <div class="input-label">
                                <label>level</label>
                            </div>
                            @if($errors != null && $errors->has('user_level'))
                                <div class="input-errors">
                                    - {{$errors->first('user_level')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="number" name="user_level" min="0" max="{{$level_max}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input password user-password">
                            <div class="input-label">
                                <label>password</label>
                            </div>
                            @if($errors != null && $errors->has('user_password'))
                                <div class="input-errors">
                                    - {{$errors->first('user_password')}}
                                </div>
                            @endif
                            <div class="input">
                                <input type="password" name="user_password"><span class="password-toggle"><i class="far fa-eye"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input select user-userlevel">
                            <div class="input-label">
                                <label>user level</label>
                            </div>
                            @if($errors != null && $errors->has('user_userlevel'))
                                <div class="input-errors">
                                    - {{$errors->first('user_userlevel')}}
                                </div>
                            @endif
                            <div class="input">
                                <select name="user_userlevel">
                                    <option></option>
                                @foreach(['member', 'admin', 'owner'] as $user_level)
                                    <option type="{{$user_level}}">{{$user_level}}</option>
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
