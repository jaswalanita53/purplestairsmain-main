                <ul>

                    <li class="{{$step == 1 ? 'active center' : ''}}">

                        <a href="@if(Auth::user()->step_reached>=1) {{ url('/candidate/personal-information')}} @endif">
                        <div class="outr-points">
                            <div class="point-wrap"><span style="background: {{ ($current_step < $step && $step > 1) || $step == 0 ? 'rgba(229, 220, 237)' : '' }};">1</span></div>
                            <h5>
                                    Personal Information
                                </h5>
                        </div>
                        </a>
                    </li>
                    <li class="{{$step == 2 ? 'active center' : ''}}">
                        <a href="@if(Auth::user()->step_reached>=2) {{ url('/candidate/position-preferences')}} @endif">
                        <div class="outr-points">
                            <div class="point-wrap"><span style="background: {{ ($current_step < $step && $step > 2) || $step == 0 ? 'rgba(229, 220, 237)' : '' }};">2</span></div>
                            <h5>Preferences</h5>
                        </div>
                        </a>
                    </li>

                    <li class="{{$step == 3 || $step == 4 || $step == 5 || $step == 0 ? 'active center' : ''}}">
                        {{-- old <a href="{{ url('/candidate/education-employment')}}"> --}}
                        <a href="@if(Auth::user()->step_reached>=3 || Auth::user()->step_reached>=4 || Auth::user()->step_reached>=5) {{ url('/candidate/education')}} @endif">
                        <div class="outr-points">
                            <div class="point-wrap"><span style="background: {{ $current_step < $step && $step > 5 ? 'rgba(229, 220, 237)' : '' }};">3</span></div>
                            <h5>Education & Employment</h5>
                        </div>
                        </a>
                    </li>
                    <li class="{{$step == 6 ? 'active center' : ''}}">
                        <a href="@if($step == 5) javascript:void(0); @else @if(Auth::user()->step_reached>=6) {{ url('/candidate/skills')}} @else javascript:void(0);@endif @endif">
                        <div class="outr-points">
                            <div class="point-wrap @if($step == 5) skills-step-btn @endif"><span style="background: {{ $current_step < $step && $step > 6 ? 'rgba(229, 220, 237)' : '' }};">4</span></div>
                            <h5>Skills</h5>
                        </div>
                        </a>
                    </li>
                    <li class="{{$step == 7 || $step == 8 ? 'active center' : ''}}">
                        <a href=" @if(Auth::user()->step_reached>=7 || Auth::user()->step_reached>=8) {{ url('/candidate/references')}} @endif">
                        <div class="outr-points">
                            <div class="point-wrap"><span style="background: {{ $current_step < $step && $step > 8 ? 'rgba(229, 220, 237)' : '' }};">5</span></div>
                            <h5>References
& About Me</h5>
                        </div>
                        </a>
                    </li>
                    <li class="{{$step == 9 ? 'active center' : ''}}">
                        <a href="@if(Auth::user()->step_reached>=9) {{ url('/candidate/approval')}} @endif">
                        <div class="outr-points">
                            <div class="point-wrap"><span style="background: {{ $current_step < $step && $step > 9 ? 'rgba(229, 220, 237)' : '' }};">6</span></div>
                            <h5>Approval</h5>
                        </div>
                        </a>
                    </li>
                </ul>
