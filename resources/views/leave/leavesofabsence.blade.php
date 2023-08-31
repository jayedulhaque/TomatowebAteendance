\@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">{{ __('messages.leaves_of_absence') }}</h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid">{{-- <div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"><div id="dataTables-example_filter" class="dataTables_filter ui form"><label>Search:<span class="ui input"><input type="search" class="" placeholder="" aria-controls="dataTables-example"></span></label></div></div></div> --}}
                    <div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-striped table-hover dataTable no-footer dtr-inline" id="dataTables-example" data-order="[[ 0, &quot;asc&quot; ]]" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 150.5px;" aria-sort="ascending" aria-label="Employee: activate to sort column descending">{{ __('messages.employee') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 160.5px;" aria-label="Leave From: activate to sort column ascending">{{ __('messages.leave_type') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 188.5px;" aria-label="Description: activate to sort column ascending">{{ __('messages.description') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 110.5px;" aria-label="Leave From: activate to sort column ascending">{{ __('messages.leave_from') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 110.5px;" aria-label="Leave To: activate to sort column ascending">{{ __('messages.leave_to') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 110.5px;" aria-label="Return Date: activate to sort column ascending">{{ __('messages.return_date') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 110.5px;" aria-label="Status: activate to sort column ascending">{{ __('messages.status') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 127.5px;" aria-label="Actions: activate to sort column ascending">{{ __('messages.action') }}</th></tr>
                        </thead>
                        <tbody>
                            @forelse($leaves as $leave)
                            <tr>
                            @php
                                    $user=DB::table("users")->where('id',$leave->user_id)->first();
                            @endphp
                            <td tabindex="0" class="sorting_1">
                                {{$user->first_name}} {{$user->last_name}}
                            </td>
                            <td>
                                    {{ucfirst($leave->leave_type)}}
                            </td>
                            <td>
                                    {{ucfirst($leave->reason)}}
                            </td>
                            <td>
                                    {{$leave->from}}
                            </td>
                            <td>
                                    {{$leave->to}}
                            </td>
                            <td>
                                    {{$leave->return_date}}
                            </td>
                            <td>
                                @if($leave->status=='cancelled')
                                {{$leave->status}}
                                @elseif($leave->from>=$dt->toDateString() )
                                    {{ucfirst($leave->status)}}
                                @else
                                Past
                                @endif
                            </td>
                            <td>
                            @permission('edit-leaverequest')
                            @if($leave->status=='pending')
                            @if($leave->from>=$dt->toDateString() )
                                    <a class="ui circular green button tiny" href="{{url('leave/approve',$leave->id)}}" style="">{{ __('messages.approve') }}</a>
                                    <a class="ui circular red button tiny" href="{{url('leave/decline',$leave->id)}}" style="">{{ __('messages.decline') }}</a>
                            {{-- @elseif($leave->from>$leave->to && $leave->from>=$dt->toDateString())
                                    <a class="ui circular green button tiny" href="{{url('leave/approve',$leave->id)}}" style="">Approve</a>
                                    <a class="ui circular red button tiny" href="{{url('leave/decline',$leave->id)}}" style="">Decline</a> --}}
                            @endif
                            @endif
                            @endpermission
                        </td>
                        </tr>
                            @empty
                            <tr class="odd"><td valign="top" colspan="8" class="dataTables_empty">No data available in table</td></tr></tbody>
                            @endforelse

                    </table></div></div>
                    {{-- <div class="row">
                    <div class="seven wide column">
                        <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing 1 to {{count($leaves)}} of {{$leaves->total()}} entries</div>
                    </div>
                    <div class="right aligned nine wide column">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                            @if ($leaves->lastPage() > 1)
                            <div class="ui stackable pagination menu">
                                <div class="paginate_button item previous {{ ($leaves->currentPage() == 1) ? ' disabled' : '' }}" id="dataTables-example_previous" href="{{ $leaves->url(1) }}" aria-controls="dataTables-example" data-dt-idx="0" tabindex="0">Previous</div>
                                @for ($i = 1; $i <= $leaves->lastPage(); $i++)
                                <a class="paginate_button item {{ ($leaves->currentPage() == $i) ? ' active' : '' }}" href="{{ $leaves->url($i) }}" aria-controls="dataTables-example" data-dt-idx="1" tabindex="0">{{ $i }}</a>
                                @endfor
                                <div class="paginate_button item next {{ ($leaves->currentPage() == $leaves->lastPage()) ? ' disabled' : '' }}" id="dataTables-example_next" href="{{ $leaves->url($leaves->currentPage()+1) }}" aria-controls="dataTables-example" data-dt-idx="2" tabindex="0">Next</div>
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
@endsection
@section('script')
<script type="text/javascript">
$('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,ordering: true});
</script>
@endsection