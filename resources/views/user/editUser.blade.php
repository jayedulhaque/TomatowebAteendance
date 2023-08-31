@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __('messages.edit_user') }}
                    <a href="{{route('user.index')}}" class="ui basic blue button mini offsettop5 float-right"><i class="fa fa-angle-left"></i>&nbsp;{{ __('messages.return') }}</a>
                </h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-content">
                        <form id="edit_user_form" action="{{route('user.update',$user->id)}}" class="ui form add-user" method="post" accept-charset="utf-8">
                            {{method_field('PATCH')}}
                {{csrf_field()}}
                                            <div class="field">
                                <label>{{ __('messages.employee') }}</label>
                                <input type="text" name="employee" value="{{$user->first_name}} {{$user->last_name}}" class="readonly uppercase notempty" readonly="">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.email') }}</label>
                                <input type="text" name="email" value="{{$user->email}}" class="readonly lowercase notempty" readonly="">
                            </div>
                            <div class="grouped fields opt-radio">
                                <label class="">{{ __('messages.choose_account_type') }}</label>
                                <div class="field">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="acc_type" @if($user->account_type=='Employee') checked="" @endif value="Employee" tabindex="0" class="notempty hidden">
                                        <label>{{ __('messages.employee') }}</label>
                                    </div>
                                </div>
                                <div class="field" style="padding:0px!important">
                                    <div class="ui radio checkbox">
                                        <input type="radio" name="acc_type" value="Admin" @if($user->account_type=='Admin')checked="" @endif tabindex="0" class="hidden notempty">
                                        <label>{{ __('messages.admin') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="sixteen wide field role">
                                    <label for="">{{ __('messages.role') }}</label>
                                    <div class="ui dropdown uppercase selection notempty" tabindex="0">
                                        <select name="roles">
                                        @if(count($user->roles))
                                        <option value="@foreach($user->roles as $role){{$role->id}}@endforeach" selected="">@foreach($user->roles as $role){{$role->name}}@endforeach</option>
                                                @foreach($allRoles as $role)
                                                @foreach($user->roles as $rle)
                                                @if($rle->name==$role->name)
                                                @else
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endif
                                                @endforeach
                                                @endforeach
                                        @else
                                            <option value="">{{ __('messages.select_role') }}</option>
                                                @foreach($allRoles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                        @endif
                                        </select>
                        <i class="dropdown icon"></i>
                        @if(count($user->roles))
                        <div class="text">@foreach($user->roles as $role){{$role->name}}@endforeach</div>
                                    <div class="menu" tabindex="-1">
                                        <div class="item active selected" data-value="@foreach($user->roles as $role){{$role->id}}@endforeach">@foreach($user->roles as $role){{$role->name}} @endforeach</div>
                                        @foreach($allRoles as $role)
                                        @foreach($user->roles as $rle)
                                                @if($rle->name==$role->name)
                                        @else
                                        <div class="item" data-value="{{$role->id}}">{{$role->name}}</div>
                                        @endif
                                        @endforeach
                                        @endforeach
                                    </div>
                        @else
                        <div class="default text">{{ __('messages.select_role') }}</div><div class="menu" tabindex="-1">
                        @foreach($allRoles as $role)
                            <div class="item" data-value="{{$role->id}}">{{$role->name}}</div>
                        @endforeach
                        </div>
                        @endif
                                </div>
                                </div>
                            </div>
                            <div class="field">
                                <label>{{ __('messages.status') }}</label>
                                <div class="ui dropdown uppercase selection notempty" tabindex="0"><select name="status">
                                <option value="">{{ __('messages.select_status') }}</option>
                                    <option value="{{$user->status}}" selected="">{{$user->status}}</option>
                                    @foreach($employmentstatuses as $employmentstatus)
                                        @if($user->status==$employmentstatus->name)
                                        @else
                                            <option value="{{$employmentstatus->name}}">{{$employmentstatus->name}}</option>
                                        @endif
                                    @endforeach
                                </select><i class="dropdown icon"></i><div class="text">{{$user->status}}</div><div class="menu" tabindex="-1">
                                    <div class="item active selected" data-value="{{$user->status}}">{{$user->status}}</div>
                                    @foreach($employmentstatuses as $employmentstatus)
                                        @if($user->status==$employmentstatus->name)
                                        @else
                                        <div class="item" data-value="{{$employmentstatus->name}}">{{$employmentstatus->name}}</div>
                                        @endif
                                    @endforeach

                            </div></div>
                            </div>
                            {{-- <div class="two fields"> --}}
                                <div class="field">
                                    <label for="">{{ __('messages.new_password') }}</label>
                                    <input type="password" name="password" class="" placeholder="********">
                                </div>
                                {{-- <div class="field">
                                    <label for="">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" class="" placeholder="********">
                                </div> --}}
                            {{-- </div> --}}
                            <div class="field">
                                <div class="ui error message">
                                    <i class="close icon"></i>
                                    <div class="header"></div>
                                    <ul class="list">
                                        <li class=""></li>
                                    </ul>
                                </div>
                            </div>
                    </div>

                    <div class="box-footer">
                        <button class="ui positive approve small button" type="submit" name="submit"><i class="fa fa-check"></i> {{ __('messages.update') }}</button>
                        <a href="{{route('user.index')}}" class="ui black grey small button"><i class="fa fa-close"></i> {{ __('messages.cancel') }}</a>
                    </div>
</form>


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