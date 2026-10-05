<?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-xl-4 col-md-6 blog-grid-item">
        <div class="blog-item wow fadeInUp" data-wow-delay=".1s">
            <div class="blog-thumb">
                <a href="<?php echo e(route('blog.details', $blog->slug)); ?>"><img
                        src="<?php echo e(asset('storage/' . $blog->featured_image)); ?>" alt=""></a>
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
                    <span>
                        By
                        <a href="<?php echo e(route('blog.details', $blog->slug)); ?>">
                            <?php echo e($blog->user->name ?? 'Admin'); ?>

                        </a>
                    </span>
                </div>
                <span class="span-title-black"><a href="<?php echo e(route('blog.details', $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                </span>
                <a class="text-btn" href="<?php echo e(route('blog.details', $blog->slug)); ?>">
                    <span class="btn-text"><span>Read More</span></span>
                    <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                </a>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/partials/blog-card.blade.php ENDPATH**/ ?>