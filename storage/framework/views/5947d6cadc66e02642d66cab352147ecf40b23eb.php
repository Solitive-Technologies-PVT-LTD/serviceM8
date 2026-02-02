

<?php $__env->startSection('title', 'Universal Documentation - Tom\'s Pest Control'); ?>

<?php $__env->startSection('header-action'); ?>
    <a href="<?php echo e(route('login')); ?>" class="bg-toms-green hover:bg-green-700 text-white font-medium px-6 py-3 rounded inline-flex items-center transition">
        CLIENT LOGIN →
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="bg-white rounded-lg shadow-lg p-6">

        
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-900">Universal Documentation</h2>
            <button onclick="toggleViewMode()" class="p-2 text-gray-600 hover:text-toms-green hover:bg-gray-100 rounded transition" title="Toggle View">
                <svg id="gridIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h4v4H4V6zm6 0h4v4h-4V6zm6 0h4v4h-4V6zM4 12h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4zM4 18h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4z"></path>
                </svg>
                <svg id="listIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        
        <div class="mb-4">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="<?php echo e(route('universal-docs')); ?>" class="text-toms-green hover:underline">Home</a>
                <?php if($breadcrumb): ?>
                    <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="text-gray-400">/</span>
                        <a href="<?php echo e(route('universal-docs', $folder->id)); ?>" class="text-toms-green hover:underline"><?php echo e($folder->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </nav>
        </div>

        
        <div id="fileManager" class="min-h-[500px]">

            
            <div id="gridView" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-4 bg-white shadow rounded-lg flex flex-col items-center transition-transform transform hover:-translate-y-1">
                        <a href="<?php echo e(route('universal-docs', $folder->id)); ?>" class="flex flex-col items-center text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-2 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 012-2h4l2 2h7a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                            </svg>
                            <span class="font-medium text-gray-900 truncate w-32"><?php echo e($folder->name); ?></span>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-4 bg-white shadow rounded-lg flex flex-col items-center transition-transform transform hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10v10H7z"/>
                        </svg>
                        <span class="font-medium text-gray-900 text-center truncate w-32"><?php echo e($file->name); ?></span>
                        <a href="<?php echo e(route('documents.file.download', $file->id)); ?>" class="mt-2 text-green-600 hover:bg-green-50 px-3 py-1 rounded transition text-sm w-full text-center">
                            Download
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div id="listView" class="hidden w-full bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Download</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 flex items-center space-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 012-2h4l2 2h7a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                                    </svg>
                                    <a href="<?php echo e(route('universal-docs', $folder->id)); ?>" class="text-gray-900 font-medium"><?php echo e($folder->name); ?></a>
                                </td>
                                <td class="px-6 py-4">Folder</td>
                                <td class="px-6 py-4 text-gray-400">—</td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 flex items-center space-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10v10H7z"/>
                                    </svg>
                                    <span class="text-gray-900"><?php echo e($file->name); ?></span>
                                </td>
                                <td class="px-6 py-4">File</td>
                                <td class="px-6 py-4">
                                    <a href="<?php echo e(route('documents.file.download', $file->id)); ?>" class="text-green-600 hover:bg-green-50 px-3 py-1 rounded transition text-sm">Download</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
let viewMode = 'grid';
function toggleViewMode() {
    viewMode = viewMode === 'grid' ? 'list' : 'grid';
    document.getElementById('gridView').classList.toggle('hidden');
    document.getElementById('listView').classList.toggle('hidden');
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/universal1.blade.php ENDPATH**/ ?>