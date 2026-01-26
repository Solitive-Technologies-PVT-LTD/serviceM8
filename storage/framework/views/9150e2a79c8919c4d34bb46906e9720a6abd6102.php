

<?php $__env->startSection('pagetitle'); ?>
    <?php echo e($pagetitle); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <?php echo $__env->make('layouts.datatable_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('components.breadcrumb', [
    'breadcrumbs' => $breadcrumbs,
    'pagetitle' => $pagetitle,
    'urls' => $urls
]); ?>
<?php echo $__env->renderComponent(); ?>


<div class="card mb-3">
    <div class="card-body">
        <form id="jobFilterForm" class="row g-3">

            
            <input type="hidden" name="staff_uuid" value="<?php echo e(request('staff_uuid')); ?>">

            
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="Quote" <?php echo e(request('status') == 'Quote' ? 'selected' : ''); ?>>Quote</option>
                    <option value="Work Order" <?php echo e(request('status') == 'Work Order' ? 'selected' : ''); ?>>Work Order</option>
                    <option value="Completed" <?php echo e(request('status') == 'Completed' ? 'selected' : ''); ?>>Completed</option>
                    <option value="Unsuccessful" <?php echo e(request('status') == 'Unsuccessful' ? 'selected' : ''); ?>>Unsuccessful</option>
                    <option value="Cancelled" <?php echo e(request('status') == 'Cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                </select>
            </div>

            
            <div class="col-md-3">
                <label class="form-label">Date From</label>
                <input type="date"
                       name="date_from"
                       class="form-control"
                       value="<?php echo e(request('date_from', '2026-01-20')); ?>">
            </div>

            <div class="col-md-2 align-self-end">
                <button type="submit" class="btn btn-primary w-100">
                    Apply Filters
                </button>
            </div>

        </form>
    </div>
</div>


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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php echo $__env->make('layouts.datatable_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
$(function () {

    let table = $('#jobs-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 50,
        order: [[6, 'desc']],
        ajax: {
            url: "<?php echo e(route('servicem8.jobs')); ?>",
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/servicem8/jobs/index.blade.php ENDPATH**/ ?>