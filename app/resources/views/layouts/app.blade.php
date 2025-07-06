<!DOCTYPE html>
<html lang="en">

<head>

    <script type="text/javascript" src="https://secure.inventive52intuitive.com/js/789514.js"></script>
    <noscript><img src="https://secure.inventive52intuitive.com/789514.png" style="display:none;" /></noscript>


    {{-- itercom --}}
        <script>
           /*window.intercomSettings = {
                api_base: "https://api-iam.intercom.io",
                app_id: "h6hfo7lg",
                {{-- @if (Auth::user())
                    name: "{{ Auth::user()->name }}", // Full name
                    email: "{{ Auth::user()->email }}", // Email address
                    created_at: "{{ Auth::user()->created_at }}" // Signup date as a Unix timestamp
                @else
                    name: "Guest", // Full name
                @endif --}}


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
                        s.src = 'https://widget.intercom.io/widget/h6hfo7lg';
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


    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Purple Stairs</title>

    <!-- fabicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/fe/images/fav.png') }}" />
    <!-- All CSS -->

    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/fe/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fe/css/brands.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fe/css/fontawesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fe/css/regular.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fe/css/solid.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/fe/css/slick.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fe/css/slick-theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fe/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fe/css/easy-responsive-tabs.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/fe/style.css') }}" />
    <script src="{{ asset('assets/fe/js/jquery-3.5.1.min.js') }}"></script>

    {{-- task - 86a1jb99z --}}
    <script type="text/javascript">
        /*(function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "jz3b0cewzh");*/
    </script>
    {{-- task - 86a1jb99z end --}}

    @stack('styles')
    @livewireStyles

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
</head>

<body>
    @include('inc.header')
    <div id="app">
        @yield('content')
    </div>
    @if (!Route::is('candidates.requests'))
        @include('inc.footer')
    @endif
    <!-- Jquery-->
    <script src="{{ asset('assets/fe/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/fe/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/fe/js/easyResponsiveTabs.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/fe/js/common.js') }}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-EHHG8VB2PL"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-EHHG8VB2PL');
    </script>
    <script type="text/javascript">
        /*(function(c, l, a, r, i, t, y) {
            c[a] = c[a] || function() {
                (c[a].q = c[a].q || []).push(arguments)
            };
            t = l.createElement(r);
            t.async = 1;
            t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "ju019kl5j7");*/

        /*(function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "ju019kl5j7");*/
    </script>
    {{-- task - 86a0h5v68 --}}
    <script type="text/javascript">
        $(document).on('keyup', function(e) {
            if (e.key == "PrintScreen") {
                navigator.clipboard.writeText('');
                return false;
            }
            // console.log(e.key);
        });
    </script>
    {{-- task - 86a0h5v68 end --}}
    @yield('js')
    @stack('scripts')
    @livewireScripts
</body>

</html>
