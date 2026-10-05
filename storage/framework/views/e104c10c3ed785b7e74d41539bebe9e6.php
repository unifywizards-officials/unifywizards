<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['companyOverview']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['companyOverview']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $customerImages = [];

    if (!empty($companyOverview?->customer_images)) {
        $customerImages = is_string($companyOverview->customer_images)
            ? json_decode($companyOverview->customer_images, true)
            : $companyOverview->customer_images;
    }

    $counters = [];

    if (!empty($companyOverview?->counters)) {
        $counters = is_string($companyOverview->counters)
            ? json_decode($companyOverview->counters, true)
            : $companyOverview->counters;
    }
?>

<section class="tj-about-section section-gap  ">
    <div class="container">
        <div class="row row-gap-4">

            
            <?php if(isset($counters[0])): ?>
                <?php
                    preg_match('/([\d\.]+)/', $counters[0]['number'], $numMatch);
                    preg_match('/([A-Za-z]+)/', $counters[0]['number'], $suffixMatch);

                    $countNumber = $numMatch[1] ?? 0;
                    $countSuffix = $suffixMatch[1] ?? '';
                ?>

                <div class="col-lg-4 col-md-6 order-lg-1 order-3">
                    <div class="countup-item style-2 wow fadeInUp" data-wow-delay=".1s">
                        <span class="count-icon">
                            <?php echo $counters[0]['icon'] ?? ''; ?>

                        </span>

                        <span class="steps">01.</span>

                        <div class="count-inner">
                            <span class="count-text">
                                <?php echo e($counters[0]['title'] ?? ''); ?>

                            </span>

                            <div class="inline-content google-red-text">
                                <span class="odometer countup-number" data-count="<?php echo e($countNumber); ?>">
                                </span>

                                <span class="count-plus">
                                    <?php echo e($countSuffix); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>


            
            <div class="col-lg-8 col-sm-12 order-lg-2 order-1">
                <div class="about-content-area-2 wow fadeInUp" data-wow-delay=".3s">

                    <div class="about-content">
                        <div class="sec-heading style-2">

                            <span class="sub-title">
                                <?php echo e($companyOverview->sub_title ?? ''); ?>

                            </span>

                            <h3 class="sec-title">
                                <?php echo e($companyOverview->title ?? ''); ?>

                            </h3>

                        </div>

                        <div class="wow fadeInUp" data-wow-delay=".3s">
                            <a class="text-btn" href="<?php echo e($companyOverview->button_link ?? '#'); ?>">

                                <span class="btn-text">
                                    <span>
                                        <?php echo e($companyOverview->button_text ?? 'Learn More'); ?>

                                    </span>
                                </span>

                                <span class="btn-icon">
                                    <i class="tji-arrow-right-long"></i>
                                </span>

                            </a>
                        </div>
                    </div>

                    <div class="video-img wow fadeInRight" data-wow-delay=".7s">

                        <img src="<?php echo e(asset($companyOverview->main_image)); ?>" alt="Company Overview" />

                        <?php if(!empty($companyOverview->video_url)): ?>
                            <a class="video-btn video-popup" data-autoplay="true" data-vbtype="video"
                                data-maxwidth="1200px" href="<?php echo e($companyOverview->video_url); ?>">

                                <span>
                                    <i class="tji-play"></i>
                                </span>

                            </a>
                        <?php endif; ?>

                    </div>

                </div>
            </div>


            
            <div class="col-lg-4 col-md-6 order-lg-3 order-2">
                <div class="customers-box style-2 wow fadeInUp" data-wow-delay=".3s">

                    <div class="customers-bg"
                        style="background-image:url('<?php echo e(asset($companyOverview->customer_bg)); ?>');">
                    </div>

                    <div class="customers">
                        <ul>

                            <?php $__currentLoopData = $customerImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="wow fadeInLeft" data-wow-delay=".<?php echo e($key + 3); ?>s">

                                    <img src="<?php echo e(asset($image)); ?>" alt="Customer">

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <li class="wow fadeInLeft" data-wow-delay=".6s">
                                <span>
                                    <i class="tji-plus"></i>
                                </span>
                            </li>

                        </ul>
                    </div>

                    <span class="customers-text wow fadeInLeft" data-wow-delay=".6s">
                        <?php echo e($companyOverview->customer_text ?? ''); ?>

                    </span>

                    <div class="star-icon zoomInOut">
                        <img src="<?php echo e(asset('home_assets/images/shape/star.svg')); ?>" alt="">
                    </div>

                </div>
            </div>


            
            <?php if(isset($counters[1])): ?>
                <?php
                    preg_match('/([\d\.]+)/', $counters[1]['number'], $numMatch);
                    preg_match('/([A-Za-z]+)/', $counters[1]['number'], $suffixMatch);

                    $countNumber = $numMatch[1] ?? 0;
                    $countSuffix = $suffixMatch[1] ?? '';
                ?>

                <div class="col-lg-4 col-md-6 order-lg-4 order-4">
                    <div class="countup-item style-2 wow fadeInUp" data-wow-delay=".5s">

                        <span class="count-icon">
                            <?php echo $counters[1]['icon'] ?? ''; ?>

                        </span>

                        <span class="steps">02.</span>

                        <div class="count-inner">

                            <span class="count-text">
                                <?php echo e($counters[1]['title'] ?? ''); ?>

                            </span>

                            <div class="inline-content">

                                <span class="odometer countup-number" data-count="<?php echo e($countNumber); ?>">
                                </span>

                                <span class="count-plus">
                                    <?php echo e($countSuffix); ?>

                                </span>

                            </div>

                        </div>

                    </div>
                </div>
            <?php endif; ?>


            
            <?php if(isset($counters[2])): ?>
                <?php
                    preg_match('/([\d\.]+)/', $counters[2]['number'], $numMatch);
                    preg_match('/([A-Za-z]+)/', $counters[2]['number'], $suffixMatch);

                    $countNumber = $numMatch[1] ?? 0;
                    $countSuffix = $suffixMatch[1] ?? '';
                ?>

                <div class="col-lg-4 col-md-6 order-lg-5 order-5">
                    <div class="countup-item style-2 wow fadeInUp" data-wow-delay=".7s">

                        <span class="count-icon">
                            <?php echo $counters[2]['icon'] ?? ''; ?>

                        </span>

                        <span class="steps">03.</span>

                        <div class="count-inner">

                            <span class="count-text">
                                <?php echo e($counters[2]['title'] ?? ''); ?>

                            </span>

                            <div class="inline-content">

                                <span class="odometer countup-number" data-count="<?php echo e($countNumber); ?>">
                                </span>

                                <span class="count-plus">
                                    <?php echo e($countSuffix); ?>

                                </span>

                            </div>

                        </div>

                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/company-overview.blade.php ENDPATH**/ ?>