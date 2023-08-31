@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">{{ __('messages.employee_leaves_report') }}
                <a href="{{route('reports')}}" class="ui basic blue button mini offsettop5 float-right"><i class="fa fa-angle-left"></i>&nbsp; {{ __('messages.return') }}</a>
            </h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body reportstable">
                <form action="{{route('empleave.search')}}" method="post" accept-charset="utf-8" class="ui small form form-filter" id="filterform">
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

                    <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid"><div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"></div></div><div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-striped table-hover dataTable no-footer dtr-inline" id="dataTables-example" data-order="[[ 0, &quot;asc&quot; ]]" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 251.5px;" aria-sort="ascending" aria-label="Employee Name: activate to sort column descending">{{ __('messages.employee_name') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 99.5px;" aria-label="Type: activate to sort column ascending">{{ __('messages.type') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 250.5px;" aria-label="Leave from (date): activate to sort column ascending">{{ __('messages.leave_from') }} <span class="help">({{ __('messages.date') }})</span></th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 213.5px;" aria-label="Leave to (date): activate to sort column ascending">{{ __('messages.leave_to') }} <span class="help">({{ __('messages.date') }})</span></th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 134.5px;" aria-label="Reason: activate to sort column ascending">{{ __('messages.reason') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 122.5px;" aria-label="Status: activate to sort column ascending">{{ __('messages.status') }}</th></tr>
                        </thead>
                        <tbody>
                        @forelse($leaves as $leave)
                        <tr role="row" class="odd">
                            @php
                                    $user=DB::table("users")->where('id',$leave->user_id)->first();
                            @endphp
                            <td tabindex="0" class="sorting_1">
                                {{$user->first_name}} {{$user->last_name}}
                            </td>
                                <td>
                                    {{$leave->leave_type}}
                                </td>
                                <td>
                                    {{$leave->from}}
                                </td>
                                <td>{{$leave->to}}</td>
                                <td>{{$leave->reason}}</td>
                                <td>
                                    @if($leave->status=='cancelled')
                                {{$leave->status}}
                                @elseif($leave->from>=$dt->toDateString() )
                                    {{$leave->status}}
                                @else
                                Past
                                @endif
                                </td>
                            </tr>
                            @empty
                         <tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr>
                         @endforelse
                     </tbody>
                    </table></div></div>
                    {{-- <div class="row">
                    <div class="seven wide column">
                        <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing 1 to {{count($leaves)}} of {{$leaves->total()}} entries</div>
                    </div>
                    <div class="right aligned nine wide column">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                            @if ($leaves->lastPage() > 1)
                            <div class="ui stackable pagination menu">
                                <div class="paginate_button item previous {{ ($leaves->currentPage() == 1) ? ' disabled' : '' }}" id="dataTables-example_previous" href="{{ $leaves->url(1) }}" aria-controls="dataTables-example" data-dt-idx="0" tabindex="0">Previous</div>
                                @for ($i = 1; $i <= $leaves->lastPage(); $i++)
                                <a class="paginate_button item {{ ($leaves->currentPage() == $i) ? ' active' : '' }}" href="{{ $leaves->url($i) }}" aria-controls="dataTables-example" data-dt-idx="1" tabindex="0">{{ $i }}</a>
                                @endfor
                                <div class="paginate_button item next {{ ($leaves->currentPage() == $leaves->lastPage()) ? ' disabled' : '' }}" id="dataTables-example_next" href="{{ $leaves->url($leaves->currentPage()+1) }}" aria-controls="dataTables-example" data-dt-idx="2" tabindex="0">Next</div>
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