<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Leave;
use Auth;
use DB;
use App\User;
use App\LeaveGroup;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\LeaveRequestStatus;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dt = Carbon::now();
        if(Auth::user()->hasRole(['admin','manager','superviser']))
        {
            $page = 'leave';
            $leaves=Leave::all();
            return view('leave.leavesofabsence', compact(['leaves','dt','page']));
        }
        else
        {
            $page = 'myleave';
            $leaves=Leave::where('user_id',Auth::user()->id)->get();
            $leavegroup=LeaveGroup::find(Auth::user()->leave_group_id);
            $leavePrivileges=explode(",",$leavegroup->leave_privileges);
            return view('leave.myLeave', compact(['leavePrivileges','leaves','dt','page']));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $leave=  new Leave;
        $leave->leave_type=$request->type;
        $leave->user_id=Auth::user()->id;
        $leave->from=$request->leavefrom;
        $leave->to=$request->leaveto;
        $leave->return_date=$request->returndate;
        $leave->reason=$request->reason;
        $leave->save();
        return redirect()->route('leave.index')->with('message', 'Information has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = 'myleave';
        $dt = Carbon::now();
        $leaves=Leave::where('user_id',Auth::user()->id)->get();
        $leavegroup=LeaveGroup::find(Auth::user()->leave_group_id);
        $leavePrivileges=explode(",",$leavegroup->leave_privileges);
        return view('leave.myLeave', compact(['leavePrivileges','leaves','dt','page']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($request->all());
        $leave = Leave::find($id);
        $leave->status='cancelled';
        $leave->save();
        return redirect()->route('leave.index')->with('message', 'Information has been cancelled');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        //
    }
    public function approveLeave($id)
    {
        $leave = Leave::find($id);
        $leave->status='approved';
        $leave->save();
        $users = User::find($leave->user_id);
        Notification::send($users, new LeaveRequestStatus($leave));
        return redirect()->route('leave.index')->with('message', 'Information has been approved');
    }
    public function declineLeave($id)
    {
        $leave = Leave::find($id);
        $leave->status='declined';
        $leave->save();
        $users = User::find($leave->user_id);
        Notification::send($users, new LeaveRequestStatus($leave));
        return redirect()->route('leave.index')->with('message', 'Information has been declined');
    }
    public function employeeLeave()
    {
        $page = 'reports';
        $dt = Carbon::now();
        $employees = User::where('status','Active')->whereHas('roles', function ($q) {
            $q->Where('name', 'employee')->
                orWhere('name', 'manager');
            })->get();
        $leaves=Leave::all();
        $leaveView=DB::table('reports_record')->where('name','employee-leave') ->update(['date' => $dt->toDateString()]);
        return view('reports.empLeavesReport', compact(['leaves','dt','employees','page']));
    }
    public function empLeaveSearch(Request $request)
    {
        $page = 'reports';
        $employees = User::where('status','Active')->whereHas('roles', function ($q) {
            $q->Where('name', 'employee')->
                orWhere('name', 'manager');
            })->get();
        $employee_id=$request->employee;
        $emp= User::find($employee_id);
        $from= $request->datefrom;
        $to = $request->dateto;
        $dt = Carbon::now();
        if($from==NULL || $to == NULL || $employee_id == NULL){
            return back()->with('message', 'Fields can not be empty.');
        }
        if($from>$to ){
            return back()->with('message', 'Date from should be less than or equal to date to.');
        }
        else{
            $leaves = Leave::where('user_id',$employee_id)->where('from', $request->datefrom)->where('to', $request->dateto)->get();

            return view('reports.empLeavesReport',compact(['leaves','employees','emp','from','to','dt','page']));
        }
    }
    public function myempsearch(Request $request)
    {
        $page = 'myleave';
        $from= $request->datefrom;
        $to = $request->dateto;
        $dt = Carbon::now();
        $leavegroup=LeaveGroup::find(Auth::user()->leave_group_id);
        $leavePrivileges=explode(",",$leavegroup->leave_privileges);
        if($from==NULL || $to == NULL){
            return back()->with('message', 'Fields can not be empty.');
        }
        if($from>$to){
            return back()->with('message', 'Date from should be less than or equal to date to.');
        }
        else{
            $leaves = Leave::where('user_id',Auth::user()->id)->where('from', $request->datefrom)->where('to', $request->dateto)->get();
            return view('leave.myLeave',compact(['leavePrivileges','leaves','from','to','dt','page']));
        }
    }
}
