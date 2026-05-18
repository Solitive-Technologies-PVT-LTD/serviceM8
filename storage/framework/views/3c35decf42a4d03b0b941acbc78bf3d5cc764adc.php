<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Tom\'s Pest Control Client Portal'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
      <?php echo $__env->make('layouts.head-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body class="bg-gray-50">
   <header class="bg-white shadow-sm">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">

        
        <div class="flex items-center">
            <img src="<?php echo e(url('/images/Tom-Pest-Control_logo.png')); ?>" alt="Tom's Pest Control" class="h-16" onerror="this.style.display='none'">
            <div class="ml-3">
                <h1 class="text-xl font-semibold">
                    <span class="text-toms-green">TOM'S PEST</span>
                    <span class="text-gray-900">CONTROL</span>
                </h1>
            </div>
        </div>

        
        <div class="flex items-center space-x-4">

            
            <div>
                <?php echo $__env->yieldContent('header-action'); ?>
            </div>

            
            <?php if(auth()->guard()->check()): ?>
            <div class="dropdown relative">
                <button class="flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-toms-green dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    
                    <img src="<?php echo e(url('/assets/images/users/user-dummy-img.jpg')); ?>" class="h-8 w-8 rounded-full object-cover">
                    
                    <span class="font-medium text-gray-700"><?php echo e(auth()->user()->name); ?></span>
                </button>

                
                <ul class="dropdown-menu dropdown-menu-end mt-2 min-w-[160px] bg-white border border-gray-200 rounded shadow-lg p-1" aria-labelledby="userDropdown">
                    <li>
                        <a href="<?php echo e(route('password.change')); ?>"
                        class="block w-full text-left px-2  py-2 text-gray-700 hover:bg-gray-100 rounded">
                            Change Password
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded">Logout</button>
                        </form>
                    </li>
                    
                </ul>
            </div>
            <?php endif; ?>

        </div>
    </div>
</header>



    <main class="container mx-auto px-4 py-8">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
  <?php echo $__env->make('layouts.vendor-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <footer class="bg-white mt-12 py-6 border-t">
        <div class="container mx-auto px-4 text-center text-gray-600 text-sm">
            <p>&copy; <?php echo e(date('Y')); ?> Tom's Pest Control Pty Ltd. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>




<?php /**PATH C:\laragon\www\laravel-app\resources\views/layouts/app1.blade.php ENDPATH**/ ?>