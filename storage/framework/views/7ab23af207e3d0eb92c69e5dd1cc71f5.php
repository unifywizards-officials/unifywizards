<?php
    $logos = [];

    if (!empty($clientlogos->logos)) {
        $logos = is_string($clientlogos->logos) ? json_decode($clientlogos->logos, true) : $clientlogos->logos;
    }
?>

<section class="tj-client-section client-section-gap wow fadeInUp" data-wow-delay=".4s">
    <div class="container-fluid client-container">
        <div class="row">
            <div class="col-12">

                <div class="client-content">
                    <h5 class="sec-title">
                        <?php echo e($clientlogos->title ?? 'Join Over'); ?>


                        <span class="client-numbers">
                            <?php echo e($clientlogos->highlight_number ?? ''); ?>

                        </span>

                        <span class="client-text">
                            <?php echo e($clientlogos->highlight_text ?? ''); ?>

                        </span>
                    </h5>
                </div>

                <?php if(!empty($logos)): ?>
                    <div class="swiper client-slider client-slider-1">
                        <div class="swiper-wrapper">

                            <?php $__currentLoopData = $logos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide client-item">
                                    <div class="client-logo">
                                        <img src="<?php echo e(asset($logo)); ?>" alt="Client Logo">
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/client-logos.blade.php ENDPATH**/ ?>