@extends('site.layout.index')

@section('content')
<div class="content">


    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">{{ __('messages.schedules') }}
                @permission('add-schedule')
                <button class="ui positive button mini offsettop5 btn-add float-right"><i class="fa fa-plus"></i>&nbsp;{{ __('messages.add') }}</button>
                @endpermission
            </h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid"><div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"><div id="dataTables-example_filter" class="dataTables_filter ui form"><label>Search:<span class="ui input"><input type="search" class="" placeholder="" aria-controls="dataTables-example"></span></label></div></div></div><div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-striped table-hover dataTable no-footer dtr-inline" id="dataTables-example" data-order="[[ 6, &quot;asc&quot; ]]" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row"><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 152.5px;" aria-label="Employee: activate to sort column ascending">{{ __('messages.employee') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 171.5px;" aria-label="Time (Start-Off): activate to sort column ascending">{{ __('messages.time_start_off') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 60.5px;" aria-label="Hours: activate to sort column ascending">{{ __('messages.hours') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 135.5px;" aria-label="Rest Days: activate to sort column ascending">{{ __('messages.rest_days') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 149.5px;" aria-label="From (Date): activate to sort column ascending">{{ __('messages.from_date') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 133.5px;" aria-label="To (Date): activate to sort column ascending">{{ __('messages.to_date') }}</th><th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 68.5px;" aria-sort="ascending" aria-label="Status: activate to sort column descending">{{ __('messages.status') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 139.5px;" aria-label="Actions: activate to sort column ascending">{{ __('messages.action') }}</th></tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                            <tr role="row" class="odd">
                                @php
                                    $user=DB::table("users")->where('id',$schedule->user_id)->first();
                                @endphp
                                <td tabindex="0">{{$user->first_name}} {{$user->last_name}}</td>
                                <td>
                                    {{date('h:i:s A', strtotime($schedule->start_time))}} - {{date('h:i:s A', strtotime($schedule->off_time))}}                                </td>
                                <td>{{$schedule->hours}} hr</td>
                                <td>{{$schedule->rest_days}}</td>
                                <td>{{$schedule->from}}</td>
                                <td>{{$schedule->to}}</td>
                                <td class="sorting_1">
                                    @if($dt->toDateString()>$schedule->to)
                                    <span class="blue">Previous</span>
                                    @else
                                    <span class="green">Present</span>
                                    @endif

                                </td>
                                <td class="align-right">
                                    @permission('edit-schedule')
                                        <a href="{{route('schedule.edit',$schedule->id)}}" class="ui circular basic icon button tiny"><i class="fa fa-edit"></i></a>
                                    @endpermission
                                    @permission('delete-schedule')
                                        <form action="{{route('schedule.destroy',$schedule->id)}}" class="inline-form" method="POST">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button class="ui circular basic icon button tiny" type="submit"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    @endpermission
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table></div></div>
                    {{-- <div class="row">
                    <div class="seven wide column">
                        <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing 1 to {{count($schedules)}} of {{$schedules->total()}} entries</div>
                    </div>
                    <div class="right aligned nine wide column">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                            @if ($schedules->lastPage() > 1)
                            <div class="ui stackable pagination menu">
                                <div class="paginate_button item previous {{ ($schedules->currentPage() == 1) ? ' disabled' : '' }}" id="dataTables-example_previous" href="{{ $schedules->url(1) }}" aria-controls="dataTables-example" data-dt-idx="0" tabindex="0">Previous</div>
                                @for ($i = 1; $i <= $schedules->lastPage(); $i++)
                                <a class="paginate_button item {{ ($schedules->currentPage() == $i) ? ' active' : '' }}" href="{{ $schedules->url($i) }}" aria-controls="dataTables-example" data-dt-idx="1" tabindex="0">{{ $i }}</a>
                                @endfor
                                <div class="paginate_button item next {{ ($schedules->currentPage() == $schedules->lastPage()) ? ' disabled' : '' }}" id="dataTables-example_next" href="{{ $schedules->url($schedules->currentPage()+1) }}" aria-controls="dataTables-example" data-dt-idx="2" tabindex="0">Next</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div> --}}
                </div></div>
                </div>
            </div>
        </div>

    </div>

                </div>
    <div class="ui dimmer modals page transition hidden"><div class="ui modal add medium scrolling transition hidden">
    <div class="header">{{ __('messages.add_new_schedule') }}</div>
    <div class="content">
        <form id="add_schedule_form" action="{{route('schedule.store')}}" class="ui form" method="post" accept-charset="utf-8">
            {{csrf_field()}}
            <div class="field">
                <label>{{ __('messages.employee') }}</label>
                <div class="ui search dropdown getid uppercase selection notempty"><select name="employee">
                    <option value="">{{ __('messages.select_employee') }}</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}" data-id="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                    @endforeach
                    </select><i class="dropdown icon"></i><input class="search" autocomplete="off" tabindex="0">
                    <div class="default text">{{ __('messages.select_employee') }}</div>
                    <div class="menu transition hidden" tabindex="-1">
                        @foreach($users as $user)
                            <div class="item " data-value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</div>
                        @endforeach
                        </div></div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label for="">{{ __('messages.start_time') }}</label>
                    <input type="text" placeholder="00:00:00 AM" name="intime" class="jtimepicker" readonly="">
                </div>
                <div class="field">
                    <label for="">{{ __('messages.off_time') }}</label>
                    <input type="text" placeholder="00:00:00 PM" name="outime" class="jtimepicker" readonly="">
                </div>
            </div>
            <div class="field">
                <label for="">{{ __('messages.from_date') }}</label>
                <input type="date" placeholder="Date" name="datefrom" id="datefrom" class="airdatepicker">
            </div>
            <div class="field">
                <label for="">{{ __('messages.to_date') }}</label>
                <input type="date" placeholder="Date" name="dateto" id="dateto" class="airdatepicker">
            </div>
            <div class="eight wide field">
                <label for="">{{ __('messages.total_hours') }}</label>
                <input type="number" placeholder="0" name="hours">
            </div>
           <div class="grouped fields field">
                <label>{{ __('messages.choose_rest_days') }}</label>
                <div class="field">
                    <div class="ui checkbox sunday">
                        <input type="checkbox" name="restday[]" value="Sunday" tabindex="0" class="hidden notempty">
                        <label>{{ __('messages.sunday') }}</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox ">
                        <input type="checkbox" name="restday[]" value="Monday" tabindex="0" class="hidden notempty">
                        <label>{{ __('messages.monday') }}</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox ">
                        <input type="checkbox" name="restday[]" value="Tuesday" tabindex="0" class="hidden notempty">
                        <label>{{ __('messages.tuesday') }}</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox ">
                        <input type="checkbox" name="restday[]" value="Wednesday" tabindex="0" class="hidden notempty">
                        <label>{{ __('messages.wednesday') }}</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox ">
                        <input type="checkbox" name="restday[]" value="Thursday" tabindex="0" class="hidden notempty">
                        <label>{{ __('messages.thursday') }}</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox ">
                        <input type="checkbox" name="restday[]" value="Friday" tabindex="0" class="hidden notempty">
                        <label>{{ __('messages.friday') }}</label>
                    </div>
                </div>
                <div class="field" style="padding:0">
                    <div class="ui checkbox saturday">
                        <input type="checkbox" name="restday[]" value="Saturday" tabindex="0" class="hidden notempty">
                        <label>{{ __('messages.saturday') }}</label>
                    </div>
                </div>
                <div class="ui error message">
                    <i class="close icon"></i>
                    <div class="header"></div>
                    <ul class="list">
                        <li class=""></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="actions">
            <button class="ui positive small button" type="submit" name="submit"><i class="fa fa-check"></i> {{ __('messages.save') }}</button>
            <button class="ui grey small button cancel" type="button"><i class="fa fa-close"></i> {{ __('messages.cancel') }}</button>
        </div>
        </form>

</div></div>





<div class="mdtimepicker hidden"><div class="mdtp__wrapper" data-theme="blue"><section class="mdtp__time_holder"><span class="mdtp__time_h active">10</span><span class="mdtp__timedots">:</span><span class="mdtp__time_m">50</span><span class="mdtp__ampm">AM</span></section><section class="mdtp__clock_holder"><div class="mdtp__clock"><span class="mdtp__am active">AM</span><span class="mdtp__pm">PM</span><span class="mdtp__clock_dot"></span><div class="mdtp__hour_holder"><div class="mdtp__digit rotate-120" data-hour="1"><span>1</span></div><div class="mdtp__digit rotate-150" data-hour="2"><span>2</span></div><div class="mdtp__digit rotate-180" data-hour="3"><span>3</span></div><div class="mdtp__digit rotate-210" data-hour="4"><span>4</span></div><div class="mdtp__digit rotate-240" data-hour="5"><span>5</span></div><div class="mdtp__digit rotate-270" data-hour="6"><span>6</span></div><div class="mdtp__digit rotate-300" data-hour="7"><span>7</span></div><div class="mdtp__digit rotate-330" data-hour="8"><span>8</span></div><div class="mdtp__digit rotate-0" data-hour="9"><span>9</span></div><div class="mdtp__digit rotate-30 active" data-hour="10"><span>10</span></div><div class="mdtp__digit rotate-60" data-hour="11"><span>11</span></div><div class="mdtp__digit rotate-90" data-hour="12"><span>12</span></div></div><div class="mdtp__minute_holder hidden"><div class="mdtp__digit rotate-90 marker" data-minute="0"><span>00</span></div><div class="mdtp__digit rotate-96" data-minute="1"><span></span></div><div class="mdtp__digit rotate-102" data-minute="2"><span></span></div><div class="mdtp__digit rotate-108" data-minute="3"><span></span></div><div class="mdtp__digit rotate-114" data-minute="4"><span></span></div><div class="mdtp__digit rotate-120 marker" data-minute="5"><span>05</span></div><div class="mdtp__digit rotate-126" data-minute="6"><span></span></div><div class="mdtp__digit rotate-132" data-minute="7"><span></span></div><div class="mdtp__digit rotate-138" data-minute="8"><span></span></div><div class="mdtp__digit rotate-144" data-minute="9"><span></span></div><div class="mdtp__digit rotate-150 marker" data-minute="10"><span>10</span></div><div class="mdtp__digit rotate-156" data-minute="11"><span></span></div><div class="mdtp__digit rotate-162" data-minute="12"><span></span></div><div class="mdtp__digit rotate-168" data-minute="13"><span></span></div><div class="mdtp__digit rotate-174" data-minute="14"><span></span></div><div class="mdtp__digit rotate-180 marker" data-minute="15"><span>15</span></div><div class="mdtp__digit rotate-186" data-minute="16"><span></span></div><div class="mdtp__digit rotate-192" data-minute="17"><span></span></div><div class="mdtp__digit rotate-198" data-minute="18"><span></span></div><div class="mdtp__digit rotate-204" data-minute="19"><span></span></div><div class="mdtp__digit rotate-210 marker" data-minute="20"><span>20</span></div><div class="mdtp__digit rotate-216" data-minute="21"><span></span></div><div class="mdtp__digit rotate-222" data-minute="22"><span></span></div><div class="mdtp__digit rotate-228" data-minute="23"><span></span></div><div class="mdtp__digit rotate-234" data-minute="24"><span></span></div><div class="mdtp__digit rotate-240 marker" data-minute="25"><span>25</span></div><div class="mdtp__digit rotate-246" data-minute="26"><span></span></div><div class="mdtp__digit rotate-252" data-minute="27"><span></span></div><div class="mdtp__digit rotate-258" data-minute="28"><span></span></div><div class="mdtp__digit rotate-264" data-minute="29"><span></span></div><div class="mdtp__digit rotate-270 marker" data-minute="30"><span>30</span></div><div class="mdtp__digit rotate-276" data-minute="31"><span></span></div><div class="mdtp__digit rotate-282" data-minute="32"><span></span></div><div class="mdtp__digit rotate-288" data-minute="33"><span></span></div><div class="mdtp__digit rotate-294" data-minute="34"><span></span></div><div class="mdtp__digit rotate-300 marker" data-minute="35"><span>35</span></div><div class="mdtp__digit rotate-306" data-minute="36"><span></span></div><div class="mdtp__digit rotate-312" data-minute="37"><span></span></div><div class="mdtp__digit rotate-318" data-minute="38"><span></span></div><div class="mdtp__digit rotate-324" data-minute="39"><span></span></div><div class="mdtp__digit rotate-330 marker" data-minute="40"><span>40</span></div><div class="mdtp__digit rotate-336" data-minute="41"><span></span></div><div class="mdtp__digit rotate-342" data-minute="42"><span></span></div><div class="mdtp__digit rotate-348" data-minute="43"><span></span></div><div class="mdtp__digit rotate-354" data-minute="44"><span></span></div><div class="mdtp__digit rotate-0 marker" data-minute="45"><span>45</span></div><div class="mdtp__digit rotate-6" data-minute="46"><span></span></div><div class="mdtp__digit rotate-12" data-minute="47"><span></span></div><div class="mdtp__digit rotate-18" data-minute="48"><span></span></div><div class="mdtp__digit rotate-24" data-minute="49"><span></span></div><div class="mdtp__digit rotate-30 marker active" data-minute="50"><span>50</span></div><div class="mdtp__digit rotate-36" data-minute="51"><span></span></div><div class="mdtp__digit rotate-42" data-minute="52"><span></span></div><div class="mdtp__digit rotate-48" data-minute="53"><span></span></div><div class="mdtp__digit rotate-54" data-minute="54"><span></span></div><div class="mdtp__digit rotate-60 marker" data-minute="55"><span>55</span></div><div class="mdtp__digit rotate-66" data-minute="56"><span></span></div><div class="mdtp__digit rotate-72" data-minute="57"><span></span></div><div class="mdtp__digit rotate-78" data-minute="58"><span></span></div><div class="mdtp__digit rotate-84" data-minute="59"><span></span></div></div></div><div class="mdtp__buttons"><span class="mdtp__button cancel">Cancel</span><span class="mdtp__button ok">Ok</span></div></section></div></div>
<div class="mdtimepicker hidden"><div class="mdtp__wrapper" data-theme="blue"><section class="mdtp__time_holder"><span class="mdtp__time_h active">2</span><span class="mdtp__timedots">:</span><span class="mdtp__time_m">50</span><span class="mdtp__ampm">PM</span></section><section class="mdtp__clock_holder"><div class="mdtp__clock"><span class="mdtp__am">AM</span><span class="mdtp__pm active">PM</span><span class="mdtp__clock_dot"></span><div class="mdtp__hour_holder"><div class="mdtp__digit rotate-120" data-hour="1"><span>1</span></div><div class="mdtp__digit rotate-150 active" data-hour="2"><span>2</span></div><div class="mdtp__digit rotate-180" data-hour="3"><span>3</span></div><div class="mdtp__digit rotate-210" data-hour="4"><span>4</span></div><div class="mdtp__digit rotate-240" data-hour="5"><span>5</span></div><div class="mdtp__digit rotate-270" data-hour="6"><span>6</span></div><div class="mdtp__digit rotate-300" data-hour="7"><span>7</span></div><div class="mdtp__digit rotate-330" data-hour="8"><span>8</span></div><div class="mdtp__digit rotate-0" data-hour="9"><span>9</span></div><div class="mdtp__digit rotate-30" data-hour="10"><span>10</span></div><div class="mdtp__digit rotate-60" data-hour="11"><span>11</span></div><div class="mdtp__digit rotate-90" data-hour="12"><span>12</span></div></div><div class="mdtp__minute_holder hidden"><div class="mdtp__digit rotate-90 marker" data-minute="0"><span>00</span></div><div class="mdtp__digit rotate-96" data-minute="1"><span></span></div><div class="mdtp__digit rotate-102" data-minute="2"><span></span></div><div class="mdtp__digit rotate-108" data-minute="3"><span></span></div><div class="mdtp__digit rotate-114" data-minute="4"><span></span></div><div class="mdtp__digit rotate-120 marker" data-minute="5"><span>05</span></div><div class="mdtp__digit rotate-126" data-minute="6"><span></span></div><div class="mdtp__digit rotate-132" data-minute="7"><span></span></div><div class="mdtp__digit rotate-138" data-minute="8"><span></span></div><div class="mdtp__digit rotate-144" data-minute="9"><span></span></div><div class="mdtp__digit rotate-150 marker" data-minute="10"><span>10</span></div><div class="mdtp__digit rotate-156" data-minute="11"><span></span></div><div class="mdtp__digit rotate-162" data-minute="12"><span></span></div><div class="mdtp__digit rotate-168" data-minute="13"><span></span></div><div class="mdtp__digit rotate-174" data-minute="14"><span></span></div><div class="mdtp__digit rotate-180 marker" data-minute="15"><span>15</span></div><div class="mdtp__digit rotate-186" data-minute="16"><span></span></div><div class="mdtp__digit rotate-192" data-minute="17"><span></span></div><div class="mdtp__digit rotate-198" data-minute="18"><span></span></div><div class="mdtp__digit rotate-204" data-minute="19"><span></span></div><div class="mdtp__digit rotate-210 marker" data-minute="20"><span>20</span></div><div class="mdtp__digit rotate-216" data-minute="21"><span></span></div><div class="mdtp__digit rotate-222" data-minute="22"><span></span></div><div class="mdtp__digit rotate-228" data-minute="23"><span></span></div><div class="mdtp__digit rotate-234" data-minute="24"><span></span></div><div class="mdtp__digit rotate-240 marker" data-minute="25"><span>25</span></div><div class="mdtp__digit rotate-246" data-minute="26"><span></span></div><div class="mdtp__digit rotate-252" data-minute="27"><span></span></div><div class="mdtp__digit rotate-258" data-minute="28"><span></span></div><div class="mdtp__digit rotate-264" data-minute="29"><span></span></div><div class="mdtp__digit rotate-270 marker" data-minute="30"><span>30</span></div><div class="mdtp__digit rotate-276" data-minute="31"><span></span></div><div class="mdtp__digit rotate-282" data-minute="32"><span></span></div><div class="mdtp__digit rotate-288" data-minute="33"><span></span></div><div class="mdtp__digit rotate-294" data-minute="34"><span></span></div><div class="mdtp__digit rotate-300 marker" data-minute="35"><span>35</span></div><div class="mdtp__digit rotate-306" data-minute="36"><span></span></div><div class="mdtp__digit rotate-312" data-minute="37"><span></span></div><div class="mdtp__digit rotate-318" data-minute="38"><span></span></div><div class="mdtp__digit rotate-324" data-minute="39"><span></span></div><div class="mdtp__digit rotate-330 marker" data-minute="40"><span>40</span></div><div class="mdtp__digit rotate-336" data-minute="41"><span></span></div><div class="mdtp__digit rotate-342" data-minute="42"><span></span></div><div class="mdtp__digit rotate-348" data-minute="43"><span></span></div><div class="mdtp__digit rotate-354" data-minute="44"><span></span></div><div class="mdtp__digit rotate-0 marker" data-minute="45"><span>45</span></div><div class="mdtp__digit rotate-6" data-minute="46"><span></span></div><div class="mdtp__digit rotate-12" data-minute="47"><span></span></div><div class="mdtp__digit rotate-18" data-minute="48"><span></span></div><div class="mdtp__digit rotate-24" data-minute="49"><span></span></div><div class="mdtp__digit rotate-30 marker active" data-minute="50"><span>50</span></div><div class="mdtp__digit rotate-36" data-minute="51"><span></span></div><div class="mdtp__digit rotate-42" data-minute="52"><span></span></div><div class="mdtp__digit rotate-48" data-minute="53"><span></span></div><div class="mdtp__digit rotate-54" data-minute="54"><span></span></div><div class="mdtp__digit rotate-60 marker" data-minute="55"><span>55</span></div><div class="mdtp__digit rotate-66" data-minute="56"><span></span></div><div class="mdtp__digit rotate-72" data-minute="57"><span></span></div><div class="mdtp__digit rotate-78" data-minute="58"><span></span></div><div class="mdtp__digit rotate-84" data-minute="59"><span></span></div></div></div><div class="mdtp__buttons"><span class="mdtp__button cancel">Cancel</span><span class="mdtp__button ok">Ok</span></div></section></div></div>



@endsection

@section('style')
<link href="{{asset('assets/vendor/mdtimepicker/mdtimepicker.min.css')}}" rel="stylesheet">
{{-- <link href="{{asset('assets/vendor/air-datepicker/dist/css/datepicker.min.css')}}" rel="stylesheet"> --}}
@endsection
@section('script')
<script src="{{asset('assets/vendor/mdtimepicker/mdtimepicker.min.js')}}"></script>
{{-- <script src="{{asset('assets/vendor/air-datepicker/dist/js/datepicker.min.js')}}"></script>
<script src="{{asset('assets/vendor/air-datepicker/dist/js/i18n/datepicker.en.js')}}"></script> --}}
<script type="text/javascript">
    $('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: false,ordering: true});
    // $('.airdatepicker').datepicker({ language: 'en', dateFormat: 'yyyy-mm-dd' });
    $('.jtimepicker').mdtimepicker({format:'hh:mm', theme: 'blue', hourPadding: true});

    $('.ui.dropdown.getid').dropdown({ onChange: function(value, text, $selectedItem) {
        $('select[name="employee"] option').each(function() {
            if($(this).val()==value) {var id = $(this).attr('data-id');$('input[name="id"]').val(id);};
        });
    }});
    </script>
@endsection
