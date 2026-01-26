
<?php $__env->startSection('pagetitle'); ?> <?php echo e($pagetitle); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php echo $__env->make('layouts.datatable_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb', ['breadcrumbs' => $breadcrumbs, 'pagetitle' => $pagetitle, 'urls' => $urls]); ?>
<?php echo $__env->renderComponent(); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form method="post" action="<?php echo e(route('role-save')); ?>" name="add-setting-form" id="add-setting-form" enctype="multipart/form-data"> 
                <?php echo csrf_field(); ?>

                <div class="card-body">
                
                    <div class="live-preview">
                            <!-- Base Example -->
                        <div class="row gy-4 mt-3">
                            <div class="col-lg-12 ">
                                <div>
                                    <label for="role_name" class="form-label">Enter Role Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['role_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="role_name" id="role_name" value="<?php echo e(old('role_name')); ?>" placeholder="Enter Role Name">
                                    <?php $__errorArgs = ['role_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($message); ?></strong>
                                                </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row gy-4 mt-2">
                            <div class="col-md-12">
                                <div class="form-group <?php echo e($errors->has('selected_permissions') ? ' has-error' : ''); ?> required-field">
                                    <label for="description" class="col-md-2 control-label">Permissions</label>

                                    <div class="col-md-10">
                                        <input type="hidden" id="selected_permissions" name="selected_permissions">
                                        <div id="permissions">
                                            <ul>
                                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($permission->children()->count() > 0): ?>
                                                    <?php if(old('selected_permissions')) 
                                                    {
                                                        $selected=explode(',', old('selected_permissions'));
                                                    }
                                                    ?>
                                                     <li <?php if( old('selected_permissions') && in_array($permission->id, $selected) ): ?>) data-jstree='{"selected":true}' <?php endif; ?> id="<?php echo e($permission->id); ?>"><?php echo e($permission->name); ?>

                                                            <ul>
                                                                <?php $__currentLoopData = $permission->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <li <?php if(old('selected_permissions') && in_array($sub_permission->id, $selected)): ?> data-jstree='{"selected":true}' <?php endif; ?> id="<?php echo e($sub_permission->id); ?>"><?php echo e($sub_permission->name); ?> </li> 
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        </li>
                                                    <?php else: ?>
                                                     <li <?php if(old('selected_permissions') && in_array($permission->id,$selected)): ?>) data-jstree='{"selected":true}' <?php endif; ?> id="<?php echo e($permission->id); ?>"><?php echo e($permission->name); ?></li> 
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>

                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-end mb-1 mt-5">
                    <a href="<?php echo e(route('roles')); ?>">
                            <button type="button" class="btn btn-primary waves-effect waves-light">
                                <i class="mdi mdi-cancel w-sm"></i> Cancel
                            </button>
                        </a>
                       <button type="submit" class="btn btn-success w-sm">Create</button>
                    </div>
                </div>  
                
            </form>  
        </div>       
    </div>                               
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/assets/libs/jstree/dist/themes/default/style.min.css')); ?>" />
    <script src="<?php echo e(asset('/assets/libs/jstree/dist/jstree.min.js')); ?>"></script>
    <script>
         $(function () {
            $('#permissions').jstree({
                'plugins': ["checkbox"],
                "core": {
                    "themes": {
                        "icons": false
                    }
                }
            })
                .on('changed.jstree', function (e, data) {
                    var i, j, r = [];
                    for(i = 0, j = data.selected.length; i < j; i++) {
                        r.push(data.instance.get_node(data.selected[i]).id);
                    }
                    $('#selected_permissions').val(r);
                })
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/roles/create.blade.php ENDPATH**/ ?>