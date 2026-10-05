<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['solution']));

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

foreach (array_filter((['solution']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $services = [];

    if (!empty($solution->services)) {
        $services = is_string($solution->services) ? json_decode($solution->services, true) : $solution->services;
    }
?>

<section class="tj-service-section-5 section-gap">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="sec-heading style-4 text-center">
                    <span class="sub-title" data-wow-delay=".3s">
                        <i class="tji-box"></i>
                        <?php echo e($solution->sub_title); ?>

                    </span>

                    <h2 class="sec-title">
                        <?php echo str_replace(
                            $solution->highlight_text,
                            '<span class="google-text">' . $solution->highlight_text . '</span>',
                            $solution->title,
                        ); ?>

                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="service-wrapper">

                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="service-item style-5 <?php echo e(!$loop->last ? 'service-stack' : ''); ?>">
                            <div class="row">

                                <div class="service-content-area col-lg-9">

                                    <div class="service-content fold-content-mb-5 position-relative">

                                        <div class="service-icon">
                                            <?php echo $service['icon'] ?? ''; ?>

                                        </div>

                                        <span class="no">
                                            <?php echo e(sprintf('%02d', $index + 1)); ?>.
                                        </span>

                                        
                                        
                                        <?php echo $service['description'] ?? ''; ?>


                                        <?php if(!empty($service['tags'])): ?>
                                            <div class="d-flex mt-4">

                                                <?php $__currentLoopData = $service['tags']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="tooltip-container">
                                                        <span class="text">
                                                            <?php echo e($tag['text']); ?>

                                                        </span>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </div>
                                        <?php endif; ?>

                                        <?php if(!empty($service['button_text'])): ?>
                                            <a class="tj-primary-btn" href="<?php echo e($service['button_link'] ?? '#'); ?>">

                                                <span class="btn-text">
                                                    <span>
                                                        <?php echo e($service['button_text']); ?>

                                                    </span>
                                                </span>

                                                <span class="btn-icon">
                                                    <i class="tji-arrow-right-long"></i>
                                                </span>
                                            </a>
                                        <?php endif; ?>

                                    </div>
                                </div>

                                <div class="service-img col-lg-3">

                                    <?php if(!empty($service['image'])): ?>
                                        <img src="<?php echo e(asset($service['image'])); ?>"
                                            alt="<?php echo e(strip_tags($service['title'] ?? 'Service')); ?>">
                                    <?php endif; ?>

                                </div>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="service-bottom-text">
                        <p class="desc">
                            <span>
                                <i class="tji-box"></i>

                                <?php echo e($solution->bottom_text); ?>


                            &nbsp;
                            <a href="<?php echo e($solution->bottom_button_link); ?>">
                                <?php echo e($solution->bottom_button_text); ?>

                            </a>
                        </p>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/solutions.blade.php ENDPATH**/ ?>