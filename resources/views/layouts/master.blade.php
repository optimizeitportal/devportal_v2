<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | Optimize it</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="OptimizeIT Solutions" name="description" />
    <meta content="optimizeit" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    @include('layouts.head-css')
    <script>document.documentElement.setAttribute("data-bs-theme", "dark");</script>
</head>

@section('body')
    <body data-sidebar="dark" data-layout-mode="light" >
@show
    <!-- Begin page -->
    <div id="layout-wrapper">
        <div id="preloader" style="display: none">
            <div id="loader"></div>
            <div class="timer"></div>
            <div id="loader_text" style="display: none">
                <h6></h6>
                <span style="--i:1">.</span>
                <span style="--i:2">.</span>
                <span style="--i:3">.</span>
            </div>
        </div>
        @include('layouts.topbar')
        @include('layouts.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('layouts.right-sidebar')
    <!-- /Right-bar -->

    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')
   
</body>

</html>
