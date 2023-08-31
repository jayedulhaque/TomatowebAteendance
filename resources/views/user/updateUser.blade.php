@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __('messages.update_account') }}</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-content">
                    <form id="edit_personal_user_form" action="{{route('account.updatedata')}}" class="ui form" method="post" accept-charset="utf-8">
                        {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$user->id}}" class="notempty">              <div class="field">
                                <label>{{ __('messages.first_name') }}</label>
                                <input type="text" name="firstname" value="{{$user->first_name}}" class="uppercase notempty">
                            </div>
                            <div class="field">
                                <label>{{ __('messages.last_name') }}</label>
                                <input type="text" name="lastname" value="{{$user->last_name}}" class="uppercase notempty">
                            </div>
                            <div class="field">
                                <label for="">{{ __('messages.email') }}</label>
                                <input type="email" name="email" value="{{$user->email}}" class="lowercase notempty">
                            </div>
                            <div class="field">
                                <label for="">{{ __('messages.role') }}</label>
                                <input type="text" class="readonly uppercase notempty" value="@foreach($user->roles as $role){{$role->name}}@endforeach" readonly="">
                            </div>
                            <div class="field">
                                <label for="">{{ __('messages.status') }}</label>
                                <input type="text" class="readonly uppercase notempty" value="{{$user->status}}  " readonly="">
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
                        </div>
                        <div class="box-footer">
                            <button class="ui positive small button" type="submit" name="submit"><i class="fa fa-check"></i> {{ __('messages.update') }}</button>
                            <a class="ui grey black small button" href="{{url('/')}}"><i class="fa fa-close"></i> {{ __('messages.cancel') }}</a>
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

                </div>
@endsection