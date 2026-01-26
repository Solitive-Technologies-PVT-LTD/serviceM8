<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="PBS" name="description" />
    <meta content="PBS" name="author" />
    @php
        if(empty(get_setting('company_favicon')))
        {
            $favicon = url('assets/images/favicon.png');
        }
        else{
            $favicon = url('/storage/'.get_setting('company_favicon'));
        }
    @endphp
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ $favicon }}">
    @include('layouts.head-css')
</head>

{{-- @section('body')
    @include('layouts.body')
@show --}}
<body data-topbar="light">

    <!-- Begin page -->
    <div id="layout-wrapper">
<body data-layout="horizontal">
        @include('layouts.topbar')
        @include('layouts.sidebar')
        @include('layouts.horizontal')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <!-- Start content -->
                <div class="container-fluid">
                    @yield('content')
                </div> <!-- content -->
            </div>
            @include('layouts.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    @include('layouts.customizer')
    <!-- END Right Sidebar -->

    @include('layouts.vendor-scripts')
</body>

</html>
