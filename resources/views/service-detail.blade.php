@extends('layouts.app')

@section('title', 'Service Details - Tom\'s Pest Control')

@section('header-action')
    <a href="{{ route('login') }}" class="bg-toms-green hover:bg-green-700 text-white font-medium px-6 py-3 rounded inline-flex items-center transition">
        CLIENT LOGIN →
    </a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-toms-green hover:underline">← Back to Dashboard</a>
    </div>

    <h2 class="text-3xl font-bold text-gray-900 mb-2">General Pest Control</h2>

    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-1">Date</h3>
        <p class="text-gray-900">May 18, 2024</p>
    </div>

    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-700 mb-1">Job Details</h3>
        <p class="text-gray-900">General pest control for residential property</p>
    </div>

    <div>
        <h3 class="text-xl font-bold text-gray-900 mb-4">Attached Documents</h3>
        
        <div class="space-y-4">
            @php
            $documents = [
                ['name' => 'Service Report', 'icon' => 'document'],
                ['name' => 'Invoice', 'icon' => 'document'],
                ['name' => 'SDS', 'icon' => 'document'],
                ['name' => 'Map', 'icon' => 'document'],
            ];
            @endphp

            @foreach($documents as $document)
            <div class="bg-white rounded-lg p-6 shadow flex items-center justify-between hover:shadow-md transition">
                <div class="flex items-center">
                    <svg class="w-8 h-8 text-blue-900 mr-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-lg font-medium text-gray-900">{{ $document['name'] }}</span>
                </div>
                <button class="bg-toms-green hover:bg-green-700 text-white px-6 py-2 rounded font-medium transition">
                    Download
                </button>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection


