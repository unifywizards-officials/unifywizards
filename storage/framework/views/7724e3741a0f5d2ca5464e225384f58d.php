<section class="tj-faq-section section-gap tj-arrange-container-2">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <div class="faq-img-area tj-arrange-item-2">
                    <div class="faq-img overflow-hidden">
                        <img src="<?php echo e(asset('home_assets/images/faq/faq.webp')); ?>" alt="" />
                        <h3 class="title">We have answers for your most asked questions.</h3>
                    </div>
                    <div class="box-area">
                        <div class="call-box">
                            <span class="title" style="font-size:20px;">Get Started Free Call?</span><br>
                            <span class="call-icon"><i class="tji-phone"></i></span>

                            <?php if($footerNumber): ?>
                                <a class="number" href="tel:<?php echo e($footerNumber); ?>">
                                    <span><?php echo e($footerNumber); ?></span>
                                </a>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php
                $currentPage = request()->path() == '/' ? '/' : '/' . request()->path();

                $schema = \App\Models\Schema::where('status', 1)
                    ->whereHas('pages', function ($q) use ($currentPage) {
                        $q->where('page', $currentPage);
                    })
                    ->first();

                $faqSchema = $schema ? json_decode($schema->json_data, true) : [];

                $faqs = $faqSchema['faq']['mainEntity'] ?? [];
            ?>

            <?php if(count($faqs)): ?>
                <div class="col-lg-6">
                    <div class="accordion tj-faq tj-arrange-item-2" id="faqOne">

                        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="accordion-item <?php echo e($i == 0 ? 'active' : ''); ?>">

                                <button class="faq-title <?php echo e($i != 0 ? 'collapsed' : ''); ?>" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq-<?php echo e($i); ?>"
                                    aria-expanded="<?php echo e($i == 0 ? 'true' : 'false'); ?>">
                                    <?php echo e($faq['name']); ?>

                                </button>

                                <div id="faq-<?php echo e($i); ?>" class="collapse <?php echo e($i == 0 ? 'show' : ''); ?>"
                                    data-bs-parent="#faqOne">
                                    <div class="accordion-body faq-text">
                                        <p>
                                            <?php echo e($faq['acceptedAnswer']['text']); ?>

                                        </p>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/faq.blade.php ENDPATH**/ ?>