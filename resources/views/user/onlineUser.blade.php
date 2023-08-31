@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title uppercase">{{ __('messages.online_user') }}
                {{-- @permission('edit-user') --}}
                <a class="ui basic blue button mini offsettop5 float-right" href="{{url('/')}}"><i class="fa fa-angle-left"></i>&nbsp;{{ __('messages.return') }}</a>
                {{-- @endpermission --}}
            </h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid">{{-- <div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"><div id="dataTables-example_filter" class="dataTables_filter ui form"><label>Search:<span class="ui input"><input type="search" class="" placeholder="" aria-controls="dataTables-example"></span></label></div></div></div> --}}<div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-striped table-hover dataTable no-footer dtr-inline" id="dataTables-example" data-order="[[ 0, &quot;asc&quot; ]]" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 272.5px;" aria-sort="ascending" aria-label="Employee Name: activate to sort column descending">{{ __('messages.employee_name') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 304.5px;" aria-label="Email: activate to sort column ascending">{{ __('messages.email') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 264.5px;" aria-label="Account Type: activate to sort column ascending">{{ __('messages.time_in') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 131.5px;" aria-label="Status: activate to sort column ascending">{{ __('messages.status') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 159.5px;" aria-label="Status: activate to sort column ascending">{{ __('messages.action') }}</th></tr>
                        </thead>
                        <tbody>
                            @forelse($onlineUsers as $online)
                                    <tr role="row" class="odd">
                                    	@php
		                                    $user=\App\User::where('id',$online[0]->user_id)->first();
		                                @endphp
                                        <td tabindex="0" class="sorting_1">{{$user->first_name}} {{$user->last_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td class="uppercase"> {{$online[0]->time_in}} </td>
                                        <td class="uppercase"> {{$user->status}}  </td>
                                        <td>
                                        	<a class="ui circular orange button tiny" href="" style="">{{ __('messages.forceful_time_out') }}</a>
                                            @if($user->isOnline())
                                            <a class="ui circular red button tiny" href="{{route('logout.user',$user->id)}}" style="">{{ __('messages.logout') }}</a>
                                            @endif
                                        </td>
                                    </tr>
                            @empty
                            <tr class="odd"><td valign="top" colspan="7" class="dataTables_empty">No data available in table</td></tr></tbody>
                            @endforelse
                                </tbody>
                    </table></div></div>
                </div></div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
$('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,ordering: true});
</script>
@endsection