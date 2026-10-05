<?php
    $section = $page->s14_our_process ?? null;

    if (is_string($section)) {
        $section = json_decode($section, true);
    }
?>

<?php if(!empty($section) && ($section['status'] ?? '') === 'active'): ?>

    <section class="h5-working-process section-gap section-gap-x">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading sec-heading-centered style-3">

                        <?php if(!empty($section['heading'])): ?>
                            <span class="sub-title wow fadeInUp" data-wow-delay=".3s">
                                <i class="tji-box"></i>
                                <?php echo e($section['heading']); ?>

                            </span>
                        <?php endif; ?>

                        <?php if(!empty($section['description'])): ?>
                            <h2 class="sec-title text-anim text-white">
                                <?php echo e($section['description']); ?>

                            </h2>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="h5-working-process-inner">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="working-process-area h5-working-process-wrapper">

                            <?php $__currentLoopData = $section['items'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $stepNumber = $index + 1;
                                    $formattedStep = str_pad($stepNumber, 2, '0', STR_PAD_LEFT);

                                    $delay = 0.3 + $index * 0.1;
                                ?>

                                <div class="process-item h5-working-process-item wow bounceInUp"
                                    data-wow-delay="<?php echo e($delay); ?>s">

                                    <span class="h5-working-process-indicator">
                                        Step <?php echo e($formattedStep); ?>

                                    </span>

                                    <div class="process-step">
                                        <span><?php echo e($formattedStep); ?></span>
                                    </div>

                                    <div class="process-content">

                                        <?php if(!empty($item['title'])): ?>
                                            <span class="title" style="font-size: 22px;">
                                                <?php echo e($item['title']); ?>

                                            </span>
                                        <?php endif; ?>

                                        <?php if(!empty($item['description'])): ?>
                                            <p class="desc" style="margin-top: 20px;">
                                                <?php echo e($item['description']); ?>

                                            </p>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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

        <div class="bg-shape-4">
            <img src="<?php echo e(asset('home_assets/images/shape/shape-blur.svg')); ?>" alt="">
        </div>
    </section>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/our-process.blade.php ENDPATH**/ ?>