<!-- GRID VIEW -->
<div id="gridView" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

    <?php $__empty_1 = true; $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="p-4 bg-white shadow rounded-lg text-center">
            <a href="<?php echo e(route('client.document.show',['client_uuid'=>$uuid,'folderId'=>$folder->id])); ?>">
                <svg class="w-16 h-16 mx-auto text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2"
                          d="M3 7a2 2 0 012-2h4l2 2h7a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                </svg>
                <p class="mt-2 font-medium truncate"><?php echo e($folder->name); ?></p>
            </a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-full text-center text-gray-500">No folders</div>
    <?php endif; ?>

    <?php $__empty_1 = true; $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="p-4 bg-white shadow rounded-lg text-center">
            <svg class="w-16 h-16 mx-auto text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" d="M7 7h10v10H7z"/>
            </svg>

            <p class="mt-2 font-medium truncate"><?php echo e($file->name); ?></p>

            <!-- TAGS (Clickable for Filtering) -->
            <div class="flex flex-wrap justify-center gap-1 mt-2">
                <?php $__currentLoopData = $file->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="javascript:void(0)"
                       data-tag="<?php echo e($tag->name); ?>"
                       class="tagFilter text-xs bg-gray-100 hover:bg-toms-green hover:text-white px-2 py-1 rounded transition">
                        <?php echo e($tag->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="flex justify-center space-x-2 mt-3">
                <a href="<?php echo e(route('documents.file.download',$file->id)); ?>"
                   class="text-green-600 text-sm">Download</a>

                <form action="<?php echo e(route('documents.file.delete',$file->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="text-red-600 text-sm">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-full text-center text-gray-500">No files</div>
    <?php endif; ?>
</div>

<!-- LIST VIEW -->
<div id="listView" class="hidden mt-6">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $folders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $folder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-t">
                    <td class="px-4 py-2">
                        <a href="<?php echo e(route('client.document.show',['client_uuid'=>$uuid,'folderId'=>$folder->id])); ?>">
                            📁 <?php echo e($folder->name); ?>

                        </a>
                    </td>
                    <td class="text-center">Folder</td>
                    <td></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-t">
                    <td class="px-4 py-2">
                        <?php echo e($file->name); ?>

                        <div class="mt-1">
                            <?php $__currentLoopData = $file->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="javascript:void(0)"
                                   data-tag="<?php echo e($tag->name); ?>"
                                   class="tagFilter text-xs bg-gray-100 px-2 py-1 rounded mr-1 hover:bg-toms-green hover:text-white">
                                    <?php echo e($tag->name); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </td>
                    <td class="text-center">File</td>
                    <td class="text-center">
                        <a href="<?php echo e(route('documents.file.download',$file->id)); ?>" class="text-green-600 mr-2">Download</a>
                        <form action="<?php echo e(route('documents.file.delete',$file->id)); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH C:\laragon\www\laravel-app\resources\views/client/documents/folder_files.blade.php ENDPATH**/ ?>