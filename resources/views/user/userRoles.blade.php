@extends('site.layout.index')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">{{ __('messages.user_role') }}
                {{-- <button class="ui positive button mini offsettop5 btn-add float-right"><i class="fa fa-plus"></i>&nbsp;Add</button> --}}
                @permission('add-role')
                <a href="{{route('role.create')}}" class="ui positive button mini offsettop5 float-right"><i class="fa fa-plus"></i>&nbsp;{{ __('messages.add') }}</a>
                @endpermission
                <a href="{{route('user.index')}}" class="ui basic blue button mini offsettop5 float-right"><i class="fa fa-angle-left"></i>&nbsp;{{ __('messages.return') }}</a>
            </h2>
        </div>

        <div class="row">
                    </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                    {{-- <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid"><div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"><div id="dataTables-example_filter" class="dataTables_filter ui form"><label>Search:<span class="ui input"><input type="search" class="" placeholder="" aria-controls="dataTables-example"></span></label></div></div></div> --}}
                    <div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-striped table-hover dataTable no-footer dtr-inline" id="dataTables-example" data-order="[[ 0, &quot;asc&quot; ]]" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 380.5px;" aria-sort="ascending" aria-label="Role Name: activate to sort column descending">{{ __('messages.role_name') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 280.5px;" aria-label="Status: activate to sort column ascending">{{ __('messages.status') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 502.5px;" aria-label=": activate to sort column ascending"></th></tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                            <tr role="row" class="odd">
                                    <td tabindex="0" class="sorting_1 uppercase">{{$role->name}}</td>
                                    <td class="uppercase">{{$role->status}}</td>
                                    <td class="align-right">
                                        {{-- @if($role->name=='admin') --}}
                                            @role('admin')
                                            <a href="{{ route('role.edit',$role->id) }}" class="ui circular basic icon button tiny"><i class="fa fa-edit"></i></a>
                                            @if($role->name=='admin')
                                            @else
                                            <form action="{{route('role.destroy',$role->id)}}"  method="POST">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button class="ui circular basic icon button tinybtn-danger" type="submit"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                            @endif
                                            @endrole
                                        {{-- @else --}}
                                        @role('manager')
                                        @if($role->name=='admin' || $role->name=='manager')
                                        @else
                                            @permission('edit-role')
                                                <a href="{{ route('role.edit',$role->id) }}" class="ui circular basic icon button tiny"><i class="fa fa-edit"></i></a>
                                            @endpermission
                                            @permission('delete-role')
                                                <form action="{{route('role.destroy',$role->id)}}" class="inline-form" method="POST">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button class="ui circular basic icon button tinybtn-danger" type="submit"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            @endpermission
                                        @endif
                                        @endrole

                                        {{-- @endif --}}
                                    </td>
                                </tr>
                                @empty
 <tr>
    <td>No roles</td>
</tr>
                                @endforelse
                            </tbody>
                    </table></div></div>
                    {{-- <div class="row">
                    <div class="seven wide column">
                        <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing 1 to {{count($roles)}} of {{$roles->total()}} entries</div>
                    </div>
                    <div class="right aligned nine wide column">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                            @if ($roles->lastPage() > 1)
                            <div class="ui stackable pagination menu">
                                <div class="paginate_button item previous {{ ($roles->currentPage() == 1) ? ' disabled' : '' }}" id="dataTables-example_previous" href="{{ $roles->url(1) }}" aria-controls="dataTables-example" data-dt-idx="0" tabindex="0">Previous</div>
                                @for ($i = 1; $i <= $roles->lastPage(); $i++)
                                <a class="paginate_button item {{ ($roles->currentPage() == $i) ? ' active' : '' }}" href="{{ $roles->url($i) }}" aria-controls="dataTables-example" data-dt-idx="1" tabindex="0">{{ $i }}</a>
                                @endfor
                                <div class="paginate_button item next {{ ($roles->currentPage() == $roles->lastPage()) ? ' disabled' : '' }}" id="dataTables-example_next" href="{{ $roles->url($roles->currentPage()+1) }}" aria-controls="dataTables-example" data-dt-idx="2" tabindex="0">Next</div>
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

{{-- </form> --}}

@endsection
@section('script')
<script type="text/javascript">
$('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,ordering: true});
</script>
@endsection