<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['recognitionPress']));

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

foreach (array_filter((['recognitionPress']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $pressItems = [];
    if (!empty($recognitionPress?->press_items)) {
        $pressItems = is_string($recognitionPress->press_items)
            ? json_decode($recognitionPress->press_items, true)
            : $recognitionPress->press_items;
    }
?>
<section class="tj-featured-on section-gap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sec-heading-wrap style-3"
                    style="display:flex; flex-direction:column; align-items:center; text-align:center;">

                    <div class="heading-wrap-content"
                        style="display:flex; flex-direction:column; align-items:center; text-align:center; width:100%;">
                        <div class="sec-heading style-3" style="text-align:center;">
                            <h3 class="sec-title">
                                <?php echo e($recognitionPress->title ?? ''); ?>

                            </h3>
                        </div>
                        <p class="featured-on-desc wow fadeInUp" data-wow-delay=".5s"
                            style="text-align:center; max-width:640px; margin:10px auto 0;">
                            <?php echo e($recognitionPress->description ?? ''); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="featured-on-grid">
                    <?php $__currentLoopData = $pressItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            // Support either key name, in case the controller saves it as 'logo' or 'image'.
                            $logoPath = $item['logo'] ?? ($item['image'] ?? null);
                        ?>
                        <div class="featured-on-card wow fadeInUp" data-wow-delay="<?php echo e(0.2 + $index * 0.05); ?>s">
                            <div class="press-logo">
                                <?php if(!empty($logoPath)): ?>
                                    <img src="<?php echo e(asset($logoPath)); ?>"
                                        alt="<?php echo e($item['label'] ?? ($item['name'] ?? 'Press logo')); ?>"
                                        class="press-logo-img">
                                <?php else: ?>
                                    <div class="press-logo-placeholder">
                                        <?php echo e(strtoupper(substr($item['label'] ?? ($item['name'] ?? 'P'), 0, 1))); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                         
                           
                            
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section><?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/recognitionAndPress.blade.php ENDPATH**/ ?>