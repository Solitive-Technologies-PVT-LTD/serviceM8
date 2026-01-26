@extends('layouts.master')

@section('pagetitle')
    {{ $pagetitle }}
@endsection

@section('css')
    @include('layouts.datatable_css')
    <style>
        .avatar-sm {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
@component('components.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'pagetitle' => $pagetitle, 'urls' => $urls])
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="datatable-staff"
                           class="table table-flush table-hover table-striped align-middle table-nowrap mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th>Staff</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Job Title</th>
                            <th>Status</th>
                            <th>Schedule</th>
                            <th>Push</th>
                            <th>Color</th>
                            <th>Updated</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    @include('layouts.datatable_js')

    <script>
        $(function () {

            let table = $('#datatable-staff');

            table.DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                pageLength: 50,
                pagingType: "full_numbers",
                order: [[8, 'desc']],
                dom: 'Blrtip',
                buttons: [
                    { extend: 'colvis' }
                ],
                ajax: "{{ route('servicem8.staff') }}",

                columns: [
                    {
                        data: 'name',
                        render: function (data, type, row) {
                            let initials = row.initials ?? 'NA';
                            let color = row.color ? '#' + row.color : '#556ee6';

                            return `
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-2" style="background:${color}">
                                        ${initials}
                                    </div>
                                    <div>
                                        <div class="fw-semibold">${data}</div>
                                    </div>
                                </div>
                            `;
                        }
                    },
                    { data: 'email' },
                    { data: 'mobile' },
                    { data: 'job_title' },
                    {
                        data: 'active',
                        render: data =>
                            data
                                ? '<span class="badge bg-success">Active</span>'
                                : '<span class="badge bg-danger">Inactive</span>'
                    },
                    {
                        data: 'hide_from_schedule',
                        render: data =>
                            data
                                ? '<span class="badge bg-warning">Hidden</span>'
                                : '<span class="badge bg-info">Visible</span>'
                    },
                    {
                        data: 'can_receive_push_notification',
                        render: data =>
                            data
                                ? '<span class="badge bg-success">Yes</span>'
                                : '<span class="badge bg-secondary">No</span>'
                    },
                    {
                        data: 'color',
                        render: data =>
                            data
                                ? `<span class="badge" style="background:#${data}">#${data}</span>`
                                : '—'
                    },
                    { data: 'edit_date' },
                    {
                        data: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#datatable-staff_length').addClass('float-end');
        });
    </script>
@endsection
