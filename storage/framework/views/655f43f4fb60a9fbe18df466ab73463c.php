<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="space-for-header"></div>


    <section class="tj-page-header section-gap-x" data-bg-image="assets/images/bg/pheader-bg.webp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tj-page-header-content text-center">
                        <h1 class="tj-page-title">Blog</h1>
                        <div class="tj-page-link">
                            <span><i class="tji-home"></i></span>
                            <span>
                                <a href="index.html">Home</a>
                            </span>
                            <span><i class="tji-arrow-right"></i></span>
                            <span>
                                <span>Blog</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-header-overlay" data-bg-image="assets/images/shape/pheader-overlay.webp"></div>
    </section>
    <!-- end: Breadcrumb Section -->


    <!-- start: Blog Section -->
    <section class="tj-blog-section section-gap">

        <div class="row mb-5">
            <div class="col-lg-6 mx-auto" style="">
                <input type="text" id="blog-search" class="form-control" placeholder="Search Blog..."
                    autocomplete="off">
            </div>
        </div>
        <div class="container">

            <div class="row row-gap-4" id="blog-list"
                data-next-page-url="<?php echo e($blogs->hasMorePages() ? $blogs->nextPageUrl() : ''); ?>"
                data-search-url="<?php echo e(route('blogs.show')); ?>">

                <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php echo $__env->make('partials.blog-card', ['blogs' => [$blog]], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12 text-center" id="blog-no-results">
                        <h4>No Blogs Found</h4>
                    </div>
                <?php endif; ?>

            </div>

            
            <div id="blog-loader" class="text-center mt-5" style="display:none;">
                <span class="spinner-border" role="status" aria-hidden="true"></span>
                <p class="mt-2 mb-0">Loading more posts...</p>
            </div>

            
            <div id="blog-scroll-sentinel" style="width:100%; height:20px;"></div>

            <div id="blog-end-message" class="text-center mt-5" style="display:none;">
                <p class="mb-0">You've reached the end.</p>
            </div>

        </div>

    </section>

    <!-- start: Cta Section -->
    <section class="tj-cta-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-area">
                        <div class="cta-content">
                            <h2 class="title title-anim">
                                Let’s Build Future Together.
                            </h2>
                            <div class="cta-btn wow fadeInUp" data-wow-delay=".6s">
                                <a class="tj-primary-btn btn-dark" href="<?php echo e('/contact'); ?>">
                                    <span class="btn-text"><span>Get Started Now</span></span>
                                    <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                </a>
                            </div>
                        </div>
                        <div class="cta-img">
                            <img src="<?php echo e(asset('assets/img/cta-bg.webp')); ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    <script src="<?php echo e(asset('home_assets/js/blog.js')); ?>"></script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/blog.blade.php ENDPATH**/ ?>