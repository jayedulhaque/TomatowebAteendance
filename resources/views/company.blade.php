@extends('site.layout.index')

@section('content')
<div class="content">


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title uppercase">{{ __('messages.add_company') }}
                    {{-- <button class="ui basic button mini offsettop5 btn-import float-right"><i class="fa fa-upload"></i> Import</button>
                    <a href="http://demo-workday.herokuapp.com/export/fields/company" class="ui basic button mini offsettop5 btn-export float-right"><i class="fa fa-download"></i> Export</a> --}}
                </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-body">
                            <form id="add_company_form" action="{{route('company.store')}}" class="ui form" method="post" role="form" accept-charset="utf-8">
                            {{csrf_field()}}
                            <div class="field">
                                <label>{{ __('messages.company_name') }} <span class="help">e.g. "Apple Corporation"</span></label>
                                <input class="uppercase" name="company" value="" type="text">
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
                            <div class="actions">
                                <button type="submit" class="ui positive button small"><i class="fa fa-check"></i> {{ __('messages.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
            <div class="box box-success">
                <div class="box-body">
                    {{-- <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid"><div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"><div id="dataTables-example_filter" class="dataTables_filter ui form"><label>Search:<span class="ui input"><input type="search" class="" placeholder="" aria-controls="dataTables-example"></span></label></div></div></div> --}}
                    <div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-striped table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 565.5px;" aria-sort="ascending" aria-label="Company: activate to sort column descending">{{ __('messages.company') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 163.5px;" aria-label=": activate to sort column ascending"></th></tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)

                                <tr role="row" class="odd">
                                    <td tabindex="0" class="sorting_1 uppercase">{{$company->name}}</td>
                                    <td class="align-right">
                                        @permission('delete-company')
                                        <form action="{{route('company.destroy',$company->id)}}"  method="POST">
                                         {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-sm" type="submit"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                        @endpermission
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table></div></div>
                    {{-- <div class="row">
                    <div class="seven wide column">
                        <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing 1 to {{count($companies)}} of {{$companies->total()}} entries</div>
                    </div>
                    <div class="right aligned nine wide column">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                            @if ($companies->lastPage() > 1)
                            <div class="ui stackable pagination menu">
                                <div class="paginate_button item previous {{ ($companies->currentPage() == 1) ? ' disabled' : '' }}" id="dataTables-example_previous" href="{{ $companies->url(1) }}" aria-controls="dataTables-example" data-dt-idx="0" tabindex="0">Previous</div>
                                @for ($i = 1; $i <= $companies->lastPage(); $i++)
                                <a class="paginate_button item {{ ($companies->currentPage() == $i) ? ' active' : '' }}" href="{{ $companies->url($i) }}" aria-controls="dataTables-example" data-dt-idx="1" tabindex="0">{{ $i }}</a>
                                @endfor
                                <div class="paginate_button item next {{ ($companies->currentPage() == $companies->lastPage()) ? ' disabled' : '' }}" id="dataTables-example_next" href="{{ $companies->url($companies->currentPage()+1) }}" aria-controls="dataTables-example" data-dt-idx="2" tabindex="0">Next</div>
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

                </div>
@endsection
@section('script')
<script type="text/javascript">
$('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,ordering: true});
</script>
@endsection