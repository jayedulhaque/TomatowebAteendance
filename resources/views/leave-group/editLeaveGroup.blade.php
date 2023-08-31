@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __('messages.edit_leave_group') }}
                    <a href="{{route('leavegroup.index')}}" class="ui basic blue button mini offsettop5 float-right"><i class="fa fa-angle-left"></i>&nbsp;{{ __('messages.return') }}</a>
                </h2>
            </div>
        </div>

        <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-content">
                <form id="edit_leavegroup_form" action="{{route('leavegroup.update',$leavegroup->id)}}" class="ui form" method="post" accept-charset="utf-8">
                {{method_field('PATCH')}}
				{{csrf_field()}}
                <div class="field">
                        <label>{{ __('messages.leave_group_name') }}</label>
                        <input type="text" name="leavegroup" value="{{$leavegroup->name}}" class="uppercase notempty" placeholder="Enter Leave Group Name">
                    </div>
                    <div class="field">
                        <label>{{ __('messages.description') }}</label>
                        <input type="text" name="description" value="{{$leavegroup->description}}" class="uppercase notempty" placeholder="Enter Description for Leave Group">
                    </div>
                    <div class="field">
                        <label>{{ __('messages.leave_privileges') }}</label>
                        <div class="ui search dropdown selection multiple leaves uppercase">
                        	<select name="leaveprivileges[]" multiple="">
                            <option value="">Select Leave Privileges</option>

                                @foreach($leavetypes as $leavetype)
                                @if(in_array($leavetype->description, $leavePrivileges))
                                    <option value="{{$leavetype->description}}" selected="">{{$leavetype->description}}</option>
                                @else
                                    <option value="{{$leavetype->description}}">{{$leavetype->description}}</option>
                                @endif
                                @endforeach

                               </select><i class="dropdown icon"></i>
                               @foreach($leavePrivileges as $value)
		                               <a class="ui label" data-value="{{$value}}">{{$value}}<i class="delete icon"></i></a>
                               @endforeach
                               <input class="search" autocomplete="off" tabindex="0"><span class="sizer"></span><span class="sizer"></span><div class="default text">Select Leave Privileges</div><div class="menu" tabindex="-1">
                                @foreach($leavetypes as $leavetype)
                                    @if(in_array($leavetype->description, $leavePrivileges))
                                            <div class="item selected active filtered" data-value="{{$leavePrivileges[array_search($leavetype->description, $leavePrivileges)]}}">{{$leavePrivileges[array_search($leavetype->description, $leavePrivileges)]}}</div>

                                    @else
                                        {{-- @if(!in_array($leavetype->description, $leavePrivileges)) --}}
                                        <div class="item" data-value="{{$leavetype->description}}">{{$leavetype->description}}</div>
                                        {{-- @endif --}}
                                    @endif
                                @endforeach

                               </div></div>
                    </div>
                    <div class="field">
                        <label>Status</label>
                        <div class="ui dropdown uppercase selection notempty" tabindex="0"><select name="status">
                            <option value="">{{ __('messages.select_status') }}</option>
                            <option value="{{$leavegroup->status}}" selected="">{{$leavegroup->status}}</option>
                            @foreach($statuses as $status)
                            	@if($leavegroup->status==$status->name)
                            	@else
                            	<option value="{{$status->name}}">{{$status->name}}</option>
                            	@endif
                            @endforeach
                        </select><i class="dropdown icon"></i>
                        <div class="text">{{$leavegroup->status}}</div><div class="menu" tabindex="-1">
                        	{{-- <option value="{{$leavegroup->status}}" selected=""></option> --}}
                        	<div class="item active selected" data-value="{{$leavegroup->status}}">{{$leavegroup->status}}</div>
                            @foreach($statuses as $status)
                            	@if($leavegroup->status==$status->name)
                            	@else
                            	<div class="item" data-value="{{$status->name}}">{{$status->name}}</div>
                            	@endif
                            @endforeach
                        </div>
                    </div>
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
                <div class="box-footer">
                    <button class="ui positive approve small button" type="submit" name="submit"><i class="fa fa-check"></i> {{ __('messages.update') }}</button>
                    <a href="{{route('leavegroup.index')}}" class="ui black grey small button"><i class="fa fa-close"></i> {{ __('messages.cancel') }}</a>
                </div>
                </form>

                </div>
            </div>
        </div>
    </div>

                </div>
@endsection
@section('script')
<script>
        var selected = "5";
        var items = selected.split(',');
        $('.ui.dropdown.multiple.leaves').dropdown('set selected', items);
    </script>
@endsection