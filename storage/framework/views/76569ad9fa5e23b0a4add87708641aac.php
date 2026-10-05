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
    $industries = is_array($page->s3_industries) ? $page->s3_industries : json_decode($page->s3_industries, true);
?>

<?php if(!empty($industries) && ($industries['status'] ?? '') == 'active'): ?>
    <section class="tj-industries-section section-gap section-separator">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="sec-heading-wrap style-3 text-center">

                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s">
                            <i class="tji-box"></i>
                            <?php echo e($industries['sub_title'] ?? 'Industries We Serve'); ?>

                        </span>

                        <div class="sec-heading style-3">
                            <h2 class="sec-title">
                                <?php echo e($industries['heading'] ?? ''); ?>

                            </h2>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row gy-3 justify-content-center">

                <?php $__currentLoopData = $industries['items'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($item['name'])): ?>
                        <div class="col-6 col-md-2">

                            <a class="industries-card wow fadeInUp"
                                data-wow-delay="<?php echo e(0.2 + $index * 0.05); ?>s">

                                <div class="industries-icon <?php echo e($item['color_class'] ?? 'google-blue'); ?>">
                                    <?php echo $item['icon'] ?? ''; ?>

                                </div>

                                <p class="industries-title">
                                    <?php echo e($item['name']); ?>

                                </p>

                                <?php if(!empty($item['description'])): ?>
                                    <p class="industries-description">
                                        <?php echo e($item['description']); ?>

                                    </p>
                                <?php endif; ?>

                            </a>

                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>
    </section>
<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/industries-we-serve.blade.php ENDPATH**/ ?>