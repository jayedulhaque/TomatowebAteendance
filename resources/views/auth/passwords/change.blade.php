@extends('site.layout.index')

@section('content')
<div class="content">
<div class="container-fluid">
	<div class="row">
        <div class="col-md-12">
            <h2 class="page-title">{{ __('messages.change_password') }}
            </h2>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-6">
            <div class="box box-success">
                <div class="box-content">
                	<form id="form-change-password" role="form" method="POST" action="{{ route('update.password') }}" novalidate class="ui form add-user">

			    {{-- <div class="col-sm-8"> --}}
			      <div class="field">
			        <input type="hidden" name="_token" value="{{ csrf_token() }}">
			        <label >{{ __('messages.current_password') }}</label>
			        <input type="password"  id="current-password" name="current-password" placeholder="Password">
			      </div>
			    {{-- </div> --}}

			    {{-- <div class="col-sm-8"> --}}
			      <div class="field">
			      	<label >{{ __('messages.new_password') }}</label>
			        <input type="password"  id="password" name="password" placeholder="Password">
			      </div>
			    {{-- </div> --}}

			    {{-- <div class="col-sm-8"> --}}
			      <div class="field">
			      	<label >{{ __('messages.reenter_password') }}</label>
			        <input type="password"  id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
			      </div>
			    {{-- </div> --}}
			  	</div>
			  		<div class="box-footer">
                        <button class="ui positive button" type="submit" name="submit"><i class="fa fa-check"></i> {{ __('messages.update') }}</button>
                        <a class="ui grey black button" href="{{url('/')}}"><i class="fa fa-close"></i> {{ __('messages.cancel') }}</a>
                    </div>
			</form>
		</div>
            </div>
        </div>
</div>

</div>
@endsection