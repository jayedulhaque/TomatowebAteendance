
<!doctype html>
<!--
* Workday - A time clock application for employees
* Email: official.codefactor@gmail.com
* Version: 1.1
* Author: Brian Luna
* Copyright 2020 Codefactor
-->
<html lang="en" class="fullscreen-bg">

<head>
    <title>Sign in | Tomato Time Clock</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/img/favicon-16x16.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/img/favicon-32x32.png')}}">
        <link rel="icon" type="image/x-icon" href="{{asset('assets/images/img/favicon.ico')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/semantic-ui/semantic.min.css')}}">
    <link href="{{asset('assets/css/auth.css')}}" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box">
                    <div class="content">
                        <div class="header">
                            <div class="logo align-center"><img src="{{asset('assets/images/img/logo.png')}}" alt="Workday"></div>
                            <p class="lead">Sign in to your account</p>
                        </div>
                        <form class="form-auth-small ui form" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="fields">
                                <div class="sixteen wide field ">
                                    <label for="email" class="color-white">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your e-mail address" required autofocus autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="fields">
                                <div class="sixteen wide field ">
                                    <label for="password" class="color-white">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="Enter your password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="fields">
                                <div class="sixteen wide field">
                                    <div class="ui checkbox">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} >
                                        <label class="color-white">Remember me</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="ui green button large fluid">SIGN IN</button>
                            @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('assets/vendor/jquery/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('assets/vendor/semantic-ui/semantic.min.js')}}"></script>
    <script>
        $('.ui.checkbox').checkbox('uncheck', 'toggle');
    </script>
</body>

</html>
