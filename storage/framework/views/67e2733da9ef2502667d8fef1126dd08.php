<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['processData']));

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

foreach (array_filter((['processData']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $processItems = [];

    if (!empty($processData?->process_items)) {
        $processItems = is_string($processData->process_items)
            ? json_decode($processData->process_items, true)
            : $processData->process_items;
    }
?>

<section class="h10-process section-gap section-gap-x tj-sticky-panel-3-container">
    <div class="container">

        <div class="row">

            
            <div class="col-12 col-lg-5">
                <div class="sec-heading style-3 tj-sticky-panel-3">

                    <span class="sub-title google-text">
                        <i class="tji-box google-text"></i>
                        <?php echo e($processData->sub_title ?? ''); ?>

                    </span>

                    <h3 class="sec-title" style="font-size:40px;">
                        <?php echo e($processData->title ?? ''); ?>

                    </h3>

                    <?php if(!empty($processData->description_1)): ?>
                        <p class="desc text-white">
                            <?php echo e($processData->description_1); ?>

                        </p>
                    <?php endif; ?>

                    <?php if(!empty($processData->description_2)): ?>
                        <p class="desc text-white">
                            <?php echo e($processData->description_2); ?>

                        </p>
                    <?php endif; ?>

                    <div class="h10-process-more">
                        <a class="tj-primary-btn" href="<?php echo e($processData->button_link ?? '#'); ?>">

                            <span class="btn-text">
                                <span>
                                    <?php echo e($processData->button_text ?? 'Explore More'); ?>

                                </span>
                            </span>

                            <span class="btn-icon">
                                <i class="tji-arrow-right-long"></i>
                            </span>

                        </a>
                    </div>

                </div>
            </div>

            
            <div class="col-12 col-lg-7">
                <div class="h10-process-wrapper">

                    <?php $__currentLoopData = $processItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="h10-process-item tj-sticky-panel-3"
                            style="margin-bottom:20px; padding:24px 28px;">

                            <span class="h10-process-sln">
                                Step <?php echo e(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?>

                            </span>

                            <div class="h10-process-content" style="display:flex; flex-direction:column; margin-top:10px;">

                                
                                <div style="display:flex; align-items:center; gap:14px;margin-top: 22px;">

                                    <div class="h10-process-icon google-red-background"
                                        style="margin:0 !important; flex-shrink:0;">
                                        <?php echo $item['icon'] ?? ''; ?>

                                    </div>

                                    <span class="title" style="font-size:22px; margin:0;">
                                        <?php echo e($item['title'] ?? ''); ?>

                                    </span>

                                </div>

                                
                                <?php if(!empty($item['description_1'])): ?>
                                    <p class="desc" style="margin-top:10px;">
                                        <?php echo e($item['description_1']); ?>

                                    </p>
                                <?php endif; ?>

                                <?php if(!empty($item['description_2'])): ?>
                                    <p class="desc" style="margin-top:4px;">
                                        <?php echo e($item['description_2']); ?>

                                    </p>
                                <?php endif; ?>

                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>

        </div>

    </div>

    
    <div class="bg-shape-1">
        <img src="<?php echo e(asset('assets/images/shape/pattern-2.svg')); ?>" alt="" />
    </div>

    <div class="bg-shape-2">
        <img src="<?php echo e(asset('assets/images/shape/pattern-3.svg')); ?>" alt="" />
    </div>

    <div class="bg-shape-3">
        <img src="<?php echo e(asset('assets/images/shape/h7-testimonial-shape-blur.svg')); ?>" alt="" />
    </div>

</section>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/process.blade.php ENDPATH**/ ?>