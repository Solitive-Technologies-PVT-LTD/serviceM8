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
        .dt-horizontal-scroll {
            overflow-x: auto;
        }
        table.dataTable td {
            white-space: nowrap;
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
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="name_search" class="form-label">Search by Client Name</label>
                        <div class="input-group">
                            <input type="text" id="name_search" class="form-control" placeholder="Type a client name...">
                            <button type="button" id="name_search_btn" class="btn btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive dt-horizontal-scroll">
                    <table id="datatable-clients"
                           class="table table-flush table-hover table-striped align-middle table-nowrap mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th>Client</th>
                            <th>ABN</th>
                            <th>Address</th>
                            <th>Billing Address</th>
                            <th>Website</th>
                            <th>Type</th>
                            <th>Fax</th>
                            <th>Tax Rate</th>
                            <th>Billing Attention</th>
                            <th>Payment Terms</th>
                            <th>Status</th>
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

    let table = $('#datatable-clients');

    table.DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        scrollX: true,
        autoWidth: false,
        pageLength: 50,
        pagingType: "full_numbers",
        order: [[11, 'desc']], // edit_date column (fixed index)
        dom: 'Brtip',
        buttons: [{ extend: 'colvis' }],
        ajax: {
                url: "{{ route('servicem8.clients') }}",
                data: function (d) {
                    d.name_search = $('#name_search').val();
                }
            },

        columns: [
            {
                data: 'name',
                render: function (data, type, row) {
                    let initials = row.initials ?? 'NA';
                    let color = '#556ee6';
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
            { data: 'abn_number' },
            { data: 'address' },
            { data: 'billing_address' },
            { data: 'website' },
            { data: 'is_individual' },
            { data: 'fax_number' },
            { data: 'tax_rate_uuid' },
            { data: 'billing_attention' },
            { data: 'payment_terms' },
            { data: 'active' }, // backend already renders the badge HTML — no frontend render needed
            { data: 'edit_date' },
            { data: 'actions', orderable: false, searchable: false }
        ]
    });

    $('#datatable-clients_length').addClass('float-end');

        $('#name_search_btn').on('click', function () {
            $('#datatable-clients').DataTable().ajax.reload();
        });

        // Also trigger on Enter key inside the input
        $('#name_search').on('keypress', function (e) {
            if (e.which === 13) { // Enter key
                e.preventDefault();
                $('#datatable-clients').DataTable().ajax.reload();
            }
        });
    });
    </script>
@endsection
