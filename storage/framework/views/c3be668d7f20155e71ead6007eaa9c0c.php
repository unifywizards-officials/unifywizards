<section class="tj-blog-section section-gap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sec-heading text-center">
                    <span class="sub-title wow fadeInUp google-red-text" data-wow-delay=".3s">
                        <i class="tji-box google-red-text"></i>
                        Insights & Ideas
                    </span>

                    <h3 class="sec-title title-anim">
                        The Ultimate <span>Resource.</span>
                    </h3>
                </div>
            </div>
        </div>

        <div class="row row-gap-4">

            <?php $__empty_1 = true; $__currentLoopData = $getblogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-xl-4 col-md-6">
                    <div class="blog-item wow fadeInUp" data-wow-delay=".4s">

                        <div class="blog-thumb">
                            <a href="<?php echo e(route('blog.details',$blog->slug)); ?>">
                                <img src="<?php echo e(asset('storage/'.$blog->featured_image)); ?>" alt="<?php echo e($blog->title); ?>">
                            </a>

                            <div class="blog-date">
                                <span class="date">
                                    <?php echo e(\Carbon\Carbon::parse($blog->published_at)->format('d')); ?>

                                </span>

                                <span class="month">
                                    <?php echo e(\Carbon\Carbon::parse($blog->published_at)->format('M')); ?>

                                </span>
                            </div>
                        </div>

                        <div class="blog-content">

                            <div class="blog-meta">
                                <span class="categories">
                                    <a href="#">
                                        Blog
                                    </a>
                                </span>

                                <span>
                                    By
                                    <a href="#">
                                        Admin
                                    </a>
                                </span>
                            </div>

                            <span class="span-title-black">
                                <a href="<?php echo e(route('blog.details',$blog->slug)); ?>">
                                    <?php echo e($blog->title); ?>

                                </a>
                            </span>

                            <a class="text-btn" href="<?php echo e(route('blog.details',$blog->slug)); ?>">
                                <span class="btn-text">
                                    <span>Read More</span>
                                </span>

                                <span class="btn-icon">
                                    <i class="tji-arrow-right-long"></i>
                                </span>
                            </a>

                        </div>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center">
                    <p>No blogs found.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/blog.blade.php ENDPATH**/ ?>