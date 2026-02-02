

<?php $__env->startSection('pagetitle'); ?>
    <?php echo e($pagetitle ?? ''); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php if($type != 'client'): ?>
    <?php echo $__env->make('layouts.datatable_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if($type != 'client'): ?>
    <?php $__env->startComponent('components.breadcrumb', [
        'breadcrumbs' => $breadcrumbs,
        'pagetitle' => $pagetitle,
        'urls' => $urls
    ]); ?>
    <?php echo $__env->renderComponent(); ?>
<?php endif; ?>

<div class="max-w-7xl mx-auto px-4">

    <!-- Header -->
    <div class="grid md:grid-cols-3 gap-3">

        <!-- LEFT: SERVICE HISTORY -->
        <div class="md:col-span-2">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">
                SERVICE HISTORY
            </h3>

            <?php $__empty_1 = true; $__currentLoopData = $completedJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
               <a href="<?php echo e(route('servicem8.jobs.show', $job['uuid'])); ?>" 
                       class="block bg-white rounded-lg p-3 shadow hover:shadow-md transition" style="margin-bottom:10px">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-900 font-medium mb-1"><?php echo e(\Carbon\Carbon::parse($job['edit_date'])->format('M d, Y')); ?></p>
                                <p class="text-gray-700 text-lg"><?php echo e($job['job_description']); ?></p>
                            </div>
                            <div>
                                <span class="bg-toms-green text-white px-4 py-2 rounded text-sm font-medium">
                                     <?php echo e($job['status']); ?>

                                </span>
                            </div>
                        </div>
                    </a>
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="bg-white p-6 rounded shadow text-gray-500">
                    No completed jobs found.
                </div>
            <?php endif; ?>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="space-y-8">

            <!-- UPCOMING JOBS -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">
                    UPCOMING JOBS
                </h3>

                <?php $__empty_1 = true; $__currentLoopData = $upcomingJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white rounded-lg p-6 shadow mb-4">
                        <p class="text-gray-900 font-medium">
                            <?php echo e(\Carbon\Carbon::parse($job['job_is_scheduled_until_stamp'])->format('M d, Y')); ?>

                        </p>

                        <p class="text-gray-700 text-lg mb-2">
                            <?php echo e($job['job_description'] ?? 'Scheduled Job'); ?>

                        </p>

                        <p class="text-sm text-gray-500 mb-3">
                            <?php echo e($job['job_address']); ?>

                        </p>

                        <span class="bg-blue-800 text-white px-4 py-2 rounded text-sm">
                            Scheduled
                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="bg-white p-6 rounded shadow text-gray-500">
                        No upcoming jobs scheduled.
                    </div>
                <?php endif; ?>
            </div>

            <!-- QUICK ACTIONS -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6">
                    QUICK ACTIONS
                </h3>

                <div class="space-y-3">
                    <a href="#"
                       class="block bg-toms-green hover:bg-green-700 text-white text-center py-3 rounded">
                        Request Quote
                    </a>

                    <a href="<?php echo e(route('client.invoices.show', $companyUuid)); ?>"
                       class="block bg-toms-green hover:bg-green-700 text-white text-center py-3 rounded">
                        View Invoices
                    </a>

                    <a href="<?php echo e(route('client.document.show', $companyUuid)); ?>"
                       class="block bg-toms-green hover:bg-green-700 text-white text-center py-3 rounded">
                        Site Documentation
                    </a>

                    <a href="#"
                       class="block bg-toms-green hover:bg-green-700 text-white text-center py-3 rounded">
                        Contact Information
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($type == 'client' ? 'layouts.app1' : 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/serviceM8/clientJobs/index.blade.php ENDPATH**/ ?>