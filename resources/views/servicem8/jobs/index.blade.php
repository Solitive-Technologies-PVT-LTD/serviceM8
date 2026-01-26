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

{{-- Filters --}}
<div class="card mb-3">
    <div class="card-body">
        <form id="jobFilterForm" class="row g-3">

            {{-- Staff hidden field --}}
            <input type="hidden" name="staff_uuid" value="{{ request('staff_uuid') }}">

            {{-- Status Filter --}}
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="Quote" {{ request('status') == 'Quote' ? 'selected' : '' }}>Quote</option>
                    <option value="Work Order" {{ request('status') == 'Work Order' ? 'selected' : '' }}>Work Order</option>
                    <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Unsuccessful" {{ request('status') == 'Unsuccessful' ? 'selected' : '' }}>Unsuccessful</option>
                    <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            {{-- Date From Filter --}}
            <div class="col-md-3">
                <label class="form-label">Date From</label>
                <input type="date"
                       name="date_from"
                       class="form-control"
                       value="{{ request('date_from', '2026-01-20') }}">
            </div>

            <div class="col-md-2 align-self-end">
                <button type="submit" class="btn btn-primary w-100">
                    Apply Filters
                </button>
            </div>

        </form>
    </div>
</div>

{{-- Jobs Table --}}
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="jobs-table" class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>Job ID</th>
                    <th>Status</th>
                    <th>Address</th>
                    <th>Invoice</th>
                    <th>Paid</th>
                    <th>Completed</th>
                    <th>Updated</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@section('script')
@include('layouts.datatable_js')

<script>
$(function () {

    let table = $('#jobs-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 50,
        order: [[6, 'desc']],
        ajax: {
            url: "{{ route('servicem8.jobs') }}",
            data: function (d) {
                d.staff_uuid = $('input[name=staff_uuid]').val();
                d.status     = $('select[name=status]').val();
                d.date_from  = $('input[name=date_from]').val();
            }
        },
        columns: [
            { data: 'generated_job_id' },
            { data: 'status' },
            { data: 'job_address' },
            { data: 'total_invoice_amount' },
            { data: 'payment_received', orderable: false },
            { data: 'completion_date' },
            { data: 'edit_date' },
            { data: 'actions', orderable: false, searchable: false }
        ]
    });

    // Apply filters on submit
    $('#jobFilterForm').on('submit', function (e) {
        e.preventDefault();
        table.ajax.reload();
    });

});
</script>
@endsection
