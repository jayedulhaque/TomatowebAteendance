@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __('messages.employee_profile') }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                        </div>
            <form id="add_employee_form" action="{{route('employee.store')}}" class="ui form custom" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-md-6 float-left">
                    <div class="box box-success">
                        <div class="box-header with-border">{{ __('messages.personal_information') }}</div>
                        <div class="box-body">
                            <div class="two fields">
                                <div class="field">
                                    <label>{{ __('messages.first_name') }}</label>
                                    <input type="text" class="uppercase" name="firstname" value="">
                                </div>
                                <div class="field">
                                    <label>{{ __('messages.middle_name') }}</label>
                                    <input type="text" class="uppercase" name="middlename" value="">
                                </div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.last_name') }}</label>
                                <input type="text" class="uppercase" name="lastname" value="">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.gender') }}</label>
                                <div class="ui dropdown uppercase selection" tabindex="0"><select name="gender">
                                    <option value="">{{ __('messages.select_gender') }}</option>
                                    @foreach($genders as $gender)
                                        <option value="{{$gender->name}}">{{$gender->name}}</option>
                                    @endforeach
                                </select><i class="dropdown icon"></i><div class="default text">{{ __('messages.select_gender') }}</div><div class="menu" tabindex="-1">
                                    @foreach($genders as $gender)
                                        <div class="item" data-value="{{$gender->name}}">{{$gender->name}}</div>
                                    @endforeach
                                </div></div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.civil_status') }}</label>
                                <div class="ui dropdown uppercase selection" tabindex="0"><select name="civilstatus">
                                    <option value="">{{ __('messages.select_civil_status') }}</option>
                                    @foreach($civilstatuses as $civilstatus)
                                    <option value="{{$civilstatus->name}}">{{$civilstatus->name}}</option>
                                    @endforeach
                                </select><i class="dropdown icon"></i><div class="default text">{{ __('messages.select_civil_status') }}</div><div class="menu" tabindex="-1">
                                    @foreach($civilstatuses as $civilstatus)
                                        <div class="item" data-value="{{$civilstatus->name}}">{{$civilstatus->name}}</div>
                                    @endforeach
                                </div></div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label>{{ __('messages.height') }} <span class="help">(cm)</span></label>
                                    <input type="number" name="height" value="" placeholder="000">
                                </div>
                                <div class="field">
                                    <label>{{ __('messages.weight') }} <span class="help">(pounds)</span></label>
                                    <input type="number" name="weight" value="" placeholder="000">
                                </div>
                            </div>
                            <div class="two fields">
                            <div class="field">
                                <label>{{ __('messages.email_address_personal') }}</label>
                                <input type="email" name="emailaddress" value="" class="lowercase">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.mobile_number') }}</label>
                                <input type="text" class="" name="mobileno" value="">
                            </div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label>{{ __('messages.age') }}</label>
                                    <input type="number" name="age" value="" placeholder="00">
                                </div>
                                <div class="field">
                                    <label>{{ __('messages.date_of_birth') }}</label>
                                    <input type="date" name="birthday" value="" class="airdatepicker uppercase" data-position="top right" placeholder="Date">
                                </div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.national_id') }}</label>
                                <input type="text" class="uppercase" name="nationalid" value="" placeholder="">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.place_of_birth') }}</label>
                                <input type="text" class="uppercase" name="birthplace" value="" placeholder="City, Province, Country">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.home_address') }}</label>
                                <input type="text" class="uppercase" name="homeaddress" value="" placeholder="House/Unit Number, Building, Street, City, Province, Country">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.upload_profile_photo') }}</label>
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
                                <div class="ui search dropdown uppercase selection">
                                    <select name="company">
                                        <option value="">{{ __('messages.select_company') }}</option>
                                        @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                          </select><i class="dropdown icon"></i><input class="search" autocomplete="off" tabindex="0"><div class="default text">{{ __('messages.select_company') }}</div><div class="menu" tabindex="-1">
                                            @foreach($companies as $company)
                                                <div class="item" data-value="{{$company->id}}"> {{$company->name}}</div>
                                            @endforeach
                                        </div></div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.department') }}</label>
                                <div class="ui search dropdown uppercase selection">
                                    <select name="department">
                                    <option value="">{{ __('messages.select_department') }}</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                    </select><i class="dropdown icon"></i><input class="search" autocomplete="off" tabindex="0"><div class="default text">{{ __('messages.select_department') }}</div><div class="menu" tabindex="-1">
                                        @foreach($departments as $department)
                                        <div class="item" data-value="{{$department->id}}"> {{$department->name}}</div>
                                        @endforeach

                                    </div></div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.job_title') }}</label>
                                <div class="ui search dropdown selection uppercase">
                                    <select name="jobposition">
                                    <option value="">{{ __('messages.select_job_title') }}</option>
                                    @foreach($jobs as $job)
                                        <option value="{{$job->id}}">{{$job->title}}</option>
                                    @endforeach
                                    </select>
                                    <i class="dropdown icon" tabindex="1"><div class="menu"></div></i>
                                    <input class="search" autocomplete="off" tabindex="0"><div class="default text">{{ __('messages.select_job_title') }}</div>
                                    <div class="menu" tabindex="-1">
                                    @foreach($jobs as $job)
                                        <div class="item" data-value="{{$job->id}}" data-dept="OPERATIONS">{{$job->title}}</div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.id_number') }}</label>
                                <input type="text" class="uppercase" name="idno" value="">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.email_address_company') }}</label>
                                <input type="email" name="companyemail" value="" class="lowercase">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.leave_groups') }}</label>
                                <div class="ui dropdown uppercase selection" tabindex="0"><select name="leaveprivilege">
                                    <option value="">{{ __('messages.select_leave_privileges') }}</option>
                                    @foreach($leavegroups as $leavegroup)
                                        <option value="{{$leavegroup->id}}">{{$leavegroup->name}}</option>
                                    @endforeach
                                        </select><i class="dropdown icon"></i><div class="default text">{{ __('messages.select_leave_privileges') }}</div><div class="menu" tabindex="-1">
                                        @foreach($leavegroups as $leavegroup)
                                        <div class="item" data-value="{{$leavegroup->id}}">{{$leavegroup->name}}</div>
                                        @endforeach
                                </div></div>
                            </div>
                            <h4 class="ui dividing header">{{ __('messages.employment_information') }}</h4>
                            <div class="field">
                                <label>{{ __('messages.employment_type') }}</label>
                                <div class="ui dropdown uppercase selection" tabindex="0"><select name="employmenttype">
                                    <option value="">{{ __('messages.select_type') }}</option>
                                    @foreach($employmenttypes as $employmenttype)
                                        <option value="{{$employmenttype->name}}">{{$employmenttype->name}}</option>
                                    @endforeach
                                </select><i class="dropdown icon"></i><div class="default text">{{ __('messages.select_type') }}</div><div class="menu" tabindex="-1">
                                @foreach($employmenttypes as $employmenttype)
                                    <div class="item" data-value="{{$employmenttype->name}}">{{$employmenttype->name}}</div>
                                @endforeach
                                </div></div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.employment_status') }}</label>
                                <div class="ui dropdown uppercase selection" tabindex="0"><select name="employmentstatus">
                                    <option value="">{{ __('messages.select_status') }}</option>
                                    @foreach($employmentstatuses as $employmentstatus)
                                        <option value="{{$employmentstatus->name}}">{{$employmentstatus->name}}</option>
                                    @endforeach
                                </select><i class="dropdown icon"></i><div class="default text">{{ __('messages.select_status') }}</div><div class="menu" tabindex="-1">
                                    @foreach($employmentstatuses as $employmentstatus)
                                        <div class="item" data-value="{{$employmentstatus->name}}">{{$employmentstatus->name}}</div>
                                    @endforeach
                                </div></div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.official_start_date') }}</label>
                                <input type="date" name="startdate" value="" class="airdatepicker uppercase" data-position="top right" placeholder="Date">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.date_regularized') }}</label>
                                <input type="date" name="dateregularized" value="" class="airdatepicker uppercase" data-position="top right" placeholder="Date">
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
                        <button type="submit" name="submit" class="ui green positive button small"><i class="fa fa-check"></i>&nbsp;{{ __('messages.save') }}</button>
                        <a href="{{route('employee.index')}}" class="ui grey black button small"><i class="fa fa-close"></i>&nbsp;{{ __('messages.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
                </div>
@endsection