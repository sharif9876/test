@extends('layouts.admin.layout')

@section('content')
    <div class="content-block" id="user-add">
        <div class="block-header">
            <div class="block-title">New User</div>
        </div>
        <div class="block-body">
            <div class="form">
                <form method="POST" action="">
                @csrf
                    <div class="form-row">
                        <div class="form-input text user-name">
                            <div class="input-label">
                                name
                            </div>
                            <div class="input">
                                <input type="text" name="user_name">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input email user-email">
                            <div class="input-label">
                                e-mail
                            </div>
                            <div class="input">
                                <input type="email" name="user_email">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input num user-level">
                            <div class="input-label">
                                level
                            </div>
                            <div class="input">
                                <input type="num" name="user_email">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-input num user-level">
                            <div class="input-label">
                                points
                            </div>
                            <div class="input">
                                <input type="num" name="user_email">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-submit user-submit">
                            <button class="submit" type="submit">CREATE USER</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
