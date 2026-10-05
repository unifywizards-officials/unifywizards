<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['position' => null]));

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

foreach (array_filter((['position' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    use App\Models\ExtraFold;

    // Current page ka URL lo
    $currentUrl = '/' . trim(request()->path(), '/');

    // Query build karo
    $query = ExtraFold::where('page_url', $currentUrl)->where('status', 1)->orderBy('sort_order', 'asc');

    // Agar position diya hai to sirf us sort_order wala fold lo
    if ($position !== null) {
        $query->where('sort_order', $position);
    }

    $extraFolds = $query->get();
?>

<?php $__currentLoopData = $extraFolds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fold): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <section class="tj-about-section h6-about section-gap section-gap-x">
        <div class="container">

            <div class="row align-items-center">

                
                <div class="col-xl-6 col-lg-6">

                    <div class="about-content-area h6-about-content style-1 wow fadeInLeft" data-wow-delay=".2s">

                        <div class="sec-heading style-2 style-6">

                            <?php if(!empty($fold->title)): ?>
                                <span class="sub-title wow fadeInUp text-white" data-wow-delay=".3s">
                                    <i class="tji-box text-white"></i>
                                    <?php echo e($fold->title); ?>

                                </span>
                            <?php endif; ?>

                            <?php if(!empty($fold->heading)): ?>
                                <h2 class="sec-title">
                                    <?php echo e($fold->heading); ?>

                                </h2><br>
                            <?php endif; ?>

                            <?php if(!empty($fold->description)): ?>
                                <div class="desc mb-1">
                                    <?php echo $fold->description; ?>

                                </div>
                            <?php endif; ?>
                            
                            
                           <?php if(!empty($fold->button_name) && !empty($fold->button_url)): ?>
                            <div class="btn-area wow fadeInUp" data-wow-delay=".8s" style="margin-top:40px;">
                        
                                <a class="tj-primary-btn" href="<?php echo e($fold->button_url); ?>">
                        
                                    <span class="btn-text">
                                        <span><?php echo e($fold->button_name); ?></span>
                                    </span>
                        
                                    <span class="btn-icon">
                                        <i class="tji-arrow-right-long"></i>
                                    </span>
                        
                                </a>
                        
                            </div>
                        <?php endif; ?>

                        </div>

                        <div class="h6-about-funfact-wrapper">
                            <div class="h6-about-funfact-shape">
                                <img src="<?php echo e(asset('home_assets/images/shape/about-counter-shape-blur.svg')); ?>"
                                    alt="">
                            </div>
                        </div>

                    </div>

                </div>

                
                <div class="col-xl-6 col-lg-6">

                    <div class="about-img-area h6-about-img wow fadeInLeft" data-wow-delay=".2s">

                        <div class="about-img overflow-hidden wow fadeInRight" data-wow-delay=".8s">

                            <?php if(!empty($fold->image)): ?>
                                <img data-speed=".8" src="<?php echo e(asset('storage/' . $fold->image)); ?>"
                                    alt="<?php echo e($fold->heading ?? ($fold->title ?? 'Extra Fold')); ?>">
                            <?php endif; ?>

                        </div>

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
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/extra-fold.blade.php ENDPATH**/ ?>