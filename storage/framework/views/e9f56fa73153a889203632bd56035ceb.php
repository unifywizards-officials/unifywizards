<div class="wcu-item <?php echo e($isFirstOverall ? 'active' : ''); ?>" data-index="<?php echo e($index); ?>">

    <button type="button" class="wcu-item-head">

        <span class="wcu-badge-circle">
            <span class="wcu-num">
                <?php echo e(str_pad($index + 1, 2, '0', STR_PAD_LEFT)); ?>

            </span>
            <svg class="wcu-check" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF"
                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 6L9 17l-5-5" />
            </svg>
        </span>

        <h4 class="wcu-item-title">
            <?php echo e($item['title'] ?? ''); ?>

        </h4>

        <span class="wcu-chevron-wrap">
            <svg class="wcu-chevron" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 9l6 6 6-6" />
            </svg>
        </span>

    </button>

    <div class="wcu-item-body">
        <div class="wcu-item-body-inner">
            <p class="wcu-item-desc">
                <?php echo e($item['description'] ?? ''); ?>

            </p>
        </div>
    </div>

</div>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/partials/why-choose-item.blade.php ENDPATH**/ ?>