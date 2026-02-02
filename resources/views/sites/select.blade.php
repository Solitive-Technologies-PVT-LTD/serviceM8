@extends('layouts.app1')

@section('css')
@include('layouts.datatable_css')
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-4xl font-bold text-gray-900 mb-8">Select a Site</h2>

    <div class="space-y-4">
        @foreach($clients as $client)
            @php
                // Convert multi-line address into a single line for display
                $formattedAddress = trim(preg_replace('/\s+/', ' ', $client['address']));
            @endphp

            <a href="{{ route('company.clientJobs', $client['uuid']) }}" 
               class="block bg-gray-100 hover:bg-gray-200 rounded-lg p-6 transition group">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ $client['name'] }}</h3>
                        <p class="text-gray-600">{{ $formattedAddress }}</p>
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
