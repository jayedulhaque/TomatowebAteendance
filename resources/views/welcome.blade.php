@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">Edit User</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-content">
                                                <form id="edit_user_form" action="http://demo-workday.herokuapp.com/users/update/user" class="ui form add-user" method="post" accept-charset="utf-8">
                            <input type="hidden" name="_token" value="vnb2e0o2FLOYsxZ2RAdVelRX0nKAbKpF7Yn6XJLc" class="notempty">                            <div class="field">
                                <label>Employee</label>
                                <input type="text" name="employee" value="DEMO, MANAGER" class="readonly uppercase notempty" readonly="">
                            </div>
                            <div class="field">
                                <label>Email</label>
                                <input type="text" name="email" value="manager@example.com" class="readonly lowercase notempty" readonly="">
                            </div>
                            <div class="grouped fields opt-radio">
                                <label class="">Choose Account type</label>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="acc_type" value="1" tabindex="0" class="notempty hidden">
                                        <label>Employee</label>
                                    </div>
                                </div>
                                <div class="field" style="padding:0px!important">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="acc_type" value="2" checked="" tabindex="0" class="hidden notempty">
                                        <label>Admin</label>
                                    </div>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="sixteen wide field role">
                                    <label for="">Role</label>
                                    <div class="ui dropdown uppercase selection notempty" tabindex="0"><select name="role_id">
                                        <option value="">Select Role</option>
                                                                                                                                    <option value="1" selected="">MANAGER</option>
                                                                                            <option value="2">EMPLOYEE</option>
                                                                                            <option value="3">STUDENT</option>
                                                                                            <option value="4">ASASD</option>
                                                                                            <option value="5">CHEF</option>
                                                                                                                        </select><i class="dropdown icon"></i><div class="text">MANAGER</div><div class="menu" tabindex="-1"><div class="item active selected" data-value="1">MANAGER</div><div class="item" data-value="2">EMPLOYEE</div><div class="item" data-value="3">STUDENT</div><div class="item" data-value="4">ASASD</div><div class="item" data-value="5">CHEF</div></div></div>
                                </div>
                            </div>
                            <div class="field">
                                <label>Status</label>
                                <div class="ui dropdown uppercase selection notempty" tabindex="0"><select name="status">
                                    <option value="">Select Status</option>
                                    <option value="1" selected="">Enabled</option>
                                    <option value="0">Disabled</option>
                                </select><i class="dropdown icon"></i><div class="text">Enabled</div><div class="menu" tabindex="-1"><div class="item active selected" data-value="1">Enabled</div><div class="item" data-value="0">Disabled</div></div></div>
                            </div>
                            <div class="two fields">
                                <div class="field">
                                    <label for="">New Password</label>
                                    <input type="password" name="password" class="" placeholder="********">
                                </div>
                                <div class="field">
                                    <label for="">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" class="" placeholder="********">
                                </div>
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
                    </form></div>

                    <div class="box-footer">
                        <input type="hidden" value="eyJpdiI6Im1tSzM4TTJPcHRUXC9RemxDVXBKK2l3PT0iLCJ2YWx1ZSI6IlpZR1gwN2FzejF0ZnRqdGlhN1N1RXc9PSIsIm1hYyI6IjViODExMTliZmQyOGU4ZmYxNGQwN2I1Y2I2OTEwOGQxZjk3NzZhNWFhNmYxNzQyM2IzNzEzYmI4OWVjYTc1ZGUifQ==" name="ref" class="notempty">
                        <button class="ui positive approve small button" type="submit" name="submit"><i class="ui checkmark icon"></i> Update</button>
                        <a href="http://demo-workday.herokuapp.com/users" class="ui black grey small button"><i class="ui times icon"></i> Cancel</a>
                    </div>



                </div>
            </div>
        </div>

                    </div>

            <input type="hidden" id="_url" value="http://demo-workday.herokuapp.com" class="notempty">
            <script>
                var y = '';
            </script>
        </div>
@endsection