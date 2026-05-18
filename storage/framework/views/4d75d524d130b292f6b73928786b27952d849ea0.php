

<?php $__env->startSection('pagetitle'); ?>
    <?php echo e($pagetitle ?? ''); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-6">Change Password</h2>

    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-700  rounded mb-1" style="color:green">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="bg-red-100 text-red-700  rounded mb-1" style="color:red">
            <ul class="list-disc ml-5">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('password.update')); ?>">
        <?php echo csrf_field(); ?>

        <!-- Current Password -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">Current Password</label>
            <input type="password"
                   name="current_password"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>

        <!-- New Password -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">New Password</label>
            <input type="password"
                   name="new_password"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">Confirm New Password</label>
            <input type="password"
                   name="new_password_confirmation"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                   required>
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update Password
        </button>

    </form>

</div>

<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/auth/changePassword.blade.php ENDPATH**/ ?>