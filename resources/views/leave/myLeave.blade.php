@extends('site.layout.index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">{{ __('messages.my_leave') }}
                <button class="ui positive button mini offsettop5 btn-add float-right"><i class="fa fa-plus"></i>&nbsp;{{ __('messages.request_leave') }}</button>
            </h2>
        </div>
        <div class="row">
                    </div>
        <div class="row">
            <div class="box box-success">
                <div class="box-body reportstable">
                    <form action="{{route('myleave.search')}}" method="post" accept-charset="utf-8" class="ui small form form-filter" id="filterform">
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

                    <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid"><div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"></div></div><div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-striped table-bordered table-hover delegation dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 168.5px;" aria-sort="ascending" aria-label="Leave Type: activate to sort column descending">{{ __('messages.leave_type') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 174.5px;" aria-label="Leave From: activate to sort column ascending">{{ __('messages.leave_from') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 138.5px;" aria-label="Leave To: activate to sort column ascending">{{ __('messages.leave_to') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 122.5px;" aria-label="Reason: activate to sort column ascending">{{ __('messages.reason') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 185.5px;" aria-label="Return Date: activate to sort column ascending">{{ __('messages.return_date') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 111.5px;" aria-label="Status: activate to sort column ascending">{{ __('messages.status') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 127.5px;" aria-label="Actions: activate to sort column ascending">{{ __('messages.action') }}</th></tr>
                        </thead>
                        <tbody>
                            @forelse($leaves as $leave)
                            <tr>
                                <td>
                                    {{$leave->leave_type}}
                                </td>
                                <td>
                                    {{$leave->from}}
                                </td>
                                <td>
                                    {{$leave->to}}
                                </td>
                                <td>
                                    {{$leave->reason}}
                                </td>
                                <td>
                                    {{$leave->return_date}}
                                </td>
                                <td>
                                    {{$leave->status}}
                                </td>
                                <td>
                                    @if($leave->status=='pending' && $leave->from>=$dt->toDateString())
                                    <a class="ui circular red button tiny" href="{{route('leave.edit',$leave->id)}}" style="">{{ __('messages.cancel') }}</a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                        	<tr class="odd"><td valign="top" colspan="7" class="dataTables_empty">No data available in table</td></tr>
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
    <div class="ui dimmer modals page transition hidden"><div class="ui modal medium add scrolling transition hidden">
    <div class="header">{{ __('messages.request_leave') }}</div>
    <div class="content">
        <form id="request_personal_leave_form" action="{{route('leave.store')}}" class="ui form" method="post" accept-charset="utf-8">
        {{csrf_field()}}
        <div class="field">
            <label>{{ __('messages.leave_type') }}</label>
            <div class="ui dropdown uppercase getid selection" tabindex="0">
                <select name="type">
                    <option value="">{{ __('messages.select_type') }}</option>
                    @foreach($leavePrivileges as $value)
                                <option value="{{$value}}">{{$value}}</option>
                    @endforeach
                </select><i class="dropdown icon"></i>

                <div class="default text">{{ __('messages.select_type') }}</div>
                <div class="menu" tabindex="-1">
                    @foreach($leavePrivileges as $value)
                            <div class="item" data-value="{{$value}}">{{$value}}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label for="">{{ __('messages.leave_from') }}</label>
                <input id="leavefrom" type="date" placeholder="Start date" name="leavefrom" class="airdatepicker uppercase">
            </div>
            <div class="field">
                <label for="">{{ __('messages.leave_to') }}</label>
                <input id="leaveto" type="date" placeholder="End date" name="leaveto" class="airdatepicker uppercase">
            </div>
        </div>
        <div class="field">
            <label for="">{{ __('messages.return_date') }}</label>
            <input id="returndate" type="date" placeholder="Enter Return date" name="returndate" class="airdatepicker uppercase">
        </div>
        <div class="field">
            <label>{{ __('messages.reason') }}</label>
            <textarea class="uppercase" rows="5" name="reason" value=""></textarea>
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
    <div class="actions">
        <input type="hidden" name="typeid" value="">
        <button class="ui positive small button" type="submit" name="submit"><i class="fa fa-check"></i> {{ __('messages.send_request') }}</button>
        <button class="ui grey small button cancel" type="button"><i class="fa fa-close"></i> {{ __('messages.cancel') }}</button>
    </div>
</form>
</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: false,ordering: true});
</script>
@endsection