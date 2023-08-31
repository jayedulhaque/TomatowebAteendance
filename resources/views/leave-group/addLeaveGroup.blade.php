@extends('site.layout.index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">{{ __('messages.leave_groups') }}
                @permission('add-leavegroup')
                <button class="ui positive mini button offsettop5 btn-add float-right"><i class="fa fa-plus"></i>&nbsp;{{ __('messages.add') }}</button>
                @endpermission
                <a href="{{route('leavetype.index')}}" class="ui basic blue mini button offsettop5 float-right"><i class="fa fa-angle-left"></i>&nbsp;{{ __('messages.return') }}</a>
            </h2>
        </div>

        <div class="row">
                    </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                    {{-- <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid"><div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"><div id="dataTables-example_filter" class="dataTables_filter ui form"><label>Search:<span class="ui input"><input type="search" class="" placeholder="" aria-controls="dataTables-example"></span></label></div></div></div> --}}
                    <div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-striped table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 249.5px;" aria-sort="ascending" aria-label="Leave Group: activate to sort column descending">{{ __('messages.leave_groups') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 349.5px;" aria-label="Description: activate to sort column ascending">{{ __('messages.description') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 195.5px;" aria-label="Privilege: activate to sort column ascending">{{ __('messages.privilege') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 129.5px;" aria-label="Status: activate to sort column ascending">{{ __('messages.status') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 178.5px;" aria-label=": activate to sort column ascending"></th></tr>
                        </thead>
                        <tbody>
                        	@foreach($leavegroups as $leavegroup)

                                       <tr role="row" class="odd">
                                        <td tabindex="0" class="sorting_1 uppercase">{{$leavegroup->name}}</td>
                                        <td class="uppercase">{{$leavegroup->description}}</td>
                                        <td class="uppercase">{{$leavegroup->leave_privileges}}</td>
 										<td class="uppercase"> {{$leavegroup->status}} </td>
                                        <td class="align-right">
                                            @permission('edit-leavegroup')
                                            <a class="ui circular basic icon button tiny" href="{{route('leavegroup.edit',$leavegroup->id)}}" style="margin-left: 120px;"><i class="fa fa-edit"></i></a>
                                            @endpermission
                                            @permission('delete-leavegroup')
                                            <form action="{{route('leavegroup.destroy',$leavegroup->id)}}" class="inline-form" method="POST">
                                			{{csrf_field()}}
                                			{{method_field('DELETE')}}
                                            	<button class="ui circular basic icon button tiny" type="submit"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                            @endpermission
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                    </table></div></div>
                    {{-- <div class="row">
                    <div class="seven wide column">
                        <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing 1 to {{count($leavegroups)}} of {{$leavegroups->total()}} entries</div>
                    </div>
                    <div class="right aligned nine wide column">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                            @if ($leavegroups->lastPage() > 1)
                            <div class="ui stackable pagination menu">
                                <div class="paginate_button item previous {{ ($leavegroups->currentPage() == 1) ? ' disabled' : '' }}" id="dataTables-example_previous" href="{{ $leavegroups->url(1) }}" aria-controls="dataTables-example" data-dt-idx="0" tabindex="0">Previous</div>
                                @for ($i = 1; $i <= $leavegroups->lastPage(); $i++)
                                <a class="paginate_button item {{ ($leavegroups->currentPage() == $i) ? ' active' : '' }}" href="{{ $leavegroups->url($i) }}" aria-controls="dataTables-example" data-dt-idx="1" tabindex="0">{{ $i }}</a>
                                @endfor
                                <div class="paginate_button item next {{ ($leavegroups->currentPage() == $leavegroups->lastPage()) ? ' disabled' : '' }}" id="dataTables-example_next" href="{{ $leavegroups->url($leavegroups->currentPage()+1) }}" aria-controls="dataTables-example" data-dt-idx="2" tabindex="0">Next</div>
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


                <div class="ui dimmer modals page transition hidden">
                	<div class="ui modal medium add scrolling transition hidden">
    <div class="header">{{ __('messages.add_new_leave_group') }}</div>
    <div class="content">
        <form id="add_leavegroup_form" action="{{route('leavegroup.store')}}" class="ui form" method="post" role="form" accept-charset="utf-8">
            {{csrf_field()}}
            <div class="field">
                <label>{{ __('messages.leave_group_name') }}</label>
                <input type="text" name="leavegroup" value="" class="uppercase" placeholder="Enter Leave Group Name">
            </div>
            <div class="field">
                <label>{{ __('messages.description') }}</label>
                <input type="text" name="description" value="" class="uppercase" placeholder="Enter Description for Leave Group">
            </div>
            <div class="field">
                <label>{{ __('messages.leave_privileges') }}</label>
                <div class="ui search dropdown selection multiple uppercase"><select name="leaveprivileges[]" multiple="">
                    <option value="">{{ __('messages.select_leave_privileges') }}</option>
                    @foreach($leavetypes as $leavetype)
                            <option value="{{$leavetype->description}}">{{$leavetype->description}}</option>
                    @endforeach
                    </select>
                    <i class="dropdown icon"></i>
                    <input class="search" autocomplete="off" tabindex="0">
                    <span class="sizer"></span><span class="sizer"></span>
                    <div class="default text">{{ __('messages.select_leave_privileges') }}</div><div class="menu" tabindex="-1">
                    	@foreach($leavetypes as $leavetype)
                    		<div class="item" data-value="{{$leavetype->description}}">{{$leavetype->description}}</div>
                    	@endforeach
                    </div></div>
            </div>
            <div class="field">
                <label>{{ __('messages.status') }}</label>
                <div class="ui dropdown uppercase selection" tabindex="0"><select name="status">
                    <option value="">{{ __('messages.select_status') }}</option>
                    <option value="Active">Active</option>
                    <option value="Disabled">Disabled</option>
                </select><i class="dropdown icon"></i><div class="default text">{{ __('messages.select_status') }}</div><div class="menu" tabindex="-1"><div class="item" data-value="Active">Active</div><div class="item" data-value="Disabled">Disabled</div></div></div>
            </div>
            <div class="field">
                <div class="ui error message">
                    <i class="fa fa-window-close"></i>
                    <div class="header"></div>
                    <ul class="list">
                        <li class=""></li>
                    </ul>
                </div>
            </div>
    </div>
    <div class="actions">
        <button class="ui positive small button approve" type="submit" name="submit"><i class="fa fa-check"></i> {{ __('messages.save') }}</button>
        <button class="ui grey black button cancel" type="button"><i class="fa fa-times"></i> {{ __('messages.cancel') }}</button>
    </div>
</form>
</div></div>
@endsection
@section('script')
<script type="text/javascript">
$('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,ordering: true});
</script>
@endsection