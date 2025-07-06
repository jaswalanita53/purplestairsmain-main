<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
{{-- code formatted for 86a2bf326 --}}
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('assets/backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/backend/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('assets/backend/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/backend/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('assets/backend/dist/css/skins/_all-skins.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('assets/backend/bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('assets/backend/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet"
        href="{{ asset('assets/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet"
        href="{{ asset('assets/backend/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet"
        href="{{ asset('assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>Purple</b>Stairs</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Purple</b>Stairs</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('assets/backend/dist/img/user.png') }}" class="user-image"
                                    alt="User Image">
                                <span class="hidden-xs"> Admin</span>
                            </a>
                            <ul class="dropdown-menu">

                                <!-- User image -->

                                <!-- Menu Body -->

                                <!-- Menu Footer-->
                                <li class="user-footer">

                                    <div class="pull-right">
                                        <a href="{{ route('admin.logout') }}"
                                            onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"
                                            class="btn btn-default btn-flat"> {{ __('Sign out') }}</a>
                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->

                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ asset('assets/backend/dist/img/user.png') }}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>Admin</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }} treeview">
                        <a href="{{ URL('admin/dashboard') }}">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>

                        </a>

                    </li>
                    <li
                        class="{{ request()->is('industries') ? 'active' : '' }}{{ request()->is('industries/add') ? 'active' : '' }}{{ request()->is('areaInterest') ? 'active' : '' }}{{ request()->is('areaInterest/add') ? 'active' : '' }} treeview">
                        <a href="#">
                            <i class="fa fa-shopping-bag"></i>
                            <span>Position Preferences</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li
                                class="{{ request()->is('industries') ? 'active' : '' }}{{ request()->is('industries/add') ? 'active' : '' }}">
                                <a
                                    href="{{ URL('industries') }}{{ request()->is('industries/add') ? 'active' : '' }}"><i
                                        class="fa fa-circle-o"></i> Industries</a>
                            </li>
                            <li
                                class="{{ request()->is('areaInterest') ? 'active' : '' }}{{ request()->is('areaInterest/add') ? 'active' : '' }}">
                                <a
                                    href="{{ URL('areaInterest') }}{{ request()->is('areaInterest/add') ? 'active' : '' }}"><i
                                        class="fa fa-circle-o"></i> Area of Interest</a>
                            </li>

                        </ul>
                    </li>
                    <li
                        class="{{ request()->is('languages') ? 'active' : '' }}{{ request()->is('languages/add') ? 'active' : '' }}{{ request()->is('hardSkills') ? 'active' : '' }}{{ request()->is('hardSkills/add') ? 'active' : '' }}{{ request()->is('softSkills') ? 'active' : '' }}{{ request()->is('softSkills/add') ? 'active' : '' }} treeview">
                        <a href="#">
                            <i class="fa fa-shopping-bag"></i>
                            <span>Skills</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li
                                class="{{ request()->is('hardSkills') ? 'active' : '' }}{{ request()->is('hardSkills/add') ? 'active' : '' }}">
                                <a
                                    href="{{ URL('hardSkills') }}{{ request()->is('hardSkills/add') ? 'active' : '' }}"><i
                                        class="fa fa-circle-o"></i> Hard Skills</a>
                            </li>
                            <li
                                class="{{ request()->is('softSkills') ? 'active' : '' }}{{ request()->is('softSkills/add') ? 'active' : '' }}">
                                <a
                                    href="{{ URL('softSkills') }}{{ request()->is('softSkills/add') ? 'active' : '' }}"><i
                                        class="fa fa-circle-o"></i> Soft Skills</a>
                            </li>
                            <li
                                class="{{ request()->is('languages') ? 'active' : '' }}{{ request()->is('languages/add') ? 'active' : '' }}">
                                <a href="{{ URL('languages') }}{{ request()->is('languages/add') ? 'active' : '' }}"><i
                                        class="fa fa-circle-o"></i> Languages</a>
                            </li>

                        </ul>
                    </li>

                    <li
                        class="{{ Route::is('admin.discount') || Route::is('admin.discount.add') || Route::is('admin.discount.edit') ? 'active' : '' }}">
                        <a href="{{ route('admin.discount') }}">
                            <i class="fa fa-diamond"></i> <span>Discounts</span>
                        </a>
                    </li>

                    <li
                        class="{{ Route::is('admin.employers') || Route::is('admin.employers.view') || Route::is('admin.candidates') || Route::is('admin.candidates.delete') || Route::is('admin.candidates.view') || Route::is('admin.candidates.add') || Route::is('admin.candidates.store') || Route::is('admin.candidates.edit') || Route::is('admin.candidates.update') ? 'active' : '' }}

                        {{ Route::is('admin.abandoned.users') || Route::is('admin.sleep_account') || Route::is('admin.sleep_account_candidate') || Route::is('admin.deleted_account') || Route::is('admin.deleted_account_candidate') ? 'active' : '' }} treeview">
                        <a href="#">
                            <i class="fa fa-shopping-bag"></i>
                            <span>Users</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu"
                            style="display : {{ Route::is('admin.employers') || Route::is('admin.abandoned.users') || Route::is('admin.sleep_account') || Route::is('admin.sleep_account_candidate') || Route::is('admin.deleted_account') || Route::is('admin.deleted_account_candidate') ? 'block' : 'none' }}">
                            <li
                                class="{{ Route::is('admin.employers') || Route::is('admin.employers.view') ? 'active' : '' }}">
                                <a href="{{ route('admin.employers') }}">
                                    <i class="fa fa-user"></i> Employers
                                </a>
                            </li>

                            {{-- task - 86a1fwwdq --}}
                            <li
                                class="{{ Route::is('admin.candidates') || Route::is('admin.candidates.delete') || Route::is('admin.candidates.view') || Route::is('admin.candidates.add') || Route::is('admin.candidates.store') || Route::is('admin.candidates.edit') || Route::is('admin.candidates.update') ? 'active' : '' }}">
                                <a href="{{ route('admin.candidates') }}">
                                    <i class="fa fa-user"></i> Candidates
                                </a>
                            </li>
                            {{-- Task #86a2qw2e1 --}}
                            <li class="{{ Route::is('admin.invited.users') ? 'active' : '' }}">
                                <a href="{{ route('admin.invited.users') }}">
                                    <i class="fa fa-user-times" aria-hidden="true"></i> <span>Invited Users</span>
                                </a>
                            </li>
                            {{-- 86a2qw2e1 --}}
                            {{-- Task #862k5c5t1 --}}
                            <li class="{{ Route::is('admin.abandoned.users') ? 'active' : '' }}">
                                <a href="{{ route('admin.abandoned.users') }}">
                                    <i class="fa fa-user-times" aria-hidden="true"></i> <span>Abandoned Users</span>
                                </a>
                            </li>

                            {{-- task - 86a0unpr7 --}}
                            {{-- <li class="{{ Route::is('admin.sleep_account') ? 'active' : '' }}">
                                <a href="{{ route('admin.sleep_account') }}">
                                    <i class="fa fa-circle-o"></i> Sleep Accounts
                                </a>
                            </li> --}}

                            {{-- task - 86a17a78z --}}
                            {{-- <li class="{{ (Route::is('admin.deleted_account')) ? 'active' : '' }}">
              <a href="{{ route('admin.deleted_account') }}">
                <i class="fa fa-circle-o"></i> Deleted Accounts
              </a>
            </li> --}}
                            {{-- 86a2bf326 --}}
                            <li
                                class="{{ Route::is('admin.sleep_account') || Route::is('admin.sleep_account_candidate') ? 'active' : '' }} treeview">
                                <a href="#">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Sleep Accounts</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu"
                                    style="display : {{ Route::is('admin.sleep_account') ? 'block' : 'none' }}">
                                    <li class="{{ Route::is('admin.sleep_account') ? 'active' : '' }}">
                                        <a href="{{ route('admin.sleep_account') }}">
                                            <i class="fa fa-user"></i> Employer Sleep A/Cs
                                        </a>
                                    </li>
                                    <li class="{{ Route::is('admin.sleep_account_candidate') ? 'active' : '' }}">
                                        <a href="{{ route('admin.sleep_account_candidate') }}">
                                            <i class="fa fa-user"></i> Candidate Sleep A/Cs
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li
                                class="{{ Route::is('admin.employers') || Route::is('admin.deleted_account') || Route::is('admin.deleted_account_candidate') ? 'active' : '' }} treeview">
                                <a href="{{ route('admin.deleted_account') }}">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Deleted Accounts</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu"
                                    style="display : {{ Route::is('admin.deleted_account_candidate') ? 'block' : 'none' }}">
                                    <li class="{{ Route::is('admin.deleted_account') ? 'active' : '' }}">
                                        <a href="{{ route('admin.deleted_account') }}">
                                            <i class="fa fa-user"></i> Employer Deleted A/Cs
                                        </a>
                                    </li>
                                    <li class="{{ Route::is('admin.deleted_account_candidate') ? 'active' : '' }}">
                                        <a href="{{ route('admin.deleted_account_candidate') }}">
                                            <i class="fa fa-user"></i> Candidate Deleted A/Cs
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ route('backup.downloadCurrent') }}" download>
                            <i class="fa fa-download" aria-hidden="true"></i> <span>Download Backup</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manage.zipCode') }}" >
                            <i class="fa fa-map-pin" aria-hidden="true"></i> <span>Manage Zipcodes</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2023 <a href=""></a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- pdf-->
    <script src="{{ asset('assets/backend/bower_components/jquery/dist/jspdf.min.js') }}"></script>
    <script src="{{ asset('assets/backend/bower_components/jquery/dist/html2canvas.js') }}"></script>
    <!-- jQuery 3 -->
    <script src="{{ asset('assets/backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/backend/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('assets/backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Morris.js charts -->
    <script src="{{ asset('assets/backend/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/backend/bower_components/morris.js/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets/backend/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('assets/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets/backend/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/backend/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/backend/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('assets/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <!-- Select2 -->
    <script src="{{ asset('assets/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('assets/backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/backend/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/backend/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/backend/dist/js/demo.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('assets/backend/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {
                'placeholder': 'mm/dd/yyyy'
            })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }
            var today = mm + '/' + dd + '/' + yyyy;
            $('#reservation').daterangepicker({
                minDate: today
            })

            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                format: 'MM/DD/YYYY h:mm A'
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                        'MMMM D, YYYY'))
                }
            )

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })


        })
    </script>
</body>

</html>
