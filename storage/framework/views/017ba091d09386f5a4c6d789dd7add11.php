<?php
    // s1_banner JSON already cast to array/object via model $casts
    $banner = $page->s1_banner;

    // Safety: agar status null ya inactive ho to section skip
    // (remove this check if you always want to show the section)
    $show = !empty($banner) && ($banner['status'] ?? null) === 'active';
?>

<?php if($show): ?>
    <section class="tj-banner-section-2 section-gap-x top-space-30">
        <div class="container">
            <div class="row align-items-center">

                
                <div class="col-lg-6">
                    <div class="banner-content-2">

                        
                        <?php if(!empty($banner['sub_title'])): ?>
                            <span class="sub-title" data-wow-delay=".2s">
                                <i class="tji-box"></i> <?php echo e($banner['sub_title']); ?>

                            </span>
                        <?php endif; ?>

                        
                        <?php if(!empty($banner['banner_title'])): ?>
                            <h1 class="banner-title">
                                <?php echo e($banner['banner_title']); ?>

                            </h1><br>
                        <?php endif; ?>

                        
                        <?php if(!empty($banner['description'])): ?>
                            <div class="desc">
                                <p><?php echo e($banner['description']); ?></p>
                            </div>
                        <?php endif; ?>

                        
                        <div class="btn-area mb-40" data-wow-delay=".8s">

                            <?php if(!empty($banner['button_text'])): ?>
                                <a class="tj-primary-btn" href="<?php echo e($banner['button_url'] ?? '#'); ?>">
                                    <span class="btn-text">
                                        <span><?php echo e($banner['button_text']); ?></span>
                                    </span>
                                    <span class="btn-icon">
                                        <i class="tji-arrow-right-long"></i>
                                    </span>
                                </a>
                            <?php endif; ?>

                            <?php if(!empty($banner['phone_number'])): ?>
                                <a class="number"
                                    href="tel:<?php echo e(preg_replace('/[^0-9]/', '', $banner['phone_number'])); ?>">
                                    <i class="tji-phone"></i>
                                    <span><?php echo e($banner['phone_number']); ?></span>
                                </a>
                            <?php endif; ?>

                        </div>

                        
                        <?php if(!empty($banner['logos']) && count($banner['logos']) > 0): ?>
                            <div class="row">
                                <?php $__currentLoopData = $banner['logos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($logo['image'])): ?>
                                        <div class="col-6 col-lg-3 justify-content-center d-flex">
                                            <img src="<?php echo e(asset('storage/' . $logo['image'])); ?>" alt="Logo"
                                                class="award-width" />
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                
                <div class="col-lg-6">
                    <div class="banner-img-area wow fadeInUp" data-wow-delay=".3s">
                        <div class="banner-img">
                            <div class="uw2-wrap" id="uw2Container">
                                <div class="uw2-accent-bar"></div>

                                
                                <?php if (isset($component)) { $__componentOriginaldfbf0b98e870f606074be8c8119d6a06 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldfbf0b98e870f606074be8c8119d6a06 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.Proposal','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('Proposal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldfbf0b98e870f606074be8c8119d6a06)): ?>
<?php $attributes = $__attributesOriginaldfbf0b98e870f606074be8c8119d6a06; ?>
<?php unset($__attributesOriginaldfbf0b98e870f606074be8c8119d6a06); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldfbf0b98e870f606074be8c8119d6a06)): ?>
<?php $component = $__componentOriginaldfbf0b98e870f606074be8c8119d6a06; ?>
<?php unset($__componentOriginaldfbf0b98e870f606074be8c8119d6a06); ?>
<?php endif; ?>

                                
                                <div class="uw2-success text-white" id="uw2Success">
                                    <div class="uw2-success-icon">
                                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                                            <path d="M5 12L10 17L19 7" stroke="#22c55e" stroke-width="2.2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <span>Proposal Request Sent!</span>
                                    <p>Our team will review your project and get back to you within 24 hours.</p>
                                </div>
                            </div>

                            
                            <div class="brand-name wow fadeIn" data-wow-delay="2.2s">
                                <div class="marquee-vr">
                                    <?php for($i = 0; $i < 7; $i++): ?>
                                        <span class="text">
                                            <?php echo e($page->page_name); ?>

                                            <span class="icon">/</span>
                                        </span>
                                    <?php endfor; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="bg-shape-1">
            <img src="<?php echo e(asset('home_assets/images/shape/pattern-2.svg')); ?>" alt="" />
        </div>
        <div class="bg-shape-2">
            <img src="<?php echo e(asset('home_assets/images/shape/pattern-3.svg')); ?>" alt="" />
        </div>

        <div class="banner-scroll wow fadeInDown" data-wow-delay="2.5s">
            <a href="#choose" class="scroll-down tj-scroll-btn">
                <span><i class="tji-arrow-down-long"></i></span>
                Scroll Down
            </a>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/hero.blade.php ENDPATH**/ ?>