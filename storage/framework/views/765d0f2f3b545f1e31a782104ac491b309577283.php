
<?php $__env->startSection('css'); ?>
<?php if($type != 'client'): ?>
    <?php echo $__env->make('layouts.datatable_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-7xl mx-auto">
   <?php if($type=="client"): ?>
    <div class="mb-6">
        <a href="<?php echo e(route('dashboard-index')); ?>" class="text-toms-green hover:underline">
            ← Back to Dashboard
        </a>
    </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-900">Site Documentation</h2>
            <div class="flex items-center space-x-3">

                <!-- Toggle view -->
                <button onclick="toggleViewMode()" class="p-2 text-gray-600 hover:text-toms-green hover:bg-gray-100 rounded transition" title="Toggle View">
                    <svg id="gridIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h4v4H4V6zm6 0h4v4h-4V6zm6 0h4v4h-4V6zM4 12h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4zM4 18h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4z"></path>
                    </svg>
                    <svg id="listIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Create folder -->
                <button onclick="showCreateFolderModal()" class="bg-toms-green hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium inline-flex items-center transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 012-2h4l2 2h7a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11v6m3-3H9"/>
                    </svg>
                    New Folder
                </button>

                <!-- Upload files -->
                <form action="<?php echo e(route('documents.file.store')); ?>" method="POST" enctype="multipart/form-data" class="inline-block">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="company_uuid" value="<?php echo e($uuid); ?>">
                    <input type="hidden" name="folder_id" value="<?php echo e($currentFolder ? $currentFolder->id : ''); ?>">
                    <label class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium inline-flex items-center cursor-pointer transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Upload File
                        <input type="file" name="file" class="hidden" onchange="this.form.submit()">
                    </label>
                </form>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="mb-4">
            <nav class="flex items-center space-x-2 text-sm">
                <?php if($breadcrumb): ?>
                    <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="text-gray-400">/</span>
                        <a href="<?php echo e(route('client.document.show', [
                                            'client_uuid' => $uuid,
                                            'folderId' => $folder->id
                                            ])); ?>" class="text-toms-green hover:underline"><?php echo e($folder->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </nav>
        </div>

        <!-- File Manager -->
        <div id="fileManager" class="min-h-[500px]">
            <!-- Grid view -->
            <div id="gridView" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php $__empty_1 = true; $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="p-4 bg-white shadow hover:shadow-lg rounded-lg flex flex-col items-center transition-transform transform hover:-translate-y-1">
                        <a href="<?php echo e(route('client.document.show', [
                                            'client_uuid' => $uuid,
                                            'folderId' => $folder->id
                                            ])); ?>" class="flex flex-col items-center text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-2 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 012-2h4l2 2h7a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                            </svg>
                            <span class="font-medium text-gray-900 truncate w-32"><?php echo e($folder->name); ?></span>
                        </a>
                        <form action="<?php echo e(route('documents.folder.delete', $folder->id)); ?>" method="POST" class="mt-2">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 hover:bg-red-50 px-2 py-1 rounded transition text-sm">Delete</button>
                        </form>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-gray-500 col-span-full text-center py-12">No folders</div>
                <?php endif; ?>

                <?php $__empty_1 = true; $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="p-4 bg-white shadow hover:shadow-lg rounded-lg flex flex-col items-center transition-transform transform hover:-translate-y-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10v10H7z"/>
                        </svg>
                        <span class="font-medium text-gray-900 text-center truncate w-32"><?php echo e($file->name); ?></span>
                        <div class="flex space-x-2 mt-2">
                            <a href="<?php echo e(route('documents.file.download', $file->id)); ?>" class="text-green-600 hover:bg-green-50 px-2 py-1 rounded transition text-sm">Download</a>
                            <form action="<?php echo e(route('documents.file.delete', $file->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:bg-red-50 px-2 py-1 rounded transition text-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-gray-500 col-span-full text-center py-12">No files</div>
                <?php endif; ?>
            </div>

            <!-- List view -->
            <div id="listView" class="hidden w-full bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 flex items-center space-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 012-2h4l2 2h7a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                                    </svg>
                                    <a href="<?php echo e(route('client.document.show', [
                                            'client_uuid' => $uuid,
                                            'folderId' => $folder->id
                                            ])); ?>" class="text-gray-900 font-medium"><?php echo e($folder->name); ?></a>
                                </td>
                                <td class="px-6 py-4">Folder</td>
                                <td class="px-6 py-4">
                                    <form action="<?php echo e(route('documents.folder.delete', $folder->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:bg-red-50 px-2 py-1 rounded transition text-sm">Delete</button>
                                    </form>
                                </td>
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
                                <td class="px-6 py-4 flex space-x-2">
                                    <a href="<?php echo e(route('documents.file.download', $file->id)); ?>" class="text-green-600 hover:bg-green-50 px-2 py-1 rounded transition text-sm">Download</a>
                                    <form action="<?php echo e(route('documents.file.delete', $file->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:bg-red-50 px-2 py-1 rounded transition text-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Folder Modal -->
<div id="createFolderModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Create New Folder</h3>
        <form action="<?php echo e(route('documents.folder.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="company_uuid" value="<?php echo e($uuid); ?>">
            <input type="hidden" name="parent_id" value="<?php echo e($currentFolder ? $currentFolder->id : ''); ?>">
            <input type="text" name="name" placeholder="Enter folder name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green focus:border-transparent mb-4" required>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeCreateFolderModal()" class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-toms-green hover:bg-green-700 text-white rounded-lg transition">Create</button>
            </div>
        </form>
    </div>
</div>

<script>
let viewMode = 'grid';
function showCreateFolderModal(){ document.getElementById('createFolderModal').classList.remove('hidden'); }
function closeCreateFolderModal(){ document.getElementById('createFolderModal').classList.add('hidden'); }
function toggleViewMode(){
    viewMode = viewMode === 'grid' ? 'list' : 'grid';
    document.getElementById('gridView').classList.toggle('hidden');
    document.getElementById('listView').classList.toggle('hidden');
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($type == 'client' ? 'layouts.app1' : 'layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/client/documents/index.blade.php ENDPATH**/ ?>