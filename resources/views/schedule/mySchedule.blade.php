@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <h2 class="page-title">{{ __('messages.my_schedule') }}</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
            <div class="box box-success">
                <div class="box-body reportstable">
                    <form action="{{route('myschedule.search')}}" method="post" accept-charset="utf-8" class="ui small form form-filter" id="filterform">
                        {{csrf_field()}}
                        <div class="inline two fields">
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
                        </div>
                    </form>

                    <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid"><div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"></div></div><div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" data-order="[[ 6, &quot;desc&quot; ]]" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row"><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 97.5px;" aria-label="Start Time: activate to sort column ascending">{{ __('messages.start_time') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 84.5px;" aria-label="Off Time: activate to sort column ascending">{{ __('messages.off_time') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 107.5px;" aria-label="Total Hours: activate to sort column ascending">{{ __('messages.total_hours') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 138.5px;" aria-label="Rest Days: activate to sort column ascending">{{ __('messages.rest_days') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 212.5px;" aria-label="From (Date): activate to sort column ascending">{{ __('messages.from_date') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 245.5px;" aria-label="To (Date): activate to sort column ascending">{{ __('messages.to_date') }}</th><th class="sorting_desc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 112.5px;" aria-sort="descending" aria-label="Status: activate to sort column ascending">{{ __('messages.status') }}</th></tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                            <tr role="row" class="odd">
                                <td tabindex="0">
                                    {{$schedule->start_time}}
                                </td>
                                <td>
                                    {{$schedule->off_time}}
                                </td>
                                <td>{{$schedule->hours}}</td>
                                <td>{{$schedule->rest_days}}</td>
                                <td>
                                    {{$schedule->from}}
                                </td>
                                <td>
                                    {{$schedule->to}}
                                </td>
                                <td class="sorting_1">
                                @if($dt->toDateString()>$schedule->to)
                                    <span class="teal">Past Schedule</span>
                                    @else
                                    <span class="green">Present</span>
                                    @endif
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

                </div>
@endsection
@section('script')
<script type="text/javascript">
$('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: false,ordering: true});
</script>
@endsection