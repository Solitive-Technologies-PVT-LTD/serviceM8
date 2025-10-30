@extends('layouts.app')

@section('title', 'Dashboard - Tom\'s Pest Control')

@section('header-action')
    <a href="{{ route('logout') }}" class="border-2 border-gray-800 hover:bg-gray-800 hover:text-white text-gray-800 font-medium px-6 py-2 rounded transition">
        LOG OUT
    </a>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('sites.select') }}" class="text-toms-green hover:underline mb-4 inline-block">← Back to Sites</a>
        <h2 class="text-4xl font-bold text-gray-900">Welcome to Tom's Pest Control client portal</h2>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Left Column - Service History and Upcoming Jobs -->
        <div class="md:col-span-2 space-y-8">
            <!-- Service History -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">SERVICE HISTORY</h3>
                <div class="space-y-4">
                    @php
                    $serviceHistory = [
                        ['id' => 1, 'date' => 'May 18, 2024', 'service' => 'General Pest Control', 'status' => 'Completed'],
                        ['id' => 2, 'date' => 'March 23, 2024', 'service' => 'Termite Inspection', 'status' => 'Completed'],
                        ['id' => 3, 'date' => 'January 10, 2024', 'service' => 'Rodent Control', 'status' => 'Completed'],
                    ];
                    @endphp

                    @foreach($serviceHistory as $service)
                    <a href="{{ route('service.detail', ['id' => $service['id']]) }}" 
                       class="block bg-white rounded-lg p-5 shadow hover:shadow-md transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-900 font-medium mb-1">{{ $service['date'] }}</p>
                                <p class="text-gray-700 text-lg">{{ $service['service'] }}</p>
                            </div>
                            <div>
                                <span class="bg-toms-green text-white px-4 py-2 rounded text-sm font-medium">
                                    {{ $service['status'] }}
                                </span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Column - Upcoming Jobs and Quick Actions -->
        <div class="space-y-8">
            <!-- Upcoming Jobs -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">UPCOMING JOBS</h3>
                <div class="bg-white rounded-lg p-6 shadow">
                    <p class="text-gray-900 font-medium mb-1">June 25, 2024</p>
                    <p class="text-gray-700 text-lg mb-3">General Pest Control</p>
                    <span class="bg-blue-900 text-white px-4 py-2 rounded text-sm font-medium inline-block">
                        Scheduled
                    </span>
                </div>
            </div>

            <!-- Quick Actions -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">QUICK ACTIONS</h3>
                <div class="space-y-3">
                    <a href="{{ route('quote.request') }}" 
                       class="block bg-toms-green hover:bg-green-700 text-white text-center font-medium py-3 rounded transition">
                        Request Quote
                    </a>
                    <a href="{{ route('invoices') }}" 
                       class="block bg-toms-green hover:bg-green-700 text-white text-center font-medium py-3 rounded transition">
                        View Invoices
                    </a>
                    <a href="{{ route('site.documentation') }}" 
                       class="block bg-toms-green hover:bg-green-700 text-white text-center font-medium py-3 rounded transition">
                        Site Documentation
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="block bg-toms-green hover:bg-green-700 text-white text-center font-medium py-3 rounded transition">
                        Contact Information
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


