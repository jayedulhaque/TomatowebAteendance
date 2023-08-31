<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page='user';
        $roles=Role::paginate(15);
        $employmentstatuses = DB::table('employment_status')->get();
        return view('user.userRoles',compact(['roles','employmentstatuses','page']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page='user';
        $permissions=Permission::all();
        $statuses = DB::table('status')->get();
       return view('user.createRole',compact(['permissions','statuses','page']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rolecheck = DB::table('roles')->where('name',strtolower($request['role_name']))->first();
        if($rolecheck){
            return redirect()->route('role.index')->withMessage('role already exists');
        }
        $role=Role::create([
            'name' => strtolower($request['role_name']),
            'status' => $request['state'],
        ]);
        if($request->perms){
            foreach ($request->perms as $key=>$value){
                $role->attachPermission($value);
            }
        }
        return redirect()->route('role.index')->withMessage('role created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page='user';
        $role=Role::find($id);
        $permissions=Permission::all();
        $role_permissions = $role->perms()->pluck('id','id')->toArray();
        $statuses = DB::table('status')->get();
         return view('user.editPermission',compact(['role','role_permissions','permissions','statuses','page']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role=Role::find($id);
        $role->name=strtolower($request->role_name);
        $role->status=$request->state;
        $role->save();
        DB::table('permission_role')->where('role_id',$id)->delete();
        foreach ($request->perms as $key=>$value){
            $role->attachPermission($value);
        }
        return redirect()->route('role.index')->withMessage('role Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return back()->withMessage('Role Deleted');
    }
}
