<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />

    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Pignose Calender -->
    <link href="{{asset('template_admin/plugins/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{asset('template_admin/plugins/chartist/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{asset('template_admin/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css')}}">
    <!-- Custom Stylesheet -->
    <link href="{{asset('template_admin/css/style.css')}}" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
        ********************-->
        <div id="preloader">
            <div class="loader">
                <svg class="circular" viewBox="25 25 50 50">
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
                </svg>
            </div>
        </div>
    <!--*******************
        Preloader end
        ********************-->


    <!--**********************************
        Main wrapper start
        ***********************************-->
        <div id="main-wrapper">

        <!--**********************************
            Nav header start
            ***********************************-->
            <div class="nav-header">
                <div class="brand-logo">
                    <a href="index.html">
                        <b class="logo-abbr"><img src="{{asset('template_admin/images/logo.png')}}" alt=""> </b>
                        <span class="logo-compact"><img src="{{asset('template_admin/images/logo-compact.png')}}" alt=""></span>
                        <span class="brand-title">
                            <img src="{{asset('template_admin/images/logo-text.png')}}" alt="">
                        </span>
                    </a>
                </div>
            </div>
        <!--**********************************
            Nav header end
            ***********************************-->

        <!--**********************************
            Header start
            ***********************************-->
            @include('layouts_admin.header')
        <!--**********************************
            Header end ti-comment-alt
            ***********************************-->

        <!--**********************************
            Sidebar start
            ***********************************-->
            @include('layouts_admin.sidebar')
        <!--**********************************
            Sidebar end
            ***********************************-->

        <!--**********************************
            Content body start
            ***********************************-->
            <div class="content-body">

                <div class="container-fluid mt-3">
                    @yield('contents')
                </div>
                <!-- #/ container -->
            </div>
        <!--**********************************
            Content body end
            ***********************************-->


        <!--**********************************
            Footer start
            ***********************************-->
            @include('layouts_admin.footer')
        <!--**********************************
            Footer end
            ***********************************-->
        </div>
    <!--**********************************
        Main wrapper end
        ***********************************-->

    <!--**********************************
        Scripts
        ***********************************-->
        <script src="{{asset('template_admin/plugins/common/common.min.js')}}"></script>
        <script src="{{asset('template_admin/js/custom.min.js')}}"></script>
        <script src="{{asset('template_admin/js/settings.js')}}"></script>
        <script src="{{asset('template_admin/js/gleek.js')}}"></script>
        <script src="{{asset('template_admin/js/styleSwitcher.js')}}"></script>

        <!-- Chartjs -->
        <script src="{{asset('template_admin/plugins/chart.js/Chart.bundle.min.js')}}"></script>
        <!-- Circle progress -->
        <script src="{{asset('template_admin/plugins/circle-progress/circle-progress.min.js')}}"></script>
        <!-- Datamap -->
        <script src="{{asset('template_admin/plugins/d3v3/index.js')}}"></script>
        <script src="{{asset('template_admin/plugins/topojson/topojson.min.js')}}"></script>
        <script src="{{asset('template_admin/plugins/datamaps/datamaps.world.min.js')}}"></script>
        <!-- Morrisjs -->
        <script src="{{asset('template_admin/plugins/raphael/raphael.min.js')}}"></script>
        <script src="{{asset('template_admin/plugins/morris/morris.min.js')}}"></script>
        <!-- Pignose Calender -->
        <script src="{{asset('template_admin/plugins/moment/moment.min.js')}}"></script>
        <script src="{{asset('template_admin/plugins/pg-calendar/js/pignose.calendar.min.js')}}"></script>
        <!-- ChartistJS -->
        <script src="{{asset('template_admin/plugins/chartist/js/chartist.min.js')}}"></script>
        <script src="{{asset('template_admin/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js')}}"></script>



        <script src="{{asset('template_admin/js/dashboard/dashboard-1.js')}}"></script>

    </body>

    </html>
