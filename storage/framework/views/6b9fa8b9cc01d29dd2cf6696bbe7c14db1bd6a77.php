
<?php $__env->startSection('title', 'Invoices & Payments'); ?>
<?php $__env->startSection('content'); ?>
<style>
    body { background-color: #f5f6fa; }
    .job-container { max-width: 1100px; margin: 2rem auto; font-family: 'Inter', sans-serif; }
    .attachments { display: flex; flex-wrap: wrap; gap: 0.75rem; margin-top: 1rem; }
    .attachment-item { padding: 0.5rem 0.75rem; border: 1px solid #ddd; border-radius: 8px; display: flex; align-items: center; min-width: 150px; }
    .attachment-item img { width: 32px; height: 32px; margin-right: 0.5rem; object-fit: contain; }
    .attachment-name { font-size: 0.9rem; font-weight: 500; word-break: break-word; }
    .btn { font-size: 0.8rem; padding: 0.25rem 0.5rem; }
</style>

<div class="job-container">

    
    <h2 class="text-3xl font-bold text-gray-900 mb-6">Invoices & Payments</h2>

    
    <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-lg p-6 shadow mb-4 hover:shadow-md transition">

            
            <div class="flex items-center justify-between mb-4">
                <div>
                    <span class="text-lg font-semibold text-gray-900">
                        INV-<?php echo e($job['generated_job_id'] ?? '—'); ?>

                    </span>
                    <span class="text-gray-600 ml-2">
                        <?php echo e(isset($job['completion_date']) ? \Carbon\Carbon::parse($job['completion_date'])->format('M d, Y') : '—'); ?>

                    </span>
                    <p class="text-gray-600 mt-1"><?php echo e($job['work_done_description'] ?? ''); ?></p>
                    <p class="text-sm text-gray-500 mt-1 whitespace-pre-line"><?php echo e($job['job_address'] ?? ''); ?></p>
                </div>

                <div class="text-right space-y-2">
                    <?php if(!empty($job['payment_received'])): ?>
                        <span class="bg-toms-green text-white px-4 py-1 rounded font-medium">Paid</span>
                    <?php elseif(!empty($job['invoice_sent'])): ?>
                        <span class="bg-red-600 text-white px-4 py-1 rounded font-medium">Due</span>
                    <?php else: ?>
                        <span class="bg-orange-500 text-white px-4 py-1 rounded font-medium">Pending</span>
                    <?php endif; ?>

                    <div class="text-gray-900 font-semibold mt-1">
                        $<?php echo e(isset($job['total_invoice_amount']) ? number_format((float)$job['total_invoice_amount'],2) : '0.00'); ?>

                    </div>

                    <?php if(!empty($job['payment_received']) && !empty($job['payment_method'])): ?>
                        <div class="text-sm text-gray-500">Paid via <?php echo e($job['payment_method']); ?></div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="job-section">
                <h3>Attachments</h3>
                <div class="attachments">
                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $att): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($att['related_object_uuid'] == $job['uuid']): ?>
                            <div class="attachment-item col-md-5">
                                <img src="<?php echo e(getIconImage($att['file_type'] ?? '')); ?>" alt="icon">
                                <div class="attachment-name"><?php echo e($att['attachment_name']); ?></div>
                                <a href="<?php echo e(url('servicem8/attachment/download/'.$att['uuid'])); ?>" target="_blank" class="btn btn-primary ms-auto">
                                    Download
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="bg-white rounded-lg p-6 shadow text-center text-gray-600">
            No completed invoices found.
        </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($type == 'client' ? 'layouts.app1' : 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/client/invoices/index.blade.php ENDPATH**/ ?>