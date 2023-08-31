@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">{{ __('messages.employee_schedule_report') }}
                <a href="{{route('reports')}}" class="ui basic blue button mini offsettop5 float-right"><i class="fa fa-angle-left"></i>&nbsp;Return</a>
            </h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body reportstable">
                    <form action="{{route('empschedule.search')}}" method="post" accept-charset="utf-8" class="ui small form form-filter" id="filterform">
                        {{csrf_field()}}
                        <div class="inline three fields">
                            <div class="three wide field">
                                <div class="ui search dropdown getid selection"><select name="employee">
                                    <option value="">{{ __('messages.employee') }}</option>
                                    @if(isset($emp))
                                    <option value="{{$emp->id}}" selected="">{{$emp->first_name}} {{$emp->last_name}}</option>
                                    @foreach($employees as $user)
                                    @if($emp->id==$user->id)
                                        @else
                                        <option value="{{$user->id}}" data-e="{{$user->email}}" data-ref="1">{{$user->first_name}} {{$user->last_name}}</option>
                                        @endif
                                    @endforeach
                                    @else
                                    @foreach($employees as $user)
                                        <option value="{{$user->id}}" data-e="{{$user->email}}" data-ref="1">{{$user->first_name}} {{$user->last_name}}</option>
                                    @endforeach
                                    @endif
                                    </select><i class="dropdown icon"></i><input class="search" autocomplete="off" tabindex="0">
                                    @if(isset($emp))
                                    <div class="text">{{$emp->first_name}} {{$emp->last_name}}</div>
                                    @else
                                    <div class="default text">{{ __('messages.select_user') }}</div>
                                    @endif
                                    <div class="menu transition hidden" tabindex="-1">
                                        @if(isset($emp))
                                        <div class="item active selected" data-value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}}</div>
                                        @foreach($employees as $user)
                                        @if($emp->id==$user->id)
                                        @else
                                            <div class="item " data-value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</div>
                                            @endif
                                        @endforeach
                                        @else
                                        @foreach($employees as $user)
                                            <div class="item " data-value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</div>
                                        @endforeach
                                        @endif
                                    </div></div>
                            </div>

                            {{-- <input type="hidden" name="emp_id" value=""> --}}
                            <button id="btnfilter" class="ui icon button positive small inline-button"><i class="fa fa-filter"></i> {{ __('messages.filter') }}</button>
                            {{-- <button type="submit" name="submit" class="ui icon button blue small inline-button"><i class="ui icon download"></i> Download</button> --}}
                        </div>
                    </form>

                    <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid"><div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"></div></div><div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-striped table-hover dataTable no-footer dtr-inline" id="dataTables-example" data-order="[[ 0, &quot;asc&quot; ]]" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 153.5px;" aria-sort="ascending" aria-label="Employee Name: activate to sort column descending">{{ __('messages.employee_name') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 105.5px;" aria-label="Start Time: activate to sort column ascending">{{ __('messages.start_time') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 92.5px;" aria-label="Off Time: activate to sort column ascending">{{ __('messages.off_time') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 168.5px;" aria-label="Start Date : activate to sort column ascending">{{ __('messages.start_date') }} </th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 177.5px;" aria-label="End Date: activate to sort column ascending">{{ __('messages.end_date') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 52.5px;" aria-label="Hours: activate to sort column ascending">{{ __('messages.hours') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 162.5px;" aria-label="Rest Days: activate to sort column ascending">{{ __('messages.rest_days') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 98.5px;" aria-label="Status: activate to sort column ascending">{{ __('messages.status') }}</th></tr>
                        </thead>
                        <tbody>
                            @forelse($schedules as $schedule)
                                <tr role="row" class="odd">
                                    @php
                                    $user=DB::table("users")->where('id',$schedule->user_id)->first();
                                    @endphp
                                    <td tabindex="0" class="sorting_1">{{$user->first_name}} {{$user->last_name}}</td>
                                    <td>
                                        {{date('h:i:s A', strtotime($schedule->start_time))}}
                                    </td>
                                    <td>
                                        {{date('h:i:s A', strtotime($schedule->off_time))}}
                                    </td>
                                    <td>
                                        {{date('d F Y', strtotime($schedule->from))}}

                                    </td>
                                    <td>
                                        {{date('d F Y', strtotime($schedule->to))}}
                                    </td>

                                    <td>{{$schedule->hours}}</td>
                                    <td>{{$schedule->rest_days}}</td>
                                    <td class="sorting_1">
                                    @if($dt->toDateString()>$schedule->to)
                                    <span class="teal">Past Schedule</span>
                                    @else
                                    <span class="green">Present Schedule</span>
                                    @endif
                            @empty
                            <tr class="odd"><td valign="top" colspan="7" class="dataTables_empty">No data available in table</td></tr></tbody>
                            @endforelse
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
@endsection
@section('script')
<script type="text/javascript">
$('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: false,ordering: true});
</script>
@endsection