<?php
    $topServices = is_array($page->s2_top_services)
        ? $page->s2_top_services
        : json_decode($page->s2_top_services, true);
?>

<?php if(!empty($topServices) && ($topServices['status'] ?? '') == 'active'): ?>

    <section class="tj-team-section section-separator">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="sec-heading text-center style-2">

                        <h2 class="sec-title" style="margin-top: -50px;">
                            <?php echo e($topServices['heading'] ?? ''); ?>

                            <span><?php echo e($topServices['name'] ?? ''); ?></span>
                        </h2><br>

                        <?php if(!empty($topServices['description'])): ?>
                            <p class="desc">
                                <?php echo e($topServices['description']); ?>

                            </p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="details-content-box row">

                <?php $__currentLoopData = $topServices['items'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php if(!empty($item['title'])): ?>

                        <div class="col-6 col-md-4 col-lg-3">

                            <?php if(!empty($item['url'])): ?>
                                <a href="<?php echo e($item['url']); ?>"
                                   class="service-details-link">
                            <?php endif; ?>

                                <div class="service-details-item wow fadeInUp"
                                    data-wow-delay="<?php echo e((($index % 3) + 1) * 0.2); ?>s">

                                    <span class="number">
                                        <?php echo e(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?>.
                                    </span>

                                    <span class="span-title">
                                        <?php echo e($item['title']); ?>

                                    </span>

                                    <?php if(!empty($item['description'])): ?>
                                        <div class="desc">
                                            <p>
                                                <?php echo e(\Illuminate\Support\Str::words(strip_tags($item['description']), 25, '...')); ?>

                                            </p>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            <?php if(!empty($item['url'])): ?>
                                </a>
                            <?php endif; ?>

                        </div>

                    <?php endif; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>
    </section>

<?php endif; ?>

<style>
 

    /* Full box clickable */
    .service-details-link {
        display: block;
        text-decoration: none;
        color: inherit;
        height: 100%;
    }

    .service-details-link:hover {
        text-decoration: none;
        color: inherit;
    }

</style><?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/digital-marketing.blade.php ENDPATH**/ ?>