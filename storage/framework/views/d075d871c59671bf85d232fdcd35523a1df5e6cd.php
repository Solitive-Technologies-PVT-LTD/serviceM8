

<?php $__env->startSection('title', 'Invoices & Payments - Tom\'s Pest Control'); ?>

<?php $__env->startSection('header-action'); ?>
    <a href="<?php echo e(route('login')); ?>" class="bg-toms-green hover:bg-green-700 text-white font-medium px-6 py-3 rounded inline-flex items-center transition">
        CLIENT LOGIN →
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="<?php echo e(route('dashboard')); ?>" class="text-toms-green hover:underline">← Back to Dashboard</a>
    </div>

    <h2 class="text-3xl font-bold text-gray-900 mb-2">Invoices & Payments</h2>

    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-1">Date</h3>
        <p class="text-gray-900">May 18, 2024</p>
    </div>

    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-700 mb-1">Job Details</h3>
        <p class="text-gray-900">General pest control for residential property</p>
    </div>

    <div>
        <h3 class="text-xl font-bold text-gray-900 mb-4">Attached Documents</h3>
        
        <div class="space-y-4">
            <?php
            $invoices = [
                ['number' => 'INV-0001', 'date' => 'May 2, 2024', 'status' => 'Paid', 'color' => 'green'],
                ['number' => 'INV-0002', 'date' => 'April 17, 2024', 'status' => 'Due', 'color' => 'red'],
                ['number' => 'INV-0003', 'date' => 'March 5, 2024', 'status' => 'Overdue', 'color' => 'orange'],
                ['number' => 'INV-0004', 'date' => 'February 28, 2024', 'status' => 'Paid', 'color' => 'green'],
            ];
            ?>

            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-lg p-6 shadow hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-4">
                            <span class="text-lg font-semibold text-gray-900"><?php echo e($invoice['number']); ?></span>
                            <span class="text-gray-600"><?php echo e($invoice['date']); ?></span>
                        </div>
                    </div>
                    <div>
                        <?php if($invoice['color'] === 'green'): ?>
                        <span class="bg-toms-green text-white px-6 py-2 rounded font-medium">
                            <?php echo e($invoice['status']); ?>

                        </span>
                        <?php elseif($invoice['color'] === 'red'): ?>
                        <span class="bg-red-600 text-white px-6 py-2 rounded font-medium">
                            <?php echo e($invoice['status']); ?>

                        </span>
                        <?php else: ?>
                        <span class="bg-orange-500 text-white px-6 py-2 rounded font-medium">
                            <?php echo e($invoice['status']); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/invoices.blade.php ENDPATH**/ ?>