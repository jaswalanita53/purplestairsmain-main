<div class="sidebar-nav ms-auto">
  <style>
    .sidebar_extended .show-on-sidebar-open {
      display: flex;
    }
    .sidebar_extended .show-on-sidebar-close {
      display: none;
    }
    .sidebar_show .show-on-sidebar-open {
      display: none;
    }
    .sidebar_show .show-on-sidebar-close {
      display: flex;
    }
    .seacrh-name-left {
      text-wrap: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      padding-right: 0px !important;
    }
  </style>

  {{-- remove font awesome css --}}
  {{-- <script src="https://use.fontawesome.com/e1fdc7929b.js"></script> --}}

  <livewire:update-request-count />

  <li class="left-menu-one11 search-sub-menu {{ Route::is('company.dashboard') ? 'active current-menu-item-' : '' }}">
    <a href="{{ route('company.dashboard') }}" class="left-menu-one">
      <span class="menu-icon">
        {{-- <img src="{{ asset('assets/be/images/new_dash_icon1.svg') }}" alt="" /> --}}
        <i class="fa fa-users" aria-hidden="true"></i>
      </span>
      <em>All Candidates</em>
    </a>
  </li>

  <li class="left-menu-one11
      @if(Request::is('company/saved-searches')) active current-menu-item-
      @elseif(Request::is('company/saved-search/*')) active current-menu-item-
      @else inactive @endif">
    <a href="{{ route('company.savedsearches') }}" class="left-menu-one">
      <span class="menu-icon">
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
      </span>
      <em>My Searches</em>
    </a>
    <ul class="menu-sub search-sub-menu" id="content_2">
      @foreach ($searches as $search)


        @if($search['deleted_at'] == '')
          @if(!empty($search['slug']))
            <li>
              <a href="{{route('company.savedsearch',$search['slug'])}}" class="submenu-innner">
                @php
                  //$searchName=str_replace(' ', '-', strtolower($search['name']));
                  $slug = 'company/saved-search/'.$search['slug']; // 86a0h5r7c
                @endphp
                {{-- //86a2zt9nn new match --}}
                <span class="submenu-innner-lft text-capitalize seacrh-name-left
                    @if(Request::is($slug)) active @endif"
                    data-toggle="tooltip"
                    title="{{ $search['name'] }}">
                  {{ $search['name'] }}
                </span>
                <span class="submenu-innner-rght d-flex-">
                  <span class="notificate_number">{{ count($search['searchUser']) }}</span>
                  @if(count($search['newMatch']) > 0)
                    <span class="notificate_total">{{ count($search['newMatch']) }} NEW</span>
                  @endif
                </span>
              </a>
            </li>
          @endif
        @endif
      @endforeach
    </ul>
  </li>

  <li class="left-menu-one11
      @if(Request::is('company/archived-searches')) active current-menu-item-
      @elseif(Request::is('company/archived-search/*')) current-menu-item- active
      @else inactive @endif">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <a href="{{ url('/company/archived-searches') }}"
        class="show-on-sidebar-close left-menu-one archived-collapse">
      <span class="menu-icon toggle-coll">
        <img src="{{ asset('assets/be/images/new_dash_icon3.svg') }}" alt=""/>
      </span>
    </a>
    <a data-toggle="collapse" href="#collapseExample" role="button"
        @if(Request::is('company/archived-search/*') || Request::is('company/archived-searches'))
          aria-expanded="true"
        @else
          aria-expanded="false"
        @endif
        aria-controls="collapseExample"
        class="left-menu-one archived-collapse show-on-sidebar-open">
      <span class="menu-icon toggle-coll">
        <img src="{{ asset('assets/be/images/new_dash_icon3.svg') }}" alt=""/>
      </span>
      <em>Archived Searches</em>
    </a>
    <span class="collapse @if(Request::is('company/archived-search/*') || Request::is('company/archived-searches')) show @endif"
        id="collapseExample">
      <ul class="side-bar-ul">
        <li class="m-0 p-0 all-archived-pist-btn
            @if(Request::is('company/archived-searches')) active @endif">
          <a class="archived-list" href="{{ route('company.archivedsearches') }}">
            <em class="m-0 p-0">View All Archived Searches</em>
          </a>
        </li>
      </ul>
      <ul class="menu-sub archive-sub-menu">
        {{-- <li><a class="archived-list" data-url="{{ route('company.archivedsearches') }}">
              <span class="menu-icon">
                <img src="{{ asset('assets/be/images/new_dash_icon1.svg') }}" alt=""/>
              </span>
              <em>View All Archived Searches</em>
            </a>
        </li> --}}
        @foreach ($searches as $search)
         @if($search['deleted_at'] != '')
            @php
              //$searchName=str_replace(' ', '-', strtolower($search['name']));
              $slug = 'company/archived-search/'.$search['slug']; //86a0h5r7c
            @endphp
            <li>
              <a href="{{route('company.archivedsearch',$search['slug'])}}" class="submenu-innner">
                <span class="submenu-innner-lft text-capitalize seacrh-name-left
                    @if(Request::is($slug)) active @endif"
                    data-toggle="tooltip"
                    title="{{ $search['name'] }}">
                  {{ $search['name'] }}
                </span>
                <span class="submenu-innner-rght d-flex-">
                  <span class="notificate_number">{{ count($search['searchUser']) }}</span>
                  @if(count($search['newMatch']) > 0)
                    <span class="notificate_total">{{ count($search['newMatch']) }} NEW</span>
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

<script type="text/javascript" src="{{ asset('assets/be/js/scrollbar.js') }}"></script>
<script>
  $("body").delegate(".toggle-coll", "click", function(e) {
    if ($('body').hasClass('sidebar_show')) {
      window.location.href = "{{ url('/company/archived-searches') }}";
    }
  });

  // task - 86a2p90gy
  // $(function() {
    if (!$('body').hasClass('sidebar_show')) { // task - 86a2tey15
      setTimeout(function(){
        $("#content_2").css('overflow', 'auto');
        $("#content_2").mCustomScrollbar({
          scrollButtons: {
            enable: false
          },
          theme: "dark",
          scrollInertia: 3000
        });
      }, 50);
    }
  // });
</script>
<script>
  $(document).ready(function() {
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
