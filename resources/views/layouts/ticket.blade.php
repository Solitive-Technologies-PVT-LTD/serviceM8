<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    @php
        if(empty(get_setting('company_logo')))
        {
            $favicon = url('/assets//images/khazanapk-logo.png');
        }
        else{
            $favicon = url('/assets/storage/'.get_setting('company_logo'));
        }
    @endphp
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ $favicon }}">
    <!-- Site Title -->
    <title>{{'CMS - '.get_setting("app_name")}}@yield('pagetitle')</title>
    
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ $favicon }}">
    @include('layouts.head-css')
</head>

@section('body')
    @include('layouts.body')
@show
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.ticket-topbar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="loaderWrapper d-none">
            <div class="loaderContent">
                <span class="dot"></span>
                <div class="dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <h2 class="text-below-loader appendMovingDots"></h2>
        </div>
        <div class="main-content" style="margin-left: 0px !important">
            <div class="page-content" style="padding-top:25px;">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.ticket-footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    @include('layouts.customizer')

    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')
</body>

</html>
