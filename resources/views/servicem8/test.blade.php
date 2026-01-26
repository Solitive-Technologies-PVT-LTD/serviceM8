@extends('layouts.app')

@section('title', 'ServiceM8 Integration Test - Tom\'s Pest Control')

@section('header-action')
    <a href="{{ route('dashboard') }}" class="border-2 border-gray-800 hover:bg-gray-800 hover:text-white text-gray-800 font-medium px-6 py-2 rounded transition">
        LOG OUT
    </a>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-toms-green hover:underline">← Back to Dashboard</a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">ServiceM8 Integration Test</h2>

        <!-- API Key Status -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">API Configuration</h3>
            <p class="text-sm text-gray-600">
                <strong>API Key:</strong> 
                @if(config('services.servicem8.api_key'))
                    <span class="text-green-600">✓ Configured</span>
                @else
                    <span class="text-red-600">✗ Not configured (add SERVICEM8_API_KEY to .env)</span>
                @endif
            </p>
            <p class="text-sm text-gray-600 mt-1">
                <strong>Base URL:</strong> {{ config('services.servicem8.base_url') }}
            </p>
        </div>

        <!-- Test Buttons -->
        <div class="grid md:grid-cols-3 gap-4 mb-6">
            <button onclick="testConnection()" class="bg-toms-green hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition">
                Test API Connection
            </button>
            <button onclick="fetchJobs()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition">
                Fetch Jobs
            </button>
            <button onclick="fetchInvoices()" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium transition">
                Fetch Invoices
            </button>
        </div>

        <!-- Webhook Information -->
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Webhook Setup</h3>
            <p class="text-sm text-gray-700 mb-2">
                <strong>Webhook URL:</strong> 
                <code class="bg-white px-2 py-1 rounded">{{ url('/api/servicem8/webhook') }}</code>
            </p>
            <p class="text-sm text-gray-700 mb-2">
                <strong>Test Endpoint:</strong> 
                <a href="{{ route('servicem8.webhook.test') }}" target="_blank" class="text-toms-green hover:underline">
                    {{ url('/api/servicem8/webhook/test') }}
                </a>
            </p>
            <p class="text-xs text-gray-600 mt-2">
                💡 <strong>For local testing:</strong> Use <a href="https://ngrok.com" target="_blank" class="text-toms-green hover:underline">ngrok</a> to expose your local server. 
                Then configure this URL in ServiceM8 webhook settings.
            </p>
        </div>

        <!-- Results Area -->
        <div id="results" class="mt-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Test Results</h3>
            <div id="resultsContent" class="bg-gray-50 rounded-lg p-4 min-h-[200px]">
                <p class="text-gray-500 text-center">Click a test button above to see results...</p>
            </div>
        </div>

        <!-- Webhook Logs -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Webhook Logs</h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-2">
                    Webhook logs are stored in: <code class="bg-white px-2 py-1 rounded">storage/logs/laravel.log</code>
                </p>
                <p class="text-sm text-gray-600">
                    Webhook payloads are saved in: <code class="bg-white px-2 py-1 rounded">storage/app/webhooks/</code>
                </p>
                <button onclick="checkWebhookLogs()" class="mt-3 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm transition">
                    Check Recent Webhooks
                </button>
                <div id="webhookLogs" class="mt-4 hidden"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function testConnection() {
        showLoading('Testing API connection...');
        fetch('{{ route("servicem8.test") }}')
            .then(response => response.json())
            .then(data => {
                showResults('API Connection Test', data);
            })
            .catch(error => {
                showResults('API Connection Test', { error: error.message });
            });
    }

    function fetchJobs() {
        showLoading('Fetching jobs from ServiceM8...');
        fetch('{{ route("servicem8.test.jobs") }}')
            .then(response => response.json())
            .then(data => {
                showResults('Fetch Jobs', data);
            })
            .catch(error => {
                showResults('Fetch Jobs', { error: error.message });
            });
    }

    function fetchInvoices() {
        showLoading('Fetching invoices from ServiceM8...');
        fetch('{{ route("servicem8.test.invoices") }}')
            .then(response => response.json())
            .then(data => {
                showResults('Fetch Invoices', data);
            })
            .catch(error => {
                showResults('Fetch Invoices', { error: error.message });
            });
    }

    function showLoading(message) {
        document.getElementById('resultsContent').innerHTML = `
            <div class="text-center py-8">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-toms-green"></div>
                <p class="mt-4 text-gray-600">${message}</p>
            </div>
        `;
    }

    function showResults(title, data) {
        const content = document.getElementById('resultsContent');
        content.innerHTML = `
            <div class="mb-4">
                <h4 class="font-semibold text-gray-900 mb-2">${title}</h4>
                <pre class="bg-white p-4 rounded border border-gray-200 overflow-auto text-xs">${JSON.stringify(data, null, 2)}</pre>
            </div>
        `;
    }

    function checkWebhookLogs() {
        alert('Webhook logs are stored in:\n\n1. Laravel Log: storage/logs/laravel.log\n2. Webhook Files: storage/app/webhooks/\n\nCheck these files to see received webhooks.');
    }
</script>
@endsection

