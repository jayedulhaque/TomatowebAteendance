@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">{{ __('messages.reports') }}</h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid"><div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"></div></div><div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="reports-table table table-striped table-hover dataTable no-footer dtr-inline" id="dataTables-example" data-order="[[ 0, &quot;asc&quot; ]]" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                    <thead>
                        <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 973.5px;" aria-sort="ascending" aria-label="Report name: activate to sort column descending">{{ __('messages.report_name') }}</th><th class="odd sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 220.5px;" aria-label="Last Viewed: activate to sort column ascending">{{ __('messages.last_viewed') }}</th></tr>
                    </thead>
                    <tbody>
                    <tr role="row" class="odd">
                            <td tabindex="0" class="sorting_1"><a href="{{route('employee.attendance')}}"><i class="fa fa-clock-o"></i> {{ __('messages.employee_attendance_report') }}</a></td>
                            <td class="odd">
                                @if($reportsView[0]->date)
                                {{date('d F Y', strtotime($reportsView[0]->date))}}
                                @else
                                @endif
                            </td>
                        </tr><tr role="row" class="even">
                            <td tabindex="0" class="sorting_1"><a href="{{route('employee.birthday')}}"><i class="fa fa-building"></i> {{ __('messages.employee_birthdays') }}</a></td>
                            <td class="odd">                                                                @if($reportsView[1]->date)
                                {{date('d F Y', strtotime($reportsView[1]->date))}}
                                @else
                                @endif
                            </td>
                        </tr><tr role="row" class="odd">
                            <td tabindex="0" class="sorting_1"><a href="{{route('employee.leave')}}"><i class="fa fa-calendar"></i> {{ __('messages.employee_leaves_report') }}</a></td>
                            <td class="odd">
                            @if($reportsView[2]->date)
                                {{date('d F Y', strtotime($reportsView[2]->date))}}
                                @else
                                @endif
                            </td>
                        </tr><tr role="row" class="even">
                            <td tabindex="0" class="sorting_1"><a href="{{route('employee.list')}}"><i class="fa fa-users"></i> {{ __('messages.employee_list_report') }}</a></td>
                            <td class="odd">
                            @if($reportsView[3]->date)
                                {{date('d F Y', strtotime($reportsView[3]->date))}}
                                @else
                                @endif                                                                             </td>
                        </tr><tr role="row" class="odd">
                            <td tabindex="0" class="sorting_1"><a href="{{route('employee.schedule')}}"><i class="fa fa-calendar-o"></i> {{ __('messages.employee_schedule_report') }}</a></td>
                            <td class="odd">                                                                 @if($reportsView[4]->date)
                                {{date('d F Y', strtotime($reportsView[4]->date))}}
                                @else
                                @endif
                            </td>
                        </tr>
                        <tr role="row" class="odd">
                            <td tabindex="0" class="sorting_1"><a href="{{route('user.account')}}"><i class="fa fa-address-book"></i> {{ __('messages.user_accounts_report') }}</a></td>
                            <td class="odd">
                            @if($reportsView[5]->date)
                                {{date('d F Y', strtotime($reportsView[5]->date))}}
                                @else
                                @endif                                                                              </td>
                        </tr></tbody>
                </table></div></div>

            </div></div>
                </div>
            </div>
        </div>
    </div>

                </div>
@endsection