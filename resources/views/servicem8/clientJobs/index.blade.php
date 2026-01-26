@extends('layouts.master')

@section('pagetitle')
    {{ $pagetitle }}
@endsection

@section('css')
    @include('layouts.datatable_css')
@endsection

@section('content')

@component('components.breadcrumb', [
    'breadcrumbs' => $breadcrumbs,
    'pagetitle' => $pagetitle,
    'urls' => $urls
])
@endcomponent

<div class="max-w-7xl mx-auto px-4">

    <!-- Header -->
    <div class="grid md:grid-cols-3 gap-3">

        <!-- LEFT: SERVICE HISTORY -->
        <div class="md:col-span-2">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">
                SERVICE HISTORY
            </h3>

            @forelse($completedJobs as $job)
               <a href="{{ route('servicem8.jobs.show', $job['uuid']) }}" 
                       class="block bg-white rounded-lg p-3 shadow hover:shadow-md transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-900 font-medium mb-1">{{ \Carbon\Carbon::parse($job['edit_date'])->format('M d, Y') }}</p>
                                <p class="text-gray-700 text-lg">{{$job['job_description']}}</p>
                            </div>
                            <div>
                                <span class="bg-toms-green text-white px-4 py-2 rounded text-sm font-medium">
                                     {{$job['status']}}
                                </span>
                            </div>
                        </div>
                    </a>
            
            @empty
                <div class="bg-white p-6 rounded shadow text-gray-500">
                    No completed jobs found.
                </div>
            @endforelse
        </div>

        <!-- RIGHT COLUMN -->
        <div class="space-y-8">

            <!-- UPCOMING JOBS -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">
                    UPCOMING JOBS
                </h3>

                @forelse($upcomingJobs as $job)
                    <div class="bg-white rounded-lg p-6 shadow mb-4">
                        <p class="text-gray-900 font-medium">
                            {{ \Carbon\Carbon::parse($job['job_is_scheduled_until_stamp'])->format('M d, Y') }}
                        </p>

                        <p class="text-gray-700 text-lg mb-2">
                            {{ $job['job_description'] ?? 'Scheduled Job' }}
                        </p>

                        <p class="text-sm text-gray-500 mb-3">
                            {{ $job['job_address'] }}
                        </p>

                        <span class="bg-blue-800 text-white px-4 py-2 rounded text-sm">
                            Scheduled
                        </span>
                    </div>
                @empty
                    <div class="bg-white p-6 rounded shadow text-gray-500">
                        No upcoming jobs scheduled.
                    </div>
                @endforelse
            </div>

            <!-- QUICK ACTIONS -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">
                    QUICK ACTIONS
                </h3>

                <div class="space-y-3">
                    <a href="#"
                       class="block bg-toms-green hover:bg-green-700 text-white text-center py-3 rounded">
                        Request Quote
                    </a>

                    <a href="#"
                       class="block bg-toms-green hover:bg-green-700 text-white text-center py-3 rounded">
                        View Invoices
                    </a>

                    <a href="#"
                       class="block bg-toms-green hover:bg-green-700 text-white text-center py-3 rounded">
                        Site Documentation
                    </a>

                    <a href="#"
                       class="block bg-toms-green hover:bg-green-700 text-white text-center py-3 rounded">
                        Contact Information
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
