@extends('site.layout.index')

@section('content')
<div class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{ __('messages.general_settings') }}</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

            <div class="box box-success">
                <div class="box-body">

                    <div class="ui secondary blue pointing tabular menu">
                        <a class="item active" data-tab="system">{{ __('messages.system') }}</a>
                        <a class="item" data-tab="about">{{ __('messages.about') }}</a>
                        <a class="item" data-tab="attribution">{{ __('messages.attributions') }}</a>
                    </div>

                    <div class="ui tab active" data-tab="system">
                        <div class="col-md-12">
                            <div class="tab-content">
                    <form action="{{route('settings.update',$setting->id)}}" class="ui form" method="post" accept-charset="utf-8">
                         <div class="content">
                        {{method_field('PATCH')}}
                        {{csrf_field()}}
                        <h4 class="ui dividing header">{{ __('messages.localization') }}</h4>

                                            <div class="eight wide field">
                                                <h2 class="ui small header">{{ __('messages.country') }}
                                                    <div class="sub header">{{ __('messages.country_message') }}</div>
                                                </h2>
                                                <div class="ui search dropdown uppercase selection notempty"><select name="country">
                                                    <option value="">{{ __('messages.select_country') }}</option>
                                                    {{-- <option value="Afganistan">Afghanistan</option> --}}
                                                    <option value="{{$selectedCountries->id}}" selected="">{{$selectedCountries->name}}</option>
                                                    @foreach($countries as $country)
                                                        @if($selectedCountries->id==$country->id)
                                                        @else
                                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select><i class="dropdown icon"></i>
                                                <input class="search" autocomplete="off" tabindex="0">
                                                <div class="text">{{$selectedCountries->name}}</div>
                                                <div class="menu" tabindex="-1">
                                                    <div class="item active selected" data-value="{{$selectedCountries->id}}">{{$selectedCountries->name}}</div>
                                                    @foreach($countries as $country)
                                                    @if($selectedCountries->id==$country->id)
                                                        @else
                                                    <div class="item" data-value="{{$country->id}}">{{$country->name}}</div>
                                                        @endif
                                                    @endforeach
                                                </div></div>
                                            </div>

                                            <div class="eight wide field">
                                                <h2 class="ui small header">{{ __('messages.time_zone') }}
                                                    <div class="sub header">{{ __('messages.time_zone_message') }}</div>
                                                </h2>
                                                <div class="ui search dropdown uppercase selection notempty"><select name="timezone">
                                                    <option value="">{{ __('messages.select_time_zone') }}</option>
                                                    <option value="{{$setting->time_zone}}" selected="">{{$setting->time_zone}}</option>
                                                    @foreach($timeZones as $timeZone)
                                                        @if($setting->time_zone==$timeZone->description)
                                                        @else
                                                            <option value="{{$timeZone->description}}">{{$timeZone->description}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <i class="dropdown icon"></i>
                                                <input class="search" autocomplete="off" tabindex="0">
                                                <div class="text">{{$setting->time_zone}}</div>
                                                <div class="menu" tabindex="-1">
                                                    <div class="item active selected" data-value="{{$setting->time_zone}}">{{$setting->time_zone}}</div>
                                                    @foreach($timeZones as $timeZone)
                                                        @if($setting->time_zone==$timeZone->description)
                                                        @else
                                                        <div class="item" data-value="$timeZones->description">{{$timeZone->description}}</div>
                                                        @endif
                                                    @endforeach

                                                </div></div>
                                            </div>

                                            <div class="eight wide field">
                                                <h2 class="ui small header">{{ __('messages.time_format') }}
                                                    <div class="sub header">{{ __('messages.time_format_message') }}</div>
                                                </h2>
                                                <div class="ui dropdown uppercase selection notempty" tabindex="0"><select name="time_format" class="target">
                                                    <option value="">{{ __('messages.select_time_format') }}</option>
                                                    <option value="{{$setting->time_format}}" selected="">{{$setting->time_format}}-Hour</option>
                                                    @foreach($timeFormats as $timeFormat)
                                                        @if($setting->time_format==$timeFormat->name)
                                                        @else
                                                            <option value="{{$timeFormat->name}}">{{$timeFormat->name}}-Hour</option>
                                                        @endif
                                                    @endforeach
                                                </select><i class="dropdown icon"></i><div class="text">{{$setting->time_format}}-Hour</div><div class="menu" tabindex="-1">
                                                    <div class="item active selected" data-value="{{$setting->time_format}}">{{$setting->time_format}}-Hour</div>
                                                    @foreach($timeFormats as $timeFormat)
                                                        @if($setting->time_format==$timeFormat->name)
                                                        @else
                                                        <div class="item" data-value="{{$timeFormat->name}}">{{$timeFormat->name}}-Hour</div>
                                                        @endif
                                                    @endforeach
                                                    </div></div>
                                            </div>

                                        <div class="12-Hour boxes">
                                            <h4 class="ui dividing header ">{{ __('messages.time_slot') }}</h4>
                                        <div class="eight wide field ">
                                            <h2 class="ui small header">{{ __('messages.time_in') }}
                                                </h2>
                                                    <div class='input-group date twelve-hour-format'>
                                                        {{-- <input type='text' value="{{$setting->time_in}}" name="timein" class="form-control " > --}}
                                                        <input class="jtimepicker notempty" type="text" placeholder="00:00:00 AM" name="timein" value="{{date('H:i', strtotime($setting->time_in))}}" readonly="" data-time="{{date('H:i', strtotime($setting->time_in))}}:00.000">
                                                        {{-- <div class="input-group-addon">
                                                            <span class="input-group-text"><span class="fa fa-clock-o"></span></span>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="12-Hour boxes">
                                            <h4 class="ui dividing header "></h4>
                                        <div class="eight wide field ">
                                            <h2 class="ui small header">{{ __('messages.time_out') }}
                                                </h2>
                                                    <div class='input-group date'>
                                                        <input class="jtimepicker notempty" type="text" placeholder="00:00:00 AM" name="timeout" value="{{date('H:i', strtotime($setting->time_out))}}" readonly="" data-time="{{date('H:i', strtotime($setting->time_out))}}:00.000">
                                                        {{-- <input type='text' name="timeout" value="{{$setting->time_out}}" class="form-control " >
                                                        <div class="input-group-addon">
                                                            <span class="input-group-text"><span class="fa fa-clock-o"></span></span>

                                                        </div> --}}
                                                    </div>
                                                </div>
                                        </div>
                                        {{-- <div class="24-Hour boxes">
                                            <h4 class="ui dividing header ">Time Slot</h4>
                                        <div class="eight wide field ">
                                            <h2 class="ui small header">Time In
                                                </h2>
                                                    <div class='input-group date tfour-hour-format'>
                                                        <input type='text' class="form-control " />
                                                        <span class="input-group-addon">
                                                            <span class="input-group-text"><span class="fa fa-clock-o"></span></span>
                                                        </span>
                                                    </div>
                                        </div>
                                    </div> --}}

                            <h4 class="ui dividing header ">{{ __('messages.safeguarding') }}</h4>
                                <div class="eight wide field ">
                                    <h2 class="ui small header">{{ __('messages.web_clock_ip_restriction') }}
                                                    <div class="sub header">{{ __('messages.web_clock_ip_restriction_message') }}</div>
                                                </h2>
                                                <textarea name="iprestriction" rows="3" placeholder="Enter IP addresses, if more than one add comma after each IP address">{{$setting->ip_restriction}}</textarea>
                                            </div>
                                    </div>
                                    <div class="actions align-left">
                                        <button class="ui positive small button approve" type="submit" name="submit"><i class="fa fa-check"></i> {{ __('messages.save') }}</button>
                                    </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                        <div class="ui tab" data-tab="about">
                        <div class="col-md-12">
                            <div class="tab-content">
                                <p class="license col-md-6" style="margin-bottom:0">
                                    </p><h3 style="margin-top:0" class="ui header">Workday a time clock application for employees</h3>
                                    <p>Easily track and manage employee work hours on jobs, improve your payroll process and collaborate with your timekeeping employees like never before.</p>
                                    <h4 class="ui header">Features</h4>
                                    <ul>
                                        <li>Employee Management (HRIS)</li>
                                        <li>Time and Attendance Management</li>
                                        <li>Employee Time Tracking</li>
                                        <li>Shift Management</li>
                                        <li>Leave Management</li>
                                        <li>Reporting and Analytics</li>
                                        <li>Multi-company</li>
                                        <li>Manager and Employee self-service</li>
                                    </ul>
                                    <div class="footer-text">
                                        <div class="sub header">Version 1.1</div>
                                        <div class="sub header">Copyright (c) 2020 Codefactor. All rights reserved.</div>
                                    </div>
                                <p></p>
                                <div class="ui section divider"></div>
                                <h4 class="ui header">Send Feedback
                                    <div class="sub header">Write your feedback and send it to our developer's email address official.codefactor@gmail.com</div>
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="ui tab" data-tab="attribution">
                        <div class="tab-content">
                        <h3 class="ui header">Legal Notice
                            <div class="sub header">Copyright (c) 2020 Brian Luna. All rights reserved.</div>
                        </h3>
                        <h5 class="ui header">Laravel
                        <div class="sub header">The MIT License (MIT)</div>
                        </h5>
                        <p class="license col-md-6">
                            Copyright (c) Taylor Otwell
                            <br><br>
                            Permission is hereby granted, free of charge, to any person obtaining a copy
                            of this software and associated documentation files (the "Software"), to deal
                            in the Software without restriction, including without limitation the rights
                            to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
                            copies of the Software, and to permit persons to whom the Software is
                            furnished to do so, subject to the following conditions:
                            <br><br>
                            The above copyright notice and this permission notice shall be included in
                            all copies or substantial portions of the Software.
                            <br><br>
                            THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                            IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
                            FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                            AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                            LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
                            OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
                            THE SOFTWARE.
                        </p>

                        <h5 class="ui header">Bootstrap
                            <div class="sub header">The MIT License (MIT)</div>
                        </h5>
                        <p class="license col-md-6">
                            Copyright 2011-2018 Twitter, Inc.
                            <br><br>
                            Permission is hereby granted, free of charge, to any person obtaining a copy
                            of this software and associated documentation files (the "Software"), to deal
                            in the Software without restriction, including without limitation the rights
                            to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
                            copies of the Software, and to permit persons to whom the Software is
                            furnished to do so, subject to the following conditions:
                            <br><br>
                            The above copyright notice and this permission notice shall be included in
                            all copies or substantial portions of the Software.
                            <br><br>
                            THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                            IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
                            FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                            AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                            LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
                            OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
                            THE SOFTWARE.
                        </p>

                        <h5 class="ui header">Semantic UI
                            <div class="sub header">The MIT License (MIT)</div>
                        </h5>
                        <p class="license col-md-6">
                            Copyright (c) 2015 Semantic Org
                            <br><br>
                            Permission is hereby granted, free of charge, to any person obtaining a copy
                            of this software and associated documentation files (the "Software"), to deal
                            in the Software without restriction, including without limitation the rights
                            to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
                            copies of the Software, and to permit persons to whom the Software is
                            furnished to do so, subject to the following conditions:
                            <br><br>
                            The above copyright notice and this permission notice shall be included in
                            all copies or substantial portions of the Software.
                            <br><br>
                            THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                            IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
                            FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                            AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                            LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
                            OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
                            SOFTWARE.
                        </p>

                        <h5 class="ui header">jQuery JavaScript Library
                            <div class="sub header">The MIT License (MIT)</div>
                        </h5>
                        <p class="license col-md-6">
                            Copyright jQuery Foundation and other contributors
                            <br><br>
                            Permission is hereby granted, free of charge, to any person obtaining a copy
                            of this software and associated documentation files (the "Software"), to deal
                            in the Software without restriction, including without limitation the rights
                            to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
                            copies of the Software, and to permit persons to whom the Software is
                            furnished to do so, subject to the following conditions:
                            <br><br>
                            The above copyright notice and this permission notice shall be included in
                            all copies or substantial portions of the Software.
                            <br><br>
                            THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                            IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
                            FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                            AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                            LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
                            OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
                            THE SOFTWARE.
                        </p>

                        <h5 class="ui header">DataTables
                            <div class="sub header">The MIT License (MIT)</div>
                        </h5>
                        <p class="license col-md-6">
                            Copyright 2008-2018 SpryMedia Ltd
                            <br><br>
                            Permission is hereby granted, free of charge, to any person obtaining a copy
                            of this software and associated documentation files (the "Software"), to deal
                            in the Software without restriction, including without limitation the rights
                            to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
                            copies of the Software, and to permit persons to whom the Software is
                            furnished to do so, subject to the following conditions:
                            <br><br>
                            The above copyright notice and this permission notice shall be included in
                            all copies or substantial portions of the Software.
                            <br><br>
                            THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                            IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
                            FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                            AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                            LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
                            OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
                            THE SOFTWARE.
                        </p>

                        <h5 class="ui header">Chart.js
                            <div class="sub header">The MIT License (MIT)</div>
                        </h5>
                        <p class="license col-md-6">
                            Copyright 2018 Chart.js Contributors
                            <br><br>
                            Permission is hereby granted, free of charge, to any person obtaining a copy
                            of this software and associated documentation files (the "Software"), to deal
                            in the Software without restriction, including without limitation the rights
                            to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
                            copies of the Software, and to permit persons to whom the Software is
                            furnished to do so, subject to the following conditions:
                            <br><br>
                            The above copyright notice and this permission notice shall be included in
                            all copies or substantial portions of the Software.
                            <br><br>
                            THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                            IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
                            FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                            AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                            LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
                            OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
                            THE SOFTWARE.
                        </p>

                        <h5 class="ui header">Moment.js
                            <div class="sub header">The MIT License (MIT)</div>
                        </h5>
                        <p class="license col-md-6">
                            Copyright (c) JS Foundation and other contributors
                            <br><br>
                            Permission is hereby granted, free of charge, to any person obtaining a copy
                            of this software and associated documentation files (the "Software"), to deal
                            in the Software without restriction, including without limitation the rights
                            to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
                            copies of the Software, and to permit persons to whom the Software is
                            furnished to do so, subject to the following conditions:
                            <br><br>
                            The above copyright notice and this permission notice shall be included in
                            all copies or substantial portions of the Software.
                            <br><br>
                            THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                            IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
                            FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                            AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                            LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
                            OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
                            THE SOFTWARE.
                        </p>

                        <h5 class="ui header">Air Datepicker
                            <div class="sub header">The MIT License (MIT)</div>
                        </h5>
                        <p class="license col-md-6">
                            Copyright (c) 2016 Timofey Marochkin
                            <br><br>
                            Permission is hereby granted, free of charge, to any person obtaining a copy
                            of this software and associated documentation files (the "Software"), to deal
                            in the Software without restriction, including without limitation the rights
                            to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
                            copies of the Software, and to permit persons to whom the Software is
                            furnished to do so, subject to the following conditions:
                            <br><br>
                            The above copyright notice and this permission notice shall be included in
                            all copies or substantial portions of the Software.
                            <br><br>
                            THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                            IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
                            FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                            AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                            LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
                            OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
                            THE SOFTWARE.
                        </p>

                        <h5 class="ui header">MDTimePicker
                            <div class="sub header">The MIT License (MIT)</div>
                        </h5>
                        <p class="license col-md-6">
                            Copyright (c) 2017 Dionlee Uy
                            <br><br>
                            Permission is hereby granted, free of charge, to any person obtaining a copy
                            of this software and associated documentation files (the "Software"), to deal
                            in the Software without restriction, including without limitation the rights
                            to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
                            copies of the Software, and to permit persons to whom the Software is
                            furnished to do so, subject to the following conditions:
                            <br><br>
                            The above copyright notice and this permission notice shall be included in
                            all copies or substantial portions of the Software.
                            <br><br>
                            THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                            IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
                            FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                            AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                            LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
                            OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
                            THE SOFTWARE.
                        </p>
                        </div>
                    </div>

                </div>
            </div>

            </div>
        </div>
    </div>

                </div>

<div class="mdtimepicker hidden"><div class="mdtp__wrapper" data-theme="blue"><section class="mdtp__time_holder"><span class="mdtp__time_h active">10</span><span class="mdtp__timedots">:</span><span class="mdtp__time_m">50</span><span class="mdtp__ampm">AM</span></section><section class="mdtp__clock_holder"><div class="mdtp__clock"><span class="mdtp__am active">AM</span><span class="mdtp__pm">PM</span><span class="mdtp__clock_dot"></span><div class="mdtp__hour_holder"><div class="mdtp__digit rotate-120" data-hour="1"><span>1</span></div><div class="mdtp__digit rotate-150" data-hour="2"><span>2</span></div><div class="mdtp__digit rotate-180" data-hour="3"><span>3</span></div><div class="mdtp__digit rotate-210" data-hour="4"><span>4</span></div><div class="mdtp__digit rotate-240" data-hour="5"><span>5</span></div><div class="mdtp__digit rotate-270" data-hour="6"><span>6</span></div><div class="mdtp__digit rotate-300" data-hour="7"><span>7</span></div><div class="mdtp__digit rotate-330" data-hour="8"><span>8</span></div><div class="mdtp__digit rotate-0" data-hour="9"><span>9</span></div><div class="mdtp__digit rotate-30 active" data-hour="10"><span>10</span></div><div class="mdtp__digit rotate-60" data-hour="11"><span>11</span></div><div class="mdtp__digit rotate-90" data-hour="12"><span>12</span></div></div><div class="mdtp__minute_holder hidden"><div class="mdtp__digit rotate-90 marker" data-minute="0"><span>00</span></div><div class="mdtp__digit rotate-96" data-minute="1"><span></span></div><div class="mdtp__digit rotate-102" data-minute="2"><span></span></div><div class="mdtp__digit rotate-108" data-minute="3"><span></span></div><div class="mdtp__digit rotate-114" data-minute="4"><span></span></div><div class="mdtp__digit rotate-120 marker" data-minute="5"><span>05</span></div><div class="mdtp__digit rotate-126" data-minute="6"><span></span></div><div class="mdtp__digit rotate-132" data-minute="7"><span></span></div><div class="mdtp__digit rotate-138" data-minute="8"><span></span></div><div class="mdtp__digit rotate-144" data-minute="9"><span></span></div><div class="mdtp__digit rotate-150 marker" data-minute="10"><span>10</span></div><div class="mdtp__digit rotate-156" data-minute="11"><span></span></div><div class="mdtp__digit rotate-162" data-minute="12"><span></span></div><div class="mdtp__digit rotate-168" data-minute="13"><span></span></div><div class="mdtp__digit rotate-174" data-minute="14"><span></span></div><div class="mdtp__digit rotate-180 marker" data-minute="15"><span>15</span></div><div class="mdtp__digit rotate-186" data-minute="16"><span></span></div><div class="mdtp__digit rotate-192" data-minute="17"><span></span></div><div class="mdtp__digit rotate-198" data-minute="18"><span></span></div><div class="mdtp__digit rotate-204" data-minute="19"><span></span></div><div class="mdtp__digit rotate-210 marker" data-minute="20"><span>20</span></div><div class="mdtp__digit rotate-216" data-minute="21"><span></span></div><div class="mdtp__digit rotate-222" data-minute="22"><span></span></div><div class="mdtp__digit rotate-228" data-minute="23"><span></span></div><div class="mdtp__digit rotate-234" data-minute="24"><span></span></div><div class="mdtp__digit rotate-240 marker" data-minute="25"><span>25</span></div><div class="mdtp__digit rotate-246" data-minute="26"><span></span></div><div class="mdtp__digit rotate-252" data-minute="27"><span></span></div><div class="mdtp__digit rotate-258" data-minute="28"><span></span></div><div class="mdtp__digit rotate-264" data-minute="29"><span></span></div><div class="mdtp__digit rotate-270 marker" data-minute="30"><span>30</span></div><div class="mdtp__digit rotate-276" data-minute="31"><span></span></div><div class="mdtp__digit rotate-282" data-minute="32"><span></span></div><div class="mdtp__digit rotate-288" data-minute="33"><span></span></div><div class="mdtp__digit rotate-294" data-minute="34"><span></span></div><div class="mdtp__digit rotate-300 marker" data-minute="35"><span>35</span></div><div class="mdtp__digit rotate-306" data-minute="36"><span></span></div><div class="mdtp__digit rotate-312" data-minute="37"><span></span></div><div class="mdtp__digit rotate-318" data-minute="38"><span></span></div><div class="mdtp__digit rotate-324" data-minute="39"><span></span></div><div class="mdtp__digit rotate-330 marker" data-minute="40"><span>40</span></div><div class="mdtp__digit rotate-336" data-minute="41"><span></span></div><div class="mdtp__digit rotate-342" data-minute="42"><span></span></div><div class="mdtp__digit rotate-348" data-minute="43"><span></span></div><div class="mdtp__digit rotate-354" data-minute="44"><span></span></div><div class="mdtp__digit rotate-0 marker" data-minute="45"><span>45</span></div><div class="mdtp__digit rotate-6" data-minute="46"><span></span></div><div class="mdtp__digit rotate-12" data-minute="47"><span></span></div><div class="mdtp__digit rotate-18" data-minute="48"><span></span></div><div class="mdtp__digit rotate-24" data-minute="49"><span></span></div><div class="mdtp__digit rotate-30 marker active" data-minute="50"><span>50</span></div><div class="mdtp__digit rotate-36" data-minute="51"><span></span></div><div class="mdtp__digit rotate-42" data-minute="52"><span></span></div><div class="mdtp__digit rotate-48" data-minute="53"><span></span></div><div class="mdtp__digit rotate-54" data-minute="54"><span></span></div><div class="mdtp__digit rotate-60 marker" data-minute="55"><span>55</span></div><div class="mdtp__digit rotate-66" data-minute="56"><span></span></div><div class="mdtp__digit rotate-72" data-minute="57"><span></span></div><div class="mdtp__digit rotate-78" data-minute="58"><span></span></div><div class="mdtp__digit rotate-84" data-minute="59"><span></span></div></div></div><div class="mdtp__buttons"><span class="mdtp__button cancel">Cancel</span><span class="mdtp__button ok">Ok</span></div></section></div></div>
<div class="mdtimepicker hidden"><div class="mdtp__wrapper" data-theme="blue"><section class="mdtp__time_holder"><span class="mdtp__time_h active">2</span><span class="mdtp__timedots">:</span><span class="mdtp__time_m">50</span><span class="mdtp__ampm">PM</span></section><section class="mdtp__clock_holder"><div class="mdtp__clock"><span class="mdtp__am">AM</span><span class="mdtp__pm active">PM</span><span class="mdtp__clock_dot"></span><div class="mdtp__hour_holder"><div class="mdtp__digit rotate-120" data-hour="1"><span>1</span></div><div class="mdtp__digit rotate-150 active" data-hour="2"><span>2</span></div><div class="mdtp__digit rotate-180" data-hour="3"><span>3</span></div><div class="mdtp__digit rotate-210" data-hour="4"><span>4</span></div><div class="mdtp__digit rotate-240" data-hour="5"><span>5</span></div><div class="mdtp__digit rotate-270" data-hour="6"><span>6</span></div><div class="mdtp__digit rotate-300" data-hour="7"><span>7</span></div><div class="mdtp__digit rotate-330" data-hour="8"><span>8</span></div><div class="mdtp__digit rotate-0" data-hour="9"><span>9</span></div><div class="mdtp__digit rotate-30" data-hour="10"><span>10</span></div><div class="mdtp__digit rotate-60" data-hour="11"><span>11</span></div><div class="mdtp__digit rotate-90" data-hour="12"><span>12</span></div></div><div class="mdtp__minute_holder hidden"><div class="mdtp__digit rotate-90 marker" data-minute="0"><span>00</span></div><div class="mdtp__digit rotate-96" data-minute="1"><span></span></div><div class="mdtp__digit rotate-102" data-minute="2"><span></span></div><div class="mdtp__digit rotate-108" data-minute="3"><span></span></div><div class="mdtp__digit rotate-114" data-minute="4"><span></span></div><div class="mdtp__digit rotate-120 marker" data-minute="5"><span>05</span></div><div class="mdtp__digit rotate-126" data-minute="6"><span></span></div><div class="mdtp__digit rotate-132" data-minute="7"><span></span></div><div class="mdtp__digit rotate-138" data-minute="8"><span></span></div><div class="mdtp__digit rotate-144" data-minute="9"><span></span></div><div class="mdtp__digit rotate-150 marker" data-minute="10"><span>10</span></div><div class="mdtp__digit rotate-156" data-minute="11"><span></span></div><div class="mdtp__digit rotate-162" data-minute="12"><span></span></div><div class="mdtp__digit rotate-168" data-minute="13"><span></span></div><div class="mdtp__digit rotate-174" data-minute="14"><span></span></div><div class="mdtp__digit rotate-180 marker" data-minute="15"><span>15</span></div><div class="mdtp__digit rotate-186" data-minute="16"><span></span></div><div class="mdtp__digit rotate-192" data-minute="17"><span></span></div><div class="mdtp__digit rotate-198" data-minute="18"><span></span></div><div class="mdtp__digit rotate-204" data-minute="19"><span></span></div><div class="mdtp__digit rotate-210 marker" data-minute="20"><span>20</span></div><div class="mdtp__digit rotate-216" data-minute="21"><span></span></div><div class="mdtp__digit rotate-222" data-minute="22"><span></span></div><div class="mdtp__digit rotate-228" data-minute="23"><span></span></div><div class="mdtp__digit rotate-234" data-minute="24"><span></span></div><div class="mdtp__digit rotate-240 marker" data-minute="25"><span>25</span></div><div class="mdtp__digit rotate-246" data-minute="26"><span></span></div><div class="mdtp__digit rotate-252" data-minute="27"><span></span></div><div class="mdtp__digit rotate-258" data-minute="28"><span></span></div><div class="mdtp__digit rotate-264" data-minute="29"><span></span></div><div class="mdtp__digit rotate-270 marker" data-minute="30"><span>30</span></div><div class="mdtp__digit rotate-276" data-minute="31"><span></span></div><div class="mdtp__digit rotate-282" data-minute="32"><span></span></div><div class="mdtp__digit rotate-288" data-minute="33"><span></span></div><div class="mdtp__digit rotate-294" data-minute="34"><span></span></div><div class="mdtp__digit rotate-300 marker" data-minute="35"><span>35</span></div><div class="mdtp__digit rotate-306" data-minute="36"><span></span></div><div class="mdtp__digit rotate-312" data-minute="37"><span></span></div><div class="mdtp__digit rotate-318" data-minute="38"><span></span></div><div class="mdtp__digit rotate-324" data-minute="39"><span></span></div><div class="mdtp__digit rotate-330 marker" data-minute="40"><span>40</span></div><div class="mdtp__digit rotate-336" data-minute="41"><span></span></div><div class="mdtp__digit rotate-342" data-minute="42"><span></span></div><div class="mdtp__digit rotate-348" data-minute="43"><span></span></div><div class="mdtp__digit rotate-354" data-minute="44"><span></span></div><div class="mdtp__digit rotate-0 marker" data-minute="45"><span>45</span></div><div class="mdtp__digit rotate-6" data-minute="46"><span></span></div><div class="mdtp__digit rotate-12" data-minute="47"><span></span></div><div class="mdtp__digit rotate-18" data-minute="48"><span></span></div><div class="mdtp__digit rotate-24" data-minute="49"><span></span></div><div class="mdtp__digit rotate-30 marker active" data-minute="50"><span>50</span></div><div class="mdtp__digit rotate-36" data-minute="51"><span></span></div><div class="mdtp__digit rotate-42" data-minute="52"><span></span></div><div class="mdtp__digit rotate-48" data-minute="53"><span></span></div><div class="mdtp__digit rotate-54" data-minute="54"><span></span></div><div class="mdtp__digit rotate-60 marker" data-minute="55"><span>55</span></div><div class="mdtp__digit rotate-66" data-minute="56"><span></span></div><div class="mdtp__digit rotate-72" data-minute="57"><span></span></div><div class="mdtp__digit rotate-78" data-minute="58"><span></span></div><div class="mdtp__digit rotate-84" data-minute="59"><span></span></div></div></div><div class="mdtp__buttons"><span class="mdtp__button cancel">Cancel</span><span class="mdtp__button ok">Ok</span></div></section></div></div>

@endsection
@section('script')
<script src="{{asset('assets/vendor/mdtimepicker/mdtimepicker.min.js')}}"></script>
<script src="{{asset('assets/vendor/air-datepicker/dist/js/datepicker.min.js')}}"></script>
<script src="{{asset('assets/vendor/air-datepicker/dist/js/i18n/datepicker.en.js')}}"></script>
<script type="text/javascript">
            $('.jtimepicker').mdtimepicker({format:'hh:mm', theme: 'blue', hourPadding: true});
            $('.airdatepicker').datepicker({ language: 'en', dateFormat: 'yyyy-mm-dd' });
</script>
<script type="text/javascript">
        $('.menu .item').tab();
</script>
<script type="text/javascript">
            // $(function () {
            //     $('.twelve-hour-format').datetimepicker({
            //         format: 'LT'
            //     });
            // });
            // $(function () {
            //     $('.tfour-hour-format').datetimepicker({
            //         format: 'H HH'
            //     });
            // });
// $(document).ready(function(){
//     $(".target").change(function(){
//         $(this).find("option:selected").each(function(){
//             var optionValue = $(this).attr("value");
//             if(optionValue){
//                 $(".boxes").not("." + optionValue).hide();
//                 $("." + optionValue).show();
//             } else{
//                 $(".boxes").hide();
//             }
//         });
//     }).change();
// });
</script>
@endsection
@section('style')
<link href="{{asset('assets/vendor/mdtimepicker/mdtimepicker.min.css')}}" rel="stylesheet">
<link href="{{asset('assets/vendor/air-datepicker/dist/css/datepicker.min.css')}}" rel="stylesheet">
@endsection