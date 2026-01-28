<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Tom\'s Pest Control Client Portal'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Tom's Pest Control" class="h-16" onerror="this.style.display='none'">
                <div class="ml-3">
                    <h1 class="text-xl font-semibold">
                        <span class="text-toms-green">TOM'S PEST</span>
                        <span class="text-gray-900">CONTROL</span>
                    </h1>
                </div>
            </div>
            <div>
                <?php echo $__env->yieldContent('header-action'); ?>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="bg-white mt-12 py-6 border-t">
        <div class="container mx-auto px-4 text-center text-gray-600 text-sm">
            <p>&copy; <?php echo e(date('Y')); ?> Tom's Pest Control Pty Ltd. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>




<?php /**PATH C:\laragon\www\serviceM8\resources\views/layouts/app1.blade.php ENDPATH**/ ?>