

<?php $__env->startSection('css'); ?>
<?php echo $__env->make('layouts.datatable_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <a href="<?php echo e(route('sites.select')); ?>" class="text-toms-green hover:underline mb-4 inline-block">← Back to Sites</a>
        <h2 class="text-4xl font-bold text-gray-900">Welcome to Tom's Pest Control client portal</h2>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Left Column - Service History and Upcoming Jobs -->
        <div class="md:col-span-2 space-y-8">
            <!-- Service History -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">SERVICE HISTORY</h3>
                <div class="space-y-4">
                    <?php
                    $serviceHistory = [
                        ['id' => 1, 'date' => 'May 18, 2024', 'service' => 'General Pest Control', 'status' => 'Completed'],
                        ['id' => 2, 'date' => 'March 23, 2024', 'service' => 'Termite Inspection', 'status' => 'Completed'],
                        ['id' => 3, 'date' => 'January 10, 2024', 'service' => 'Rodent Control', 'status' => 'Completed'],
                    ];
                    ?>

                    <?php $__currentLoopData = $serviceHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('service.detail', ['id' => $service['id']])); ?>" 
                       class="block bg-white rounded-lg p-5 shadow hover:shadow-md transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-900 font-medium mb-1"><?php echo e($service['date']); ?></p>
                                <p class="text-gray-700 text-lg"><?php echo e($service['service']); ?></p>
                            </div>
                            <div>
                                <span class="bg-toms-green text-white px-4 py-2 rounded text-sm font-medium">
                                    <?php echo e($service['status']); ?>

                                </span>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <!-- Right Column - Upcoming Jobs and Quick Actions -->
        <div class="space-y-8">
            <!-- Upcoming Jobs -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">UPCOMING JOBS</h3>
                <div class="bg-white rounded-lg p-6 shadow">
                    <p class="text-gray-900 font-medium mb-1">June 25, 2024</p>
                    <p class="text-gray-700 text-lg mb-3">General Pest Control</p>
                    <span class="bg-blue-900 text-white px-4 py-2 rounded text-sm font-medium inline-block">
                        Scheduled
                    </span>
                </div>
            </div>

            <!-- Quick Actions -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">QUICK ACTIONS</h3>
                <div class="space-y-3">
                    <a href="<?php echo e(route('quote.request')); ?>" 
                       class="block bg-toms-green hover:bg-green-700 text-white text-center font-medium py-3 rounded transition">
                        Request Quote
                    </a>
                    <a href="<?php echo e(route('invoices')); ?>" 
                       class="block bg-toms-green hover:bg-green-700 text-white text-center font-medium py-3 rounded transition">
                        View Invoices
                    </a>
                    <a href="<?php echo e(route('site.documentation')); ?>" 
                       class="block bg-toms-green hover:bg-green-700 text-white text-center font-medium py-3 rounded transition">
                        Site Documentation
                    </a>
                    <a href="<?php echo e(route('contact')); ?>" 
                       class="block bg-toms-green hover:bg-green-700 text-white text-center font-medium py-3 rounded transition">
                        Contact Information
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/dashboard.blade.php ENDPATH**/ ?>