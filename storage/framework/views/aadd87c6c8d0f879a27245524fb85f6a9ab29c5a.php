<?php $__env->startSection('title', 'Client Login - Tom\'s Pest Control'); ?>

<?php $__env->startSection('header-action'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-8">
            <div class="mb-6">
                <svg class="w-20 h-20 mx-auto text-gray-800" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Client Login</h2>
            <p class="text-gray-600">Welcome to Tom's Pest Control client portal</p>
        </div>

        <form action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green focus:border-transparent"
                    placeholder="your.email@example.com (optional for demo)">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green focus:border-transparent"
                    placeholder="Enter your password (optional for demo)">
            </div>

            <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                <p class="text-sm text-blue-800 text-center">
                    <strong>Demo Mode:</strong> Any email/password will work, or use the Demo Login button below
                </p>
            </div>

            <button type="submit" class="w-full bg-toms-green hover:bg-green-700 text-white font-medium py-3 rounded-lg transition">
                Log In
            </button>

            
        </form>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/auth/login.blade.php ENDPATH**/ ?>