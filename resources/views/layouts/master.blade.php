<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PBS">
    <meta name="author" content="PBS">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    @php
        $favicon = url('assets/images/favicon.jpeg');
    @endphp

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ $favicon }}">
    <!-- Site Title -->
    <title>{{ config('app.name') }} | @yield('pagetitle')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @include('layouts.head-css')
</head>

@section('body')
    @include('layouts.body')
@show
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @include('layouts.sidebar')
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
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
                <div class="row">
                    <audio id="play_notif_add_info_sound" src="{{ URL::asset('/assets/play_sound/service_bell.wav') }}" autostart="0" volume="0.5"></audio>
                </div>
            </div>
            <!-- End Page-content -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    @include('layouts.customizer')

    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')

    <!--Alert start here-->
    @include('layouts.alert')
    <!--Alert End here-->
</body>

</html>
