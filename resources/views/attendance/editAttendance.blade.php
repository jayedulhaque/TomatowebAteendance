@extends('site.layout.index')
@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __('messages.edit_attendance') }}
                <a href="{{route('attendance.index')}}" class="ui basic blue button mini offsettop5 float-right"><i class="fa fa-angle-left"></i>&nbsp;{{ __('messages.return') }}</a>
                </h2>

            </div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-content">
                 <form id="edit_attendance_form" action="{{route('attendance.update',$attendance->id)}}" class="ui form" method="post" accept-charset="utf-8">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                          <div class="two fields">
                            <div class="field">
                            	@php
                                    $user=DB::table("users")->where('id',$attendance->user_id)->first();
                                @endphp
                                <label>{{ __('messages.employee') }}</label>
                                <input type="text" name="employee" class="readonly notempty" readonly="" value="{{$user->first_name}} {{$user->last_name}} ">
                            </div>
                            <div class="field">
                                <label for="">{{ __('messages.date') }}</label>
                                <input class="readonly notempty" type="text" placeholder="Date" name="date" value="{{$attendance->date}}" readonly="">
                            </div>
                        </div>

                          <div class="field">
                            <label for="">{{ __('messages.time_in') }}</label>
                            <input type="hidden" name="timein_date" value="{{$attendance->date}}" class="notempty">
                            <input class="jtimepicker notempty" type="text" placeholder="00:00:00 AM" name="timein" value="{{date('H:i', strtotime($attendance->time_in))}}" readonly="" data-time="{{date('H:i', strtotime($attendance->time_in))}}:00.000">
                        </div>

                                            <div class="field">
                            <label for="">{{ __('messages.time_out') }}</label>
                            <input type="hidden" name="timeout_date" value="{{$attendance->date}}" class="notempty">
                            <input class="jtimepicker notempty" type="text" placeholder="00:00:00 AM" name="timeout" value="{{date("H:i", strtotime($attendance->time_out))}}" readonly="" data-time="{{date("H:i", strtotime($attendance->time_out))}}:00.000">
                        </div>

                    <div class="fields">
                        <div class="sixteen wide field">
                            <label>{{ __('messages.reason') }}</label>
                            <textarea class="" rows="5" name="reason">{{$attendance->comment}}</textarea>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui error message">
                            <i class="close icon"></i>
                            <div class="header"></div>
                            <ul class="list">
                                <li class=""></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <input type="hidden" name="idno" value="1223" class="notempty">
                    <button class="ui positive small button" type="submit" name="submit"><i class="fa fa-check"></i> {{ __('messages.update') }}</button>
                    <a class="ui grey black small button" href="{{route('attendance.index')}}"><i class="fa fa-close"></i> {{ __('messages.cancel') }}</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

                </div>
                <div class="mdtimepicker hidden"><div class="mdtp__wrapper" data-theme="blue"><section class="mdtp__time_holder"><span class="mdtp__time_h active">10</span><span class="mdtp__timedots">:</span><span class="mdtp__time_m">50</span><span class="mdtp__ampm">AM</span></section><section class="mdtp__clock_holder"><div class="mdtp__clock"><span class="mdtp__am active">AM</span><span class="mdtp__pm">PM</span><span class="mdtp__clock_dot"></span><div class="mdtp__hour_holder"><div class="mdtp__digit rotate-120" data-hour="1"><span>1</span></div><div class="mdtp__digit rotate-150" data-hour="2"><span>2</span></div><div class="mdtp__digit rotate-180" data-hour="3"><span>3</span></div><div class="mdtp__digit rotate-210" data-hour="4"><span>4</span></div><div class="mdtp__digit rotate-240" data-hour="5"><span>5</span></div><div class="mdtp__digit rotate-270" data-hour="6"><span>6</span></div><div class="mdtp__digit rotate-300" data-hour="7"><span>7</span></div><div class="mdtp__digit rotate-330" data-hour="8"><span>8</span></div><div class="mdtp__digit rotate-0" data-hour="9"><span>9</span></div><div class="mdtp__digit rotate-30 active" data-hour="10"><span>10</span></div><div class="mdtp__digit rotate-60" data-hour="11"><span>11</span></div><div class="mdtp__digit rotate-90" data-hour="12"><span>12</span></div></div><div class="mdtp__minute_holder hidden"><div class="mdtp__digit rotate-90 marker" data-minute="0"><span>00</span></div><div class="mdtp__digit rotate-96" data-minute="1"><span></span></div><div class="mdtp__digit rotate-102" data-minute="2"><span></span></div><div class="mdtp__digit rotate-108" data-minute="3"><span></span></div><div class="mdtp__digit rotate-114" data-minute="4"><span></span></div><div class="mdtp__digit rotate-120 marker" data-minute="5"><span>05</span></div><div class="mdtp__digit rotate-126" data-minute="6"><span></span></div><div class="mdtp__digit rotate-132" data-minute="7"><span></span></div><div class="mdtp__digit rotate-138" data-minute="8"><span></span></div><div class="mdtp__digit rotate-144" data-minute="9"><span></span></div><div class="mdtp__digit rotate-150 marker" data-minute="10"><span>10</span></div><div class="mdtp__digit rotate-156" data-minute="11"><span></span></div><div class="mdtp__digit rotate-162" data-minute="12"><span></span></div><div class="mdtp__digit rotate-168" data-minute="13"><span></span></div><div class="mdtp__digit rotate-174" data-minute="14"><span></span></div><div class="mdtp__digit rotate-180 marker" data-minute="15"><span>15</span></div><div class="mdtp__digit rotate-186" data-minute="16"><span></span></div><div class="mdtp__digit rotate-192" data-minute="17"><span></span></div><div class="mdtp__digit rotate-198" data-minute="18"><span></span></div><div class="mdtp__digit rotate-204" data-minute="19"><span></span></div><div class="mdtp__digit rotate-210 marker" data-minute="20"><span>20</span></div><div class="mdtp__digit rotate-216" data-minute="21"><span></span></div><div class="mdtp__digit rotate-222" data-minute="22"><span></span></div><div class="mdtp__digit rotate-228" data-minute="23"><span></span></div><div class="mdtp__digit rotate-234" data-minute="24"><span></span></div><div class="mdtp__digit rotate-240 marker" data-minute="25"><span>25</span></div><div class="mdtp__digit rotate-246" data-minute="26"><span></span></div><div class="mdtp__digit rotate-252" data-minute="27"><span></span></div><div class="mdtp__digit rotate-258" data-minute="28"><span></span></div><div class="mdtp__digit rotate-264" data-minute="29"><span></span></div><div class="mdtp__digit rotate-270 marker" data-minute="30"><span>30</span></div><div class="mdtp__digit rotate-276" data-minute="31"><span></span></div><div class="mdtp__digit rotate-282" data-minute="32"><span></span></div><div class="mdtp__digit rotate-288" data-minute="33"><span></span></div><div class="mdtp__digit rotate-294" data-minute="34"><span></span></div><div class="mdtp__digit rotate-300 marker" data-minute="35"><span>35</span></div><div class="mdtp__digit rotate-306" data-minute="36"><span></span></div><div class="mdtp__digit rotate-312" data-minute="37"><span></span></div><div class="mdtp__digit rotate-318" data-minute="38"><span></span></div><div class="mdtp__digit rotate-324" data-minute="39"><span></span></div><div class="mdtp__digit rotate-330 marker" data-minute="40"><span>40</span></div><div class="mdtp__digit rotate-336" data-minute="41"><span></span></div><div class="mdtp__digit rotate-342" data-minute="42"><span></span></div><div class="mdtp__digit rotate-348" data-minute="43"><span></span></div><div class="mdtp__digit rotate-354" data-minute="44"><span></span></div><div class="mdtp__digit rotate-0 marker" data-minute="45"><span>45</span></div><div class="mdtp__digit rotate-6" data-minute="46"><span></span></div><div class="mdtp__digit rotate-12" data-minute="47"><span></span></div><div class="mdtp__digit rotate-18" data-minute="48"><span></span></div><div class="mdtp__digit rotate-24" data-minute="49"><span></span></div><div class="mdtp__digit rotate-30 marker active" data-minute="50"><span>50</span></div><div class="mdtp__digit rotate-36" data-minute="51"><span></span></div><div class="mdtp__digit rotate-42" data-minute="52"><span></span></div><div class="mdtp__digit rotate-48" data-minute="53"><span></span></div><div class="mdtp__digit rotate-54" data-minute="54"><span></span></div><div class="mdtp__digit rotate-60 marker" data-minute="55"><span>55</span></div><div class="mdtp__digit rotate-66" data-minute="56"><span></span></div><div class="mdtp__digit rotate-72" data-minute="57"><span></span></div><div class="mdtp__digit rotate-78" data-minute="58"><span></span></div><div class="mdtp__digit rotate-84" data-minute="59"><span></span></div></div></div><div class="mdtp__buttons"><span class="mdtp__button cancel">Cancel</span><span class="mdtp__button ok">Ok</span></div></section></div></div>
<div class="mdtimepicker hidden"><div class="mdtp__wrapper" data-theme="blue"><section class="mdtp__time_holder"><span class="mdtp__time_h active">2</span><span class="mdtp__timedots">:</span><span class="mdtp__time_m">50</span><span class="mdtp__ampm">PM</span></section><section class="mdtp__clock_holder"><div class="mdtp__clock"><span class="mdtp__am">AM</span><span class="mdtp__pm active">PM</span><span class="mdtp__clock_dot"></span><div class="mdtp__hour_holder"><div class="mdtp__digit rotate-120" data-hour="1"><span>1</span></div><div class="mdtp__digit rotate-150 active" data-hour="2"><span>2</span></div><div class="mdtp__digit rotate-180" data-hour="3"><span>3</span></div><div class="mdtp__digit rotate-210" data-hour="4"><span>4</span></div><div class="mdtp__digit rotate-240" data-hour="5"><span>5</span></div><div class="mdtp__digit rotate-270" data-hour="6"><span>6</span></div><div class="mdtp__digit rotate-300" data-hour="7"><span>7</span></div><div class="mdtp__digit rotate-330" data-hour="8"><span>8</span></div><div class="mdtp__digit rotate-0" data-hour="9"><span>9</span></div><div class="mdtp__digit rotate-30" data-hour="10"><span>10</span></div><div class="mdtp__digit rotate-60" data-hour="11"><span>11</span></div><div class="mdtp__digit rotate-90" data-hour="12"><span>12</span></div></div><div class="mdtp__minute_holder hidden"><div class="mdtp__digit rotate-90 marker" data-minute="0"><span>00</span></div><div class="mdtp__digit rotate-96" data-minute="1"><span></span></div><div class="mdtp__digit rotate-102" data-minute="2"><span></span></div><div class="mdtp__digit rotate-108" data-minute="3"><span></span></div><div class="mdtp__digit rotate-114" data-minute="4"><span></span></div><div class="mdtp__digit rotate-120 marker" data-minute="5"><span>05</span></div><div class="mdtp__digit rotate-126" data-minute="6"><span></span></div><div class="mdtp__digit rotate-132" data-minute="7"><span></span></div><div class="mdtp__digit rotate-138" data-minute="8"><span></span></div><div class="mdtp__digit rotate-144" data-minute="9"><span></span></div><div class="mdtp__digit rotate-150 marker" data-minute="10"><span>10</span></div><div class="mdtp__digit rotate-156" data-minute="11"><span></span></div><div class="mdtp__digit rotate-162" data-minute="12"><span></span></div><div class="mdtp__digit rotate-168" data-minute="13"><span></span></div><div class="mdtp__digit rotate-174" data-minute="14"><span></span></div><div class="mdtp__digit rotate-180 marker" data-minute="15"><span>15</span></div><div class="mdtp__digit rotate-186" data-minute="16"><span></span></div><div class="mdtp__digit rotate-192" data-minute="17"><span></span></div><div class="mdtp__digit rotate-198" data-minute="18"><span></span></div><div class="mdtp__digit rotate-204" data-minute="19"><span></span></div><div class="mdtp__digit rotate-210 marker" data-minute="20"><span>20</span></div><div class="mdtp__digit rotate-216" data-minute="21"><span></span></div><div class="mdtp__digit rotate-222" data-minute="22"><span></span></div><div class="mdtp__digit rotate-228" data-minute="23"><span></span></div><div class="mdtp__digit rotate-234" data-minute="24"><span></span></div><div class="mdtp__digit rotate-240 marker" data-minute="25"><span>25</span></div><div class="mdtp__digit rotate-246" data-minute="26"><span></span></div><div class="mdtp__digit rotate-252" data-minute="27"><span></span></div><div class="mdtp__digit rotate-258" data-minute="28"><span></span></div><div class="mdtp__digit rotate-264" data-minute="29"><span></span></div><div class="mdtp__digit rotate-270 marker" data-minute="30"><span>30</span></div><div class="mdtp__digit rotate-276" data-minute="31"><span></span></div><div class="mdtp__digit rotate-282" data-minute="32"><span></span></div><div class="mdtp__digit rotate-288" data-minute="33"><span></span></div><div class="mdtp__digit rotate-294" data-minute="34"><span></span></div><div class="mdtp__digit rotate-300 marker" data-minute="35"><span>35</span></div><div class="mdtp__digit rotate-306" data-minute="36"><span></span></div><div class="mdtp__digit rotate-312" data-minute="37"><span></span></div><div class="mdtp__digit rotate-318" data-minute="38"><span></span></div><div class="mdtp__digit rotate-324" data-minute="39"><span></span></div><div class="mdtp__digit rotate-330 marker" data-minute="40"><span>40</span></div><div class="mdtp__digit rotate-336" data-minute="41"><span></span></div><div class="mdtp__digit rotate-342" data-minute="42"><span></span></div><div class="mdtp__digit rotate-348" data-minute="43"><span></span></div><div class="mdtp__digit rotate-354" data-minute="44"><span></span></div><div class="mdtp__digit rotate-0 marker" data-minute="45"><span>45</span></div><div class="mdtp__digit rotate-6" data-minute="46"><span></span></div><div class="mdtp__digit rotate-12" data-minute="47"><span></span></div><div class="mdtp__digit rotate-18" data-minute="48"><span></span></div><div class="mdtp__digit rotate-24" data-minute="49"><span></span></div><div class="mdtp__digit rotate-30 marker active" data-minute="50"><span>50</span></div><div class="mdtp__digit rotate-36" data-minute="51"><span></span></div><div class="mdtp__digit rotate-42" data-minute="52"><span></span></div><div class="mdtp__digit rotate-48" data-minute="53"><span></span></div><div class="mdtp__digit rotate-54" data-minute="54"><span></span></div><div class="mdtp__digit rotate-60 marker" data-minute="55"><span>55</span></div><div class="mdtp__digit rotate-66" data-minute="56"><span></span></div><div class="mdtp__digit rotate-72" data-minute="57"><span></span></div><div class="mdtp__digit rotate-78" data-minute="58"><span></span></div><div class="mdtp__digit rotate-84" data-minute="59"><span></span></div></div></div><div class="mdtp__buttons"><span class="mdtp__button cancel">Cancel</span><span class="mdtp__button ok">Ok</span></div></section></div></div>
@endsection
@section('script')
<script src="{{asset('assets/vendor/mdtimepicker/mdtimepicker.min.js')}}"></script>
<script src="{{asset('assets/vendor/air-datepicker/dist/js/datepicker.min.js')}}"></script>
<script src="{{asset('assets/vendor/air-datepicker/dist/js/i18n/datepicker.en.js')}}"></script>
<script type="text/javascript">
            $('.jtimepicker').mdtimepicker({format:'hh:mm', theme: 'blue', hourPadding: true});
            $('.airdatepicker').datepicker({ language: 'en', dateFormat: 'yyyy-mm-dd' });
</script>
@endsection
@section('style')
<link href="{{asset('assets/vendor/mdtimepicker/mdtimepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/vendor/air-datepicker/dist/css/datepicker.min.css')}}" rel="stylesheet">
@endsection