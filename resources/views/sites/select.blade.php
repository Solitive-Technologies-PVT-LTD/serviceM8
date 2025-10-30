@extends('layouts.app')

@section('title', 'Select a Site - Tom\'s Pest Control')

@section('header-action')
    <a href="{{ route('logout') }}" class="border-2 border-gray-800 hover:bg-gray-800 hover:text-white text-gray-800 font-medium px-6 py-2 rounded transition">
        LOG OUT
    </a>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-4xl font-bold text-gray-900 mb-8">Select a Site</h2>

    <div class="space-y-4">
        @php
        $sites = [
            ['id' => 1, 'address' => '123 Main Street', 'city' => 'Anytown, CA'],
            ['id' => 2, 'address' => '456 Elm Street', 'city' => 'Othertown, CA'],
            ['id' => 3, 'address' => '789 Oak Avenue', 'city' => 'Melbourne, VIC'],
        ];
        @endphp

        @foreach($sites as $site)
        <a href="{{ route('dashboard', ['site' => $site['id']]) }}" 
           class="block bg-gray-100 hover:bg-gray-200 rounded-lg p-6 transition group">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ $site['address'] }}</h3>
                    <p class="text-gray-600">{{ $site['city'] }}</p>
                </div>
                <div>
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection


