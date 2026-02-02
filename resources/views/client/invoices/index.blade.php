@extends($type == 'client' ? 'layouts.app1' : 'layouts.master')
@section('title', 'Invoices & Payments')
@section('content')
<div class="max-w-4xl mx-auto">

    {{-- Back --}}
    @if($type=="client")
    <div class="mb-6">
        <a href="{{ route('dashboard-index') }}" class="text-toms-green hover:underline">
            ← Back to Dashboard
        </a>
    </div>
    @endif
    {{-- Page Title --}}
    <h2 class="text-3xl font-bold text-gray-900 mb-6">
        Invoices & Payments
    </h2>

    {{-- Invoices --}}
    <div>
        <h3 class="text-xl font-bold text-gray-900 mb-4">
            Attached Documents
        </h3>

        <div class="space-y-4">

            @forelse($jobs as $job)
                <div class="bg-white rounded-lg p-6 shadow hover:shadow-md transition">
                    <div class="flex items-center justify-between">

                        {{-- Left --}}
                        <div class="flex-1">
                            <div class="flex items-center space-x-4">
                                <span class="text-lg font-semibold text-gray-900">
                                    INV-{{ $job['generated_job_id'] ?? '—' }}
                                </span>

                                <span class="text-gray-600">
                                    {{ 
                                        isset($job['completion_date']) 
                                            ? \Carbon\Carbon::parse($job['completion_date'])->format('M d, Y') 
                                            : '—'
                                    }}
                                </span>
                            </div>

                            <p class="text-gray-600 mt-1">
                                {{ $job['work_done_description'] ?? '' }}
                            </p>

                            <p class="text-sm text-gray-500 mt-1 whitespace-pre-line">
                                {{ $job['job_address'] ?? '' }}
                            </p>
                        </div>

                        {{-- Right --}}
                        <div class="text-right space-y-2">

                            {{-- Status --}}
                            @if(!empty($job['payment_received']))
                                <span class="bg-toms-green text-white px-6 py-2 rounded font-medium">
                                    Paid
                                </span>
                            @elseif(!empty($job['invoice_sent']))
                                <span class="bg-red-600 text-white px-6 py-2 rounded font-medium">
                                    Due
                                </span>
                            @else
                                <span class="bg-orange-500 text-white px-6 py-2 rounded font-medium">
                                    Pending
                                </span>
                            @endif

                            {{-- Amount --}}
                            <div class="text-gray-900 font-semibold" style="margin-top:10px">
                                $
                                {{ 
                                    isset($job['total_invoice_amount']) 
                                        ? number_format((float)$job['total_invoice_amount'], 2) 
                                        : '0.00'
                                }}
                            </div>

                            {{-- Payment Method --}}
                            @if(!empty($job['payment_received']) && !empty($job['payment_method']))
                                <div class="text-sm text-gray-500">
                                    Paid via {{ $job['payment_method'] }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg p-6 shadow text-center text-gray-600">
                    No completed invoices found.
                </div>
            @endforelse

        </div>
    </div>
</div>
@endsection
