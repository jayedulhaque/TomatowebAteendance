@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title uppercase">{{ __('messages.employees') }}
                @permission('add-employee')
                <a class="ui positive button mini offsettop5 float-right" href="{{ route('employee.create') }}"><i class="fa fa-plus"></i>&nbsp;{{ __('messages.add') }}</a>
                @endpermission
            </h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid">{{-- <div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"><div id="dataTables-example_filter" class="dataTables_filter ui form">
                <label>Search:<span class="ui input">
                    <input type="search" class="" placeholder="" aria-controls="dataTables-example">
                </span></label>
            </div></div></div> --}}
            <div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-striped table-hover dataTable no-footer dtr-inline" id="dataTables-example" data-order="[[ 0, &quot;desc&quot; ]]" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                    <thead>
                        <tr role="row"><th class="sorting_desc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 87.5px;" aria-sort="descending" aria-label="ID: activate to sort column ascending">{{ __('messages.id') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 228.5px;" aria-label="Employee: activate to sort column ascending">{{ __('messages.employee') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 123.5px;" aria-label="Company: activate to sort column ascending">{{ __('messages.company') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 152.5px;" aria-label="Department: activate to sort column ascending">{{ __('messages.department') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 109.5px;" aria-label="Position: activate to sort column ascending">{{ __('messages.position') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 89.5px;" aria-label="Status: activate to sort column ascending">{{ __('messages.status') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 250.5px;" aria-label=": activate to sort column ascending">{{ __('messages.action') }}</th></tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $user)
                        <tr class="odd" role="row">
                            <td tabindex="0" class="sorting_1">{{$user->id_number}}</td>
                            <td class="uppercase">{{$user->first_name}} {{$user->last_name}}</td>
                            <td class="uppercase">@php
                                $company=DB::table("companies")->where('id',$user->company_id)->first();
                            @endphp
                            {{$company->name}}
                            </td>
                            <td class="uppercase">
                                @php
                                $dpt=DB::table("departments")->where('id',$user->department_id)->first();
                                @endphp
                                {{$dpt->name}}
                            </td>
                            <td class="uppercase">
                                @php
                                $job=DB::table("jobs")->where('id',$user->job_id)->first();
                                @endphp
                                {{$job->title}}
                            </td>
                            <td class="uppercase"> {{$user->status}} </td>
                            <td class="align-right">
                                {{-- @php
                                    $user=DB::table("users")->where('id',Auth::user())->first();
                                @endphp --}}
                            @permission('view-employee')
                            @if($user->hasRole('admin') && Auth::user()->hasRole('admin'))
                            <a href="{{ route('employee.show',$user->id) }}" class="ui circular basic icon button tiny"><i class="fa fa-eye"></i></a>
                            @elseif($user->hasRole('admin'))
                            @else
                            <a href="{{ route('employee.show',$user->id) }}" class="ui circular basic icon button tiny"><i class="fa fa-eye"></i></a>
                            @endif
                            @endpermission
                            @permission('edit-employee')
                            @if($user->hasRole('admin') && Auth::user()->hasRole('admin'))
                            <a href="{{ route('employee.edit',$user->id) }}" class="ui circular basic icon button tiny"><i class="fa fa-edit"></i></a>
                            @elseif($user->hasRole('admin'))
                            @else
                            <a href="{{ route('employee.edit',$user->id) }}" class="ui circular basic icon button tiny"><i class="fa fa-edit"></i></a>
                            @endif
                            @endpermission
                            @permission('delete-employee')
                            @if($user->hasRole('admin') || $user->status=="Disabled")
                            @else
                            <form action="{{route('employee.destroy',$user->id)}}" class="inline-form" method="POST">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button class="ui circular basic icon button tiny" type="submit"><i class="fa fa-trash-o"></i></button>
                            </form>
                            @endif
                            @endpermission
                            {{-- <a href="http://demo-workday.herokuapp.com/profile/edit/21" class="ui circular basic icon button tiny"><i class="edit outline icon"></i></a>
                            <a href="http://demo-workday.herokuapp.com/profile/delete/21" class="ui circular basic icon button tiny"><i class="trash alternate outline icon"></i></a>
                            <a href="http://demo-workday.herokuapp.com/profile/archive/21" class="ui circular basic icon button tiny"><i class="archive icon"></i></a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table></div></div>
                {{-- <div class="row">
                    <div class="seven wide column">
                        <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing 1 to {{count($employees)}} of {{$employees->total()}} entries</div>
                    </div>
                    <div class="right aligned nine wide column">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                            @if ($employees->lastPage() > 1)
                            <div class="ui stackable pagination menu">
                                <div class="paginate_button item previous {{ ($employees->currentPage() == 1) ? ' disabled' : '' }}" id="dataTables-example_previous" href="{{ $employees->url(1) }}" aria-controls="dataTables-example" data-dt-idx="0" tabindex="0">Previous</div>
                                @for ($i = 1; $i <= $employees->lastPage(); $i++)
                                <a class="paginate_button item {{ ($employees->currentPage() == $i) ? ' active' : '' }}" href="{{ $employees->url($i) }}" aria-controls="dataTables-example" data-dt-idx="1" tabindex="0">{{ $i }}</a>
                                @endfor
                                <div class="paginate_button item next {{ ($employees->currentPage() == $employees->lastPage()) ? ' disabled' : '' }}" id="dataTables-example_next" href="{{ $employees->url($employees->currentPage()+1) }}" aria-controls="dataTables-example" data-dt-idx="2" tabindex="0">Next</div>
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