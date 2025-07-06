<div class="c-left">
    <div class="left-panel-main new_h">
        <div class="top-logo1">
            <a href="{{url('/')}}" class="logo">
                <img src="{{ asset('assets/be/images/folded-p.svg') }}" alt="" class="logo_for_small_bar" />
                <img src="{{ asset('assets/be/images/new_log.svg') }}" alt="" class="default_logo" />
            </a>

            <button class="menu_toggle mbl">
                <img src="{{ asset('assets/be/images/left-arrw.svg') }}" alt="" class="arrow-left"/>
            </button>


        </div>

        <div class="left-menu">
            <ul class="sidebar-nav ms-auto">

                 @if(Request::is('company/archived-search/*') || Request::is('company/archived-searches'))
                    @livewire('archives')
                @else
                    @livewire('searches')
                @endif
                <!-- <li class="left-menu-one11">
                    <a href="{ { route('company.savedsearches') }}" class="left-menu-one">
                        <span class="menu-icon"><img src="{ { asset('assets/be/images/new_dash_icon1.svg') }}" alt="" /></span>
                        <em>My Searches</em></a>



                </li>

                <li class="left-menu-one11">
                    <a href="{ { route('company.archivedsearches') }}" class="left-menu-one">
                        <span class="menu-icon"><img src="{ { asset('assets/be/images/new_dash_icon3.svg') }}" alt="" /></span>
                        <em>Archived Searches</em></a>
                </li> -->
            </ul>

            <div class="float_menu">
                <ul class="sidebar-nav ms-auto sidebar-nav-bottom">
                    @if(auth()->user()->reference > 0)
                     {{-- <li class="left-menu-one11">
                        <a href="{{ route('company.editprofile') }}" class="left-menu-one">
                            <span class="menu-icon"><img src="{ { asset('assets/be/images/user_icon.svg') }}" alt="" /></span>
                            <em>Edit Profile </em></a>
                    </li> --}}
                    <li class="left-menu-one11">
                        <a href="{{ route('company.manageaccount') }}" class="left-menu-one">
                            <span class="menu-icon"><img src="{{ asset('assets/be/images/dp2_yellow.svg') }}" alt="" /></span>
                            <em>Manage Account </em></a>
                    </li>
                    @else
                    <li class="left-menu-one11">
                        <a href="{{ route('company.editprofile') }}" class="left-menu-one">
                            <span class="menu-icon">
                                <img src="{{ asset('assets/be/images/user_icon.svg') }}" alt="" />
                            </span>
                            <em>Edit Profile </em></a>
                    </li>
                    <li class="left-menu-one11">
                        <a href="{{ route('company.manage.subsciption') }}" class="left-menu-one">
                            <span class="menu-icon">
                                <img src="{{ asset('assets/be/images/settings_icon.svg') }}" alt="" />
                            </span>
                            <em> Manage Subscription </em></a>
                    </li>
                    {{-- task - 86a28zyzx --}}
                    <li class="left-menu-one11">
                        <a href="{{ route('company.paymenthistory') }}" class="left-menu-one">
                            <span class="menu-icon"><img src="{{ asset('assets/be/images/dollar.svg') }}" alt="" /></span>
                            <em>Payment History </em></a>
                    </li>
                    <li class="left-menu-one11">
                        <a href="{{ route('company.manageaccount') }}" class="left-menu-one">
                            <span class="menu-icon"><img src="{{ asset('assets/be/images/dp2_yellow.svg') }}" alt="" /></span>
                            <em>Manage Account </em></a>
                    </li>
                    {{-- task - 86a28zyzx end --}}
                    @endif
                    <li class="left-menu-one11">
                        <a href="#url" class="left-menu-one logoutBtn">
                            <span class="menu-icon"><img src="{{ asset('assets/be/images/logout.svg') }}" alt="" /></span>
                            <em>Log Out</em></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
  div#swal2-html-container {

    margin-bottom: 23px !important;

}
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $('.menu_toggle').click(function(e) {
        alert();
    });


    $("body").delegate(".logoutBtn", "click", function(e) {
    Swal.fire({
    // title: "Opting out of this section causes you to appear as an entry-level candidate. To avoid this without revealing your position, add your information and select the hide option.",
    text: 'Are you sure you want to log out?',
    icon: 'warning',
    iconHtml: "<img src='{{ asset('assets/fe/images/warning.png') }}'>",
    showCancelButton: true,
    confirmButtonColor: '#7E50A7',
    cancelButtonColor: '#4A2D64',
    confirmButtonText: 'Yes',
    cancelButtonText: 'No',
    showCloseButton: true,
    }).then((result) => {
    if (result.isConfirmed) {
    $('#logout-form').submit();
    } else {
    return false;
    }
    });
    });
</script>
