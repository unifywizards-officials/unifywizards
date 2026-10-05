<?php
    $poweredBy = is_array($page->s8_powered_by) ? $page->s8_powered_by : json_decode($page->s8_powered_by, true);
?>

<?php if(!empty($poweredBy) && ($poweredBy['status'] ?? '') === 'active'): ?>

    <section class="tj-service-section service-3 section-gap">
        <div class="container">

            
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-heading style-3 text-center">

                        <?php if(!empty($poweredBy['sub_title'])): ?>
                            <span class="sub-title wow fadeInUp" data-wow-delay=".3s">
                                <i class="tji-box"></i><?php echo e($poweredBy['sub_title']); ?>

                            </span>
                        <?php endif; ?>

                        <?php if(!empty($poweredBy['heading'])): ?>
                            <h3 class="sec-title">
                                <?php echo e($poweredBy['heading']); ?>

                            </h3><br>
                        <?php endif; ?>

                        <?php if(!empty($poweredBy['description'])): ?>
                            <p class="desc wow fadeInUp" data-wow-delay=".5s">
                                <?php echo e($poweredBy['description']); ?>

                            </p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-12">

                    <div class="service-wrapper">

                        <?php $__currentLoopData = $poweredBy['items'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="service-item style-3 wow fadeInUp" data-wow-delay="<?php echo e(0.2 + $index * 0.1); ?>s">

                                <div class="service-content-wrap">

                                    <div class="service-title">

                                        <div class="service-icon">
                                            <?php echo $item['icon'] ?? ''; ?>

                                        </div>

                                        <span class="span-title-black">
                                            <a>
                                                <?php echo e($item['heading'] ?? ''); ?>

                                            </a>
                                        </span>

                                    </div>

                                    <div class="service-content">
                                        <p class="desc">
                                            <?php echo e($item['description'] ?? ''); ?>

                                        </p>
                                    </div>

                                </div>

                                <div class="service-reveal-bg"
                                    data-bg-image="<?php echo e(!empty($item['image_path']) ? asset('storage/' . $item['image_path']) : ''); ?>">
                                </div>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                    
                    <?php if(!empty($poweredBy['button_text'])): ?>
                        <div class="service-btn-area text-center wow fadeInUp" data-wow-delay=".3s">

                            <a class="tj-primary-btn" href="<?php echo e($poweredBy['button_url'] ?? '#'); ?>">

                                <span class="btn-text">
                                    <span><?php echo e($poweredBy['button_text']); ?></span>
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
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/powered-by.blade.php ENDPATH**/ ?>