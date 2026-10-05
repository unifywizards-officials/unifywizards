<?php
    $projects = is_array($page->s7_proud_projects)
        ? $page->s7_proud_projects
        : json_decode($page->s7_proud_projects, true);
?>

<?php if(!empty($projects) && ($projects['status'] ?? '') === 'active'): ?>

    <section class="tj-project-section section-gap">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="sec-heading-wrap">

                        <?php if(!empty($projects['sub_title'])): ?>
                            <span class="sub-title wow fadeInUp" data-wow-delay=".3s">
                                <i class="tji-box"></i><?php echo e($projects['sub_title']); ?>

                            </span>
                        <?php endif; ?>

                        <div class="heading-wrap-content">

                            <div class="sec-heading">
                                <h3 class="sec-title">
                                    <?php echo e($projects['title'] ?? ''); ?>

                                </h3>
                            </div>

                            <?php if(!empty($projects['description'])): ?>
                                <p class="desc wow fadeInUp" data-wow-delay=".5s">
                                    <?php echo e($projects['description']); ?>

                                </p>
                            <?php endif; ?>

                            <?php if(!empty($projects['button_text']) && !empty($projects['button_url'])): ?>
                                <div class="btn-wrap wow fadeInUp" data-wow-delay=".6s">
                                    <a class="tj-primary-btn">
                                        <span class="btn-text">
                                            <span><?php echo e($projects['button_text']); ?></span>
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
            </div>

            <?php if(!empty($projects['items'])): ?>
                <div class="row">
                    <div class="col-12">
                        <div class="project-area tj-arrange-container">

                            <?php $__currentLoopData = $projects['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="project-item tj-arrange-item">

                                    <div class="project-img"
                                        data-bg-image="<?php echo e(asset('storage/' . ($item['image_path'] ?? ''))); ?>">
                                    </div>

                                    <div class="project-content">

                                        <?php if(!empty($item['category'])): ?>
                                            <span class="categories">
                                                <a>
                                                    <?php echo e($item['category']); ?>

                                                </a>
                                            </span>
                                        <?php endif; ?>

                                        <div class="project-text">

                                          <span class="span-title-white">
                                                <a style="color:white">
                                                    <?php echo e($item['name'] ?? ''); ?>

                                                </a>
                                            </span>

                                            <a class="project-btn">
                                                <i class="tji-arrow-right-long"></i>
                                            </a>

                                        </div>

                                    </div>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/proud-projects.blade.php ENDPATH**/ ?>