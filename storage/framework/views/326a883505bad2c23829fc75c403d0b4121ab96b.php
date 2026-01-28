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
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'pagetitle' => $pagetitle, 'urls' => $urls]); ?>
<?php echo $__env->renderComponent(); ?>

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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('layouts.datatable_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                ajax: "<?php echo e(route('servicem8.staff')); ?>",

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\serviceM8\resources\views/servicem8/staff/index.blade.php ENDPATH**/ ?>