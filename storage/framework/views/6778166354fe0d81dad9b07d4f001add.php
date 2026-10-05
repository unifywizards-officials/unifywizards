<?php
    $hero = $hero ?? null;

    $customerImages = is_string($hero->customer_images ?? null)
        ? json_decode($hero->customer_images, true)
        : $hero->customer_images ?? [];

    $awardImages = is_string($hero->award_images ?? null)
        ? json_decode($hero->award_images, true)
        : $hero->award_images ?? [];
?>

<?php if($hero): ?>

    <section class="tj-banner-section section-gap-x">
        <div class="banner-area">

            
            <div class="banner-left-box">
                <div class="banner-content">

                    <span class="sub-title">
                        <i class="tji-excellence"></i>
                        <?php echo e($hero->sub_title); ?>

                    </span>

                    <h1 class="banner-title">
                        <?php echo str_replace($hero->highlight_text, "<span>{$hero->highlight_text}</span>", e($hero->title)); ?>

                    </h1>

                    <div class="banner-desc-area">
                        <div class="banner-desc">
                            <?php echo e($hero->description); ?>

                        </div>
                    </div>

                    
                    <div class="row">
                        <?php $__currentLoopData = $awardImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-6 col-lg-3 d-flex justify-content-center">
                                <img src="<?php echo e(asset($img)); ?>" class="award-width">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>

                <div class="banner-shape">
                    <img src="<?php echo e(asset('home_assets/images/shape/pattern-bg.webp')); ?>">
                </div>
            </div>

            
            <div class="banner-right-box">

                <div class="banner-img">
                    <img data-speed="0.8" src="<?php echo e(asset($hero->hero_image)); ?>">
                </div>

                <div class="box-area">
                    <div class="customers-box">

                        <div class="customers">
                            <ul>

                                <?php $__currentLoopData = $customerImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <img src="<?php echo e(asset($img)); ?>">
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <li><span><i class="tji-plus"></i></span></li>

                            </ul>
                        </div>

                        <div class="customers-number google-text">
                            <?php echo e($hero->customer_count); ?>K
                        </div>

                        <span class="customers-text">
                            <?php echo e($hero->customer_text); ?>

                        </span>

                    </div>
                </div>

            </div>

        </div>

        <?php if($hero->scroll_button_link): ?>
            <div class="banner-scroll">
                <a href="<?php echo e($hero->scroll_button_link); ?>">
                    <?php echo e($hero->scroll_button_text ?? 'Scroll Down'); ?>

                </a>
            </div>
        <?php endif; ?>

    </section>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/hero.blade.php ENDPATH**/ ?>