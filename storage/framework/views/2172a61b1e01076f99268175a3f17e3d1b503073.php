

<?php $__env->startSection('title', 'Request Quote - Tom\'s Pest Control'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
   <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Request Quote</h2>

        <form method="POST" action="<?php echo e(route('quote.submit')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                <input type="text" id="name" name="name" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green focus:border-transparent"
                    placeholder="Your name">
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green focus:border-transparent"
                    placeholder="your.email@example.com">
            </div>

            <div class="mb-6">
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                <input type="tel" id="phone" name="phone" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green focus:border-transparent"
                    placeholder="0400 000 000">
            </div>

            <div class="mb-8">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                <textarea id="message" name="message" rows="6" required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green focus:border-transparent resize-none"
                    placeholder="Please describe your pest control needs..."></textarea>
            </div>

            <button type="submit" class="w-full bg-toms-green hover:bg-green-700 text-white font-medium py-4 rounded-lg text-lg transition">
                SUBMIT
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/request-quote.blade.php ENDPATH**/ ?>