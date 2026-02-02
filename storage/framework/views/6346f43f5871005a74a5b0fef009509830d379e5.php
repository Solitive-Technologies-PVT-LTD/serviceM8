

<?php $__env->startSection('title', 'Client Registration - Tom\'s Pest Control'); ?>

<?php $__env->startSection('header-action'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-8">
            <div class="mb-6">
                <svg class="w-20 h-20 mx-auto text-gray-800" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a5 5 0 100 10 5 5 0 000-10zM2 18a8 8 0 1116 0H2z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Client Registration</h2>
            <p class="text-gray-600">Create your client portal account</p>
        </div>

        <form action="<?php echo e(route('register')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <input type="text" name="name" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green"
                    placeholder="John Smith">
            </div>

            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                <input type="text" name="username" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green"
                    placeholder="johnsmith">
            </div>

            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green"
                    placeholder="john@example.com">
            </div>

            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                <input type="text" name="contact_number" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green"
                    placeholder="+61 4XX XXX XXX">
            </div>

            
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green"
                    placeholder="Create a strong password">
            </div>

            
            <button type="submit"
                class="w-full bg-toms-green hover:bg-green-700 text-white font-medium py-3 rounded-lg transition">
                Register
            </button>

            
            <p class="text-center text-sm text-gray-600 mt-6">
                Already have an account?
                <a href="<?php echo e(route('login')); ?>" class="text-toms-green font-medium hover:underline">
                    Log in
                </a>
            </p>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/auth/register.blade.php ENDPATH**/ ?>