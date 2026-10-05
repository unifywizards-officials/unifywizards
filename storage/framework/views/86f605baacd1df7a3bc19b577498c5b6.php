<?php
    $section = $page->s9_who_should_invest ?? null;

    if (is_string($section)) {
        $section = json_decode($section, true);
    }
?>

<?php if(!empty($section) && ($section['status'] ?? '') === 'active'): ?>

    <section class="wsi__section">
        <div class="container">

            <!-- Background blobs -->
            <div class="wsi__blob wsi__blob--1"></div>
            <div class="wsi__blob wsi__blob--2"></div>
            <div class="wsi__blob wsi__blob--3"></div>

            <div class="wsi__center">

                <?php if(!empty($section['chip_label'])): ?>
                    <div class="wsi__chip">
                        <div class="wsi__chip-dot"></div>
                        <?php echo e($section['chip_label']); ?>

                    </div>
                <?php endif; ?>

                <?php if(!empty($section['heading'])): ?>
                    <h3 class="wsi__title">
                        <?php echo nl2br(e($section['heading'])); ?>

                    </h3>
                <?php endif; ?>

                <?php if(!empty($section['description'])): ?>
                    <p class="wsi__intro">
                        <?php echo e($section['description']); ?>

                    </p>
                <?php endif; ?>

                <?php if(!empty($section['questions_label'])): ?>
                    <p class="wsi__sub-label">
                        <?php echo e($section['questions_label']); ?>

                    </p>
                <?php elseif(!empty($section['questions'])): ?>
                    <p class="wsi__sub-label">
                        Quick questions to ask yourself:
                    </p>
                <?php endif; ?>

            </div>

            
            <?php if(!empty($section['questions']) && is_array($section['questions'])): ?>
                <div class="wsi__cards-grid">

                    <?php $__currentLoopData = $section['questions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $colorClass = $question['color_class'] ?? 'wsi__q-card--blue';

                            $iconColorClass = str_replace('wsi__q-card--', 'wsi__q-icon--', $colorClass);
                        ?>

                        <div class="wsi__q-card <?php echo e($colorClass); ?>">
                            <div class="wsi__q-icon <?php echo e($iconColorClass); ?>">
                                <?php echo $question['icon'] ?: '✓'; ?>

                            </div>

                            <p class="wsi__q-text">
                                <?php echo e($question['heading'] ?? ''); ?>

                            </p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            <?php endif; ?>

            
            <?php if(!empty($section['divider_label'])): ?>
                <div class="wsi__divider-row">
                    <div class="wsi__divider-line"></div>

                    <span class="wsi__divider-label">
                        <?php echo e($section['divider_label']); ?>

                    </span>

                    <div class="wsi__divider-line"></div>
                </div>
            <?php endif; ?>

            
            <?php if(!empty($section['answers']) && is_array($section['answers'])): ?>
                <div class="wsi__bottom-grid">

                    <?php $__currentLoopData = $section['answers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $accent = strtolower($answer['accent_color'] ?? 'green');

                            $allowedColors = ['green', 'blue', 'red', 'yellow'];

                            if (!in_array($accent, $allowedColors)) {
                                $accent = 'green';
                            }
                        ?>

                        <div class="wsi__info-card">

                            <div class="wsi__info-accent wsi__info-accent--<?php echo e($accent); ?>"></div>

                            <div class="wsi__info-body">

                                <strong class="wsi__info-title">
                                    <?php echo e($answer['heading'] ?? ''); ?>

                                </strong>

                                <p class="wsi__info-text">
                                    <?php echo e($answer['description'] ?? ''); ?>

                                </p>

                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            <?php endif; ?>

            <!---->
            <!--<?php if(!empty($section['button_text']) && !empty($section['button_url'])): ?>-->
            <!--    <div class="wsi__cta-row">-->
            <!--        <a href="<?php echo e($section['button_url']); ?>" class="wsi__cta-btn">-->
            <!--            <?php echo e($section['button_text']); ?>-->
            <!--            <span class="wsi__cta-arrow">↗</span>-->
            <!--        </a>-->
            <!--    </div>-->
            <!--<?php endif; ?>-->

        </div>
    </section>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/who-should-invest.blade.php ENDPATH**/ ?>