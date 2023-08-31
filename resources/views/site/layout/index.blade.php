<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <meta name="csrf-token" content="YajpaEPpvFKFF23jF7id1xIwAYkyJHt99dfXUKVm" />
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" /> --}}
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/img/favicon-16x16.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/img/favicon-32x32.png')}}">
        <link rel="icon" type="image/x-icon" href="{{asset('assets/images/img/favicon.ico')}}">

                <title>Dashboard | Workday Time Clock</title>
        <meta name="description" content="Workday dashboard, view recent attendance, recent leaves of absence, and newest employees">
        <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/semantic-ui/semantic.min.css')}}">
        <!--<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/DataTables/datatables.min.css')}}">-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/flag-icon-css/css/flag-icon.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="http://demo-workday.herokuapp.com/assets/vendor/html5shiv/html5shiv.min.js></script>
            <script src="http://demo-workday.herokuapp.com/assets/vendor/respond/respond.min.js"></script>
        <![endif]-->
        @yield('style')
            </head>
    <body>

        <div class="wrapper">

        <nav id="sidebar" class="">
            <div class="sidebar-header bg-lightblue">
                <div class="logo">
                <a href="{{url('/')}}" class="simple-text">
                    <img src="{{asset('assets/images/img/logo.png')}}">
                </a>
                </div>
            </div>

            <ul class="list-unstyled components">
                <li class="{{$page=='dashboard'?"active":""}}">
                    <a href="{{url('/')}}">
                        <i class="fa fa-bars"></i>
                        <p>{{ __('messages.dashboard') }}</p>
                    </a>
                </li>
                @if(Auth::user()->status=='Active' || Auth::user()->hasRole('admin'))
                @role(['employee','manager'])
                    <li class="{{$page=='myattendance'?"active":""}}">
                        <a href="{{ route('attendance.show',Auth::user()->id) }}">
                            <i class="fa fa-clock-o"></i>
                            <p>{{ __('messages.my_attendance') }}</p>
                        </a>
                    </li>
                    <li class="{{$page=='myschedule'?"active":""}}">
                    <a href="{{ route('schedule.show',Auth::user()->id) }}">
                        <i class="fa fa-calendar-o"></i>
                        <p>{{ __('messages.my_schedule') }}</p>
                    </a>
                    </li>
                    <li class="{{$page=='myleave'?"active":""}}">
                    <a href="{{route('leave.show',Auth::user()->id)}}">
                        <i class="fa fa-calendar"></i>
                        <p>{{ __('messages.my_leave') }}</p>
                    </a>
                    </li>
                @endrole
                @role(['admin','manager','superviser'])
                <li class="{{$page=='employee'?"active":""}}">
                    <a href="{{ route('employee.index') }}">
                        <i class="fa fa-users"></i>
                        <p>{{ __('messages.employees') }}</p>
                    </a>
                </li>
                <li class="{{$page=='attendance'?"active":""}}">
                    <a href="{{route('attendance.index')}}">
                        <i class="fa fa-clock-o"></i>
                        <p>{{ __('messages.attendances') }}</p>
                    </a>
                </li>

                <li class="{{$page=='schedule'?"active":""}}">
                    <a href="{{route('schedule.index')}}">
                        <i class="fa fa-calendar-o"></i>
                        <p>{{ __('messages.schedules') }}</p>
                    </a>
                </li>

                <li class="{{$page=='leave'?"active":""}}">
                    <a href="{{route('leave.index')}}">
                        <i class="fa fa-calendar"></i>
                        <p>{{ __('messages.leaves') }}</p>
                    </a>
                </li>
                <li class="{{$page=='reports'?"active":""}}">
                    <a href="{{route('reports')}}">
                        <i class="fa fa-file-text-o"></i>
                        <p>{{ __('messages.reports') }}</p>
                    </a>
                </li>
                <li class="{{$page=='user'?"active":""}}">
                    <a href="{{ route('user.index') }}">
                        <i class="fa fa-user"></i>
                        <p>{{ __('messages.users') }}</p>
                    </a>
                </li>
                <li class="{{$page=='setting'?"active":""}}">
                    @permission('update-settings')
                    <a href="{{route('settings.index')}}">
                        <i class="fa fa-cogs"></i>
                        <p>{{ __('messages.settings') }}</p>
                    </a>
                    @endpermission
                </li>
                @endrole
                @endif

            </ul>
        </nav>

        <div id="body" class="">
        @include('site.layout.include.header')
        @if(Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            @endif
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        @yield('content')

            <input type="hidden" id="_url" value="http://demo-workday.herokuapp.com">
            <script>
                var y = '';
            </script>
        </div>
    </div>

    <script src="{{asset('assets/vendor/jquery/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('assets/vendor/momentjs/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendor/semantic-ui/semantic.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('assets/vendor/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    @yield('script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity
    ="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script> --}}



    <script type="text/javascript">

    $('.ui.dropdown.department').dropdown({ onChange: function(value, text, $selectedItem) {
        $('.jobposition .menu .item').addClass('hide disabled');
        $('.jobposition .text').text('');
        $('input[name="jobposition"]').val('');
        $('.jobposition .menu .item').each(function() {
            var dept = $(this).attr('data-dept');
            if(dept == value) {$(this).removeClass('hide disabled');};
        });
    }});

    function validateFile() {
        var f = document.getElementById("imagefile").value;
        var d = f.lastIndexOf(".") + 1;
        var ext = f.substr(d, f.length).toLowerCase();
        if (ext == "jpg" || ext == "jpeg" || ext == "png") { } else {
            document.getElementById("imagefile").value="";
            $.notify({
            icon: 'ui icon times',
            message: "Please upload only jpg/jpeg and png image formats."},
            {type: 'danger',timer: 400});
        }
    }
    </script>



    </body>
</html>