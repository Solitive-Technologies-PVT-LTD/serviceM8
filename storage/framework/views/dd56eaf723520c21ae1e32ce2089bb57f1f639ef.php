

<?php $__env->startSection('css'); ?>
<?php echo $__env->make('layouts.datatable_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <h2 class="text-4xl font-bold text-gray-900 mb-8">Select a Site</h2>

    <div class="space-y-4">
        <?php
        $sites = [
            ['id' => 1, 'address' => '123 Main Street', 'city' => 'Anytown, CA'],
            ['id' => 2, 'address' => '456 Elm Street', 'city' => 'Othertown, CA'],
            ['id' => 3, 'address' => '789 Oak Avenue', 'city' => 'Melbourne, VIC'],
        ];
        ?>

        <?php $__currentLoopData = $sites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $site): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('sites', ['site' => $site['id']])); ?>" 
           class="block bg-gray-100 hover:bg-gray-200 rounded-lg p-6 transition group">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-1"><?php echo e($site['address']); ?></h3>
                    <p class="text-gray-600"><?php echo e($site['city']); ?></p>
                </div>
                <div>
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/sites/select.blade.php ENDPATH**/ ?>