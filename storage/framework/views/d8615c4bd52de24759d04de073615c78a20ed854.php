<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?php echo e(url('/')); ?>" class="logo logo-dark">
            <span class="logo-sm">
            <?php if(empty(get_setting('company_logo'))): ?>
            <!-- <img src="<?php echo e(url('/assets/images/favicon.jpeg')); ?>" alt="Logo" height="50" width="50"> -->
            <?php else: ?>
            <!-- <img src="<?php echo e(url('/storage/'.get_setting('company_logo_sm'))); ?>" alt="Logo" height="50" width="50"> -->
            <?php endif; ?>
            </span>
            <span class="logo-lg">
            <?php if(empty(get_setting('company_logo'))): ?>
            <!-- <img src="<?php echo e(url('/assets/images/favicon.jpeg')); ?>" alt="Logo" height="60"> -->
            <?php else: ?>
            <!-- <img src="<?php echo e(url('/storage/'.get_setting('company_logo'))); ?>" alt="Logo" height="60"> -->
            <?php endif; ?>
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?php echo e(url('/')); ?>" class="logo logo-light">
            <span class="logo-sm">
            <?php if(empty(get_setting('company_logo'))): ?>
            <!-- <img src="<?php echo e(url('/assets/images/favicon.jpeg')); ?>" alt="Logo" height="50" width="50"> -->
            <?php else: ?>
            <!-- <img src="<?php echo e(url('/storage/'.get_setting('company_logo_sm'))); ?>" alt="Logo" height="50" width="50"> -->
            <?php endif; ?>
            </span>
            <span class="logo-lg">
            <?php if(empty(get_setting('company_logo'))): ?>
            <!-- <img src="<?php echo e(url('/assets/images/favicon.jpeg')); ?>" alt="Logo" height="60"> -->
            <?php else: ?>
            <!-- <img src="<?php echo e(url('/storage/'.get_setting('company_logo'))); ?>" alt="Logo" height="60"> -->
            <?php endif; ?>
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
           
                <li class="menu-title"><span ><?php echo app('translator')->get('translation.menu'); ?></span></li>

               
                <?php echo create_menus(); ?>

                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<?php /**PATH C:\laragon\www\laravel-app\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>