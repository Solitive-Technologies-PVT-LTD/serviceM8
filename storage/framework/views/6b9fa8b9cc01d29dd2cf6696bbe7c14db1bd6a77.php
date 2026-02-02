
<?php $__env->startSection('title', 'Invoices & Payments'); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">

    
    <?php if($type=="client"): ?>
    <div class="mb-6">
        <a href="<?php echo e(route('dashboard-index')); ?>" class="text-toms-green hover:underline">
            ← Back to Dashboard
        </a>
    </div>
    <?php endif; ?>
    
    <h2 class="text-3xl font-bold text-gray-900 mb-6">
        Invoices & Payments
    </h2>

    
    <div>
        <h3 class="text-xl font-bold text-gray-900 mb-4">
            Attached Documents
        </h3>

        <div class="space-y-4">

            <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white rounded-lg p-6 shadow hover:shadow-md transition">
                    <div class="flex items-center justify-between">

                        
                        <div class="flex-1">
                            <div class="flex items-center space-x-4">
                                <span class="text-lg font-semibold text-gray-900">
                                    INV-<?php echo e($job['generated_job_id'] ?? '—'); ?>

                                </span>

                                <span class="text-gray-600">
                                    <?php echo e(isset($job['completion_date']) 
                                            ? \Carbon\Carbon::parse($job['completion_date'])->format('M d, Y') 
                                            : '—'); ?>

                                </span>
                            </div>

                            <p class="text-gray-600 mt-1">
                                <?php echo e($job['work_done_description'] ?? ''); ?>

                            </p>

                            <p class="text-sm text-gray-500 mt-1 whitespace-pre-line">
                                <?php echo e($job['job_address'] ?? ''); ?>

                            </p>
                        </div>

                        
                        <div class="text-right space-y-2">

                            
                            <?php if(!empty($job['payment_received'])): ?>
                                <span class="bg-toms-green text-white px-6 py-2 rounded font-medium">
                                    Paid
                                </span>
                            <?php elseif(!empty($job['invoice_sent'])): ?>
                                <span class="bg-red-600 text-white px-6 py-2 rounded font-medium">
                                    Due
                                </span>
                            <?php else: ?>
                                <span class="bg-orange-500 text-white px-6 py-2 rounded font-medium">
                                    Pending
                                </span>
                            <?php endif; ?>

                            
                            <div class="text-gray-900 font-semibold" style="margin-top:10px">
                                $
                                <?php echo e(isset($job['total_invoice_amount']) 
                                        ? number_format((float)$job['total_invoice_amount'], 2) 
                                        : '0.00'); ?>

                            </div>

                            
                            <?php if(!empty($job['payment_received']) && !empty($job['payment_method'])): ?>
                                <div class="text-sm text-gray-500">
                                    Paid via <?php echo e($job['payment_method']); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="bg-white rounded-lg p-6 shadow text-center text-gray-600">
                    No completed invoices found.
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($type == 'client' ? 'layouts.app1' : 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/client/invoices/index.blade.php ENDPATH**/ ?>