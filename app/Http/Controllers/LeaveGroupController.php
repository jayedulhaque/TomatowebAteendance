<?php

namespace App\Http\Controllers;

use App\LeaveGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LeaveGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole(['admin','manager','superviser']))
        {
            $page = 'leave';
        }
        else
        {
            $page = 'dashboard';
        }
        $leavegroups = DB::table('leave_groups')->get();
        $leavetypes = DB::table('leave_types')->get();
        return view('leave-group.addLeaveGroup',compact(['leavegroups','leavetypes','page']));
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
        $leavegroup= new LeaveGroup;
        $leavegroup->description=$request->get('description');
        $leavegroup->name=$request->get('leavegroup');
        $leavegroup->leave_privileges=implode(",",$request->get('leaveprivileges'));
        $leavegroup->save();
        return redirect()->route('leavegroup.index')->with('message', 'Information has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeaveGroup  $leaveGroup
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveGroup $leaveGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeaveGroup  $leaveGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasRole(['admin','manager','superviser']))
        {
            $page = 'leave';
        }
        else
        {
            $page = 'dashboard';
        }
        $leavegroup=LeaveGroup::find($id);
        $leavePrivileges=explode(",",$leavegroup->leave_privileges);
        $leavetypes = DB::table('leave_types')->get();
        $statuses = DB::table('status')->get();
        return view('leave-group.editLeaveGroup',compact(['leavegroup','leavetypes','leavePrivileges','statuses','page']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeaveGroup  $leaveGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $leavegroup=LeaveGroup::find($id);
        $leavegroup->description=$request->get('description');
        $leavegroup->name=$request->get('leavegroup');
        $leavegroup->status=$request->get('status');
        $leavegroup->leave_privileges=implode(",",$request->get('leaveprivileges'));
        $leavegroup->save();
        return redirect()->back()->with('message', 'Information has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeaveGroup  $leaveGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("leave_groups")->where('id',$id)->delete();
        return redirect()->route('leavegroup.index')->with('message', 'Information has been Deleted');
    }
}
