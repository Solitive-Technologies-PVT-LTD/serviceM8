<?php $__env->startSection('pagetitle'); ?>
    <?php echo e($pagetitle); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <?php echo $__env->make('layouts.datatable_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'pagetitle' => $pagetitle, 'urls' => $urls]); ?>
<?php echo $__env->renderComponent(); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('layouts.datatable_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(function () {

            let table = $('#datatable-clients');

            table.DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                scrollX: true, // horizontal scroll for many columns
                autoWidth: false,
                pageLength: 50,
                pagingType: "full_numbers",
                order: [[12, 'desc']], // edit_date column
                dom: 'Blrtip',
                buttons: [{ extend: 'colvis' }],
                ajax: "<?php echo e(route('servicem8.clients')); ?>",
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
                    { data: 'active', render: function(data) {
                        return data
                            ? '<span class="badge bg-success">Active</span>'
                            : '<span class="badge bg-danger">Inactive</span>';
                    }},
                    { data: 'edit_date' },
                    { data: 'actions', orderable: false, searchable: false }
                ]
            });

            $('#datatable-clients_length').addClass('float-end');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\serviceM8\resources\views/servicem8/clients/index.blade.php ENDPATH**/ ?>