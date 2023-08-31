@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __('messages.employee_profile') }}
                    @permission('*-employee')
                    <a href="{{route('employee.index')}}" class="ui basic blue button mini offsettop5 float-right"><i class="fa fa-angle-left"></i>&nbsp;{{ __('messages.return') }}</a>
                    @endpermission
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 float-left">
                <div class="box box-success">
                    <div class="box-body employee-info">
                        <div class="author">
                                                    @if($employee->pro_photo!=NULL)
                                                    <img class="avatar border-white" src="{{ url('storage/images/'.$employee->pro_photo) }}" alt="profile photo">
                                                    @else
                                                    <img class="avatar border-white" src="{{ url('storage/images/'.'default-user.png') }}" alt="profile photo">
                                                    @endif
                                                </div>
                        <p class="description text-center">
                            </p><h4 class="title"> {{$employee->first_name}}   {{$employee->last_name}} </h4>
                            <table style="width: 100%" class="profile-tbl">
                                <tbody>
                                    <tr>
                                        <td>{{ __('messages.email') }}</td>
                                        <td><span class="p_value"> {{$employee->email}} </span></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.mobile_number') }}</td>
                                        <td><span class="p_value"> {{$employee->mobile_number}} </span></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.id') }}</td>
                                        <td><span class="p_value"> {{$employee->id_number}} </span></td>
                                    </tr>
                                </tbody>
                            </table>
                        <p></p>
                    </div>
                </div>
            </div>

            <div class="col-md-8 float-left">
                <div class="box box-success">
                    <div class="box-header with-border">{{ __('messages.personal_information') }}</div>
                    <div class="box-body employee-info">
                            <table class="tablelist">
                                <tbody>
                                    <tr>
                                        <td><p>{{ __('messages.civil_status') }}</p></td>
                                        <td><p> {{$employee->civil_status}} </p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('messages.age') }}</p></td>
                                        <td><p> {{$employee->age}} </p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('messages.height') }} <span class="help">(cm)</span></p></td>
                                        <td><p> {{$employee->height}} </p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('messages.weight') }} <span class="help">(pounds)</span></p></td>
                                        <td><p> {{$employee->weight}} </p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('messages.gender') }}</p></td>
                                        <td><p> {{$employee->gender}} </p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('messages.date_of_birth') }}</p></td>
                                        <td>
                                            <p>
                                                    {{$employee->dob}}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('messages.place_of_birth') }}</p></td>
                                        <td><p> {{$employee->place_of_birth}} </p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('messages.home_address') }}</p></td>
                                        <td><p> {{$employee->home_address}} </p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('messages.national_id') }}</p></td>
                                        <td><p> {{$employee->national_id_no}} </p></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h4 class="ui dividing header">{{ __('messages.designation') }}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.company') }}</td>
                                        <td>
                                            @php
                                                $company=DB::table("companies")->where('id',$employee->company_id)->first();
                                            @endphp
                                            {{$company->name}}
                                         </td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('messages.department') }}</p></td>
                                        <td><p>
                                                @php
                                                $dpt=DB::table("departments")->where('id',$employee->department_id)->first();
                                                @endphp
                                                {{$dpt->name}}
                                         </p></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.position') }}</td>
                                        <td>
                                            @php
                                            $job=DB::table("jobs")->where('id',$employee->job_id)->first();
                                            @endphp
                                {{$job->title}}
                                         </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('messages.leave_privileges') }}</td>
                                        <td>
                                            @php
                                            $leavegroup=DB::table("leave_groups")->where('id',$employee->leave_group_id)->first();
                                            @endphp
                                            {{$leavegroup->leave_privileges}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('messages.employment_type') }}</p></td>
                                        <td><p>
                                            {{$employee->employment_type}}
                                        </p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('messages.employment_status') }}</p></td>
                                        <td><p> {{$employee->status}} </p></td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('messages.official_start_date') }}</p></td>
                                        <td>
                                            <p>
                                                {{$employee->official_start_date}}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>{{ __('messages.date_regularized') }}</p></td>
                                        <td>
                                            <p>
                                                {{$employee->date_regularized}}
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

                </div>
@endsection