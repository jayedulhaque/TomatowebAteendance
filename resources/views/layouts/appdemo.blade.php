<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <meta name="csrf-token" content="YajpaEPpvFKFF23jF7id1xIwAYkyJHt99dfXUKVm" />
                <title>Forget Password | Tomato Time Clock</title>
        <meta name="description" content="Workday dashboard, view recent attendance, recent leaves of absence, and newest employees">
        <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="http://demo-workday.herokuapp.com/assets/vendor/html5shiv/html5shiv.min.js></script>
            <script src="http://demo-workday.herokuapp.com/assets/vendor/respond/respond.min.js"></script>
        <![endif]-->
            </head>
    <body>

        <div class="wrapper">
        <div id="body" class="active">
            <nav class="navbar navbar-expand-lg navbar-light bg-lightblue">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto navmenu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        @yield('content')

            <input type="hidden" id="_url" value="http://demo-workday.herokuapp.com">
            <script>
                var y = '';
            </script>
        </div>
    </div>

    <script src="{{asset('assets/vendor/jquery/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    </body>
</html>