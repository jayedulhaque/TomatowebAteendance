@extends('site.layout.index')

@section('content')
@role(['admin','manager','superviser'])
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <h2 class="page-title">{{ __('messages.dashboard') }}</h2>
            </div>
        </div>

    <div class="tiles ">
       <div class="row">
           <div class="col-xs-12 col-sm-6 col-md-4 tile services">
              <a href="javascript:void(0);">
                 <div class="icon"><i class="fa fa-user"></i></div>
                    <table style="width: 100%;" class="dashboard-table">
                        <tbody>
                            <tr>
                                <td>{{ __('messages.regular') }}</td>
                                <td> {{count($regularEmployee)}} </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.trainee') }}</td>
                                <td> {{count($traineeEmployee)}} </td>
                            </tr>
                        </tbody>
                    </table>
                 <div class="title">{{ __('messages.employees') }}</div>
              </a>
           </div>
           <div class="col-xs-12 col-sm-6 col-md-4 tile domains">
              <a href="javascript:void(0);">
                 <div class="icon"><i class="fa fa-clock-o"></i></div>
                 
                     <table style="width: 100%;" class="dashboard-table">
                        <tbody>
                            <tr>
                                <td class="online"><a target="_blank" href="{{ route('online.users') }}">{{ __('messages.online') }}</a></td>
                                <td class="online"> {{$online}} </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.offline') }}</td>
                                <td> {{$offline}} </td>
                            </tr>
                        </tbody>
                    </table>
                 
                 <div class="title">{{ __('messages.attendances') }}</div>
              </a>
           </div>
           <div class="col-xs-12 col-sm-6 col-md-4 tile support">
              <a href="javascript:void(0);">
                 <div class="icon"><i class="fa fa-calendar"></i></div>
                 
                    <table style="width: 100%;" class="dashboard-table">
                        <tbody>
                            <tr>
                                <td>{{ __('messages.approved') }}</td>
                                <td> {{$leaveApproved}} </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.pending') }}</td>
                                <td> {{$leavePending}} </td>
                            </tr>
                        </tbody>
                    </table>
                 
                 <div class="title">{{ __('messages.leaves_of_absence') }}</div>
              </a>
           </div>
        </div>
    </div>

    
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('messages.newest_employees') }}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                    <table class="table responsive nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">{{ __('messages.name') }}</th>
                                <th class="text-left">{{ __('messages.position') }}</th>
                                <th class="text-left">{{ __('messages.start_date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-left name-title">{{$user->first_name}} {{$user->last_name}}</td>
                                    <td class="text-left">@php
                                $job=DB::table("jobs")->where('id',$user->job_id)->first();
                                @endphp
                                {{$job->title}}</td>
                                    <td class="text-left">{{$user->official_start_date}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('messages.recent_attendances') }}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table responsive nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">{{ __('messages.name') }}</th>
                                <th class="text-left">{{ __('messages.type') }}</th>
                                <th class="text-left">{{ __('messages.time') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendances as $attendance)
                                @php
                                    $user=DB::table("users")->where('id',$attendance->user_id)->first();
                                @endphp
                                @if($attendance->time_out)
                                <tr>
                                    <td class="name-title">{{$user->first_name}} {{$user->last_name}} </td>
                                    <td>Time-Out</td>
                                    <td>
                                        {{$attendance->time_out}}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="name-title">{{$user->first_name}} {{$user->last_name}} </td>
                                    <td>Time-In</td>
                                    <td>
                                        {{$attendance->time_in}}
                                    </td>
                                </tr>

                            @endforeach
                        </tbody></table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('messages.recent_leaves_of_absence') }}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                    <table class="table responsive nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">{{ __('messages.name') }}</th>
                                <th class="text-left">{{ __('messages.date') }}</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach($leaves as $leave)
                                <tr>
                                    @php
                                    $user=DB::table("users")->where('id',$leave->user_id)->first();
                                    @endphp
                                    <td>
                                        {{$user->first_name}} {{$user->last_name}}
                                    </td>
                                    <td>
                                        {{date('yy-m-d', strtotime($leave->created_at))}}
                                     </td>
                                </tr>
                                @endforeach

                    </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>


    @else
    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <h2 class="page-title">{{ __('messages.dashboard') }}</h2>
            </div>
        </div>



        <div class="tiles ">
       <div class="row">
           <div class="col-xs-12 col-sm-6 col-md-4 tile services">
              <a href="javascript:void(0);">
                 <div class="icon"><i class="fa fa-clock-o"></i></div>
                    <table style="width: 100%;" class="dashboard-table">
                        <tbody>
                            <tr>
                                <td>{{ __('messages.late_arrivals') }}</td>
                                <td><span class="bolder"> {{$lateIn}} </span></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.early_departures') }}</td>
                                <td><span class="bolder"> {{$earlyOut}} </span></td>
                            </tr>
                        </tbody>
                    </table>
                 <div class="title">{{ __('messages.attendance_current_month') }}</div>
              </a>
           </div>
           <div class="col-xs-12 col-sm-6 col-md-4 tile domains">
              <a href="javascript:void(0);">
                 <div class="icon"><i class="fa fa-user-circle"></i></div>
                 
                     <table style="width: 100%;" class="dashboard-table">
                        <tbody>
                            <tr>
                                <td>{{ __('messages.time') }}</td>
                                <td>
                                    @if($presentSchedule)
                                    <span class="bolder">{{$presentSchedule->start_time}} - {{$presentSchedule->off_time}}
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.rest_days') }}</td>
                                <td>
                                    @if($presentSchedule)
                                    <span class="bolder">
                                    {{$presentSchedule->rest_days}}
                                    @endif
                                </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                 
                 <div class="title">{{ __('messages.present_schedule') }}</div>
              </a>
           </div>
           <div class="col-xs-12 col-sm-6 col-md-4 tile support">
              <a href="javascript:void(0);">
                 <div class="icon"><i class="fa fa-calendar"></i></div>
                 
                    <table style="width: 100%;" class="dashboard-table">
                        <tbody>
                            <tr>
                                <td>{{ __('messages.approved') }} </td>
                                <td><span class="bolder">{{$leaveApproved}}</span></td>
                            </tr>
                            <tr>
                                <td>{{ __('messages.pending') }} </td>
                                <td><span class="bolder">{{$leavePending}}</span></td>
                            </tr>
                        </tbody>
                    </table>
                 
                 <div class="title">{{ __('messages.leaves_of_absence') }}</div>
              </a>
           </div>
        </div>
    </div>



        <div class="row">

            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('messages.recent_attendances') }}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">{{ __('messages.date') }}</th>
                                <th class="text-left">{{ __('messages.time') }}</th>
                                <th class="text-left">{{ __('messages.description') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentAttendances as $attendance)
                                @if($attendance->time_out)
                                <tr>
                                    <td>{{$attendance->date}} </td>
                                    <td>
                                        {{$attendance->time_out}}
                                    </td>
                                    <td>{{ __('messages.time_out') }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>{{$attendance->date}} </td>
                                    <td>
                                        {{$attendance->time_in}}
                                    </td>
                                    <td>{{ __('messages.time_in') }}</td>
                                </tr>

                            @endforeach
                                                                                </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('messages.previous_schedule') }}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                    <table class="table table-striped nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">{{ __('messages.time') }}</th>
                                <th class="text-left">{{ __('messages.from_date_untill') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                            @if($dt->toDateString()>$schedule->to)
                            <tr>
                                <td>
                                    {{$schedule->start_time}} - {{$schedule->off_time}}                                </td>
                                <td>
                                    {{$schedule->from}} - {{$schedule->to}}                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('messages.recent_leaves_of_absence') }}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                    <table class="table table-striped nobordertop">
                        <thead>
                            <tr>
                                <th class="text-left">{{ __('messages.description') }}</th>
                                <th class="text-left">{{ __('messages.date') }}</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach($leaves as $leave)
                                <tr>
                                    <td>
                                        {{$leave->leave_type}}
                                    </td>
                                    <td>
                                        {{date('yy-m-d', strtotime($leave->created_at))}}
                                     </td>
                                </tr>
                                @endforeach

                            </tbody>
                    </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

                </div>
    @endrole
@endsection