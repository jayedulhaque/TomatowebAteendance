@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title"><label>{{ __('messages.my_attendance') }}</label></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <div class="box box-success">
                <div class="box-body reportstable">
                    <form action="{{route('myattendence.search')}}" method="post" accept-charset="utf-8" class="ui small form form-filter" id="filterform">
                        {{csrf_field()}}
                        <div class="inline three fields">

                            <div class="two wide field">
                                <input id="datefrom" type="date" name="datefrom" value="@if(isset($from)){{$from}}@endif" placeholder="Start Date" class="airdatepicker">
                                {{-- <i class="ui icon calendar alternate outline calendar-icon"></i> --}}
                            </div>

                            <div class="two wide field">
                                <input id="dateto" type="date" name="dateto" value="@if(isset($to)){{$to}}@endif" placeholder="End Date" class="airdatepicker">
                                {{-- <i class="ui icon calendar alternate outline calendar-icon"></i> --}}
                            </div>

                            {{-- <input type="hidden" name="emp_id" value=""> --}}
                            <button id="btnfilter" class="ui icon button positive small inline-button"><i class="fa fa-filter"></i> {{ __('messages.filter') }}</button>
                            {{-- <button type="submit" name="submit" class="ui icon button blue small inline-button"><i class="ui icon download"></i> Download</button> --}}
                        </div>
                    </form>


                    <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid"><div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"></div></div><div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" data-order="[[ 0, &quot;desc&quot; ]]" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row"><th class="sorting_desc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 197.5px;" aria-sort="descending" aria-label="Date: activate to sort column ascending">{{ __('messages.date') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 151.5px;" aria-label="Time In: activate to sort column ascending">{{ __('messages.time_in') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 183.5px;" aria-label="Time Out: activate to sort column ascending">{{ __('messages.time_out') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 237.5px;" aria-label="Total Hours: activate to sort column ascending">{{ __('messages.total_hours') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 293.5px;" aria-label="Status (In/Out): activate to sort column ascending">{{ __('messages.status_in_out') }}</th></tr>
                        </thead>
                        <tbody>
                                @foreach($attendances as $attendance)
                         <tr role="row" class="odd">
                                <td tabindex="0" class="sorting_1">{{$attendance->date}}</td>
                                <td>
                                    {{date('h:i:s A', strtotime($attendance->time_in))}}
                                </td>
                                <td>
                                    @if($attendance->time_out)
                                        {{date('h:i:s A', strtotime($attendance->time_out))}}
                                    @else
                                    @endif
                                </td>
                                <td>
                                    {{$attendance->total_hrs}}
                                </td>
                                <td>
                                    @php
                                    $mintime =  DB::table('attendences')->where('user_id',$attendance->user_id)->where('date',$attendance->date)->min('time_in');
                                    @endphp
                                    @if($attendance->time_in>$mintime)
                                     <span class=" blue ">Ok</span> /
                                    @elseif($attendance->time_in <= date("H:i:s", strtotime('+30 minutes',strtotime($setting->time_in))))
                                        <span class=" blue ">In Time</span> /
                                    @else
                                    <span class=" red ">Late In</span> /
                                    @endif
                                    @if(is_null($attendance->time_out))
                                    @elseif($attendance->time_out >= date("H:i:s", strtotime($setting->time_out)))
                                        <span class=" green ">On Time</span>
                                    @else
                                    <span class=" red ">Early Leave</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table></div></div>
                    {{-- <div class="row">
                    <div class="seven wide column">
                        <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing 1 to {{count($attendances)}} of {{$attendances->total()}} entries</div>
                    </div>
                    <div class="right aligned nine wide column">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                            @if ($attendances->lastPage() > 1)
                            <div class="ui stackable pagination menu">
                                <div class="paginate_button item previous {{ ($attendances->currentPage() == 1) ? ' disabled' : '' }}" id="dataTables-example_previous" href="{{ $attendances->url(1) }}" aria-controls="dataTables-example" data-dt-idx="0" tabindex="0">Previous</div>
                                @for ($i = 1; $i <= $attendances->lastPage(); $i++)
                                <a class="paginate_button item {{ ($attendances->currentPage() == $i) ? ' active' : '' }}" href="{{ $attendances->url($i) }}" aria-controls="dataTables-example" data-dt-idx="1" tabindex="0">{{ $i }}</a>
                                @endfor
                                <div class="paginate_button item next {{ ($attendances->currentPage() == $attendances->lastPage()) ? ' disabled' : '' }}" id="dataTables-example_next" href="{{ $attendances->url($attendances->currentPage()+1) }}" aria-controls="dataTables-example" data-dt-idx="2" tabindex="0">Next</div>
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

                </div>
@endsection

@section('script')
<script type="text/javascript">
$('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: false,ordering: true});
</script>
@endsection