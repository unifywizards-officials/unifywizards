<?php
    $pricing = is_array($page->s15_development_items)
        ? $page->s15_development_items
        : json_decode($page->s15_development_items, true);
?>

<?php if(!empty($pricing) && ($pricing['status'] ?? '') === 'active'): ?>

    <section class="section-gap container">

        <!-- Header -->
        <div class="pt-header">
            <div class="pt-label">
                <span class="pt-dot pt-dot--blue"></span>
                <span class="pt-dot pt-dot--red"></span>
                <span class="pt-dot pt-dot--yellow"></span>
                <span class="pt-dot pt-dot--green"></span>

                <?php echo e($pricing['sub_title'] ?? ''); ?>

            </div>

            <h2 class="pt-title">
                <?php echo e($pricing['heading'] ?? ''); ?>

            </h2>
        </div>

        <!-- Table -->
        <div class="pt-table-wrapper">

            <!-- Head -->
            <div class="pt-table-head">
                <div class="pt-table-head__cell">Service</div>
                <div class="pt-table-head__cell pt-table-head__cell--center">
                    Price / mo
                </div>
                <div class="pt-table-head__cell pt-table-head__cell--center">
                    Category
                </div>
                <div class="pt-table-head__cell pt-table-head__cell--center">
                    Action
                </div>
            </div>

            <?php
                $colors = ['blue', 'red', 'green', 'yellow'];

                $icons = [
                    'ti ti-search',
                    'ti ti-chart-line',
                    'ti ti-world',
                    'ti ti-speakerphone',
                    'ti ti-link',
                    'ti ti-stack-2',
                ];
            ?>

            <?php $__currentLoopData = $pricing['items'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $color = $colors[$index % count($colors)];
                    $icon = $icons[$index % count($icons)];
                ?>

                <div class="pt-row">

                    <div class="pt-service">

                        <div class="pt-icon pt-icon--<?php echo e($color); ?>">
                            <i class="<?php echo e($icon); ?>" aria-hidden="true"></i>
                        </div>

                        <div class="pt-service__info">

                            <div class="pt-service__name-row">
                                <span class="pt-service__name">
                                    <?php echo e($item['title'] ?? ''); ?>

                                </span>
                            </div>

                            <div class="pt-service__sub">
                                <?php echo e($item['heading'] ?? ''); ?>

                            </div>

                        </div>

                    </div>

                    <div class="pt-price">
                        <?php echo e($item['price'] ?? ''); ?>

                    </div>

                    <div class="pt-chip-cell">
                        <span class="pt-chip pt-chip--<?php echo e($color); ?>">
                            <?php echo e($item['category'] ?? ''); ?>

                        </span>
                    </div>

                     <div class="pt-actions">

                        <?php if(!empty($item['btn_one'])): ?>
                            <a href="/contact" class="pt-btn-primary">
                                <?php echo e($item['btn_one']); ?>

                            </a>
                        <?php endif; ?>

                        <?php if(!empty($item['btn_two'])): ?>
                            <a href="/contact" class="pt-btn-secondary">
                                <?php echo e($item['btn_two']); ?>

                            </a>
                        <?php endif; ?>

                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </section>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/our-pricing.blade.php ENDPATH**/ ?>