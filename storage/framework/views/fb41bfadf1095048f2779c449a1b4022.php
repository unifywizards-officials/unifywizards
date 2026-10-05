<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php
        $currentPage = request()->path() == '/' ? '/' : '/' . request()->path();
        $seo = \App\Models\SeoSetting::where('page_slug', $currentPage)->first();
    ?>
    <title><?php echo e($seo?->meta_title ?? config('app.name')); ?></title>
    <meta name="description" content="<?php echo e($seo?->meta_description ?? ''); ?>">
    <meta name="keywords" content="<?php echo e($seo?->meta_keywords ?? ''); ?>">
    <meta name="robots" content="<?php echo e($seo?->robots ?? 'index,follow'); ?>">
    <link rel="canonical" href="<?php echo e($seo?->canonical_url ?? url()->current()); ?>">
    <!-- Open Graph Tags -->
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:title" content="<?php echo e($seo?->og_title ?? ''); ?>">
    <meta property="og:description" content="<?php echo e($seo?->og_description ?? ''); ?>">
    <meta property="og:url" content="<?php echo e($seo?->canonical_url ?? url()->current()); ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo e($seo?->og_image ?? ''); ?>">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($seo?->meta_title ?? ''); ?>">
    <meta name="twitter:site" content="@UnifyWizards">
    <meta name="twitter:description" content="<?php echo e($seo?->og_description ?? ''); ?>">
    <meta name="twitter:image" content="<?php echo e($seo?->og_image ?? ''); ?>">
    <?php
        $settings = \App\Models\Setting::first();
     
    ?>
    <?php if($settings && $settings->favicon): ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('storage/'.$settings->favicon)); ?>" />
    <?php else: ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('home_assets/images/fav.png')); ?>" />
    <?php endif; ?>
    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('home_assets/css/bootstrap.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('home_assets/css/font-awesome-pro.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('home_assets/css/animate.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('home_assets/css/bexon-icons.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('home_assets/css/nice-select.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('home_assets/css/swiper.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('home_assets/css/venobox.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('home_assets/css/odometer-theme-default.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('home_assets/css/meanmenu.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('home_assets/css/main.css?v=1.3')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('home_assets/css/navbar.css?v=1.1')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('home_assets/css/service-form.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('home_assets/css/custom.css?v=1.1')); ?>" />
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php
        $currentPage = request()->path() == '/' ? '/' : '/' . request()->path();
        $schemas = \App\Models\Schema::where('status', 1)->where('page', $currentPage)->get();
    ?>
    <?php if($schemas->count()): ?>
        <?php $__currentLoopData = $schemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $items = json_decode($schema->json_data, true);
            ?>
            <?php if(is_array($items)): ?>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <script type="application/ld+json">
                    <?php echo json_encode($item, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>

                    </script>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</head>

<body>

    <div class="body-overlay"></div>
    <div id="tj-back-to-top">
        <span id="tj-back-to-top-percentage"></span>
    </div>
    <div class="search-popup-overlay"></div>

    <!-- Header -->
    <?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
 
    <div id="smooth-wrapper">
        <div id="smooth-content">

            <main id="primary" class="site-main">
                 <?php echo e($slot); ?>

              <!-- Footer -->
                <?php if (isset($component)) { $__componentOriginal8a8716efb3c62a45938aca52e78e0322 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a8716efb3c62a45938aca52e78e0322 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $attributes = $__attributesOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__attributesOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a8716efb3c62a45938aca52e78e0322)): ?>
<?php $component = $__componentOriginal8a8716efb3c62a45938aca52e78e0322; ?>
<?php unset($__componentOriginal8a8716efb3c62a45938aca52e78e0322); ?>
<?php endif; ?>
            </main>

        </div>
    </div>

    <!-- SEO Audit Popup -->
    <?php if (isset($component)) { $__componentOriginal5be308ef34d3f54a5da3b89c6c66317f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5be308ef34d3f54a5da3b89c6c66317f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-audit-popup','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-audit-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5be308ef34d3f54a5da3b89c6c66317f)): ?>
<?php $attributes = $__attributesOriginal5be308ef34d3f54a5da3b89c6c66317f; ?>
<?php unset($__attributesOriginal5be308ef34d3f54a5da3b89c6c66317f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5be308ef34d3f54a5da3b89c6c66317f)): ?>
<?php $component = $__componentOriginal5be308ef34d3f54a5da3b89c6c66317f; ?>
<?php unset($__componentOriginal5be308ef34d3f54a5da3b89c6c66317f); ?>
<?php endif; ?>

    <!-- Core JS — order important hai -->
    <script src="<?php echo e(asset('home_assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/gsap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/ScrollSmoother.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/gsap-scroll-to-plugin.min.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/gsap-scroll-trigger.min.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/gsap-split-text.min.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/jquery.nice-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/swiper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/odometer.min.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/venobox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/appear.min.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/wow.min.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/meanmenu.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/main.js?v=1.1')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/navbar.js?v=1.1')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/proposal.js')); ?>"></script>
    <script src="<?php echo e(asset('home_assets/js/seo-audit-popup.js')); ?>"></script>

</body>

</html>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>