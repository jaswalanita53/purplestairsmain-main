<header class="main-head">
  {{-- {{  Route::currentRouteName() }} --}}
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand me-auto" href="{{url('/')}}">
                <img src="{{asset("assets/fe/images/new_logo.svg")}}" alt="" />
            </a>
            <style>
                .rotate-180 {
                    transform: rotate(180deg);
                }

                .hdr-rgt .dropdown-item .download-btn i {
                    margin-right: 14px;
                }

{{-- task  86a1krd01--}}
                @media only screen and (min-width:992px) and (max-width:1200px){
                    .hdr-rgt {
                    margin-left: 5px;
                    }
                    .navbar-nav > li {
                        margin: 0 7px;
                    }
                }
{{-- task  86a1krd01--}}                
            </style>

    @if (!request()->is('login', 'signup-select'))
    <button class="navbar-toggler navbar-toggler-main order-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <!-- <span class="navbar-toggler-icon"></span> -->
        <span class="stick"></span>
    </button>
@endif


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <span class="stick"></span>
                </button>
                @if(!Auth::check())
                @if (!Route::is('signupselect') && !Route::is('login') && !Route::is('register')  && !Route::is('employer.login') )
                <ul class="navbar-nav ms-auto">
                    <li class="{{ Route::is('welcome') ? 'current-menu-item' : '' }}"><a href="{{route('welcome')}}">Home</a></li>
                    <li class="{{ Route::is('mission') ? 'current-menu-item' : '' }}"><a href="{{route("mission")}}">Our Mission</a></li>
                    {{-- task 86a1krd5n --}}
                    <li class="{{ Route::is('features') ? 'current-menu-item' : '' }}"><a href="{{route('faq')}}">FAQ</a></li>
                     {{-- task 86a1krd5n --}}
                    <li class="{{ Route::is('pricing') ? 'current-menu-item' : '' }}"><a href="{{route("pricing")}}"> Employer Pricing</a></li>
                    <li class="{{ Route::is('features') ? 'current-menu-item' : '' }}"><a href="{{route("features")}}">Features</a></li>
                    <li class="mobile-li"> <a href="{{route("login")}}" class="btn hdr-btn hdr-bn2"  href="{{route('login')}}">Login<span><img src="{{asset("assets/fe/images/log.svg")}}" alt="" /></span></a></li>
                    <li class="mobile-li"> <a href="{{route("signupselect")}}" class="btn hdr-btn">Sign Up<span><img src="{{asset("assets/fe/images/btn-img.svg")}}" alt="" /></span></a></li>
                </ul>
                @endif
                @else
                        <ul class="navbar-nav ms-auto navbar-nav-sidebar" aria-labelledby="dropdownMenuButton2" data-popper-placement="bottom-end">
<li>
                                <span class="avatar-img px-2">

                                        @if(Auth::user()->profile_photo_path)
                                            @if(Auth::user()->isEmployer())
                                            <img src="{{asset(Auth::user()->profile_photo_path)}}" alt="" width="50px" height="50px" style="border-radius:50%" />
                                            @else
                                                @if(Auth::user()->personal->profile_status)
                                                <img src="{{asset(Auth::user()->profile_photo_path)}}" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                @else
                                                <img src="{{asset('/assets/be/images/masked_ic.png')}}" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                @endif
                                            @endif
                                        @else
                                        @if(!empty(Auth::user()->personal->profile_status))
                                        @if(Auth::user()->personal->profile_status)
                                                <img src="{{asset('assets/fe/images/default_user.png')}}" alt="" />
                                                @else
                                                <img src="{{asset('/assets/be/images/masked_ic.png')}}" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                @endif
                                                @else
                                        <img src="{{asset('assets/fe/images/default_user.png')}}" alt="" />
                                        @endif
                                        @endif

                                    </span>
                                    <span class="user-name">
                                        {{Auth::user()->name}}
                                    </span>
                                    <hr/>
                                    </li>
                                    @if(Auth::user()->isEmployer())
                                    <li class="{{ Route::is('candidates.requests') ? 'current-menu-item' : '' }}">
                                        <a class="dropdown-item" href="{{ route('company.dashboard') }}">
                                            <span class="download-btn">
                                                <img src="{{ asset('assets/be/images/new_dash_icon2.svg') }}" alt="" /> My Dashboard
                                            </span>
                                        </a>
                                    </li>
                                    @endif
                                    @if(Auth::user()->isCandidate())
                                    <li class="{{ Route::is('candidateProfile') ? 'current-menu-item' : '' }}">
                                        <a class="dropdown-item" href="{{route('candidateProfile')}}">
                                            <span class="download-btn">
                                                <img src="{{asset('assets/fe/images/user-profile-18.png')}}" alt="" width="18" /> My Profile
                                            </span>
                                        </a>
                                    </li>

                                    <li class="unmaskReq @if(Auth::user()->status==0) d-none @endif {{ Route::is('candidates.requests') ? 'current-menu-item' : '' }}" >
                                        <a class="dropdown-item" href="{{ route('candidates.requests') }}">
                                            <span class="download-btn">
                                                <i class="fa fa-eye"></i> Employer Requests
                                            </span>
                                        </a>
                                    </li>

                                    <!-- <li>
                      <a class="dropdown-item" href="{{route('candidates.editpersonal')}}">
                        <span class="download-btn">
                          <img src="{{asset('assets/fe/images/dp1.svg')}}" alt="" />Edit My Profile
                        </span>
                      </a>
                    </li> -->
                                    @endif
                                    <li class="{{ Route::is('account.resetpassword') ? 'current-menu-item' : '' }} {{ Route::is('account.delete') ? 'current-menu-item' : '' }} {{ Route::is('account.sleep') ? 'current-menu-item' : '' }}">
                                        <a class="dropdown-item {{Auth::user()->isEmployer() ? 'dropdown-item-custom-menu' : ''}}" @if(Auth::user()->isEmployer()) data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"@endif @if(Auth::user()->isCandidate()) href="{{ route('candidates.manageaccount') }}" @endif>
                                            <span class="download-btn">
                                                <img src="{{asset('assets/fe/images/dp2.svg')}}" alt="" />
                                                {{-- task - 86a28zyzx --}}
                                                @if(Auth::user()->isCandidate())
                                                    Manage My Account
                                                @else
                                                    Account Settings
                                                    <em><img class="arrow-img-dd" src="{{asset('assets/fe/images/dp-arrw.svg')}}" alt="" /></em>
                                                @endif
                                                {{-- task - 86a28zyzx end --}}
                                            </span>

                                        </a>

                                        <div class="collapse custom-collapse-menu" id="collapseExample">
                                            <ul class="sub-drop">
                                                {{-- task - 86a28zyzx --}}
                                                @if(Auth::user()->isEmployer())
                                                    <li><a href="{{route('company.editprofile')}}">Edit Profile</a></li>
                                                    @if(empty(auth()->user()->reference))
                                                    <li><a href="{{route('company.manage.subsciption')}}">Manage Subscription</a></li>
                                                    <li><a href="{{route('company.paymenthistory')}}">Payment History</a></li>
                                                    @endif
                                                    <li><a href="{{route('company.manageaccount')}}">Manage Account</a></li>
                                                @endif
                                                {{-- task - 86a28zyzx end --}}
                                                {{-- @if(Auth::user()->provider_id == '')

                                                <li class="{{ Route::is('account.resetpassword') ? 'current-menu-item' : '' }}"><a href="{{route('account.resetpassword')}}"> Reset Password</a></li>
                                                @endif
                                                <li class="{{ Route::is('account.delete') ? 'current-menu-item' : '' }}"><a href="{{route('account.delete')}}"> Delete My Account</a></li>
                                                <li class="{{ Route::is('account.sleep') ? 'current-menu-item' : '' }}"><a href="{{route('account.sleep')}}"> Put Account To Sleep</a></li> --}}
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            <span class="download-btn">
                                                <img src="{{asset('assets/fe/images/dp3.svg')}}" alt="" /> Log Out
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                @endif
            </div>
            @if (!Route::is('signupselect') && !Route::is('login') && !Route::is('register') && !Auth::check() && !Route::is('employer.login') && !Route::is('employer.signup'))
            <div class="hdr-rgt">
                <a href="{{route('login')}}" class="btn hdr-btn hdr-bn2">Login<span><img src="{{asset("assets/fe/images/log.svg")}}" alt="" /></span></a>
                <a href="{{route("signupselect")}}" class="btn hdr-btn">Sign Up<span><img src="{{asset("assets/fe/images/btn-img.svg")}}" alt="" /></span></a>
            </div>
            @endif

            @if(Auth::check() && !Route::is('verification.notice'))
            <div class="hdr-rgt hdr-rgt2 order-1">
                <div class="header-list">
                    <ul class="notification_list">
                        <li class="middle-icon-one">
                            <div class="dropdown avatar-dropdown">
                                <button class="btn btn-secondary dropdown-toggle d-none d-lg-flex" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="true">
                                    <span class="avatar-img ">

                                        @if(Auth::user()->profile_photo_path)
                                            @if(Auth::user()->isEmployer())
                                            <img src="{{asset(Auth::user()->profile_photo_path)}}" alt="" width="50px" height="50px" style="border-radius:50%" />
                                            @else
                                                @if(Auth::user()->personal->profile_status)
                                                <img src="{{asset(Auth::user()->profile_photo_path)}}" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                @else
                                                <img src="{{asset('/assets/be/images/masked_ic.png')}}" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                @endif
                                            @endif
                                        @else
                                        @if(!empty(Auth::user()->personal->profile_status))
                                        @if(Auth::user()->personal->profile_status)
                                                <img src="{{asset('assets/fe/images/default_user.png')}}" alt="" />
                                                @else
                                                <img src="{{asset('/assets/be/images/masked_ic.png')}}" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                @endif
                                                @else
                                        <img src="{{asset('assets/fe/images/default_user.png')}}" alt="" />
                                        @endif
                                        @endif

                                    </span>
                                    <span class="user-name">
                                        {{Auth::user()->name}}
                                    </span>
                                    <hr/>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2" data-popper-placement="bottom-end">
                                <li>
                                {{-- <span class="avatar-img px-2">

                                        @if(Auth::user()->profile_photo_path)
                                            @if(Auth::user()->isEmployer())
                                            <img src="{{asset(Auth::user()->profile_photo_path)}}" alt="" width="50px" height="50px" style="border-radius:50%" />
                                            @else
                                                @if(Auth::user()->personal->profile_status)
                                                <img src="{{asset(Auth::user()->profile_photo_path)}}" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                @else
                                                <img src="{{asset('/assets/be/images/masked_ic.png')}}" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                @endif
                                            @endif
                                        @else
                                        @if(!empty(Auth::user()->personal->profile_status))
                                        @if(Auth::user()->personal->profile_status)
                                                <img src="{{asset('assets/fe/images/default_user.png')}}" alt="" />
                                                @else
                                                <img src="{{asset('/assets/be/images/masked_ic.png')}}" alt="" width="50px" height="50px" style="border-radius:50%" />
                                                @endif
                                                @else
                                        <img src="{{asset('assets/fe/images/default_user.png')}}" alt="" />
                                        @endif
                                        @endif

                                    </span>
                                    <span class="user-name">
                                        {{Auth::user()->name}}
                                    </span>
                                    <hr/> --}}
                                    </li>
                                    @if(Auth::user()->isEmployer())
                                    <li>
                                        <a class="dropdown-item" href="{{ route('company.dashboard') }}">
                                            <span class="download-btn">
                                                <img src="{{ asset('assets/be/images/new_dash_icon2.svg') }}" alt="" />My Dashboard
                                            </span>
                                        </a>
                                    </li>
                                    @endif
                                    @if(Auth::user()->isCandidate())
                                    <li>
                                        <a class="dropdown-item" href="{{route('candidateProfile')}}">
                                            <span class="download-btn">
                                                <img src="{{asset('assets/fe/images/user-profile-18.png')}}" alt="" width="18" />My Profile
                                            </span>
                                        </a>
                                    </li>

                                    <li class="unmaskReq @if(Auth::user()->status==0) d-none @endif" >
                                        <a class="dropdown-item" href="{{ route('candidates.requests') }}">
                                            <span class="download-btn">
                                                <i class="fa fa-eye"></i> Employer Requests
                                            </span>
                                        </a>
                                    </li>

                                    <!-- <li>
                      <a class="dropdown-item" href="{{route('candidates.editpersonal')}}">
                        <span class="download-btn">
                          <img src="{{asset('assets/fe/images/dp1.svg')}}" alt="" />Edit My Profile
                        </span>
                      </a>
                    </li> -->
                                    @endif
                                    <li class="">
                                        <a class="dropdown-item {{Auth::user()->isEmployer() ? 'dropdown-item-custom-menu' : ''}}" @if(Auth::user()->isEmployer()) data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"@endif @if(Auth::user()->isCandidate()) href="{{ route('candidates.manageaccount') }}" @endif>
                                            <span class="download-btn">
                                                <img src="{{asset('assets/fe/images/dp2.svg')}}" alt="" />
                                                {{-- task - 86a28zyzx --}}
                                                @if(Auth::user()->isCandidate())
                                                    Manage My Account
                                                @else
                                                    Account Settings
                                                    <em><img class="arrow-img-dd" src="{{asset('assets/fe/images/dp-arrw.svg')}}" alt="" /></em>
                                                @endif
                                                {{-- task - 86a28zyzx end --}}
                                            </span>

                                        </a>

                                        <div class="collapse custom-collapse-menu" id="collapseExample">
                                            <ul class="sub-drop">
                                                {{-- task - 86a28zyzx --}}
                                                @if(Auth::user()->isCandidate())
                                                    @if(Auth::user()->provider_id == '')
                                                    <li><a href="{{route('account.resetpassword')}}">Reset Password</a></li>
                                                    @endif
                                                    <li><a href="{{route('account.delete')}}">Delete My Account</a></li>
                                                    <li><a href="{{route('account.sleep')}}">Put Account To Sleep</a></li>
                                                @else
                                                    <li><a href="{{route('company.editprofile')}}">Edit Profile</a></li>
                                                    @if(empty(auth()->user()->reference))
                                                    <li><a href="{{route('company.manage.subsciption')}}">Manage Subscription</a></li>
                                                    <li><a href="{{route('company.paymenthistory')}}">Payment History</a></li>
                                                    @endif
                                                    <li><a href="{{route('company.manageaccount')}}">Manage Account</a></li>
                                                @endif
                                                {{-- task - 86a28zyzx end --}}
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            <span class="download-btn">
                                                <img src="{{asset('assets/fe/images/dp3.svg')}}" alt="" />Log Out
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            @livewire('request-count')
            @endif
        </nav>
    </div>

    <button class="navbar-toggler" id="navoverlay" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"></button>
</header>





@push('scripts')
<script type="module">
    $(document).ready(function() {
        $('.dropdown-item-custom-menu').click(function() {
            $('.custom-collapse-menu').toggleClass('show');
            $('.arrow-img-dd').toggleClass('rotate-180');
            return false;
        });
    });
</script>
@endpush
