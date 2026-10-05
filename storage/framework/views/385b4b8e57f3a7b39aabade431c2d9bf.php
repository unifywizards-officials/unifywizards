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
    $about = is_array($page->s4_about) ? $page->s4_about : json_decode($page->s4_about, true);

    $hasImage = !empty($about['image_path']);
    $hasStat = !empty($about['counter_number']);
?>

<?php if(!empty($about) && ($about['status'] ?? '') === 'active'): ?>

    <section class="tj-gtku-section section-gap">
        <div class="container">

            <div class="gtku-grid <?php echo e($hasImage ? '' : 'gtku-no-image'); ?>">

                <?php if($hasImage): ?>
                    <div class="gtku-image-col">

                        <div class="gtku-image-frame">

                            <img src="<?php echo e(asset('storage/' . $about['image_path'])); ?>"
                                alt="<?php echo e($about['title'] ?? 'About us'); ?>" class="gtku-img">

                            <?php if($hasStat): ?>
                                <div class="gtku-stat-badge">

                                    <div class="gtku-stat-number">
                                        <span class="odometer countup-number"
                                            data-count="<?php echo e($about['counter_number']); ?>">
                                            <?php echo e($about['counter_number']); ?>

                                        </span>

                                        <?php if(!empty($about['counter_suffix'])): ?>
                                            <sup><?php echo e($about['counter_suffix']); ?></sup>
                                        <?php endif; ?>
                                    </div>

                                    <?php if(!empty($about['counter_label'])): ?>
                                        <div class="gtku-stat-label">
                                            <?php echo e($about['counter_label']); ?>

                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endif; ?>

                        </div>

                    </div>
                <?php endif; ?>

                <div class="gtku-content-col">

                    <?php if(!empty($about['sub_title'])): ?>
                        <span class="sub-title">
                            <i class="tji-box"></i>
                            <?php echo e($about['sub_title']); ?>

                        </span>
                    <?php endif; ?>

                    <h2 class="sec-title">
                        <?php echo e($about['title'] ?? ''); ?>

                    </h2>

                    <?php if(!empty($about['description_1'])): ?>
                        <p class="desc">
                            <?php echo e($about['description_1']); ?>

                        </p>
                    <?php endif; ?>

                    <?php if(!empty($about['description_2'])): ?>
                        <p class="desc">
                            <?php echo e($about['description_2']); ?>

                        </p>
                    <?php endif; ?>

                    
                    <?php if(!$hasImage && $hasStat): ?>
                        <div class="gtku-stat-inline">

                            <div class="gtku-stat-number">
                                <span class="odometer countup-number" data-count="<?php echo e($about['counter_number']); ?>">
                                    <?php echo e($about['counter_number']); ?>

                                </span>

                                <?php if(!empty($about['counter_suffix'])): ?>
                                    <sup><?php echo e($about['counter_suffix']); ?></sup>
                                <?php endif; ?>
                            </div>

                            <?php if(!empty($about['counter_label'])): ?>
                                <div class="gtku-stat-label">
                                    <?php echo e($about['counter_label']); ?>

                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>

                    <?php if(!empty($about['button_text'])): ?>
                        <div class="gtku-btn-wrap">

                            <a class="tj-primary-btn" href="<?php echo e($about['button_url'] ?? '#'); ?>">

                                <span class="btn-text">
                                    <span>
                                        <?php echo e($about['button_text']); ?>

                                    </span>
                                </span>

                                <span class="btn-icon">
                                    <i class="tji-arrow-right-long"></i>
                                </span>

                            </a>

                        </div>
                    <?php endif; ?>

                </div>

            </div>

        </div>
    </section>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/get-to-know-us.blade.php ENDPATH**/ ?>