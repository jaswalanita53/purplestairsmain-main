<div class="sidebar-nav ms-auto">
<style>
.sidebar_extended .show-on-sidebar-open{
display:flex;
}
.sidebar_extended .show-on-sidebar-close{
display:none;
}

.sidebar_show .show-on-sidebar-open{
display:none;
}
.sidebar_show .show-on-sidebar-close{
display:flex;
}

.seacrh-name-left{
    text-wrap: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding-right:0px !important;
}
</style>
{{-- remove font awesome css --}}
{{-- <script src=" https://use.fontawesome.com/e1fdc7929b.js"></script> --}}

<livewire:update-request-count />

<li class="left-menu-one11 search-sub-menu {{ Route::is('company.dashboard') ? 'active current-menu-item-' : '' }}">
    <a href="{{ route('company.dashboard') }}" class="left-menu-one">
        <span class="menu-icon">
            {{-- <img src="{{ asset('assets/be/images/new_dash_icon1.svg') }}" alt="" /> --}}
            <i class="fa fa-users" aria-hidden="true"></i>
        </span><em>All
            Candidates</em>
    </a>
</li>


<li class="left-menu-one11 @if(Request::is('company/saved-searches')) active current-menu-item- @elseif(Request::is('company/saved-search/*')) active current-menu-item- @else inactive @endif">
    <a href="{{ route('company.savedsearches') }}" class="left-menu-one">
        <span class="menu-icon"><i class="fa fa-floppy-o" aria-hidden="true"></i></span>
        <em>My Searches</em></a>
    <ul class="menu-sub search-sub-menu " id="content_2">
        @foreach ($side_searches as $search)
        @if($search['status']=='Active')
        @if(!empty($search['slug']))
        <li>
            <a href="{{route('company.savedsearch',$search['slug'])}}" class="submenu-innner">
                @php
                //$searchName=str_replace(' ', '-', strtolower($search['name']));

                $slug='company/saved-search/'.$search['slug']; // 86a0h5r7c
                @endphp
                {{-- //86a2zt9nn new match --}}
                <span
                    class="submenu-innner-lft text-capitalize seacrh-name-left @if(Request::is($slug)) active @endif"
                    data-toggle="tooltip"
                    title="{{ $search['name'] }}"
                >
                    {{$search['name']}}
                </span>
                <span class="submenu-innner-rght d-flex- ">
                    <span class="notificate_number">{{$search['match_count']}}</span>
                    @if(count($search['newMatch']) > 0)
                    <span class="notificate_total">{{count($search['newMatch'])}} NEW</span>
                    @endif
                </span>
            </a>
        </li>
        @endif
        @endif
        @endforeach
    </ul>
</li>
<li class="left-menu-one11  @if(Request::is('company/archived-searches')) active current-menu-item- @elseif(Request::is('company/archived-search/*')) current-menu-item- active @else inactive @endif">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- <a href="{ { route('company.archivedsearches')}}" class="left-menu-one"> -->
    <a  href="{{url('/company/archived-searches')}}" class="show-on-sidebar-close left-menu-one  archived-collapse">
        <span class="menu-icon toggle-coll">
            {{-- <img src="{{ asset('assets/be/images/new_dash_icon3.svg') }}" alt=""/> --}}
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.2884 6.62109C19.1149 6.38387 14.983 0.8125 9.70577 0.8125C4.42854 0.8125 0.296409 6.38387 0.123181 6.62086C-0.0410604 6.84592 -0.0410604 7.15116 0.123181 7.37622C0.296409 7.61344 4.42854 13.1848 9.70577 13.1848C14.983 13.1848 19.1149 7.6134 19.2884 7.37641C19.4528 7.15139 19.4528 6.84592 19.2884 6.62109ZM9.70577 11.9049C5.81852 11.9049 2.45176 8.20709 1.45512 6.99822C2.45047 5.78828 5.81018 2.09239 9.70577 2.09239C13.5928 2.09239 16.9594 5.78957 17.9564 6.99909C16.9611 8.20899 13.6014 11.9049 9.70577 11.9049Z" fill="#FFAE1A"/>
                <path d="M9.70493 3.15918C7.58776 3.15918 5.86523 4.88171 5.86523 6.99888C5.86523 9.11605 7.58776 10.8386 9.70493 10.8386C11.8221 10.8386 13.5446 9.11605 13.5446 6.99888C13.5446 4.88171 11.8221 3.15918 9.70493 3.15918ZM9.70493 9.55865C8.29341 9.55865 7.14516 8.41037 7.14516 6.99888C7.14516 5.58739 8.29345 4.4391 9.70493 4.4391C11.1164 4.4391 12.2647 5.58739 12.2647 6.99888C12.2647 8.41037 11.1165 9.55865 9.70493 9.55865Z" fill="#FFAE1A"/>
            </svg>

        </span>
</a>

    <a data-toggle="collapse" href="#collapseExample" role="button" @if( Request::is('company/archived-search/*') || Request::is('company/archived-searches')) aria-expanded="true" @else aria-expanded="false" @endif  aria-controls="collapseExample" class="left-menu-one archived-collapse show-on-sidebar-open">
        <span class="menu-icon toggle-coll">
            {{-- <img src="{{ asset('assets/be/images/new_dash_icon3.svg') }}" alt="" /> --}}
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.2884 6.62109C19.1149 6.38387 14.983 0.8125 9.70577 0.8125C4.42854 0.8125 0.296409 6.38387 0.123181 6.62086C-0.0410604 6.84592 -0.0410604 7.15116 0.123181 7.37622C0.296409 7.61344 4.42854 13.1848 9.70577 13.1848C14.983 13.1848 19.1149 7.6134 19.2884 7.37641C19.4528 7.15139 19.4528 6.84592 19.2884 6.62109ZM9.70577 11.9049C5.81852 11.9049 2.45176 8.20709 1.45512 6.99822C2.45047 5.78828 5.81018 2.09239 9.70577 2.09239C13.5928 2.09239 16.9594 5.78957 17.9564 6.99909C16.9611 8.20899 13.6014 11.9049 9.70577 11.9049Z" fill="#FFAE1A"/>
                <path d="M9.70493 3.15918C7.58776 3.15918 5.86523 4.88171 5.86523 6.99888C5.86523 9.11605 7.58776 10.8386 9.70493 10.8386C11.8221 10.8386 13.5446 9.11605 13.5446 6.99888C13.5446 4.88171 11.8221 3.15918 9.70493 3.15918ZM9.70493 9.55865C8.29341 9.55865 7.14516 8.41037 7.14516 6.99888C7.14516 5.58739 8.29345 4.4391 9.70493 4.4391C11.1164 4.4391 12.2647 5.58739 12.2647 6.99888C12.2647 8.41037 11.1165 9.55865 9.70493 9.55865Z" fill="#FFAE1A"/>
            </svg>
        </span>
        <em >Archived Searches</em>
           </a>
    <span class="collapse @if(Request::is('company/archived-search/*') || Request::is('company/archived-searches')) show  @endif" id="collapseExample">
    <ul class="side-bar-ul">
        <li class="m-0 p-0 all-archived-pist-btn @if(Request::is('company/archived-searches')) active @endif" ><a class="archived-list" href="{{ route('company.archivedsearches')}}"><em class="m-0 p-0">View All Archived Searches</em></a></li>
    </ul>
        <ul class="menu-sub archive-sub-menu">
        <!-- <li><a class="archived-list" data-url="{ { route('company.archivedsearches')}}"><span class="menu-icon"><img src="{ { asset('assets/be/images/new_dash_icon1.svg') }}" alt="" /></span><em >View All Archived Searches</em></a></li> -->
            @foreach ($side_searches as $search)
            @if(!empty($search['status']=='Archive'))
            @php
            //$searchName=str_replace(' ', '-', strtolower($search['name']));
            $slug='company/archived-search/'.$search['slug']; //86a0h5r7c
            @endphp
            <li>
                <a href="{{route('company.archivedsearch',$search['slug'])}}" class="submenu-innner">
                    <span
                    class="submenu-innner-lft text-capitalize seacrh-name-left @if(Request::is($slug)) active @endif"
                    data-toggle="tooltip"
                    title="{{ $search['name'] }}"
                >
                    {{$search['name']}}
                </span>
                    <span class="submenu-innner-rght d-flex- ">
                        <span class="notificate_number">{{$search['match_count']}}</span>
                        @if($search['new_match_count'] > 0)
                        <span class="notificate_total">{{$search['new_match_count']}} NEW</span>
                        @endif
                    </span>
                </a>
            </li>
            @endif
            @endforeach
        </ul>
    </span>
</li>
</div>
<script type="text/javascript" src="{{ asset("assets/be/js/scrollbar.js") }}"></script>
<script>
    $("body").delegate(".toggle-coll", "click", function(e) {
        if ($('body').hasClass('sidebar_show')) {
            window.location.href = "{{url('/company/archived-searches')}}"
        }
    });

    // task - 86a2p90gy
    // $(function() {
        if(!$('body').hasClass('sidebar_show')) { // task - 86a2tey15
            setTimeout(function(){
                $("#content_2").css('overflow','auto');
                $("#content_2").mCustomScrollbar({
                    scrollButtons:{
                        enable:false
                    },
                    theme:"dark",
                     scrollInertia: 3000
                });
            }, 50);
        }
    // });
</script>
<script>
  $(document).ready(function(){
    $('.seacrh-name-left').each(function() {
      var $this = $(this);
      if (this.scrollWidth > this.clientWidth) {
        $this.tooltip(); // Initialize tooltip if text is truncated
      } else {
        $this.removeAttr('title'); // Remove title attribute if text is not truncated
      }
    });
  });
</script>
