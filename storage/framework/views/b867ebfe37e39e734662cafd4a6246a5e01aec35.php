<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?php echo e(url('/')); ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(url('/images/Tom-Pest-Control_logo.png')); ?>" alt="Tom's Pest Control" style="height: 35px; width: 35px; max-height: 35px; max-width: 35px; object-fit: contain;">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(url('/images/Tom-Pest-Control_logo.png')); ?>" alt="Tom's Pest Control" style="height: 140px; max-height: 140px; width: auto; object-fit: contain;">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?php echo e(url('/')); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(url('/images/Tom-Pest-Control_logo.png')); ?>" alt="Tom's Pest Control" style="height: 35px; width: 35px; max-height: 35px; max-width: 35px; object-fit: contain;">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(url('/images/Tom-Pest-Control_logo.png')); ?>" alt="Tom's Pest Control" style="height: 140px; max-height: 140px; width: auto; object-fit: contain;">
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
<?php /**PATH C:\laragon\www\serviceM8\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>