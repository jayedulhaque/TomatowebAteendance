<?php

namespace App\Http\Controllers;

use App\Employee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Auth;
use Storage;
use Carbon\Carbon;

class EmployeeController extends Controller
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
            // $employee = User::withRole(['employee'])->get();
            // $managers = User::withRole(['manager'])->get();
            // $merged = $employee->merge($managers);
            // $employees = $merged->all();
            // $employees = User::whereHas('roles', function ($q) {
            // $q->Where('name', 'employee')->
            //     orWhere('name', 'manager');
            // })->paginate(15);
            $page = 'employee';
            $employees = User::all();
            return view('employeelist',compact(['employees','page']));
        }
        else
        { 
            $page = 'dashboard';
            $employee=Employee::find(Auth::user()->id);
            return view('employee.employeeProfile',compact(['employee','page']));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'employee';
        $companies = DB::table('companies')->get();
        $departments = DB::table('departments')->get();
        $jobs = DB::table('jobs')->get();
        $leavegroups = DB::table('leave_groups')->get();
        $employmenttypes = DB::table('employment_type')->get();
        $employmentstatuses = DB::table('employment_status')->get();
        $genders = DB::table('genders')->get();
        $civilstatuses = DB::table('civil_status')->get();
        return view('employee.addEmployee',compact(['companies','departments','jobs','leavegroups','employmenttypes','employmentstatuses','genders','civilstatuses','page']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee= new Employee;
        $employee->first_name=$request->get('firstname');
        $employee->middle_name=$request->get('middlename');
        $employee->last_name=$request->get('lastname');
        $employee->gender=$request->get('gender');
        $employee->civil_status=$request->get('civilstatus');
        $employee->height=$request->get('height');
        $employee->weight=$request->get('weight');
        $employee->email=$request->get('emailaddress');
        $employee->mobile_number=$request->get('mobileno');
        $employee->age=$request->get('age');
        $employee->dob=$request->get('birthday');
        $employee->national_id_no=$request->get('nationalid');
        $employee->place_of_birth=$request->get('birthplace');
        $employee->home_address=$request->get('homeaddress');
        if($request->hasfile('image'))
         {
            $name=$request->image->getClientOriginalName();
            $request->image->storeAs('public/images', $name);
            $employee->pro_photo=$name;
         }
        $employee->company_id=$request->get('company');
        $employee->department_id=$request->get('department');
        $employee->job_id=$request->get('jobposition');
        $employee->id_number=$request->get('idno');
        $employee->email_company=$request->get('companyemail');
        $employee->leave_group_id=$request->get('leaveprivilege');
        $employee->employment_type=$request->get('employmenttype');
        $employee->status=$request->get('employmentstatus');
        $employee->official_start_date=$request->get('startdate');
        $employee->date_regularized=$request->get('dateregularized');
        $employee->save();
        return redirect()->route('employee.index')->with('message', 'Information has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->hasRole(['admin','manager','superviser']))
        {
        $page = 'employee';
        }
        else{
            $page = 'dashboard';
        }
        $employee=Employee::find($id);
        return view('employee.employeeProfile',compact(['employee','page']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'employee';
        $employee=Employee::find($id);
        $companies = DB::table('companies')->get();
        $departments = DB::table('departments')->get();
        $jobs = DB::table('jobs')->get();
        $leavegroups = DB::table('leave_groups')->get();
        $employmenttypes = DB::table('employment_type')->get();
        $employmentstatuses = DB::table('employment_status')->get();
        $genders = DB::table('genders')->get();
        $civilstatuses = DB::table('civil_status')->get();
        return view('employee.editEmployeeProfile',compact(['page','companies','departments','jobs','leavegroups','employmenttypes','employmentstatuses','genders','civilstatuses','employee']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $employee=Employee::find($id);
        $employee->first_name=$request->get('firstname');
        $employee->middle_name=$request->get('mi');
        $employee->last_name=$request->get('lastname');
        $employee->gender=$request->get('gender');
        $employee->civil_status=$request->get('civilstatus');
        $employee->height=$request->get('height');
        $employee->weight=$request->get('weight');
        $employee->email=$request->get('emailaddress');
        $employee->mobile_number=$request->get('mobileno');
        $employee->age=$request->get('age');
        $employee->dob=$request->get('birthday');
        $employee->national_id_no=$request->get('nationalid');
        $employee->place_of_birth=$request->get('birthplace');
        $employee->home_address=$request->get('homeaddress');
        if($request->hasfile('image'))
         {
            if($employee->pro_photo!=NULL)
            {
                Storage::delete('public/images/'.$employee->pro_photo);
            }
            $name=$request->image->getClientOriginalName();
            $request->image->storeAs('public/images', $name);
            $employee->pro_photo=$name;
         }
        $employee->company_id=$request->get('company');
        $employee->department_id=$request->get('department');
        $employee->job_id=$request->get('jobposition');
        $employee->id_number=$request->get('idno');
        $employee->email_company=$request->get('companyemail');
        $employee->leave_group_id=$request->get('leaveprivilege');
        $employee->employment_type=$request->get('employmenttype');
        $employee->status=$request->get('employmentstatus');
        $employee->official_start_date=$request->get('startdate');
        $employee->date_regularized=$request->get('dateregularized');
        // dd(storage_path('app/public/images/').$employee->pro_photo);
        $employee->save();
        return redirect()->route('employee.index')->with('message', 'Information has been added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("users")->where('id',$id)->update(['status'=>'Disabled']);
        return redirect()->route('employee.index')->with('message', 'Information has been Deleted');
    }
    public function employeeBirthday()
    {
        $page = 'reports';
        $employees = User::withRole(['employee'])->get();
        $dt = Carbon::now();
        $birthdayView=DB::table('reports_record')->where('name','employee-birthday') ->update(['date' => $dt->toDateString()]);
        return view('reports.empBirthday',compact(['employees','page']));
    }
     public function employeeList()
    {
        $page = 'reports';
        $employees = User::all();
        $dt = Carbon::now();
        $listView=DB::table('reports_record')->where('name','employee-list') ->update(['date' => $dt->toDateString()]);
        return view('reports.empListReport',compact(['employees','page']));
    }
}
