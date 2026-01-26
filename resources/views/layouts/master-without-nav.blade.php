<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-topbar="light">

    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name') }} | @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="PBS" />
        <meta name="author" content="PBS" />
        @php
            $favicon = url('assets/images/favicon.jpeg');
        @endphp
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ $favicon }}">
            @include('layouts.head-css')
    </head>

    @yield('body')

    @yield('content')

    @include('layouts.vendor-scripts')
    </body>
</html>
