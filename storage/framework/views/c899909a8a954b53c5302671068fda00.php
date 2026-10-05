<?php if($relatedBlogs->count()): ?>

    <section class="tj-blog-section section-gap">

        <div class="container">

            <div class="sec-heading text-center mb-5">

                <span class="sub-title">
                    Related Blogs
                </span>

               

            </div>

            <div class="row row-gap-4">

                <?php $__currentLoopData = $relatedBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-4 col-md-6">

                        <div class="blog-item">

                            <div class="blog-thumb">

                                <a href="<?php echo e(route('blog.details', $blog->slug)); ?>">

                                    <img src="<?php echo e(asset('storage/' . $blog->featured_image)); ?>" alt="<?php echo e($blog->title); ?>">

                                </a>

                            </div>

                            <div class="blog-content">

                                <div class="blog-meta">

                                    <span>

                                        By

                                        <?php echo e($blog->user->name ?? 'Admin'); ?>


                                    </span>

                                </div>

                                <span class="span-title-black">

                                    <a href="<?php echo e(route('blog.details', $blog->slug)); ?>">

                                        <?php echo e($blog->title); ?>


                                    </a>

                                </span>

                                <a class="text-btn" href="<?php echo e(route('blog.details', $blog->slug)); ?>">

                                    Read More

                                </a>

                            </div>

                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

    </section>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/related-blog.blade.php ENDPATH**/ ?>