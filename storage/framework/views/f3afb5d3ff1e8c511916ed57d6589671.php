<?php
    $platforms = [
        'clutch' => ['name' => 'Clutch', 'color' => '#EE3423', 'glyph' => 'letter', 'letter' => 'C'],
        'trustpilot' => ['name' => 'Trustpilot', 'color' => '#00B67A', 'glyph' => 'star', 'letter' => ''],
        'google' => ['name' => 'Google Reviews', 'color' => '#4285F4', 'glyph' => 'letter', 'letter' => 'G'],
    ];

    $images = $getreviewscreenshot->images ?? [];

    if (!is_array($images)) {
        $images = json_decode($images, true) ?? [];
    }
?>

<?php if($getreviewscreenshot && $getreviewscreenshot->status): ?>

    <section class="tj-client-reviews-section section-gap">
        <div class="container">

            <div class="crv-heading-wrap">

                <h3 class="sec-title">
                    <?php echo $getreviewscreenshot->highlight_text
                        ? str_replace(
                            $getreviewscreenshot->highlight_text,
                            '<span>' . e($getreviewscreenshot->highlight_text) . '</span>',
                            e($getreviewscreenshot->heading),
                        )
                        : e($getreviewscreenshot->heading); ?>

                </h3>

                <?php if($getreviewscreenshot->description): ?>
                    <p class="desc">
                        <?php echo e($getreviewscreenshot->description); ?>

                    </p>
                <?php endif; ?>

            </div>

            <div class="crv-slider">

                <div class="crv-card-wrap">

                    <?php $__currentLoopData = $platforms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php
                            $screenshot = $images[$key] ?? null;
                        ?>

                        <div class="crv-card" data-platform="<?php echo e($key); ?>"
                            style="--crv-color: <?php echo e($platform['color']); ?>;">

                            <div class="crv-card-head">

                                <span class="crv-platform-icon">
                                    <?php if($platform['glyph'] === 'star'): ?>
                                        <svg width="30" height="30" viewBox="0 0 24 24" fill="<?php echo e($platform['color']); ?>">
                                            <path
                                                d="M12 2l2.9 6.6 7.1.6-5.4 4.7 1.7 7-6.3-3.9-6.3 3.9 1.7-7L2 9.2l7.1-.6z" />
                                        </svg>
                                    <?php else: ?>
                                        <span class="crv-platform-letter">
                                            <?php echo e($platform['letter']); ?>

                                        </span>
                                    <?php endif; ?>
                                </span>

                                <span class="crv-platform-name">
                                    <?php echo e($platform['name']); ?>

                                </span>

                                <span class="crv-verified">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 6L9 17l-5-5" />
                                    </svg>
                                    Verified Reviews
                                </span>

                            </div>

                            <div class="crv-screenshot">
                                <?php if($screenshot): ?>
                                    <img src="<?php echo e(asset('storage/' . $screenshot)); ?>"
                                        alt="<?php echo e($platform['name']); ?> reviews screenshot">
                                <?php else: ?>
                                    <div class="crv-screenshot-empty">
                                        <?php echo e($platform['name']); ?> screenshot coming soon
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

            </div>

        </div>
    </section>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/client-reviews.blade.php ENDPATH**/ ?>