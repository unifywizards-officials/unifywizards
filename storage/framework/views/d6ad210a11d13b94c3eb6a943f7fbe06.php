<?php
    $awards = $getawardsrecognition->award_items ?? [];

    $cardClasses = [
        ['card' => 'accent-mixed', 'badge' => 'g-mixed'],
        ['card' => 'accent-green', 'badge' => 'g-green'],
        ['card' => 'accent-red', 'badge' => 'g-red'],
        ['card' => 'accent-blue', 'badge' => 'g-blue'],
        ['card' => 'accent-yellow', 'badge' => 'g-yellow'],
    ];
?>

<section class="awd-section">
    <div class="container">

        
        <div class="awd-header">
            <div class="awd-header-left">
                <div class="awd-eyebrow">
                    <span class="awd-eyebrow-dot"></span>
                    <?php echo e($getawardsrecognition->sub_title); ?>

                </div>

                <h3 class="awd-heading">
                    <?php echo nl2br(e($getawardsrecognition->title)); ?>

                </h3>

                <p class="awd-desc">
                    <?php echo e($getawardsrecognition->description); ?>

                </p>
            </div>

            <?php if($getawardsrecognition->button_text): ?>
                <a class="awd-view-btn" href="<?php echo e($getawardsrecognition->button_link ?: '#'); ?>">
                    <?php echo e($getawardsrecognition->button_text); ?>


                    <svg viewBox="0 0 24 24">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>

        
        <div class="awd-grid awd-grid-symmetric">

            <?php $__currentLoopData = $awards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $award): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $style = $cardClasses[$index % count($cardClasses)];
                ?>

                <div class="awd-card <?php echo e($style['card']); ?>">

                    <div class="awd-card-top">

                        <div class="awd-icon-wrap <?php echo e($style['badge']); ?>">
                            <?php echo $award['icon_class'] ?? ''; ?>

                        </div>

                        <span class="awd-year-badge">
                            <?php echo e($award['year'] ?? ''); ?>

                        </span>

                    </div>

                    <p class="awd-card-name">
                        <?php echo e($award['award_name'] ?? ''); ?>

                    </p>

                    <p class="awd-card-by">
                        <?php echo e($award['award_by'] ?? ''); ?>

                    </p>

                    <div class="awd-card-divider"></div>

                    <div class="awd-card-footer">

                        <div class="awd-location">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>

                            <?php echo e($award['location'] ?? ''); ?>

                        </div>

                        <span class="awd-category <?php echo e($style['badge']); ?>">
                            <?php echo e($award['category'] ?? ''); ?>

                        </span>

                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

        
        <div class="awd-bottom">

            <p class="awd-bottom-text">
                <?php echo $getawardsrecognition->bottom_text; ?>

            </p>

            <div class="awd-logos">
                <div class="awd-logo-dot dot-blue"></div>
                <div class="awd-logo-dot dot-red"></div>
                <div class="awd-logo-dot dot-yellow"></div>
                <div class="awd-logo-dot dot-green"></div>
            </div>

        </div>

    </div>
</section>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/awards-recognition.blade.php ENDPATH**/ ?>