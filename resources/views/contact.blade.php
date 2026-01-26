@extends('layouts.app')

@section('title', 'Contact Information - Tom\'s Pest Control')

@section('header-action')
    <a href="{{ route('logout') }}" class="border-2 border-gray-800 hover:bg-gray-800 hover:text-white text-gray-800 font-medium px-6 py-2 rounded transition">
        LOG OUT
    </a>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-toms-green hover:underline">← Back to Dashboard</a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Contact Information</h2>

        <div class="space-y-6">
            <div class="border-b pb-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Business/Trading Name</h3>
                <p class="text-lg text-gray-900">Tom's Pest Control Pty Ltd</p>
            </div>

            <div class="border-b pb-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">ABN</h3>
                <p class="text-lg text-gray-900">27 640 970 734</p>
            </div>

            <div class="border-b pb-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Main Line</h3>
                <p class="text-lg text-gray-900">
                    <a href="tel:1300866773" class="text-toms-green hover:underline">1300 866 773</a>
                </p>
            </div>

            <div class="border-b pb-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Commercial Mobile</h3>
                <p class="text-lg text-gray-900">
                    <a href="tel:0488886023" class="text-toms-green hover:underline">0488 886 023</a>
                </p>
            </div>

            <div class="border-b pb-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Main Email</h3>
                <p class="text-lg text-gray-900">
                    <a href="mailto:office@tomspestcontrol.com.au" class="text-toms-green hover:underline">office@tomspestcontrol.com.au</a>
                </p>
            </div>

            <div class="border-b pb-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Commercial Email</h3>
                <p class="text-lg text-gray-900">
                    <a href="mailto:commercial@tomspestcontrol.com.au" class="text-toms-green hover:underline">commercial@tomspestcontrol.com.au</a>
                </p>
            </div>

            <div class="border-b pb-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Finance Email</h3>
                <p class="text-lg text-gray-900">
                    <a href="mailto:finance@tomspestcontrol.com.au" class="text-toms-green hover:underline">finance@tomspestcontrol.com.au</a>
                </p>
            </div>

            <div class="border-b pb-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Head Office</h3>
                <p class="text-lg text-gray-900">42 Bendigo Street, Prahran, VIC 3181</p>
            </div>

            <div class="border-b pb-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Company Director</h3>
                <p class="text-lg text-gray-900">Paul Cederman</p>
            </div>

            <div class="border-b pb-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Commercial Manager</h3>
                <p class="text-lg text-gray-900">Jesse Liles</p>
            </div>

            <div class="pb-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Finance Manager</h3>
                <p class="text-lg text-gray-900">Crystal Bratton</p>
            </div>
        </div>
    </div>
</div>
@endsection




