@extends('layouts.app')

@section('title', 'Tom\'s Pest Control Client Portal')

@section('header-action')
    <a href="{{ route('login') }}" class="bg-toms-green hover:bg-green-700 text-white font-medium px-6 py-3 rounded inline-flex items-center transition">
        CLIENT LOGIN →
    </a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="text-center mb-12">
        <h2 class="text-5xl font-bold mb-4">
            <span class="text-toms-green">TOM'S PEST</span><br>
            <span class="text-gray-900">CONTROL</span>
        </h2>
        <p class="text-2xl text-gray-700">Welcome to Tom's Pest Control client portal</p>
    </div>

    <!-- Universal Documentation Section -->
    <div class="bg-white rounded-lg shadow-md p-8 hover:shadow-lg transition">
        <div class="flex items-center">
            <div class="mr-6">
                <svg class="w-24 h-24 text-toms-green" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-3xl font-bold text-gray-900 mb-3">UNIVERSAL DOCUMENTATION</h3>
                <p class="text-gray-600 text-lg">View and download licences, insurances, and SDS's</p>
                <a href="{{ route('universal-docs') }}" class="inline-block mt-4 text-toms-green font-medium hover:underline">
                    Browse Documents →
                </a>
            </div>
        </div>
    </div>

    <!-- Accreditation Logos Section -->
    <div class="mt-12">
        <h3 class="text-center text-xl font-semibold text-gray-700 mb-6">Our Accreditations</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <!-- Placeholder for accreditation logos -->
            <div class="bg-white p-4 rounded-lg shadow flex items-center justify-center h-24">
                <span class="text-gray-400 text-xs text-center">Accreditation Logo</span>
            </div>
            <div class="bg-white p-4 rounded-lg shadow flex items-center justify-center h-24">
                <span class="text-gray-400 text-xs text-center">Accreditation Logo</span>
            </div>
            <div class="bg-white p-4 rounded-lg shadow flex items-center justify-center h-24">
                <span class="text-gray-400 text-xs text-center">Accreditation Logo</span>
            </div>
            <div class="bg-white p-4 rounded-lg shadow flex items-center justify-center h-24">
                <span class="text-gray-400 text-xs text-center">Accreditation Logo</span>
            </div>
        </div>
    </div>
</div>
@endsection


