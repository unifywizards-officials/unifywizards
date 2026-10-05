<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['page']));

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

foreach (array_filter((['page']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $company = is_array($page->s6_our_company)
        ? $page->s6_our_company
        : json_decode($page->s6_our_company, true);
?>

<?php if(!empty($company) && ($company['status'] ?? 'active') === 'active'): ?>

<section class="tj-about-section h6-about section-gap section-gap-x">
    <div class="container">

        <div class="row align-items-center">

            <!-- Image FIRST -->
            <div class="col-xl-6 col-lg-6">

                <div class="about-img-area h6-about-img wow fadeInLeft" data-wow-delay=".2s">

                    <div class="about-img overflow-hidden wow fadeInRight" data-wow-delay=".8s">

                        <?php if(!empty($company['image_path'])): ?>
                            <img
                                data-speed=".8"
                                src="<?php echo e(asset('storage/' . $company['image_path'])); ?>"
                                alt="<?php echo e($company['title'] ?? 'Our Company'); ?>">
                        <?php endif; ?>

                    </div>

                </div>

            </div>

            <!-- Content SECOND -->
            <div class="col-xl-6 col-lg-6">

                <div class="about-content-area h6-about-content style-1 wow fadeInLeft"
                    data-wow-delay=".2s">

                    <div class="sec-heading style-2 style-6">

                        <?php if(!empty($company['sub_title'])): ?>
                            <span class="sub-title wow text-white fadeInUp" data-wow-delay=".3s">
                                <i class="tji-box text-white"></i>
                                <?php echo e($company['sub_title']); ?>

                            </span>
                        <?php endif; ?>

                        <?php if(!empty($company['title'])): ?>
                            <h2 class="sec-title">
                                <?php echo e($company['title']); ?>

                            </h2>
                        <?php endif; ?>

                        <?php if(!empty($company['description_1'])): ?>
                            <div class="desc s6-desc-content">
                                <?php echo $company['description_1']; ?>

                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="h6-about-funfact-wrapper">
                        <div class="h6-about-funfact-shape">
                            <img src="<?php echo e(asset('home_assets/images/shape/about-counter-shape-blur.svg')); ?>"
                                alt="">
                        </div>
                    </div>

                    <!--<?php if(!empty($company['button_text'])): ?>-->
                    <!--    <div class="btn-area wow fadeInUp" data-wow-delay=".8s">-->

                    <!--        <a class="tj-primary-btn"-->
                    <!--            href="<?php echo e($company['button_url'] ?? '#'); ?>">-->

                    <!--            <span class="btn-text">-->
                    <!--                <span><?php echo e($company['button_text']); ?></span>-->
                    <!--            </span>-->

                    <!--            <span class="btn-icon">-->
                    <!--                <i class="tji-arrow-right-long"></i>-->
                    <!--            </span>-->

                    <!--        </a>-->

                    <!--    </div>-->
                    <!--<?php endif; ?>-->

                </div>

            </div>

        </div>

    </div>

    <div class="bg-shape-1">
        <img src="<?php echo e(asset('home_assets/images/shape/pattern-2.svg')); ?>" alt="">
    </div>

    <div class="bg-shape-2">
        <img src="<?php echo e(asset('home_assets/images/shape/pattern-3.svg')); ?>" alt="">
    </div>

    <div class="bg-shape-3">
        <img src="<?php echo e(asset('home_assets/images/shape/shape-blur.svg')); ?>" alt="">
    </div>

</section>


<style>
    .s6-desc-content p {
        margin-bottom: 15px;
    }

    .s6-desc-content p:last-child {
        margin-bottom: 0;
    }
</style>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/our-company.blade.php ENDPATH**/ ?>