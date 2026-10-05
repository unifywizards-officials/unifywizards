<?php
    $projects = is_array($getportfolio->projects_json)
        ? $getportfolio->projects_json
        : json_decode($getportfolio->projects_json, true);
?>

<section class="tj-project-section section-gap">
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="sec-heading-wrap">

                    <span class="sub-title google-red-text wow fadeInUp" data-wow-delay=".3s">
                        <i class="tji-box google-red-text"></i>
                        <?php echo e($getportfolio->sub_title); ?>

                    </span>

                    <div class="heading-wrap-content">

                        <div class="sec-heading">
                            <h3 class="sec-title">
                                <?php echo e($getportfolio->title); ?>


                                <?php if(!empty($getportfolio->highlight_text)): ?>
                                    <span><?php echo e($getportfolio->highlight_text); ?></span>
                                <?php endif; ?>
                            </h3>
                        </div>

                        <p class="desc wow fadeInUp" data-wow-delay=".5s">
                            <?php echo e($getportfolio->description); ?>

                        </p>

                        <?php if($getportfolio->button_text): ?>
                            <div class="btn-wrap wow fadeInUp" data-wow-delay=".6s">
                                <a class="tj-primary-btn" href="<?php echo e($getportfolio->button_link ?? '#'); ?>">

                                    <span class="btn-text">
                                        <span><?php echo e($getportfolio->button_text); ?></span>
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

        <div class="row">
            <div class="col-12">

                <div class="project-area tj-arrange-container">

                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="project-item tj-arrange-item">

                            <div class="project-img" data-bg-image="<?php echo e(asset($project['image'])); ?>">
                            </div>

                            <div class="project-content">

                                <span class="categories">
                                    <a  class="google-text">

                                        <?php echo e($project['category'] ?? ''); ?>


                                    </a>
                                </span>

                                <div class="project-text">

                                    <span class="span-title-white">
                                        <a style="color:#fff;">
                                            <?php echo e($project['title'] ?? ''); ?>

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

    </div>
</section>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/portfolio.blade.php ENDPATH**/ ?>