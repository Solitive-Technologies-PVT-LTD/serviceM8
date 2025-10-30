@extends('layouts.app')

@section('title', 'Site Documentation - Tom\'s Pest Control')

@section('header-action')
    <a href="{{ route('logout') }}" class="border-2 border-gray-800 hover:bg-gray-800 hover:text-white text-gray-800 font-medium px-6 py-2 rounded transition">
        LOG OUT
    </a>
@endsection

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-toms-green hover:underline">← Back to Dashboard</a>
    </div>

    <h2 class="text-3xl font-bold text-gray-900 mb-8">Site Documentation</h2>

    <div class="grid md:grid-cols-2 gap-6">
        @php
        $folders = [
            ['name' => 'Service Reports', 'description' => 'All service reports for this site'],
            ['name' => 'Invoices', 'description' => 'Invoice history and payment records'],
            ['name' => 'Audits', 'description' => 'Site audit reports and assessments'],
            ['name' => 'Safety Data Sheets', 'description' => 'Chemical safety information'],
            ['name' => 'Labels', 'description' => 'Product labels and specifications'],
            ['name' => 'Onsite Documents', 'description' => 'Site-specific documentation'],
            ['name' => 'Site Maps', 'description' => 'Property layouts and treatment zones'],
            ['name' => 'Site Specifications', 'description' => 'Technical specifications'],
            ['name' => 'Licenses and Insurances', 'description' => 'Current licenses and insurance certificates'],
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
                    <p class="text-sm text-gray-600">{{ $folder['description'] }}</p>
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


