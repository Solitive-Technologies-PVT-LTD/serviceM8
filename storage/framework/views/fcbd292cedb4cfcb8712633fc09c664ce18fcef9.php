
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
            <form method="post" action="<?php echo e(route('permission-save')); ?>" name="add-permission-form" id="add-permission-form" enctype="multipart/form-data"> 
                <?php echo csrf_field(); ?>
                <div class="" id="error_messages"></div>
                <div class="card-body">
                
                    <div class="live-preview">
                            <!-- Base Example -->
                        <div class="row gy-4 "  >
                            <div class="col-lg-12 <?php if(old('add_new_module_checkbox') == 'on'): ?>  d-none <?php endif; ?>" id="select_module">
                                <div class="input-group">
                                    <label class="input-group-text" for="inputGroupSelect01">Options <span class="text-danger">*</span></label>
                                        <select class="form-select <?php $__errorArgs = ['module'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="inputGroupSelect01" name="module">
                                            <option value="" selected="">Choose...</option>
                                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(old('module') == $permission->id): ?>  selected <?php endif; ?> value="<?php echo e($permission->id); ?>"><?php echo e($permission->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['module'];
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
                            <div class="form-check" style="margin-left:14px" >
                                <input class="form-check-input" type="checkbox" id="add_new_module" name="add_new_module_checkbox"  onChange="toggleModule()" <?php if(old('add_new_module_checkbox') == 'on'): ?>  checked <?php endif; ?>>
                                <label class="form-check-label" for="add_new_module">
                                    Add a New Module
                                </label>
                            </div>
                        </div>
                        <div class="row gy-4 mt-3  <?php if(old('add_new_module_checkbox') == 'on'): ?>  d-block <?php else: ?> d-none <?php endif; ?>" id="new_module">
                            <div class="col-lg-12">
                                <div>
                                    <label for="new_module" class="form-label">Enter Module Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['new_module'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('new_module')); ?>" name="new_module" id="new_module_value" placeholder="Enter Module Name">
                                    <?php $__errorArgs = ['new_module'];
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
                       
                        <div class="row gy-4 mt-3">
                            <div class="col-lg-12 ">
                                <div>
                                    <label for="permission_name" class="form-label">Enter Permission Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?php $__errorArgs = ['permission_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('permission_name')); ?>" name="permission_name" id="permission_name" placeholder="Enter Permission Name">
                                    <?php $__errorArgs = ['permission_name'];
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
                    <div class="text-end mb-1 mt-5">
                    <a href="<?php echo e(route('permissions')); ?>">
                            <button type="button" class="btn btn-primary waves-effect waves-light">
                                <i class="mdi mdi-cancel w-sm"></i> Cancel
                            </button>
                        </a>
                       <button type="button" class="btn btn-success w-sm submit_form">Create</button>
                    </div>
                </div>  
                
            </form>  
        </div>       
    </div>                               
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        function toggleModule()
        {
            if($('#add_new_module').is(":checked"))
            {
                $('#new_module').removeClass('d-none')
                $('#select_module').addClass('d-none')
            }
            else{
                $('#new_module').addClass('d-none')
                $('#select_module').removeClass('d-none')

            }
        }
        var errors_array = [];
      
        function formValidation(){
            $("#error_messages").empty();
            errors_array = [];
            var add_new_module = $('#add_new_module').is(":checked");
            if(add_new_module){
            var new_module =  $('#new_module_value').val();
            if(new_module == '' ){
            errors_array.push("Module name is required");
            }
            }else{
            var module =  $('#inputGroupSelect01').val();
            if(module == '' ){
            errors_array.push("Please select module name");
            }
            }
            permission_name =  $('#permission_name').val();
            if(permission_name == '' ){
            errors_array.push("Permission name is required");
            }

            if (errors_array.length > 0) 
            {  
                errors_array.forEach(myFunction);
                function myFunction(value, index, array) 
                {
                    $("#error_messages").append("<div class='alert alert-danger' >"+value+" </div>");
                }
            $(window).scrollTop(0);
                    return false;       
            }else{
                return true;
            }
        }
        $(".submit_form").on('click', function(event){
            var formValidationCheck  = formValidation();
            if(formValidationCheck){
                $("#add-permission-form").submit();
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/permissions/create.blade.php ENDPATH**/ ?>