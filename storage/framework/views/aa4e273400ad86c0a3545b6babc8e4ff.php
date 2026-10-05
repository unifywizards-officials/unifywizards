<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['pricing']));

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

foreach (array_filter((['pricing']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $pricingCards = [];

    if (!empty($pricing->pricing_cards)) {
        $pricingCards = is_string($pricing->pricing_cards)
            ? json_decode($pricing->pricing_cards, true)
            : $pricing->pricing_cards;
    }

    /*
    |--------------------------------------------------------------------------
    | Safety Check
    |--------------------------------------------------------------------------
    */

    if (!is_array($pricingCards)) {
        $pricingCards = [];
    }
?>




<section class="container pricing-section section-gap">


    

    <div class="ps-header" >

        <div class="ps-label">
            <span class="ps-label-dot"></span>
            Pricing
        </div>

        <h2 class="ps-title">

            <?php echo e($pricing->title ?? 'Our'); ?>


            <?php if(!empty($pricing->highlight_text)): ?>
                <span class="ps-title-accent">
                    <?php echo e($pricing->highlight_text); ?>

                </span>
            <?php endif; ?>

        </h2>

    </div>


    

    <div class="ps-grid">

        <?php $__currentLoopData = $pricingCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php

                $icon = trim($card['icon'] ?? '');

                $featured = !empty($card['featured']);

                $tags = $card['tags'] ?? [];

            ?>


            

            <div class="ps-card <?php echo e($featured ? 'ps-card--featured' : ''); ?>">

                <?php if($featured): ?>
                    <span class="ps-featured-badge">Most Popular</span>
                <?php endif; ?>

                <div class="ps-icon">
                    <?php if(!empty($icon)): ?>
                        <i class="<?php echo e($icon); ?>" aria-hidden="true"></i>
                    <?php endif; ?>
                </div>

                <div class="ps-card-name"><?php echo e($card['title'] ?? ''); ?></div>

                <div class="ps-card-sub"><?php echo e($card['subtitle'] ?? ''); ?></div>

                <div class="ps-card-price">

                    <?php echo e($card['price'] ?? ''); ?>


                    <?php if(!empty($card['price_unit'])): ?>
                        <span class="ps-price-unit"><?php echo e($card['price_unit']); ?></span>
                    <?php endif; ?>

                </div>

                <?php if(!empty($tags)): ?>

                    <div class="ps-card-divider"></div>

                    <ul class="ps-features">
                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!empty($tag['text'])): ?>
                                <li class="ps-feature-item">
                                    <span class="ps-feature-icon">
                                        <i class="<?php echo e(!empty($tag['icon']) ? $tag['icon'] : 'fa-solid fa-check'); ?>" aria-hidden="true"></i>
                                    </span>
                                    <?php echo e($tag['text']); ?>

                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>

                <?php endif; ?>

                <div class="ps-card-actions">

                    <?php if(!empty($card['explore_button_text'])): ?>
                        <a href="<?php echo e($card['explore_button_link'] ?? 'javascript:void(0)'); ?>" class="ps-btn-primary">
                            <?php echo e($card['explore_button_text']); ?>

                        </a>
                    <?php endif; ?>

                    <?php if(!empty($card['contact_button_text'])): ?>
                        <a href="<?php echo e($card['contact_button_link'] ?? 'javascript:void(0)'); ?>" class="ps-btn-outline">
                            <?php echo e($card['contact_button_text']); ?>

                        </a>
                    <?php endif; ?>

                </div>

            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

</section>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/our-price.blade.php ENDPATH**/ ?>