<?php
    $appHeaderAttr = !empty($appHeaderInverse) ? ' data-bs-theme=dark' : '';
    $appHeaderMenu = !empty($appHeaderMenu) ? $appHeaderMenu : '';
    $appHeaderMegaMenu = !empty($appHeaderMegaMenu) ? $appHeaderMegaMenu : '';
    $appHeaderTopMenu = !empty($appHeaderTopMenu) ? $appHeaderTopMenu : '';
?>
<style>
    .w-125px {
        width: 125px !important;
    }
</style>

<!-- BEGIN #header -->
<div id="header" class="app-header" <?php echo e($appHeaderAttr); ?>>
    <!-- BEGIN navbar-header -->
    <div class="navbar-header">
        <?php if($appSidebarTwo): ?>
            <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-end-mobile">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        <?php endif; ?>
        <a href="/" class="navbar-brand"> <img src="<?php echo e(asset('assets/img/logo-main.webp')); ?>" class="img-fluid"
                alt="logo" style="max-height: 45px;"></a>
        <?php if($appHeaderMegaMenu && !$appSidebarTwo): ?>
            <button type="button" class="navbar-mobile-toggler" data-bs-toggle="collapse" data-bs-target="#top-navbar">
                <span class="fa-stack fa-lg">
                    <i class="far fa-square fa-stack-2x"></i>
                    <i class="fa fa-cog fa-stack-1x mt-1px"></i>
                </span>
            </button>
        <?php endif; ?>
        <?php if($appTopMenu && !$appSidebarHide && !$appSidebarTwo): ?>
            <button type="button" class="navbar-mobile-toggler" data-toggle="app-top-menu-mobile">
                <span class="fa-stack fa-lg">
                    <i class="far fa-square fa-stack-2x"></i>
                    <i class="fa fa-cog fa-stack-1x mt-1px"></i>
                </span>
            </button>
        <?php endif; ?>
        <?php if($appTopMenu && $appSidebarHide && !$appSidebarTwo): ?>
            <button type="button" class="navbar-mobile-toggler" data-toggle="app-top-menu-mobile">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        <?php endif; ?>
        <?php if(!$appSidebarHide): ?>
            <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        <?php endif; ?>
    </div>

    <?php echo $__env->renderWhen($appHeaderMegaMenu, 'includes.component.header-mega-menu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1])); ?>

    <!-- BEGIN header-nav -->
    <div class="navbar-nav">
        <div class="navbar-item navbar-form">

            <a href="<?php echo e(url('create-storage-link')); ?>" class="btn btn-success">
                Storage Link
            </a>

        </div>
        <div class="navbar-item dropdown">
            <a href="<?php echo e(url('clear-route')); ?>" class="btn btn-success">
                Clear Cache
            </a>

        </div>

        <?php if(isset($appHeaderLanguageBar)): ?>
            <?php echo $__env->make('includes.component.header-language-bar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?>

        <div class="navbar-item navbar-user dropdown">
            <a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">

                <?php if(isset(Auth::user()->profile_image)): ?>
                    <img src="<?php echo e(asset('storage/' . Auth::user()->profile_image)); ?>" alt="" />
                <?php else: ?>
                    <img src="/assets/img/user/user-13.jpg" alt="" />
                <?php endif; ?>
                <span>
                    <span class="d-none d-md-inline">
                        <?php if(isset(Auth::user()->profile_image)): ?>
                            <?php echo e(Auth::user()->name); ?>

                        <?php endif; ?>
                    </span>
                    <b class="caret"></b>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end me-1">
                <a href="<?php echo e(route('admin.profile.edit')); ?>" class="dropdown-item">Edit Profile</a>


                <div class="dropdown-divider"></div>
                <a href="<?php echo e(route('logout')); ?>"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="dropdown-item">Log Out</a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </div>

        <?php if($appSidebarTwo): ?>
            <div class="navbar-divider d-none d-md-block"></div>
            <div class="navbar-item d-none d-md-block">
                <a href="javascript:;" data-toggle="app-sidebar-end" class="navbar-link icon">
                    <i class="fa fa-th"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <!-- END header-nav -->
</div>
<!-- END #header -->
<?php /**PATH D:\backend\unify-wizards-new\resources\views/includes/header.blade.php ENDPATH**/ ?>