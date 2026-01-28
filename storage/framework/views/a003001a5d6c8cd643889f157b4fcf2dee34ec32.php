<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18"><?php echo e($pagetitle); ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <?php
                    $total = count($breadcrumbs);
                    $active = $total-1;
                    ?>
                    <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key == $active): ?>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="<?php echo e(url($urls[$key])); ?>"><?php echo e($item); ?></a>
                            </li>
                        <?php else: ?>
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(url($urls[$key])); ?>"><?php echo e($item); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<?php /**PATH C:\laragon\www\serviceM8\resources\views/components/breadcrumb.blade.php ENDPATH**/ ?>