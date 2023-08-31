<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('reports', 'HomeController@report')->name('reports');
	Route::get('online-users', 'HomeController@onlineUsers')->name('online.users');
	Route::get('logging-out/{id}', 'HomeController@makeLogout')->name('logout.user');
	Route::resource('company', 'CompanyController');
	Route::resource('department', 'DepartmentController');
	Route::resource('job', 'JobController');
	Route::resource('leavetype', 'LeaveTypeController');
	Route::resource('leavegroup', 'LeaveGroupController');
	Route::resource('employee', 'EmployeeController');
	Route::resource('user', 'UserController');
	Route::resource('role', 'RoleController');
	Route::resource('attendance', 'AttendenceController');
	Route::resource('schedule', 'ScheduleController');
	Route::resource('leave', 'LeaveController');
	Route::resource('settings', 'SystemSettingController');
	Route::post('account/updatedata', 'UserController@accountupdatedata')->name('account.updatedata');
	Route::post('update/password', 'UserController@updatePassword')->name('update.password');
	Route::get('change/password', 'UserController@changePassword')->name('change.password');
	Route::get('leave/approve/{id}','LeaveController@approveLeave');
	Route::get('leave/decline/{id}','LeaveController@declineLeave');
	Route::get('employee-attendance', 'AttendenceController@attendanceReport')->name('employee.attendance');
	Route::get('employee-birthday', 'EmployeeController@employeeBirthday')->name('employee.birthday');
	Route::get('employee-leave', 'LeaveController@employeeLeave')->name('employee.leave');
	Route::get('employee-list', 'EmployeeController@employeeList')->name('employee.list');
	Route::get('employee-schedule', 'ScheduleController@employeeSchedule')->name('employee.schedule');
	Route::get('user-account', 'UserController@userAccount')->name('user.account');
	Route::any('attendance-search','AttendenceController@search')->name('attendence.search');
	Route::post('emp-attendance-search','AttendenceController@empsearch')->name('empattendence.search');
	Route::post('emp-leave-search','LeaveController@empLeaveSearch')->name('empleave.search');
	Route::post('emp-schedule-search','ScheduleController@empScheduleSearch')->name('empschedule.search');
	Route::post('my-attendance-search','AttendenceController@myempsearch')->name('myattendence.search');
	Route::post('my-schedule-search','ScheduleController@myempsearch')->name('myschedule.search');
	Route::post('my-leave-search','LeaveController@myempsearch')->name('myleave.search');
});


Auth::routes();
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});