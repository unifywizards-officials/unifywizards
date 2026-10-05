<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">

<head>
    <?php echo $__env->make('includes.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('assets/img/logo-main.webp')); ?>" type="image/webp">
</head>
<?php
    $bodyClass = !empty($appBoxedLayout) ? 'boxed-layout ' : '';
    $bodyClass .= !empty($paceTop) ? 'pace-top ' : $bodyClass;
    $bodyClass .= !empty($bodyClass) ? $bodyClass . ' ' : $bodyClass;
    $appSidebarHide = !empty($appSidebarHide) ? $appSidebarHide : '';
    $appHeaderHide = !empty($appHeaderHide) ? $appHeaderHide : '';
    $appSidebarTwo = !empty($appSidebarTwo) ? $appSidebarTwo : '';
    $appSidebarSearch = !empty($appSidebarSearch) ? $appSidebarSearch : '';
    $appTopMenu = !empty($appTopMenu) ? $appTopMenu : '';

    $appClass = !empty($appTopMenu) ? 'app-with-top-menu ' : '';
    $appClass .= !empty($appHeaderHide) ? 'app-without-header ' : ' app-header-fixed ';
    $appClass .= !empty($appSidebarEnd) ? 'app-with-end-sidebar ' : '';
    $appClass .= !empty($appSidebarWide) ? 'app-with-wide-sidebar ' : '';
    $appClass .= !empty($appSidebarHide) ? 'app-without-sidebar ' : '';
    $appClass .= !empty($appSidebarMinified) ? 'app-sidebar-minified ' : '';
    $appClass .= !empty($appSidebarTwo) ? 'app-with-two-sidebar app-sidebar-end-toggled ' : '';
    $appClass .= !empty($appSidebarHover) ? 'app-with-hover-sidebar ' : '';
    $appClass .= !empty($appContentFullHeight) ? 'app-content-full-height ' : '';

    $appContentClass = !empty($appContentClass) ? $appContentClass : '';
?>

<body class="<?php echo e($bodyClass); ?>">
    <?php echo $__env->make('includes.component.page-loader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div id="app" class="app app-sidebar-fixed <?php echo e($appClass); ?>">

        <?php echo $__env->renderWhen(!$appHeaderHide, 'includes.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1])); ?>

        <?php echo $__env->renderWhen($appTopMenu, 'includes.top-menu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1])); ?>


        <div id="content" class="app-content <?php echo e($appContentClass); ?>">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <?php echo $__env->make('includes.component.scroll-top-btn', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>



    </div>

    <?php echo $__env->yieldContent('outside-content'); ?>

    <?php echo $__env->make('includes.page-js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>

</html>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/layouts/default.blade.php ENDPATH**/ ?>