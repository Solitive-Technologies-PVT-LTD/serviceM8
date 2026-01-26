
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
                        <?php if($user->can('menus-create') ||  $isSuperAdmin): ?>
                            <a href="<?php echo e(route('menus.create')); ?>"><button type="button" class="btn btn-info">
                            Add Menu Item
                            </button>
                            </a>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">   
                    <div class="table-responsive">
                        <table id="datatable-menus" class="table table-flush table-hover table-striped align-middle table-nowrap mb-0">
                            <thead class="thead-light">
                                <tr>
                                <th>Title</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Route Name</th>
                                <th>Permission</th>
                                <th>Active</th>
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
      
            let table = $('#datatable-menus');
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
                ajax: '<?php echo route('menus.ajax_data'); ?>',
                columns: [
                    { data: 'title', name: 'title' },
                    { data: 'display_name', name: 'display_name' },
                    { data: 'description', name: 'description' },
                    { data: 'route_name', name: 'route_name' },
                    { data: 'permission', name: 'permission' },
                    { data: 'active', name: 'active' },
                    { data: 'actions', name: 'actions', searchable: false, orderable:false }
                ]
            });
            $('#datatable-menus_length').addClass('float-end');
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/menus/index.blade.php ENDPATH**/ ?>