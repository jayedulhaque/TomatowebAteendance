@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __('messages.edit_role_permission') }}
                    <a href="{{route('role.index')}}" class="ui basic blue button mini offsettop5 float-right"><i class="fa fa-angle-left"></i>&nbsp;{{ __('messages.return') }}</a>
                </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-content">
                        <form action="{{route('role.update',$role->id)}}" class="ui form grid" method="post" accept-charset="utf-8">
                        {{method_field('PATCH')}}
                        {{csrf_field()}}
                        <div class="two fields">
                           <div class="field">
                            <label>{{ __('messages.role_name') }}</label>
                            <input class="uppercase" name="role_name" value="{{$role->name}}" type="text" required="required">
                        </div>
                        <div class="field">
                            <label>{{ __('messages.status') }}</label>
                            <div class="ui dropdown uppercase selection" tabindex="0"><select name="state" required="required">
                                <option value="{{$role->status}}" selected="">{{$role->status}}</option>
                                @foreach($statuses as $status)
                                        @if($role->status==$status->name)
                                        @else
                                            <option value="{{$status->name}}">{{$status->name}}</option>
                                        @endif
                                @endforeach
                            </select><i class="dropdown icon"></i><div class="text">{{$role->status}}</div><div class="menu transition hidden" tabindex="-1">
                                <div class="item active selected" data-value="{{$role->status}}">{{$role->status}}</div>
                                @foreach($statuses as $status)
                                        @if($role->status==$status->name)
                                        @else
                                        <div class="item" data-value="{{$status->name}}">{{$status->name}}</div>
                                        @endif
                                @endforeach
                            </div></div>
                        </div>
                    </div>
                            <div class="eight wide column">
                                <div class="ui relaxed list">
                                    @foreach($permissions as $permission)
                                    @if($permission->display_name=='Open Dashboard page')
                                    <h3 class="ui sub header">{{ __('messages.dashboard') }}</h3>
                                    <div class="item">
                                        <div class="ui master checkbox">
                                            <input type="checkbox" {{in_array($permission->id,$role_permissions)?"checked":""}} name="perms[]" value="{{$permission->id}}" tabindex="0" class="notempty hidden">
                                            <label>{{$permission->display_name}}</label>
                                        </div>
                                    </div>
                                    @elseif($permission->description=='View Employee profile')
                                            <h3 class="ui sub header">{{ __('messages.employees') }}</h3>
                                            <div class="item">
                                                <div class="ui master checkbox">
                                                    <input type="checkbox" name="" value="" tabindex="0" class="notempty hidden">
                                                    <label>{{$permission->display_name}}</label>
                                                </div>
                                                @php
                                                    $perms=DB::table("permissions")->where('display_name','Open Employees page')->get();
                                                @endphp
                                                <div class="list">
                                                    @foreach($perms as $perm)
                                                    <div class="item">
                                                        <div class="ui child checkbox slider">
                                                            <input type="checkbox" {{in_array($perm->id,$role_permissions)?"checked":""}} name="perms[]" value="{{$perm->id}}" tabindex="0" class="notempty hidden">
                                                            <label>{{$perm->description}}</label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                    @elseif($permission->description=='Edit Attendence')
                                    <h3 class="ui sub header">{{ __('messages.attendances') }}</h3>
                                    <div class="item">
                                        <div class="ui master checkbox">
                                            <input type="checkbox" tabindex="0" class="notempty hidden">
                                            <label>{{$permission->display_name}}</label>
                                        </div>
                                        @php
                                                    $perms=DB::table("permissions")->where('display_name','Open Attendances page')->get();
                                                @endphp
                                        <div class="list">
                                            @foreach($perms as $perm)
                                            <div class="item">
                                                <div class="ui child checkbox slider">
                                                    <input type="checkbox" {{in_array($perm->id,$role_permissions)?"checked":""}} name="perms[]" value="{{$perm->id}}" tabindex="0" class="notempty hidden">
                                                    <label>{{$perm->description}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @elseif($permission->description=='Add Schedule')
                                    <h3 class="ui sub header">{{ __('messages.schedules') }}</h3>
                                    <div class="item">
                                        <div class="ui master checkbox">
                                            <input type="checkbox"  tabindex="0" class="notempty hidden">
                                            <label>{{$permission->display_name}}</label>
                                        </div>
                                        @php
                                                    $perms=DB::table("permissions")->where('display_name','Open Schedules page')->get();
                                                @endphp
                                        <div class="list">
                                            @foreach($perms as $perm)
                                            <div class="item">
                                                <div class="ui child checkbox slider">
                                                    <input type="checkbox" {{in_array($perm->id,$role_permissions)?"checked":""}} name="perms[]" value="{{$perm->id}}" tabindex="0" class="notempty hidden">
                                                    <label>{{$perm->description}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @elseif($permission->description=='Change Leave Status')
                                    <h3 class="ui sub header">{{ __('messages.leaves') }}</h3>
                                    <div class="item">
                                        <div class="ui master checkbox">
                                            <input type="checkbox"  tabindex="0" class="notempty hidden">
                                            <label>{{$permission->display_name}}</label>
                                        </div>
                                        @php
                                                    $perms=DB::table("permissions")->where('display_name','Open Leave page')->get();
                                                @endphp
                                        <div class="list">
                                            @foreach($perms as $perm)
                                            <div class="item">
                                                <div class="ui child checkbox slider">
                                                    <input type="checkbox" {{in_array($perm->id,$role_permissions)?"checked":""}} name="perms[]" value="{{$perm->id}}" tabindex="0" class="notempty hidden">
                                                    <label>{{$perm->description}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @elseif($permission->description=='Update Settings')
                                    <h3 class="ui sub header">{{ __('messages.settings') }}</h3>
                                    <div class="item">
                                        <div class="ui master checkbox">
                                            <input type="checkbox"  tabindex="0" class="notempty hidden">
                                            <label>{{$permission->display_name}}</label>
                                        </div>
                                        @php
                                                    $perms=DB::table("permissions")->where('display_name','Open Settings page')->get();
                                                @endphp
                                        <div class="list">
                                            @foreach($perms as $perm)
                                            <div class="item">
                                                <div class="ui child checkbox slider">
                                                    <input type="checkbox" {{in_array($perm->id,$role_permissions)?"checked":""}} name="perms[]" value="{{$perm->id}}" tabindex="0" class="notempty hidden">
                                                    <label>{{$perm->description}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @elseif($permission->display_name=='Open Reports page')
                                    <h3 class="ui sub header">{{ __('messages.reports') }}</h3>
                                    <div class="item">
                                        <div class="ui master checkbox">
                                            <input type="checkbox" {{in_array($permission->id,$role_permissions)?"checked":""}} name="perms[]" value="{{$permission->id}}" tabindex="0" class="notempty hidden">
                                            <label>{{$permission->display_name}}</label>
                                        </div>
                                    </div>
                                    @elseif($permission->description=='Add User')
                                    <h3 class="ui sub header">{{ __('messages.users') }}</h3>
                                    <div class="item">
                                        <div class="ui master checkbox">
                                            <input type="checkbox"  tabindex="0" class="notempty hidden">
                                            <label>{{$permission->display_name}}</label>
                                        </div>
                                        @php
                                                    $perms=DB::table("permissions")->where('display_name','Open Users page')->get();
                                                @endphp
                                        <div class="list">
                                            @foreach($perms as $perm)
                                            <div class="item">
                                                <div class="ui child checkbox slider">
                                                    <input type="checkbox" {{in_array($perm->id,$role_permissions)?"checked":""}} name="perms[]" value="{{$perm->id}}" tabindex="0" class="notempty hidden">
                                                    <label>{{$perm->description}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @elseif($permission->description=='Add Role')
                                    <h3 class="ui sub header">{{ __('messages.user_role') }}</h3>
                                    <div class="item">
                                        <div class="ui master checkbox">
                                            <input type="checkbox"  tabindex="0" class="notempty hidden">
                                            <label>{{$permission->display_name}}</label>
                                        </div>
                                        @php
                                            $perms=DB::table("permissions")->where('display_name','Open User roles page')->get();
                                        @endphp
                                        <div class="list">
                                            @foreach($perms as $perm)
                                            <div class="item">
                                                <div class="ui child checkbox slider">
                                                    <input type="checkbox" {{in_array($perm->id,$role_permissions)?"checked":""}} name="perms[]" value="{{$perm->id}}" tabindex="0" class="notempty hidden">
                                                    <label>{{$perm->description}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @elseif($permission->description=='Add Company')
                                    <h3 class="ui sub header">{{ __('messages.companies') }}</h3>
                                    <div class="item">
                                        <div class="ui master checkbox">
                                            <input type="checkbox"  tabindex="0" class="notempty hidden">
                                            <label>{{$permission->display_name}}</label>
                                        </div>
                                        @php
                                            $perms=DB::table("permissions")->where('display_name','Open Companies page')->get();
                                        @endphp
                                        <div class="list">
                                            @foreach($perms as $perm)
                                            <div class="item">
                                                <div class="ui child checkbox slider">
                                                    <input type="checkbox" {{in_array($perm->id,$role_permissions)?"checked":""}} name="perms[]" value="{{$perm->id}}" tabindex="0" class="notempty hidden">
                                                    <label>{{$perm->description}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @elseif($permission->description=='Add Department')
                                    <h3 class="ui sub header">{{ __('messages.departments') }}</h3>
                                    <div class="item">
                                        <div class="ui master checkbox">
                                            <input type="checkbox"  tabindex="0" class="notempty hidden">
                                            <label>{{$permission->display_name}}</label>
                                        </div>
                                        @php
                                            $perms=DB::table("permissions")->where('display_name','Open Departments page')->get();
                                        @endphp
                                        <div class="list">
                                            @foreach($perms as $perm)
                                            <div class="item">
                                                <div class="ui child checkbox slider">
                                                    <input type="checkbox" {{in_array($perm->id,$role_permissions)?"checked":""}} name="perms[]" value="{{$perm->id}}" tabindex="0" class="notempty hidden">
                                                    <label>{{$perm->description}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @elseif($permission->description=='Add Job Titles')
                                    <h3 class="ui sub header">{{ __('messages.job_title') }}</h3>
                                    <div class="item">
                                        <div class="ui master checkbox">
                                            <input type="checkbox"  tabindex="0" class="notempty hidden">
                                            <label>{{$permission->display_name}}</label>
                                        </div>
                                        @php
                                            $perms=DB::table("permissions")->where('display_name','Open Job Titles page')->get();
                                        @endphp
                                        <div class="list">
                                            @foreach($perms as $perm)
                                            <div class="item">
                                                <div class="ui child checkbox slider">
                                                    <input type="checkbox" {{in_array($perm->id,$role_permissions)?"checked":""}} name="perms[]" value="{{$perm->id}}" tabindex="0" class="notempty hidden">
                                                    <label>{{$perm->description}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @elseif($permission->description=='Add Leave Type')
                                    <h3 class="ui sub header">{{ __('messages.leave_type') }}</h3>
                                    <div class="item">
                                        <div class="ui master checkbox">
                                            <input type="checkbox" tabindex="0" class="notempty hidden" >
                                            <label>{{$permission->display_name}}</label>
                                        </div>
                                        @php
                                            $perms=DB::table("permissions")->where('display_name','Open Leave types page')->get();
                                        @endphp
                                        <div class="list">
                                            @foreach($perms as $perm)
                                            <div class="item">
                                                <div class="ui child checkbox slider">
                                                    <input type="checkbox" {{in_array($perm->id,$role_permissions)?"checked":""}} name="perms[]" value="{{$perm->id}}" tabindex="0" class="notempty hidden">
                                                    <label>{{$perm->description}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @elseif($permission->description=='Add Leave Group')
                                    <h3 class="ui sub header">{{ __('messages.leave_groups') }}</h3>
                                    <div class="item">
                                        <div class="ui master checkbox">
                                            <input type="checkbox"  tabindex="0" class="notempty hidden">
                                            <label>{{$permission->display_name}}</label>
                                        </div>
                                        @php
                                            $perms=DB::table("permissions")->where('display_name','Open Leave Group page')->get();
                                        @endphp
                                        <div class="list">
                                            @foreach($perms as $perm)
                                            <div class="item">
                                                <div class="ui child checkbox slider">
                                                    <input type="checkbox" {{in_array($perm->id,$role_permissions)?"checked":""}} name="perms[]" value="{{$perm->id}}" tabindex="0" class="notempty hidden">
                                                    <label>{{$perm->description}}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                    </div>

                    <div class="box-footer">
                        <button class="ui positive approve small button" type="submit" name="submit"><i class="fa fa-check"></i>&nbsp;{{ __('messages.set_permission') }}</button>
                        <a href="{{route('role.index')}}" class="ui grey black small button"><i class="fa fa-close"></i>&nbsp;{{ __('messages.cancel') }}</a>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

                </div>
@endsection

@section('script')
<script type="text/javascript">
        $('.list .master.checkbox').checkbox({
            onChecked: function () {
                var
                    $childCheckbox = $(this).closest('.checkbox').siblings('.list').find('.checkbox');
                $childCheckbox.checkbox('check');
            },
            onUnchecked: function () {
                var
                    $childCheckbox = $(this).closest('.checkbox').siblings('.list').find('.checkbox');
                $childCheckbox.checkbox('uncheck');
            }
        });

        $('.list .child.checkbox').checkbox({
            fireOnInit: true,
            onChange: function () {
                var
                    $listGroup = $(this).closest('.list'),
                    $parentCheckbox = $listGroup.closest('.item').children('.checkbox'),
                    $checkbox = $listGroup.find('.checkbox'),
                    allChecked = true,
                    allUnchecked = true;
                $checkbox.each(function () {
                    if ($(this).checkbox('is checked')) {
                        allUnchecked = false;
                    } else {
                        allChecked = false;
                    }
                });
                if (allChecked) {
                    $parentCheckbox.checkbox('set checked');
                } else if (allUnchecked) {
                    $parentCheckbox.checkbox('set unchecked');
                } else {
                    $parentCheckbox.checkbox('set indeterminate');
                }
            }
        });
    </script>
@endsection