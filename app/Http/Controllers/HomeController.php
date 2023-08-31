<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use App\Schedule;
use App\Leave;
use App\SystemSetting;
use App\Attendence;
use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher;
use Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page='dashboard';
        $setting=SystemSetting::first();
        $selectedTimezone=DB::table("time_zones")->where('description',$setting->time_zone)->first();
        if(Auth::user()->hasrole(['admin','manager','superviser']))
        {
            $employees=User::where('account_type', '!=' , 'Admin')->orWhereNull('account_type')->get();
            $users=User::where('account_type', '!=' , 'Admin')->orWhereNull('account_type')->orderBy('created_at','desc')->limit(5)->get();
            $attendances=Attendence::orderBy('created_at','desc')->limit(4)->get();
            $regularEmployee=User::where('employment_type','!=','Trainee')->where('account_type', '!=' , 'Admin')->get();
            $traineeEmployee=User::where('employment_type','!=','Regular')->where('account_type', '!=' , 'Admin')->get();
            $dt = Carbon::now($selectedTimezone->name);
            $online =  Attendence::where('date',$dt->toDateString())
            ->whereNotNull('time_in')
            ->whereNull('time_out')
            ->orderBy('user_id','desc')
            ->get()->groupBy('user_id')->count();
            $offline=count($employees)-$online;
            $leaveApproved = count(Leave::where('status','approved')->get());
            $leavePending = count(Leave::where('status','pending')->get());
            $leaves = Leave::where('status','pending')->orderBy('created_at','desc')->limit(5)->get();
            return view('dashboard',compact(['leaves','leaveApproved','leavePending','users','regularEmployee','traineeEmployee','attendances','online','offline','page']));
        }
        else
        {
            $dt = Carbon::now();
            $recentAttendances=Attendence::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->limit(4)->get();
            $lateIn =  Attendence::where('user_id',Auth::user()->id)->whereMonth('created_at', '=', date('m'))
            ->orderBy('date','desc')
            ->having('time_in','>',date("H:i:s", strtotime('+30 minutes',strtotime($setting->time_in))))
            ->get()->groupBy('date')->count();
            $earlyOut =  Attendence::where('user_id',Auth::user()->id)->whereMonth('created_at', '=', date('m'))
                        ->orderBy('date','desc')
                        ->having('time_out','<',date("H:i:s", strtotime($setting->time_out)))
                        ->get()->groupBy('date')->count();
            $presentSchedule=Schedule::where('to','>=',$dt->toDateString())->first();
            $schedules=Schedule::where('user_id',Auth::user()->id)->get();
            $leaveApproved = count(Leave::where('status','approved')->where('user_id',Auth::user()->id)->get());
            $leavePending = count(Leave::where('status','pending')->where('user_id',Auth::user()->id)->get());
            $leaves = Leave::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->limit(5)->get();
            return view('dashboard',compact(['leaves','leaveApproved','leavePending','recentAttendances','lateIn','earlyOut','schedules','dt','presentSchedule','page']));
        }

    }
    public function report()
    {
        $page='reports';
        $reportsView = DB::table('reports_record')->get();
        return view('reports',compact(['reportsView','page']));
    }
    public function onlineUsers()
    {
        $page='user';
        $dt = Carbon::now();
        $onlineUsers =  Attendence::where('date',$dt->toDateString())
            ->whereNotNull('time_in')
            ->whereNull('time_out')
            ->orderBy('user_id','desc')
            ->get()->groupBy('user_id');
        return view('user.onlineUser',compact(['onlineUsers','page']));
    }
    public function makeLogout($id)
    {
        // $user = Auth::user();
        $userToLogout = User::find($id);
        event('auth.logout', [$userToLogout]);
        // Auth::setUser($userToLogout);
        // Auth::logout();
        // Auth::setUser($user);
        return back()->with('message','You have logout the user');
    }
}
