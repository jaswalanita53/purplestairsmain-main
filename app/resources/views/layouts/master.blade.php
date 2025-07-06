<!DOCTYPE html>
<html lang="en" class="{{ session('sidebar') }}">

<head>
    @if(!Request::is('company/dashboard'))
    {{-- itercom --}}
        <script>
            /*window.intercomSettings = {
                api_base: "https://api-iam.intercom.io",
                app_id: "h6hfo7lg---",
                @if (Auth::user())
                    name: "{{ Auth::user()->name }}", // Full name
                    email: "{{ Auth::user()->email }}", // Email address
                    created_at: "{{ Auth::user()->created_at }}" // Signup date as a Unix timestamp
                @else
                    name: "Guest", // Full name
                @endif


            };*/
        </script>

        <script>
            // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/h6hfo7lg'
            /*(function() {
                var w = window;
                var ic = w.Intercom;
                if (typeof ic === "function") {
                    ic('reattach_activator');
                    ic('update', w.intercomSettings);
                } else {
                    var d = document;
                    var i = function() {
                        i.c(arguments);
                    };
                    i.q = [];
                    i.c = function(args) {
                        i.q.push(args);
                    };
                    w.Intercom = i;
                    var l = function() {
                        var s = d.createElement('script');
                        s.type = 'text/javascript';
                        s.async = true;
                        s.src = 'https://widget.intercom.io/widget/h6hfo7lg---';
                        var x = d.getElementsByTagName('script')[0];
                        x.parentNode.insertBefore(s, x);
                    };
                    if (document.readyState === 'complete') {
                        l();
                    } else if (w.attachEvent) {
                        w.attachEvent('onload', l);
                    } else {
                        w.addEventListener('load', l, false);
                    }
                }
            })();*/
        </script>
    {{-- itercom --}}
    @endif

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Purple Stairs</title>

    <!-- fabicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/fe/images/fav.png') }}" />
    <!-- All CSS -->

    <!-- fontawesome -->

    {{-- remove un-neccesory <link rel="stylesheet" href="{{asset('assets/be/css/all.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/be/css/brands.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/be/css/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/be/css/regular.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/be/css/solid.css')}}" /> --}}
    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @if(!Request::is('company/saved-search/*'))
    <link rel="stylesheet" href="{{asset('assets/be/css/jquery-ui.css')}}" />
    @endif
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css" /> --}}
    <link rel="stylesheet" href="{{asset('assets/be/css/slick.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/be/css/slick-theme.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/be/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="{{asset('assets/be/style.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/be/css/jquery.fancybox.min.css')}}" />
    <script src="{{asset('assets/be/js/jquery-3.5.1.min.js')}}"></script>
    <style>
        .listview_candidate_details_w .candidate_grid_ppl_icn {
            z-index: auto;
        }

        span.avatar-img img {
            /* width: 50px; */
            /* height: 50px; */
        }
    </style>

    {{-- task - 86a0h5v68 --}}
    <style type="text/css">
        @media print {
             html,
             body {
                display: none;
             }
          }
        html {
         user-select: none;
      }
    </style>
    {{-- task - 86a0h5v68 end --}}

    {{-- task - 86a1jb99z --}}
    <script type="text/javascript">
        /*(function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "jz3b0cewzh");*/

        /*(function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "ju019kl5j7");*/
    </script>
    {{-- task - 86a1jb99z end --}}

    <script type="text/javascript">
        var b_url_ = '{{ url('') }}';
    </script>

    @stack('styles')
    @livewireStyles
</head>

<body class="{{ session('sidebar')?session('sidebar'):'sidebar_extended' }} ">
    <!-- GRADIENT SPINNER -->
    {{-- task - 862k46f3v --}}
    <div id="overlay" style="display: none;"><span class="loader"></span></div>

    <div class="c-body">
        @include('inc.sidebar')
        <div class="c-right">
            <div class="right-panel-main">
                @include('inc.headbar')

                @yield('content')
            </div>
        </div>
    </div>
    <div class="c_overlay"></div>

    <!-- Jquery-->
    <script src="{{asset('assets/be/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/be/js/slick.min.js')}}"></script>
    {{-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> --}}
    @if(!Request::is('company/saved-search/*'))
    <script src="{{asset('assets/be/js/jquery-ui.js')}}"></script>
    @endif
    {{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> --}}

    <script src="{{asset('assets/be/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('assets/be/js/select2.full.js')}}"></script>
    
    {{-- @if(Request::is('company/dashboard') || Request::is('company/saved-search/*') || Request::is('company/saved-searches') || Request::is('company/archived-search/*') || Request::is('company/archived-searches') || Request::is('company/manage-subsciption'))
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.full.js"></script>
    @else
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endif --}}
    <script src="{{asset('assets/be/js/filters.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.js"></script>
<script>
    var asset_url="{{asset('assets/be/js/filters.js')}}";
    {{-- 86a2yxuh3 --}}
    var activeCardId=0;

</script>
    <script src="{{asset('assets/be/js/common.js')}}"></script>
    {{-- task - 86a0h5v68 --}}
    <script type="text/javascript">
        $(document).on('keyup', function (e) {
            if(e.key == "PrintScreen") {
                navigator.clipboard.writeText('');
                return false;
            }
            // console.log(e.key);
        });
    </script>
    {{-- task - 86a0h5v68 end --}}

    @stack('scripts')
    @livewireScripts

    <script>
         $(document).ready(function (e) {

        // $('body, html').removeClass('sidebar_show');
    });
    </script>
</body>

</html>
