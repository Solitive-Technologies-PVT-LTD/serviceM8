
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
            <?php
                $isSuperAdmin = isSuperAdmin();
                $user = Auth::user();
                ?>
                    <div class="card-header">
                    <div class="row">
                        <div class="col-md-12 text-end ">
                        <?php if($user->can('users-create') ||  $isSuperAdmin): ?>
                            <a href="<?php echo e(route('users-create')); ?>"><button type="button" class="btn btn-info">
                            Add User
                            </button>
                            </a>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>   
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-permission" class="table table-flush table-hover table-striped align-middle table-nowrap mb-0">
                            <thead class="thead-light">
                                <tr>
                                   
                                    <th>Name</th>
                                    <th>Email</th>
                                    <tH>Contact No</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php echo $__env->make('layouts.datatable_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
         let table = $('#datatable-permission');
        $(function() {
            var columns = [ 0,1,2,3 ];
                table.DataTable({
                processing: true,
                serverSide: true,
                stateSave: false,
                responsive: true,
                autoWidth:false,
                lengthMenu: [[10, 25, 50, 75, 100], [10, 25, 50, 75, 100]],
                aaSorting : [[0, 'desc']],
                pagingType: "full_numbers",
                pageLength: 50,
                dom: 'Blrtip',
                buttons: [{
                    extend: 'colvis'
                    }
                ],
                ajax: '<?php echo url('/users/getData'); ?>',
               
                columns: [
                  
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'contact_number', name: 'contact_number' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'actions', name: 'actions', searchable: false, orderable:false }
                ]
            });
            $('#datatable-permission_length').addClass('float-end');
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/users/index.blade.php ENDPATH**/ ?>