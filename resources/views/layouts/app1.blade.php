<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tom\'s Pest Control Client Portal')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Tom's Pest Control" class="h-16" onerror="this.style.display='none'">
                <div class="ml-3">
                    <h1 class="text-xl font-semibold">
                        <span class="text-toms-green">TOM'S PEST</span>
                        <span class="text-gray-900">CONTROL</span>
                    </h1>
                </div>
            </div>
            <div>
                @yield('header-action')
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-white mt-12 py-6 border-t">
        <div class="container mx-auto px-4 text-center text-gray-600 text-sm">
            <p>&copy; {{ date('Y') }} Tom's Pest Control Pty Ltd. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>




