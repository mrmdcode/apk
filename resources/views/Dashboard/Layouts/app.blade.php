<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>@yield('title')</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- morris css -->
{{--    <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/morris/morris.css')}}">--}}

    <link href="{{asset("assets/dashboard/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/dashboard/css/icons.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/dashboard/css/style.css")}}" rel="stylesheet" type="text/css"/>
{{--    <link href="{{asset('\assets\dashboard\plugins\leaflet\leaflet.css')}}"/>--}}
    @yield("css")

</head>


<body class="fixed-left">

<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>
</div>

<!-- Begin page -->
<div id="wrapper">

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
            <i class="mdi mdi-close"></i>
        </button>

        <div class="left-side-logo d-block d-lg-none">
            <div class="text-center">

                <a href="#" class="logo"><img src="assets/images/logo_dark.png" height="20" alt="logo"></a>
            </div>
        </div>

        <div class="sidebar-inner slimscrollleft">

            @include("Dashboard.Layouts._partial._menu")
            <div class="clearfix"></div>
        </div> <!-- end sidebarinner -->
    </div>
    <!-- Left Sidebar End -->

    <!-- Start right Content here -->

    <div class="content-page">
        <!-- Start content -->
        <div class="content">

            <!-- Top Bar Start -->
            @include("Dashboard.Layouts._partial._topMenu")
            <!-- Top Bar End -->

            <div class="page-content-wrapper ">

                <div class="container-fluid pt-1">

                    @yield("content")

                </div><!-- container fluid -->

            </div> <!-- Page content Wrapper -->

        </div> <!-- content -->

        <footer class="footer">
            <span>Created by <a href="https://mrmdcode.ir">MrMDCode</a> and Feri</span>
        </footer>

    </div>
    <!-- End Right content here -->

</div>
<!-- END wrapper -->


<!-- jQuery  -->
<script src="{{asset("assets/dashboard/js/jquery.min.js")}}"></script>
<script src="{{asset("assets/dashboard/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("assets/dashboard/js/modernizr.min.js")}}"></script>
<script src="{{asset("assets/dashboard/js/detect.js")}}"></script>
<script src="{{asset("assets/dashboard/js/fastclick.js")}}"></script>
<script src="{{asset("assets/dashboard/js/jquery.slimscroll.js")}}"></script>
<script src="{{asset("assets/dashboard/js/jquery.blockUI.js")}}"></script>
<script src="{{asset("assets/dashboard/js/waves.js")}}"></script>
<script src="{{asset("assets/dashboard/js/jquery.nicescroll.js")}}"></script>
<script src="{{asset("assets/dashboard/js/jquery.scrollTo.min.js")}}"></script>

<!--Morris Chart-->
<script src="{{asset("assets/dashboard/plugins/morris/morris.min.js")}}"></script>
<script src="{{asset("assets/dashboard/plugins/raphael/raphael.min.js")}}"></script>

<!-- dashboard js -->
<script src="{{asset("assets/dashboard/pages/dashboard.int.js")}}"></script>

<!-- App js -->
<script src="{{asset("assets/dashboard/js/app.js")}}"></script>
@yield("js")

</body>

</html>
