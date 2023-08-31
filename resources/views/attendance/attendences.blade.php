@extends('site.layout.index')
@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <h2 class="page-title"><label>{{ __('messages.attendances') }}</label>
                {{-- <a href="http://demo-workday.herokuapp.com/clock" target="_blank" class="ui positive button mini offsettop5 float-right"><i class="fa fa-clock-o"></i> &nbsp;View web clock</a> --}}
                {{-- <button class="ui primary button mini offsettop5 btn-add float-right"><i class="fa fa-plus-circle"></i>&nbsp;Manual entry</button> --}}
            </h2>
        </div>

        <div class="row">
            <div class="box box-success">
                <div class="box-body reportstable">
                    <form action="{{route('attendence.search')}}" method="post" accept-charset="utf-8" class="ui small form form-filter" id="filterform">
                        {{csrf_field()}}
                        <div class="inline three fields">
                            <div class="two wide field">
                                <input id="datefrom" type="date" name="datefrom" value="@if(isset($from)){{$from}}@endif" placeholder="Start Date" class="airdatepicker">
                                {{-- <i class="ui icon calendar alternate outline calendar-icon"></i> --}}
                            </div>

                            <div class="two wide field">
                                <input id="dateto" type="date" name="dateto" value="@if(isset($to)){{$to}}@endif" placeholder="End Date" class="airdatepicker">
                                {{-- <i class="ui icon calendar alternate outline calendar-icon"></i> --}}
                            </div>

                            {{-- <input type="hidden" name="emp_id" value=""> --}}
                            <button id="btnfilter" class="ui icon button positive small inline-button"><i class="fa fa-filter"></i> {{ __('messages.filter') }}</button>
                        </div>
                    </form>
                    <div id="tablecontainer">
                        
                    
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper dt-semanticUI no-footer"><div class="ui stackable grid"><div class="row"><div class="eight wide column"></div><div class="right aligned eight wide column"></div></div><div class="row dt-table"><div class="sixteen wide column"><table width="100%" class="table table-striped table-hover dataTable no-footer dtr-inline" id="dataTables-example" data-order="[[ 0, &quot;desc&quot; ]]" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
                        <thead>
                            <tr role="row"><th class="sorting_desc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 121.5px;" aria-sort="descending" aria-label="Date: activate to sort column ascending">{{ __('messages.date') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 212.5px;" aria-label="Employee: activate to sort column ascending">{{ __('messages.employee') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 131.5px;" aria-label="Time In: activate to sort column ascending">{{ __('messages.time_in') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 131.5px;" aria-label="Time Out: activate to sort column ascending">{{ __('messages.time_out') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 148.5px;" aria-label="Total Hours: activate to sort column ascending">{{ __('messages.total_hours') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 179.5px;" aria-label="Status (In/Out): activate to sort column ascending">{{ __('messages.status_in_out') }}</th><th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" style="width: 116.5px;" aria-label=": activate to sort column ascending">{{ __('messages.action') }}</th></tr>
                        </thead>
                        <tbody>
                            {{-- <div class="internship-card"> --}}
                                @foreach($attendances as $attendance)
                         <tr role="row" class="odd">
                                <td tabindex="0" class="sorting_1">{{$attendance->date}}</td>
                                @php
                                    $user=DB::table("users")->where('id',$attendance->user_id)->first();
                                @endphp
                                <td>{{$user->first_name}} {{$user->last_name}} </td>
                                <td>
                                    {{date('h:i:s A', strtotime($attendance->time_in))}}
                                </td>
                                <td>
                                    @if($attendance->time_out)
                                        {{date('h:i:s A', strtotime($attendance->time_out))}}
                                    @else
                                    @endif
                                </td>
                                <td>
                                    {{$attendance->total_hrs}}
                                </td>
                                <td>
                                    @php
                                    $mintime =  DB::table('attendences')->where('user_id',$attendance->user_id)->where('date',$attendance->date)->min('time_in');
                                    @endphp
                                    @if($attendance->time_in>$mintime)
                                     <span class=" blue ">Ok</span> /
                                    @elseif($attendance->time_in <= date("H:i:s", strtotime('+30 minutes',strtotime($setting->time_in))))
                                        <span class=" blue ">In Time</span> /
                                    @else
                                    <span class=" red ">Late In</span> /
                                    @endif
                                    @if(is_null($attendance->time_out))
                                    @elseif($attendance->time_out >= date("H:i:s", strtotime($setting->time_out)))
                                        <span class=" green ">On Time</span>
                                    @else
                                    <span class=" red ">Early Leave</span>
                                    @endif
                                </td>
                                <td class="align-right">
                                    @permission('edit-attendance')
                                    <a href="{{route('attendance.edit',$attendance->id)}}" class="ui circular basic icon button tiny"><i class="fa fa-edit"></i></a>
                                    @endpermission
                                    @permission('delete-attendance')
                                    <form action="{{route('attendance.destroy',$attendance->id)}}" class="inline-form" method="POST">
                                            {{csrf_field()}}
                                            {{method_field('DELETE')}}
                                            <button class="ui circular basic icon button tiny" type="submit"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    @endpermission
                                </td>
                            </tr>
                            @endforeach
                            {{-- </div> --}}

                        </tbody>
                    </table></div></div>
                    </div>
                    {{-- <div class="row">
                    <div class="seven wide column">
                        <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing 1 to {{count($attendances)}} of {{$attendances->total()}} entries</div>
                    </div>
                    <div class="right aligned nine wide column">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                            @if ($attendances->lastPage() > 1)
                            <div class="ui stackable pagination menu">
                                <div class="paginate_button item previous {{ ($attendances->currentPage() == 1) ? ' disabled' : '' }}" id="dataTables-example_previous" href="{{ $attendances->url(1) }}" aria-controls="dataTables-example" data-dt-idx="0" tabindex="0">Previous</div>
                                @for ($i = 1; $i <= $attendances->lastPage(); $i++)
                                <a class="paginate_button item {{ ($attendances->currentPage() == $i) ? ' active' : '' }}" href="{{ $attendances->url($i) }}" aria-controls="dataTables-example" data-dt-idx="1" tabindex="0">{{ $i }}</a>
                                @endfor
                                <div class="paginate_button item next {{ ($attendances->currentPage() == $attendances->lastPage()) ? ' disabled' : '' }}" id="dataTables-example_next" href="{{ $attendances->url($attendances->currentPage()+1) }}" aria-controls="dataTables-example" data-dt-idx="2" tabindex="0">Next</div>
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
$('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: false,ordering: true});
// $('#btnfilter').click(function(event) {
//         event.preventDefault();
//         var date_from = $('#datefrom').val();
//         var date_to = $('#dateto').val();
//         if($('#datefrom').val() && $('#dateto').val()){
//             if(date_from>date_to){
//                 alert("Date from should not be bigger than date to");
//             }
//             else{
//                 $.ajax({
//                  url:'{{route('attendence.search')}}',
//                 type: 'POST',
//                 dataType:'json',
//                 data: {"_token": "{{ csrf_token() }}",
//                     date_from:date_from,
//                     date_to:date_to},
//                     success:function(response){
//                         if(response.success == true) {

//                     location.reload();
//                 }
//                 else{
//                     // $('.skill-card').html('');
//                     location.reload();
//                 }
//                     }
//                 });}

//         }
//         else{
//             alert("Please fill out the required fields.");
//         }
//     });

    //     $.ajax({
    //         url: url + '/attendance/filter/', type: 'get', dataType: 'json', data: {datefrom: date_from, dateto: date_to}, headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
    //         success: function(response) {
    //             showdata(response);

    //             function showdata(jsonresponse) {
    //                 var employee = jsonresponse;
    //                 var tbody = $('#dataTables-example tbody');

    //                 // clear data and destroy datatable
    //                 $('#dataTables-example').DataTable().destroy();
    //                 tbody.children('tr').remove();

    //                 // append table row data
    //                 for (var i = 0; i < employee.length; i++) {
    //                     var time_in = employee[i].timein;
    //                     var time_out = employee[i].timeout;
    //                     var in_status = employee[i].status_timein;
    //                     var out_status = employee[i].status_timeout;
    //                     var t_in = moment(time_in, "YYYY-MM-DD hh:mm:ss A");
    //                     var t_out = moment(time_out, "YYYY-MM-DD hh:mm:ss A");
    //                     var format = 2;
    //                     var cc = "";

    //                     function tf(f) {
    //                         if(f == 1) {
    //                             return "hh:mm:ss A";
    //                         } else {
    //                             return "kk:mm:ss";
    //                         }
    //                     }

    //                     function time(p) {
    //                         if(p == 1) {
    //                             if(isNaN(t_in) !== true) {
    //                                 return t_in.format(tf(format));
    //                             }
    //                         } else {
    //                             if(isNaN(t_out) !== true) {
    //                                 return t_out.format(tf(format));
    //                             }
    //                         }

    //                         return "";
    //                     }

    //                     function th(tt) {
    //                         if(tt !== null && tt.indexOf('.') !== -1) {
    //                             var t = tt.split(".");
    //                             return t[0]+" hr "+t[1]+" mins";
    //                         }

    //                         if(tt !== null && tt.indexOf('.') == 0) {
    //                             return tt+" hr";
    //                         }

    //                         return "";
    //                     }

    //                     function t_in_status(in_status) {
    //                         if(in_status == 'Late In') {
    //                             return 'orange';
    //                         } else {
    //                             return 'blue';
    //                         }
    //                     }

    //                     function t_out_status(out_status) {
    //                         if(out_status == 'Early Out') {
    //                             return 'red';
    //                         } else {
    //                             return 'green';
    //                         }
    //                     }

    //                     function d_status(in_status, out_status) {
    //                         if(in_status != '' && out_status != '') {
    //                             return "<span class=' " + t_in_status(in_status) + "'>" +employee[i].status_timein+ "</span>" + ' / ' + "<span class='" + t_out_status(out_status) + "'>" +employee[i].status_timeout+ "</span>";
    //                         } else if (in_status != '' && out_status == '') {
    //                             return "<span class=' " + t_in_status(in_status) + "'>" +employee[i].status_timein+ "</span>";
    //                         } else {
    //                             return "";
    //                         }
    //                     }

    //                     if (cc === "on") {
    //                         tbody.append("<tr>"+
    //                                 "<td>"+employee[i].date+"</td>" +
    //                                 "<td>"+employee[i].employee+"</td>" +
    //                                 "<td>"+time(1)+"</td>" +
    //                                 "<td>"+time(2)+"</td>" +
    //                                 "<td>"+th(employee[i].totalhours)+"</td>" +
    //                                 "<td>"+d_status(in_status, out_status)+"</td>" +
    //                                 "<td>"+employee[i].comment+"</td>" +
    //                                 "<td class='align-right'><a href='"+ url + "/attendance/edit/" + employee[i].id +"' class='ui circular basic icon button tiny'><i class='edit outline icon'></i></a> <a href='"+ url + "/attendance/delete/" + employee[i].id +"' class='ui circular basic icon button tiny'><i class='trash alternate outline icon'></i></a>" +
    //                                 "</td>"+
    //                             "</tr>");
    //                     } else {
    //                         tbody.append("<tr>"+
    //                                     "<td>"+employee[i].date+"</td>" +
    //                                     "<td>"+employee[i].employee+"</td>" +
    //                                     "<td>"+time(1)+"</td>" +
    //                                     "<td>"+time(2)+"</td>" +
    //                                     "<td>"+th(employee[i].totalhours)+"</td>" +
    //                                     "<td>"+d_status(in_status, out_status)+"</td>" +
    //                                     "<td class='align-right'><a href='"+ url + "/attendance/edit/" + employee[i].id +"' class='ui circular basic icon button tiny'><i class='edit outline icon'></i></a> <a href='"+ url + "/attendance/delete/" + employee[i].id +"' class='ui circular basic icon button tiny'><i class='trash alternate outline icon'></i></a>" +
    //                                     "</td>"+
    //                                 "</tr>");
    //                     }
    //                 }

    //                 // initialize datatable
    //                 $('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: false,ordering: true});
    //             }
    //         }
    //     })
    // });
</script>
@endsection
{{-- <script type="text/javascript">
    $('#dataTables-example').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: false,ordering: true});
    $('.jtimepicker').mdtimepicker({format:'h:mm tt', theme: 'blue', hourPadding: true});
    $('.airdatepicker').datepicker({ language: 'en', dateFormat: 'yyyy-mm-dd' });

    $('.ui.dropdown.getref').dropdown({ onChange: function(value, text, $selectedItem) {
        $('select[name="name"] option').each(function() {
            if($(this).val()==value) {
                var r = $(this).attr('data-ref');
                $('input[name="ref"]').val(r);
            };
        });
    }});


    </script> --}}