@extends('layouts.app')

@section('title', 'Universal Documentation - Tom\'s Pest Control')

@section('header-action')
    <a href="{{ route('login') }}" class="bg-toms-green hover:bg-green-700 text-white font-medium px-6 py-3 rounded inline-flex items-center transition">
        CLIENT LOGIN →
    </a>
@endsection

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('home') }}" class="text-toms-green hover:underline">← Back to Home</a>
    </div>

    <h2 class="text-3xl font-bold text-gray-900 mb-8">Universal Documentation</h2>

    <div class="grid md:grid-cols-2 gap-6">
        @php
        $folders = [
            ['name' => 'Tom\'s Pest Control Insurances/Licenses', 'hasSubfolders' => true, 'description' => 'State-specific licenses and insurance documents'],
            ['name' => 'Chemical Safety Data Sheets', 'hasSubfolders' => false, 'description' => 'Safety data sheets for all chemicals used'],
            ['name' => 'Chemical Labels', 'hasSubfolders' => false, 'description' => 'Product labels and usage information'],
            ['name' => 'Example Documents', 'hasSubfolders' => false, 'description' => 'Sample reports and documentation'],
            ['name' => 'Pest Sighting Report', 'hasSubfolders' => false, 'description' => 'Report forms for pest sightings'],
            ['name' => 'General Health and Safety Documents', 'hasSubfolders' => false, 'description' => 'Health and safety guidelines'],
            ['name' => 'Accreditations', 'hasSubfolders' => true, 'description' => 'State-specific accreditation certificates'],
        ];
        @endphp

        @foreach($folders as $folder)
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition cursor-pointer">
            <div class="flex items-start">
                <div class="mr-4">
                    <svg class="w-12 h-12 text-toms-green" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $folder['name'] }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $folder['description'] }}</p>
                    @if($folder['hasSubfolders'])
                    <span class="text-xs text-toms-green font-medium">Contains state subfolders</span>
                    @endif
                </div>
                <div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection


