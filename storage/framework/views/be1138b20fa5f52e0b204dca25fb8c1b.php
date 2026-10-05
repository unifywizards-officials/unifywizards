<?php
    $section = $getwhychoose ?? null;

    $rawItems = $section->items ?? [];

    if (!is_array($rawItems)) {
        $rawItems = json_decode($rawItems, true) ?? [];
    }

    $items = collect($rawItems)->filter(function ($item) {
        return !empty($item['title']) || !empty($item['description']);
    })->values();

    $half = (int) ceil($items->count() / 2);
    $leftItems = $items->slice(0, $half);
    $rightItems = $items->slice($half);
?>

<?php if($section && $section->status && $items->isNotEmpty()): ?>

    <section class="tj-why-choose-section section-gap">
        <div class="container">

            <div class="sec-heading sec-heading-centered wcu-heading-wrap">

                <span class="sub-title">
                    <span class="wcu-badge-dot"></span>
                    <?php echo e($section->sub_title ?: 'Why Choose Us'); ?>

                </span>

                <h3 class="sec-title">
                    <?php echo e($section->title); ?>

                </h3>

                <?php if($section->description): ?>
                    <p class="wcu-desc">
                        <?php echo e($section->description); ?>

                    </p>
                <?php endif; ?>

            </div>

            <div class="wcu-columns">

                <div class="wcu-column">
                    <?php $__currentLoopData = $leftItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('components.Home.partials.why-choose-item', [
                            'item' => $item,
                            'index' => $loop->index,
                            'isFirstOverall' => $loop->index === 0,
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="wcu-column">
                    <?php $__currentLoopData = $rightItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('components.Home.partials.why-choose-item', [
                            'item' => $item,
                            'index' => $half + $loop->index,
                            'isFirstOverall' => false,
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>

        </div>
    </section>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/why-choose-us.blade.php ENDPATH**/ ?>