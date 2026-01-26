<script type="text/javascript">
    $(document).ready(function() {
        $(function() {
            const Toast = Swal.mixin({
                //toast: true,
                position: 'top-end',
                showConfirmButton: false,
                //showCancelButton: true,
                //cancelButtonClass: "swal2-close",
                //cancelButtonText:'<span aria-hidden="true">×</span>',
                //cancelButtonColor: 'rgb(222 53 53)',
                //cancelButtonColor: "#ff3d60",
                timer: 3000
            });

            <?php $__currentLoopData = ['error', 'warning', 'success', 'info', 'question']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(session()->has('alert-' . $msg)): ?>
                    Toast.fire({
                    icon: '<?php echo $msg; ?>',
                    type: '<?php echo $msg; ?>',
                    title: '<?php echo $msg; ?>',
                    text: '<?php echo e(session()->get('alert-' . $msg)); ?>'
                    });
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        });
    });
</script><?php /**PATH C:\laragon\www\laravel-app\resources\views/layouts/alert.blade.php ENDPATH**/ ?>