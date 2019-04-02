@extends('layouts.guest.layout')

@section('content')
    <div class="page-container login background-cover" style="background-image: url({{asset('/images/app/background-login.jpg')}});">
        <div class="container-inner">
            <div class="app-logo">
                <div class="logo-inner">
                    levels<br/>out
                </div>
            </div>
            <div class="app-login">
                <div class="login-inner">
                    <form method="POST" action="" class="form login">
                    @csrf
                        <div class="form-row">
                            <div class="form-input login-email">
                                <input id="email" type="email" placeholder="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-row lessspace">
                            <div class="form-input login-password">
                                <input id="password" type="password" placeholder="password"  class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            </div>
                        </div>
                        <div class="form-row lessspace">
                            <div class="form-input login-remember">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>remember me</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-input login-submit">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="login-forgot">
                        <div class="forgot-message">
                            <span>- or -</span>
                            <a href="{{url('password/reset')}}">forgot password?</a> / <a href="{{url('/register')}}">create an account</a>
                            <span>- or -</span>
                        </div>
                    </div>
                    <div class="login-social">
                        <div class="social-message">
                            login via twitter
                        </div>
                        <div class="social-icons">
                            <div class="social-button twitter">
                                <a href="{{url('/auth/twitter')}}">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </div>
                            {{-- <div class="social-button facebook">
                                <a href="{{url('/auth/facebook')}}">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
