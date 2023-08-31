@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __('messages.employee_profile') }}
                    <a href="{{route('employee.index')}}" class="ui basic blue button mini offsettop5 float-right"><i class="fa fa-angle-left"></i>&nbsp;{{ __('messages.return') }}</a>
                </h2>
            </div>
        </div>

        <div class="col-md-12">
                    </div>

        <div class="row">
            <form id="edit_employee_form" action="{{route('employee.update',$employee->id)}}" class="ui form custom" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                {{method_field('PATCH')}}
                {{csrf_field()}}
                <div class="col-md-6 float-left">
                    <div class="box box-success">
                        <div class="box-header with-border">{{ __('messages.personal_information') }}</div>
                        <div class="box-body">
                            <div class="two fields">
                                <div class="field">
                                    <label>{{ __('messages.first_name') }}</label>
                                    <input type="text" class="uppercase notempty" name="firstname" value="{{$employee->first_name}}">
                                </div>
                                <div class="field">
                                    <label>{{ __('messages.middle_name') }}</label>
                                    <input type="text" class="uppercase notempty" name="mi" value="{{$employee->middle_name}}">
                                </div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.last_name') }}</label>
                                <input type="text" class="uppercase notempty" name="lastname" value="{{$employee->last_name}}">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.gender') }}</label>
                                <div class="ui dropdown uppercase selection notempty" tabindex="0"><select name="gender">
                                    <option value="">{{ __('messages.select_gender') }}</option>
                                    <option value="{{$employee->gender}}" selected="">{{$employee->gender}}</option>
                                     @foreach($genders as $gender)
                                        @if($employee->gender==$gender->name)
                                        @else
                                            <option value="{{$gender->name}}">{{$gender->name}}</option>
                                        @endif
                                    @endforeach
                                </select><i class="dropdown icon"></i><div class="text">{{$employee->gender}}</div><div class="menu" tabindex="-1">
                                    <div class="item active selected" data-value="{{$employee->gender}}">{{$employee->gender}}</div>
                                    @foreach($genders as $gender)
                                        @if($employee->gender==$gender->name)
                                        @else
                                            <div class="item" data-value="{{$gender->name}}">{{$gender->name}}</div>
                                        @endif
                                    @endforeach
                                </div></div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.civil_status') }}</label>
                                <div class="ui dropdown uppercase selection" tabindex="0"><select name="civilstatus">
                                    <option value="">{{ __('messages.select_civil_status') }}</option>
                                    <option value="{{$employee->civil_status}}" selected="">{{$employee->civil_status}}</option>
                                    @foreach($civilstatuses as $civilstatus)
                                        @if($employee->civil_status==$civilstatus->name)
                                        @else
                                            <option value="{{$civilstatus->name}}">{{$civilstatus->name}}</option>
                                        @endif
                                    @endforeach
                                </select><i class="dropdown icon"></i><div class="text">{{$employee->civil_status}}</div><div class="menu" tabindex="-1">

                                    <div class="item active selected" data-value="{{$employee->civil_status}}">{{$employee->civil_status}}</div>
                                    @foreach($civilstatuses as $civilstatus)
                                        @if($employee->civil_status==$civilstatus->name)
                                        @else
                                            <div class="item" data-value="{{$civilstatus->name}}">{{$civilstatus->name}}</div>
                                        @endif
                                    @endforeach
                                </div></div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label>{{ __('messages.height') }} <span class="help">(cm)</span></label>
                                    <input type="text" name="height" value="{{$employee->height}}" placeholder="000" class="notempty">
                                </div>
                                <div class="field">
                                    <label>{{ __('messages.weight') }} <span class="help">(pounds)</span></label>
                                    <input type="text" name="weight" value="{{$employee->weight}}" placeholder="000" class="notempty">
                                </div>
                            </div>
                            <div class="two fields">
                            <div class="field">
                                <label>{{ __('messages.email_address_personal') }}</label>
                                <input type="email" name="emailaddress" value="{{$employee->email}}" class="lowercase notempty">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.mobile_number') }}</label>
                                <input type="text" class="uppercase notempty" name="mobileno" value="{{$employee->mobile_number}}">
                            </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label>{{ __('messages.age') }}</label>
                                    <input type="text" name="age" value="{{$employee->age}}" placeholder="00" class="notempty">
                                </div>
                                <div class="field">
                                    <label>{{ __('messages.date_of_birth') }}</label>
                                    <input type="text" name="birthday" value="{{$employee->dob}}" class="airdatepicker notempty" placeholder="Date">
                                </div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.national_id') }}</label>
                                <input type="text" class="uppercase notempty" name="nationalid" value="{{$employee->national_id_no}}" placeholder="">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.place_of_birth') }}</label>
                                <input type="text" class="uppercase notempty" name="birthplace" value="{{$employee->place_of_birth}}" placeholder="City, Province, Country">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.home_address') }}</label>
                                <input type="text" class="uppercase notempty" name="homeaddress" value="{{$employee->home_address}}" placeholder="House/Unit Number, Building, Street, City, Province, Country">
                            </div>
                            <div class="field">
                                @if($employee->pro_photo)
                                <div class="author">

                                                    <img class="avatar border-white" src="{{ url('storage/images/'.$employee->pro_photo) }}" alt="profile photo">

                                                </div>
                                <label>{{ __('messages.change_profile_photo') }}</label>
                                @else
                                <label>{{ __('messages.upload_profile_photo') }}</label>
                                @endif
                                <input class="ui file upload" value="" id="imagefile" name="image" type="file" accept="image/png, image/jpeg, image/jpg" onchange="validateFile()">
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 float-left">
                    <div class="box box-success">
                        <div class="box-header with-border">{{ __('messages.employee_details') }}</div>
                        <div class="box-body">
                            <h4 class="ui dividing header">{{ __('messages.designation') }}</h4>
                            <div class="field">
                                <label>{{ __('messages.company') }}</label>
                                <div class="ui search dropdown uppercase selection"><select name="company">
                                    <option value="">{{ __('messages.select_company') }}</option>
                                    @php
                                            $company=DB::table("companies")->where('id',$employee->company_id)->first();
                                    @endphp
                                    <option value="{{$company->id}}" selected="">{{$company->name}}</option>
                                    @foreach($companies as $comp)
                                        @if($company->name==$comp->name)
                                        @else
                                            <option value="{{$comp->id}}">{{$comp->name}}</option>
                                        @endif
                                    @endforeach
                                    </select><i class="dropdown icon"></i><input class="search" autocomplete="off" tabindex="0"><div class="text">{{$company->name}}</div><div class="menu" tabindex="-1">
                                        <div class="item active selected" data-value="{{$company->id}}">{{$company->name}}</div>
                                    @foreach($companies as $comp)
                                        @if($company->name==$comp->name)
                                        @else
                                            <div class="item" data-value="{{$comp->id}}">{{$comp->name}}</div>
                                        @endif
                                    @endforeach
                                    </div></div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.department') }}</label>
                                <div class="ui search dropdown uppercase department selection"><select name="department">
                                    <option value="">{{ __('messages.select_department') }}</option>
                                    @php
                                        $dpt=DB::table("departments")->where('id',$employee->department_id)->first();
                                    @endphp
                                    <option value="{{$dpt->id}}" selected="">{{$dpt->name}}</option>
                                    @foreach($departments as $department)
                                        @if($dpt->name==$department->name)
                                        @else
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endif
                                    @endforeach
                                </select><i class="dropdown icon"></i><input class="search" autocomplete="off" tabindex="0"><div class="text">{{$dpt->name}}</div><div class="menu" tabindex="-1">
                                    <div class="item active selected" data-value="{{$dpt->id}}">{{$dpt->name}}</div>
                                    @foreach($departments as $department)
                                        @if($dpt->name==$department->name)
                                        @else
                                            <div class="item" data-value="{{$department->id}}">{{$department->name}}</div>
                                        @endif
                                    @endforeach
                                </div></div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.job_title') }}</label>
                                <div class="ui search dropdown selection uppercase jobposition">
                                    {{-- <input type="hidden" name="jobposition" value=""> --}}
                                    <select name="jobposition">
                                    <option value="">{{ __('messages.select_job_title') }}</option>
                                    @php
                                    $job=DB::table("jobs")->where('id',$employee->job_id)->first();
                                    @endphp
                                    <option value="{{$job->id}}" selected="">{{$job->title}}</option>
                                    @foreach($jobs as $jb)
                                        @if($job->title==$jb->title)
                                        @else
                                            <option value="{{$jb->id}}">{{$jb->title}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                    <i class="dropdown icon" tabindex="0"><div class="menu" tabindex="-1"></div></i>
                                    <input class="search" autocomplete="off" tabindex="0"><div class="text">{{$job->title}}</div>
                                    <div class="menu" tabindex="-1">
                                        <div class="item active selected" data-value="{{$job->id}}">{{$job->title}}</div>
                                    @foreach($jobs as $jb)
                                        @if($jb->title==$job->title)
                                        @else
                                            <div class="item" data-value="{{$jb->id}}">{{$jb->title}}</div>
                                        @endif
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.id_number') }}</label>
                                <input type="text" class="uppercase notempty" name="idno" value="{{$employee->id_number}}">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.email_address_company') }}</label>
                                <input type="email" name="companyemail" value="{{$employee->email_company}}" class="lowercase notempty">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.leave_privileges') }}</label>
                                <div class="ui dropdown uppercase selection" tabindex="0"><select name="leaveprivilege">
                                    <option value="">{{ __('messages.select_leave_privileges') }}</option>
                                    @php
                                    $leaveprivilege=DB::table("leave_groups")->where('id',$employee->leave_group_id)->first();
                                    @endphp
                                    <option value="{{$leaveprivilege->id}}" selected="">{{$leaveprivilege->name}}</option>
                                    @foreach($leavegroups as $leavegroup)
                                        @if($leaveprivilege->name==$leavegroup->name)
                                        @else
                                            <option value="{{$leavegroup->id}}">{{$leavegroup->name}}</option>
                                        @endif
                                    @endforeach
                                    </select><i class="dropdown icon"></i><div class="text">{{$leaveprivilege->name}}</div><div class="menu" tabindex="-1">
                                        <div class="item active selected" data-value="{{$leaveprivilege->id}}">{{$leaveprivilege->name}}</div>
                                        @foreach($leavegroups as $leavegroup)
                                            @if($leaveprivilege->name==$leavegroup->name)
                                            @else
                                            <div class="item" data-value="{{$leavegroup->id}}">{{$leavegroup->name}}</div>
                                            @endif
                                        @endforeach

                                    </div></div>
                            </div>
                            <h4 class="ui dividing header">{{ __('messages.employment_information') }}</h4>
                            <div class="field">
                                <label>{{ __('messages.employment_type') }}</label>
                                <div class="ui dropdown uppercase selection" tabindex="0"><select name="employmenttype">
                                    <option value="">{{ __('messages.select_type') }}</option>
                                    <option value="{{$employee->employment_type}}" selected="">{{$employee->employment_type}}</option>
                                    @foreach($employmenttypes as $employmenttype)
                                        @if($employee->employment_type==$employmenttype->name)
                                        @else
                                            <option value="{{$employmenttype->name}}">{{$employmenttype->name}}</option>
                                        @endif
                                    @endforeach
                                </select><i class="dropdown icon"></i><div class="text">{{$employee->employment_type}}</div><div class="menu" tabindex="-1">
                                    <div class="item active selected" data-value="{{$employee->employment_type}}">{{$employee->employment_type}}</div>
                                    @foreach($employmenttypes as $employmenttype)
                                        @if($employee->employment_type==$employmenttype->name)
                                        @else
                                            <div class="item" data-value="{{$employmenttype->name}}">{{$employmenttype->name}}</div>
                                        @endif
                                    @endforeach
                                </div></div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.employment_status') }}</label>
                                <div class="ui dropdown uppercase selection notempty" tabindex="0"><select name="employmentstatus">
                                    <option value="">{{ __('messages.select_status') }}</option>
                                    <option value="{{$employee->status}}" selected="">{{$employee->status}}</option>
                                    @foreach($employmentstatuses as $employmentstatus)
                                        @if($employee->status==$employmentstatus->name)
                                        @else
                                            <option value="{{$employmentstatus->name}}">{{$employmentstatus->name}}</option>
                                        @endif
                                    @endforeach
                                </select><i class="dropdown icon"></i><div class="text">{{$employee->status}}</div><div class="menu" tabindex="-1">
                                    <div class="item active selected" data-value="{{$employee->status}}">{{$employee->status}}</div>
                                    @foreach($employmentstatuses as $employmentstatus)
                                        @if($employee->status==$employmentstatus->name)
                                        @else
                                        <div class="item" data-value="{{$employmentstatus->name}}">{{$employmentstatus->name}}</div>
                                        @endif
                                    @endforeach

                                </div></div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.official_start_date') }}</label>
                                <input type="text" name="startdate" value="{{$employee->official_start_date}}" class="airdatepicker notempty" placeholder="Date">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.date_regularized') }}</label>
                                <input type="text" name="dateregularized" value="{{$employee->date_regularized}}" class="airdatepicker notempty" placeholder="Date">
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 float-left">
                    <div class="ui error message">
                        <i class="close icon"></i>
                        <div class="header"></div>
                        <ul class="list">
                            <li class=""></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 float-left">
                    <div class="action align-right">
                        <button type="submit" name="submit" class="ui green positive button small"><i class="fa fa-check"></i> {{ __('messages.update') }}</button>
                        <a href="{{route('employee.index')}}" class="ui grey black button small"><i class="fa fa-close"></i> {{ __('messages.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

                </div>
@endsection