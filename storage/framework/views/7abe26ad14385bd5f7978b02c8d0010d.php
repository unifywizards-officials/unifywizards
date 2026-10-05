<?php
    $section = $page->s12_cta ?? null;

    if (is_string($section)) {
        $section = json_decode($section, true);
    }
?>

<?php if(!empty($section) && ($section['status'] ?? '') === 'active'): ?>

    <section class="tj-cta-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-area">

                        <div class="cta-content">

                            <?php if(!empty($section['sub_title'])): ?>
                                <span class="cta-eyebrow"><?php echo e($section['sub_title']); ?></span>
                            <?php endif; ?>

                            <?php if(!empty($section['heading'])): ?>
                                <span class="title title-anim">
                                    <?php echo e($section['heading']); ?>

                                </span>
                            <?php endif; ?>

                            <?php if(!empty($section['description'])): ?>
                                <p class="cta-desc">
                                    <?php echo e($section['description']); ?>

                                </p>
                            <?php endif; ?>

                            <ul class="cta-points">
                                <li><i class="fa-solid fa-circle-check"></i> Free strategy consultation</li>
                                <li><i class="fa-solid fa-circle-check"></i> No long-term contracts</li>
                                <li><i class="fa-solid fa-circle-check"></i> Response within 24 hours</li>
                            </ul>

                            <?php if(!empty($section['button_text'])): ?>
                                <div class="cta-btn wow fadeInUp" data-wow-delay=".6s">
                                    <a class="tj-primary-btn btn-dark" href="<?php echo e($section['button_url'] ?? '#'); ?>">
                                        <span class="btn-text">
                                            <span><?php echo e($section['button_text']); ?></span>
                                        </span>
                                        <span class="btn-icon">
                                            <i class="tji-arrow-right-long"></i>
                                        </span>
                                    </a>
                                </div>
                            <?php endif; ?>

                        </div>

                        <div class="cta-img">
                            <?php if(!empty($section['image_path'])): ?>
                                <img src="<?php echo e(asset('storage/' . $section['image_path'])); ?>"
                                    alt="<?php echo e($section['heading'] ?? 'CTA Image'); ?>">
                            <?php endif; ?>

                            <div class="cta-img-badge">
                                <span class="cta-img-badge-num">30K+</span>
                                <span class="cta-img-badge-label">Happy Clients Worldwide</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/services-cta.blade.php ENDPATH**/ ?>