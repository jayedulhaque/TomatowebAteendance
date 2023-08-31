
<!doctype html>
<!--
* Workday - A time clock application for employees
* Email: official.codefactor@gmail.com
* Version: 1.1
* Author: Brian Luna
* Copyright 2020 Codefactor
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <meta name="csrf-token" content="vnb2e0o2FLOYsxZ2RAdVelRX0nKAbKpF7Yn6XJLc" />
                <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/img/favicon-16x16.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/img/favicon-32x32.png')}}">
        <link rel="icon" type="image/x-icon" href="{{asset('assets/images/img/favicon.ico')}}">

        <title>Web Time Clock | Workday Time Clock</title>
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/semantic-ui/semantic.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/clock.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="http://demo-workday.herokuapp.com/assets/vendor/html5shiv/html5shiv.min.js></script>
            <script src="http://demo-workday.herokuapp.com/assets/vendor/respond/respond.min.js"></script>
        <![endif]-->

            </head>
    <body>

    <img src="{{asset('assets/images/img/clock-background.png')}}" class="wave">
    <div class="wrapper">
        <div id="body">
            <div class="content">


    <div class="container-fluid">
        <div class="fixedcenter">
            <div class="clockwrapper">
                <div class="clockinout">
                <form  action="{{route('attendance.store')}}" class="ui form custom" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <button class="btnclock timein ui green button large" name="submit" type="submit" value="timein">{{ __('messages.time_in') }}</button>
                        <button class="btnclock timeout ui red button large" name="submit" type="submit" value="timeout">{{ __('messages.time_out') }}</button>
                </form>
                </div>
            </div>
            <div class="clockwrapper">
                <div class="timeclock">
                    <span id="show_day" class="clock-text"></span>
                    <span id="show_time" class="clock-time"></span>
                    <span id="show_date" class="clock-day"></span>
                </div>
            </div>

            {{-- <div class="clockwrapper">
                <div class="userinput">
                    <form action="" method="get" accept-charset="utf-8" class="ui form">
                                                <div class="inline field">
                            <input  class="enter_idno uppercase " name="idno" value="" type="text" placeholder="ENTER YOUR ID" required autofocus>

                                                            <button id="btnclockin" type="button" class="ui positive large icon button">Confirm</button>
                                                        <input type="hidden" id="_url" value="http://demo-workday.herokuapp.com">
                        </div>
                    </form>
                </div>
            </div> --}}
            @if(Session::has('message'))

            <div class="message-after notok" style="display: block;">
                <p>
                    <span id="greetings">Welcome!</span>
                    <span id="fullname">{{Auth::user()->first_name}}&nbsp;{{Auth::user()->last_name}}</span>
                </p>
                <p id="messagewrap">
                    <span id="type"></span>
                    <span id="message">{{ Session::get('message') }}</span>
                    <span id="time"></span>
                </p>
            </div>
            @endif
        </div>

    </div>


            </div>
        </div>
    </div>

    <script src="{{asset('assets/vendor/jquery/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendor/momentjs/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendor/momentjs/moment-timezone-with-data.js')}}"></script>
    <script src="{{asset('assets/vendor/semantic-ui/semantic.min.js')}}"></script>>
    <script src="{{asset('assets/js/script.js')}}"></script>

    <script>
        var timezone = "{{$selectedTimezone->name}}";
    </script>

        <script type="text/javascript">
    // elements day, time, date
    var elTime = document.getElementById('show_time');
    var elDate = document.getElementById('show_date');
    var elDay = document.getElementById('show_day');

    // time function to prevent the 1s delay
    var setTime = function() {
        // initialize clock with timezone
        var time = moment().tz(timezone);

        // set time in html
        elTime.innerHTML= time.format("kk:mm:ss");

        // set date in html
        elDate.innerHTML = time.format('MMMM D, YYYY');

        // set day in html
        elDay.innerHTML = time.format('dddd');
    }

    setTime();
    setInterval(setTime, 1000);

    $('.btnclock').click(function(event) {
        var is_comment = $(this).data("type");
        if (is_comment == "timein") {
            $('.comment').slideDown('200').show();
        } else {
            $('.comment').slideUp('200');
        }
        $('input[name="idno"]').focus();
        $('.btnclock').removeClass('active animated fadeIn')
        $(this).toggleClass('active animated fadeIn');
    });

    $("#rfid").on("input", function(){
        var url, type, idno, comment;
        url = $("#_url").val();
        type = $('.btnclock.active').data("type");
        idno = $('input[name="idno"]').val();
        idno.toUpperCase();
        comment = $('textarea[name="comment"]').val();

        setTimeout(() => {
            $(this).val("");
        }, 600);

        $.ajax({ url: url + '/attendance/add', type: 'post', dataType: 'json', data: {idno: idno, type: type, clockin_comment: comment}, headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },

            success: function(response) {
                if(response['error'] != null)
                {
                    $('.message-after').addClass('notok').hide();
                    $('#type, #fullname').text("").hide();
                    $('#time').html("").hide();
                    $('.message-after').removeClass("ok");
                    $('#message').text(response['error']);
                    $('#fullname').text(response['employee']);
                    $('.message-after').slideToggle().slideDown('400');
                } else {
                    function type(clocktype) {
                        if (clocktype == "timein") {
                            return "Time In at";
                        } else {
                            return "Time Out at";
                        }
                    }
                    $('.message-after').addClass('ok').hide();
                    $('.message-after').removeClass("notok");
                    $('#type, #fullname, #message').text("").show();
                    $('#time').html("").show();
                    $('#type').text(type(response['type']));
                    $('#fullname').text(response['firstname'] + ' ' + response['lastname']);
                    $('#time').html('<span id=clocktime>' + response['time'] + '</span>' + '.' + '<span id=clockstatus> Success!</span>');
                    $('.message-after').slideToggle().slideDown('400');
                }
            }
        })
    });

    $('#btnclockin').click(function(event) {
        var url, type, idno, comment;
        url = $("#_url").val();
        type = $('.btnclock.active').data("type");
        idno = $('input[name="idno"]').val();
        idno.toUpperCase();
        comment = $('textarea[name="comment"]').val();

        $.ajax({
            url: url + '/attendance/add',type: 'post',dataType: 'json',data: {idno: idno, type: type, clockin_comment: comment},headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },

            success: function(response) {
                if(response['error'] != null)
                {
                    $('.message-after').addClass('notok').hide();
                    $('#type, #fullname').text("").hide();
                    $('#time').html("").hide();
                    $('.message-after').removeClass("ok");
                    $('#message').text(response['error']);
                    $('#fullname').text(response['employee']);
                    $('.message-after').slideToggle().slideDown('400');
                } else {
                    function type(clocktype) {
                        if (clocktype == "timein") {
                            return "Time In at";
                        } else {
                            return "Time Out at";
                        }
                    }
                    $('.message-after').addClass('ok').hide();
                    $('.message-after').removeClass("notok");
                    $('#type, #fullname, #message').text("").show();
                    $('#time').html("").show();
                    $('#type').text(type(response['type']));
                    $('#fullname').text(response['firstname'] + ' ' + response['lastname']);
                    $('#time').html('<span id=clocktime>' + response['time'] + '</span>' + '.' + '<span id=clockstatus> Success!</span>');
                    $('.message-after').slideToggle().slideDown('400');
                }
            }
        })
    });
    </script>


    </body>
</html>