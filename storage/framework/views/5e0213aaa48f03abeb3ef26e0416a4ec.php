<?php
    $settings = \App\Models\Setting::first();

    $socialLinks = [];

    if ($settings && !empty($settings->social_links)) {
        $socialLinks = is_array($settings->social_links)
            ? $settings->social_links
            : json_decode($settings->social_links, true);
    }
?>

<footer class="tj-footer-section footer-1 section-gap-x">
    <div class="footer-main-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget wow fadeInUp" data-wow-delay=".1s">
                        <div class="footer-logo">
                            <a href="<?php echo e('/'); ?>">
                                <img src="<?php echo e(asset('storage/'.$settings->footer_logo)); ?>" alt="Logo" />
                            </a>
                        </div>
                        <div class="footer-text">
                            <p>
                                <?php echo e($settings->footer_description); ?>

                            </p>
                        </div>
                        <div class="award-logo-area">
                            <div class="award-logo">
                                <img src="<?php echo e(asset('storage/'.$settings->dark_footer_logo1)); ?>" alt="" />
                            </div>
                            <div class="award-logo">
                                <img src="<?php echo e(asset('storage/'.$settings->dark_footer_logo2)); ?>" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php
                $footerServices = \App\Models\DmPage::where('footer_status', 1)
                    ->where('is_active', 1)
                    ->orderBy('page_name')
                    ->get();
            ?>
                            
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget widget-nav-menu wow fadeInUp" data-wow-delay=".3s">
                        <span class="span-footer-title">Services</span><br>
                       <ul class="footer-link">

                            <?php $__currentLoopData = $footerServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('services.show', $service->slug)); ?>">
                                        <?php echo e($service->page_name); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>
                    </div>
                </div>
                
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="footer-widget widget-nav-menu wow fadeInUp" data-wow-delay=".5s">
                        <span class="span-footer-title">Info</span><br>
                        <ul class="footer-link">
                            <li><a href="<?php echo e(url('aboutus')); ?>">About</a></li>
                            <li><a href="<?php echo e(url('blog')); ?>">Blog</a></li>
                            <li><a href="<?php echo e(url('contact')); ?>"> Contact Us</a></li>
                           
                            <li><a href="<?php echo e(route('privacy.policy')); ?>">Privacy Policy</a></li>
                            <li><a href="<?php echo e(route('terms.condition')); ?>">Terms & Condition</a></li>
                        </ul>
                    </div>
                </div>

                <?php if (isset($component)) { $__componentOriginalcaccc7c159de004e0967afab0e08461c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcaccc7c159de004e0967afab0e08461c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.newsletter','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('newsletter'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcaccc7c159de004e0967afab0e08461c)): ?>
<?php $attributes = $__attributesOriginalcaccc7c159de004e0967afab0e08461c; ?>
<?php unset($__attributesOriginalcaccc7c159de004e0967afab0e08461c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcaccc7c159de004e0967afab0e08461c)): ?>
<?php $component = $__componentOriginalcaccc7c159de004e0967afab0e08461c; ?>
<?php unset($__componentOriginalcaccc7c159de004e0967afab0e08461c); ?>
<?php endif; ?>

            </div>
        </div>
    </div>
    <div class="tj-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright-content-area">
                        <div class="footer-contact">
                            <ul>
                                <li>
                                    <a href="tel:<?php echo e($settings->footer_number); ?>">
                                        <span class="icon"><i class="tji-phone-2"></i></span>
                                        <span class="text"><?php echo e($settings->footer_number); ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:<?php echo e($settings->footer_email); ?>">
                                        <span class="icon"><i class="tji-envelop-2"></i></span>
                                        <span class="text"><?php echo e($settings->footer_email); ?></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="social-links">
                            <ul>
                                <?php $__currentLoopData = $socialLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $icon = 'fa-globe';

                                        if (str_contains(strtolower($social['name']), 'facebook')) {
                                            $icon = 'fa-facebook-f';
                                        } elseif (str_contains(strtolower($social['name']), 'instagram')) {
                                            $icon = 'fa-instagram';
                                        } elseif (
                                            str_contains(strtolower($social['name']), 'twitter') ||
                                            str_contains(strtolower($social['name']), 'x')
                                        ) {
                                            $icon = 'fa-x-twitter';
                                        } elseif (str_contains(strtolower($social['name']), 'linkedin')) {
                                            $icon = 'fa-linkedin-in';
                                        } elseif (str_contains(strtolower($social['name']), 'indeed')) {
                                            $icon = 'fa-briefcase';
                                        }
                                    ?>

                                    <li>
                                        <a href="<?php echo e($social['link']); ?>" target="_blank">
                                            <i class="fa-brands <?php echo e($icon); ?>"></i>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div class="copyright-text">
                            <p>
                                &copy; 2026
                                <a href="https://themeforest.net/user/theme-junction/portfolio" target="_blank">Unify
                                    Wizards</a>
                                All right reserved
                            </p>
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
</footer>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/footer.blade.php ENDPATH**/ ?>