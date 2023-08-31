@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">{{ __('messages.users') }}
            @permission('add-user')
            <button class="ui positive button mini offsettop5 btn-add float-right"><i class="fa fa-plus"></i>&nbsp;{{ __('messages.add') }}</button>
            @endpermission
            @permission('add-role')
            <a href="{{route('role.index')}}" class="ui blue button mini offsettop5 float-right"><i class="fa fa-user"></i>&nbsp;{{ __('messages.roles') }}</a>
            @endpermission
            </h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                                        {{-- <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid"><div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"><div id="dataTables-example_filter" class="dataTables_filter ui form"><label>Search:<span class="ui input"><input type="search" class="" placeholder="" aria-controls="dataTables-example"></span></label></div></div></div> --}}
                                        <div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-striped table-hover dataTable no-footer dtr-inline" id="dataTables-example" data-order="[[ 0, &quot;asc&quot; ]]" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 249.5px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">{{ __('messages.name') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 306.5px;" aria-label="Email: activate to sort column ascending">{{ __('messages.email') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 152.5px;" aria-label="Role: activate to sort column ascending">{{ __('messages.role') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 94.5px;" aria-label="Type: activate to sort column ascending">{{ __('messages.type') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 112.5px;" aria-label="Status: activate to sort column ascending">{{ __('messages.status') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 156.5px;" aria-label=": activate to sort column ascending">{{ __('messages.action') }}</th></tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr role="row" class="odd">
                                <td tabindex="0" class="sorting_1 uppercase">{{$user->first_name}} {{$user->last_name}}</td>
                                <td >{{$user->email}}</td>
                                <td class="uppercase">@foreach($user->roles as $role){{$role->name}}@endforeach</td>
                                <td class="uppercase">  {{$user->account_type}}  </td>
                                <td class="uppercase">
                                    <span>
                                        {{$user->status}}
                                    </span>
                                </td>
                                <td class="align-right">
                                    @permission('edit-user')
                                        @if($user->hasRole('admin'))
                                        @else
                                            <a href="{{ route('user.edit',$user->id) }}" class="ui circular basic icon button tiny"><i class="fa fa-edit"></i></a>
                                        @endif
                                    @endpermission
                                    @permission('delete-user')
                                    @if($user->hasRole('admin'))
                                        @else
                                        <form action="{{route('user.destroy',$user->id)}}" class="inline-form" method="POST">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button class="ui circular basic icon button tiny" type="submit"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    @endif
                                    @endpermission
                                </td>
                            </tr>
                            @empty
                            <tr class="odd"><td valign="top" colspan="7" class="dataTables_empty">No data available in table</td></tr></tbody>
                            @endforelse
                        </tbody>
                    </table></div></div>
                    {{-- <div class="row">
                    <div class="seven wide column">
                        <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing 1 to {{count($users)}} of {{$users->total()}} entries</div>
                    </div>
                    <div class="right aligned nine wide column">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                            @if ($users->lastPage() > 1)
                            <div class="ui stackable pagination menu">
                                <div class="paginate_button item previous {{ ($users->currentPage() == 1) ? ' disabled' : '' }}" id="dataTables-example_previous" href="{{ $users->url(1) }}" aria-controls="dataTables-example" data-dt-idx="0" tabindex="0">Previous</div>
                                @for ($i = 1; $i <= $users->lastPage(); $i++)
                                <a class="paginate_button item {{ ($users->currentPage() == $i) ? ' active' : '' }}" href="{{ $users->url($i) }}" aria-controls="dataTables-example" data-dt-idx="1" tabindex="0">{{ $i }}</a>
                                @endfor
                                <div class="paginate_button item next {{ ($users->currentPage() == $users->lastPage()) ? ' disabled' : '' }}" id="dataTables-example_next" href="{{ $users->url($users->currentPage()+1) }}" aria-controls="dataTables-example" data-dt-idx="2" tabindex="0">Next</div>
                            </div>
                            @endif
                        </div>
                    </div> --}}
                </div>
                </div></div>
                </div>
            </div>
        </div>
    </div>

                </div>

                <div class="ui dimmer modals page transition hidden">
                    <div class="ui modal medium add scrolling transition hidden">
    <div class="header">{{ __('messages.add_new_user') }}</div>
    <div class="content">
            <form id="add_user_form" action="{{route('user.store')}}" class="ui form add-user" method="post" role="form" accept-charset="utf-8" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="field">
                <label>{{ __('messages.employee') }}</label>
                <div class="ui search dropdown getemail uppercase selection notempty"><select name="name">
                    <option value="">{{ __('messages.select_user') }}</option>
                    @foreach($employees as $user)
                        <option value="{{$user->id}}" data-e="{{$user->email}}" data-ref="1">{{$user->first_name}} {{$user->last_name}}</option>
                    @endforeach
                    </select><i class="dropdown icon"></i><input class="search" autocomplete="off" tabindex="0">
                    <div class="default text">{{ __('messages.select_user') }}</div>
                    <div class="menu transition hidden" tabindex="-1">
                        @foreach($employees as $user)
                            <div class="item " data-value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</div>
                        @endforeach
                    </div></div>
            </div>
            <div class="field">
                <label>{{ __('messages.email') }}</label>
                <input type="text" name="email" class="readonly lowercase" value="" readonly="">
            </div>
            <div class="grouped fields opt-radio">
                <label>{{ __('messages.choose_account_type') }} </label>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" name="acc_type" value="Employee" tabindex="0" class="hidden notempty">
                        <label>{{ __('messages.employee') }}</label>
                    </div>
                </div>
                <div class="field" style="padding:0px!important">
                    <div class="ui radio checkbox">
                        <input type="radio" name="acc_type" value="Admin" tabindex="0" class="hidden notempty">
                        <label>{{ __('messages.admin') }}</label>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="sixteen wide field">
                    <label for="">{{ __('messages.role') }}</label>
                    <div class="ui dropdown uppercase selection" tabindex="0">
                        <select name="roles">
                            <option value="">{{ __('messages.select_role') }}</option>
                                                @foreach($allRoles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                        </select>
                    <i class="dropdown icon"></i>
                    <div class="default text">{{ __('messages.select_role') }}</div><div class="menu" tabindex="-1">
                        @foreach($allRoles as $role)
                            <div class="item" data-value="{{$role->id}}">{{$role->name}}</div>
                        @endforeach
                    </div></div>
                </div>
            </div>
            <div class="fields">
                <div class="sixteen wide field">
                    <label>{{ __('messages.status') }}</label>
                    <div class="ui dropdown uppercase selection" tabindex="0"><select name="status">
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
            </div>
            {{-- <div class="two fields"> --}}
                <div class="field">
                    <label for="">{{ __('messages.password') }}</label>
                    <input type="password" name="password" class="">
                </div>
                {{-- <div class="field">
                    <label for="">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="">
                </div> --}}
            {{-- </div> --}}
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
        <input type="hidden" value="1" name="ref">
        <button class="ui positive approve small button" type="submit" name="submit"><i class="fa fa-check"></i> {{ __('messages.register') }}</button>
        <button class="ui grey black small button" type="button"><i class="fa fa-close"></i> {{ __('messages.cancel') }}</button>
    </div>
        </form>
</div></div>


@endsection

@section('script')
<script type="text/javascript">
    $('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,ordering: true});
    $('.ui.dropdown.getemail').dropdown({ onChange: function(value, text, $selectedItem) {
        $('select[name="name"] option').each(function() {
            if($(this).val()==value) {var e = $(this).attr('data-e');var r = $(this).attr('data-ref');$('input[name="email"]').val(e);$('input[name="ref"]').val(r);};
        });
    }});
    </script>
@endsection