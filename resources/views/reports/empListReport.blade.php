@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title">{{ __('messages.employees') }}
                {{-- <a href="http://demo-workday.herokuapp.com/export/report/employees" class="ui basic button mini offsettop5 btn-export float-right"><i class="ui icon download"></i>Export to CSV</a> --}}
                <a href="{{route('reports')}}" class="ui basic blue button mini offsettop5 float-right"><i class="fa fa-angle-left"></i>&nbsp;{{ __('messages.return') }}</a>
            </h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid">{{-- <div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"><div id="dataTables-example_filter" class="dataTables_filter ui form"><label>Search:<span class="ui input"><input type="search" class="" placeholder="" aria-controls="dataTables-example"></span></label></div></div></div> --}}<div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-striped table-hover dataTable no-footer dtr-inline" id="dataTables-example" data-order="[[ 0, &quot;asc&quot; ]]" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 220.5px;" aria-sort="ascending" aria-label="Employee Name: activate to sort column descending">{{ __('messages.employee_name') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 34.5px;" aria-label="Age: activate to sort column ascending">{{ __('messages.age') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 59.5px;" aria-label="Gender: activate to sort column ascending">{{ __('messages.gender') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 152.5px;" aria-label="Civil Status: activate to sort column ascending">{{ __('messages.civil_status') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 119.5px;" aria-label="Mobile Number: activate to sort column ascending">{{ __('messages.mobile_number') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 140.5px;" aria-label="Email: activate to sort column ascending">Email</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 135.5px;" aria-label="Employment Type: activate to sort column ascending">{{ __('messages.employment_type') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 148.5px;" aria-label="Employment Status: activate to sort column ascending">{{ __('messages.employment_status') }}</th></tr>
                        </thead>
                        <tbody>
                            @forelse($employees as $user)
                        <tr role="row" class="odd">
                                        <td tabindex="0" class="sorting_1">{{$user->first_name}} {{$user->last_name}}</td>
                                        <td>{{$user->age}}</td>
                                        <td>{{$user->gender}}</td>
                                        <td>{{$user->civil_status}}</td>
                                        <td>{{$user->mobile_number}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->employment_type}}</td>
                                        <td>{{$user->status}}</td>
                            </tr>
                            @empty
                            <tr class="odd"><td valign="top" colspan="7" class="dataTables_empty">No data available in table</td></tr></tbody>
                            @endforelse
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