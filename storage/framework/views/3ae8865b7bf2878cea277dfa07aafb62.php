<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['page']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['page']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $technologies = is_array($page->s13_technologies)
        ? $page->s13_technologies
        : json_decode($page->s13_technologies, true);
?>

<?php if(!empty($technologies) && ($technologies['status'] ?? '') === 'active'): ?>

    <section class="tj-technologies-section bg-light section-gap">
        <div class="container">

            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8">

                    <div class="section-heading mb-50 text-center">

                        <?php if(!empty($technologies['sub_title'])): ?>
                            <span class="sub-title wow fadeInUp" data-wow-delay=".2s">
                                <i class="fa fa-code"></i>
                                <?php echo e($technologies['sub_title']); ?>

                            </span>
                        <?php endif; ?>

                        <h2 class="section-title wow fadeInUp" data-wow-delay=".4s">
                            <?php echo e($technologies['title'] ?? ''); ?>

                        </h2>

                        <?php if(!empty($technologies['description'])): ?>
                            <p class="section-desc wow fadeInUp" data-wow-delay=".6s">
                                <?php echo e($technologies['description']); ?>

                            </p>
                        <?php endif; ?>

                    </div>

                </div>
            </div>

            <div class="row g-4">

                <?php $__currentLoopData = $technologies['technology_groups'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupIndex => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($group['heading'])): ?>
                        <div class="col-md-6 col-lg-3">

                            <div class="tech-card wow fadeInUp" data-wow-delay="<?php echo e(($groupIndex + 1) * 0.2); ?>s">

                                <span class="tech-title">
                                    <?php echo e($group['heading']); ?>

                                </span>

                                <div class="tech-items">

                                    <?php $__currentLoopData = $group['items'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($item['name'])): ?>
                                            <div class="tech-item">

                                                <?php if(!empty($item['icon'])): ?>
                                                    <?php echo $item['icon']; ?>

                                                <?php else: ?>
                                                    <i class="fa fa-code"></i>
                                                <?php endif; ?>

                                                <span>
                                                    <?php echo e($item['name']); ?>

                                                </span>

                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>

                            </div>

                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>
    </section>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/technologies.blade.php ENDPATH**/ ?>