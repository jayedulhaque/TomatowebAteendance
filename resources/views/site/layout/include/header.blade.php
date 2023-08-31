<nav class="navbar navbar-expand-lg navbar-light bg-lightblue">
                <div class="container-fluid">

                    <button type="button" id="slidesidebar" class="ui icon button btn-light-outline" style="box-shadow: none !important;">
                        <i class="fa fa-bars"></i> <span class="toggle-sidebar-menu">{{ __('messages.menu') }}</span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto navmenu">
                            <li class="nav-item">
                                <div class="ui pointing link dropdown item" tabindex="0">
                                    <i class="fa fa-flag"></i> <span class="navmenutext uppercase">{{ app()->getLocale() }}</span>
                                    <i class="dropdown icon"></i>
                                    <div class="menu" tabindex="-1">
                                      <a href="{{ url('locale/en') }}" class="item"><i class="flag-icon flag-icon-us"></i>{{ __('messages.english') }}</a>
                                      <a href="{{ url('locale/bn') }}" class="item"><i class="flag-icon flag-icon-es"></i>{{ __('messages.bangla') }}</a>
                                    </div>
                              </div>
                            </li>
                            <li class="nav-item">
                                <div class="ui pointing link dropdown item" tabindex="0">
                                    <i class="fa fa-external-link"></i> <span class="navmenutext uppercase"> {{ __('messages.quick_access') }}</span>
                                    <i class="dropdown icon"></i>
                                    <div class="menu" tabindex="-1">
                                      @if(Auth::user()->status=='Active' || Auth::user()->hasRole('admin'))
                                      @role('admin')
                                      @else
                                      <a href="{{route('attendance.create')}}" target="_blank" class="item"><i class="fa fa-clock-o"></i>&nbsp; {{ __('messages.clock_in_out') }}</a>
                                      @endrole
                                      @role(['admin','manager','superviser'])
                                      @permission('add-employee')
                                      <div class="divider"></div>
                                      <a href="{{ route('employee.create') }}" class="item"><i class="fa fa-users"></i>&nbsp; {{ __('messages.new_employee') }}</a>
                                      @endpermission
                                      @permission('add-company')
                                      <div class="divider"></div>
                                      <a href="{{route('company.index')}}" class="item"><i class="fa fa-university"></i>&nbsp; {{ __('messages.company') }}</a>
                                      @endpermission
                                      @permission('add-department')
                                      <a href="{{route('department.index')}}" class="item"><i class="fa fa-cubes"></i>&nbsp; {{ __('messages.department') }}</a>
                                      @endpermission
                                      @permission('add-job')
                                      <a href="{{route('job.index')}}" class="item"><i class="fa fa-pencil-square-o"></i>&nbsp; {{ __('messages.job_title') }}</a>
                                      @endpermission
                                      @permission('add-leavetype')
                                      <a href="{{route('leavetype.index')}}" class="item"><i class="fa fa-calendar-o"></i>&nbsp; {{ __('messages.leave_type') }}</a>
                                      @endpermission
                                      @endrole
                                      @endif
                                      @role(['employee','manager'])
                                      <a href="{{ route('employee.show',Auth::user()->id) }}" class="item"><i class="fa fa-user-o"></i>&nbsp; {{ __('messages.my_profile') }}</a>
                                      @endrole
                                    </div>
                              </div>
                            </li>
                            <li class="nav-item">
                               <div class="ui pointing link dropdown item" tabindex="0">
                                    <i class="fa fa-user-o"></i> <span class="navmenutext">{{Auth::user()->first_name}}  {{Auth::user()->last_name}}</span>
                                    <i class="dropdown icon"></i>
                                    <div class="menu" tabindex="-1">
                                      @role(['admin','manager','superviser'])
                                      <a href="{{route('user.show',Auth::user()->id)}}" class="item"><i class="fa fa-user"></i> {{ __('messages.update_account') }}</a>
                                      @endrole
                                      @role('employee')
                                        <a href="{{route('user.show',Auth::user()->id)}}" class="item"><i class="fa fa-user"></i> {{ __('messages.update_user') }}</a>
                                      @endrole
                                      {{-- @if (Route::has('password.request')) --}}
                                      <a href="{{route('change.password')}}" class="item">
                                          <i class="fa fa-lock"></i> {{ __('messages.change_password') }}
                                      </a>
                                      {{-- @endif --}}
                                      {{-- <a href="" class="item"><i class="fa fa-lock"></i> Change Password</a> --}}
                                      {{-- <a href="" target="_blank" class="item"><i class="fa fa-sign-in"></i> Switch to MyAccount</a> --}}
                                      <div class="divider"></div>
                                      <a class="item" href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                                 <i class="fa fa-power-off"></i>
                                            {{ __('messages.logout') }}
                                        </a>
                                        <form action="{{ url('/logout') }}" id="logout-form" method="POST" >
                                            {{ csrf_field() }}
                                        </form>

                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
