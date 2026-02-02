<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tom\'s Pest Control Client Portal')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
      @include('layouts.head-css')
</head>
<body class="bg-gray-50">
   <header class="bg-white shadow-sm">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">

        {{-- Logo --}}
        <div class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" alt="Tom's Pest Control" class="h-16" onerror="this.style.display='none'">
            <div class="ml-3">
                <h1 class="text-xl font-semibold">
                    <span class="text-toms-green">TOM'S PEST</span>
                    <span class="text-gray-900">CONTROL</span>
                </h1>
            </div>
        </div>

        {{-- Header Action + User --}}
        <div class="flex items-center space-x-4">

            {{-- Existing Header Action --}}
            <div>
                @yield('header-action')
            </div>

            {{-- User Dropdown - only show if logged in --}}
            @auth
            <div class="dropdown relative">
                <button class="flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-toms-green dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{-- Avatar --}}
                    <img src="{{ url('/assets/images/users/user-dummy-img.jpg') }}" class="h-8 w-8 rounded-full object-cover">
                    {{-- Name --}}
                    <span class="font-medium text-gray-700">{{ auth()->user()->name }}</span>
                </button>

                {{-- Dropdown menu --}}
                <ul class="dropdown-menu dropdown-menu-end mt-2 min-w-[160px] bg-white border border-gray-200 rounded shadow-lg p-1" aria-labelledby="userDropdown">
                  
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            @endauth

        </div>
    </div>
</header>



    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>
  @include('layouts.vendor-scripts')
    <footer class="bg-white mt-12 py-6 border-t">
        <div class="container mx-auto px-4 text-center text-gray-600 text-sm">
            <p>&copy; {{ date('Y') }} Tom's Pest Control Pty Ltd. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>




