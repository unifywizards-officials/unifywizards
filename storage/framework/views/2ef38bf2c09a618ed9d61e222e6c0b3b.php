<?php
    $section = $page->s10_why_choose ?? null;

    if (is_string($section)) {
        $section = json_decode($section, true);
    }
?>

<?php if(!empty($section) && ($section['status'] ?? '') === 'active'): ?>

    <section id="choose" class="uw-choose-section section-gap">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-10 text-center mb-4">

                    <?php if(!empty($section['title'])): ?>
                        <h3 class="sec-title mb-2" style="font-size: 42px;">
                            <?php echo e($section['title']); ?>

                        </h3>
                    <?php endif; ?>

                    <?php if(!empty($section['sub_title'])): ?>
                        <div class="uw-choose-subtitle mb-2">
                            <?php echo e($section['sub_title']); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(!empty($section['description'])): ?>
                        <p class="uw-choose-intro mb-4">
                            <?php echo e($section['description']); ?>

                        </p>
                    <?php endif; ?>

                </div>
            </div>

            <?php if(!empty($section['items']) && is_array($section['items'])): ?>
                <div class="row uw-choose-cards g-4">

                    <?php $__currentLoopData = $section['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $cardColor = $item['color_class'] ?? 'uw-blue';
                        ?>

                        <div class="col-md-6 col-lg-4">
                            <div class="uw-choose-card <?php echo e($cardColor); ?>">

                                <?php if(!empty($item['icon_svg'])): ?>
                                    <div class="uw-choose-icon">
                                        <?php echo $item['icon_svg']; ?>

                                    </div>
                                <?php endif; ?>

                                <?php if(!empty($item['heading'])): ?>
                                    <span class="span-title-choose">
                                        <?php echo e($item['heading']); ?>

                                    </span><br><br>
                                <?php endif; ?>

                                <?php if(!empty($item['description'])): ?>
                                    <p>
                                        <?php echo e($item['description']); ?>

                                    </p>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            <?php endif; ?>

        </div>
    </section>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/why-choose.blade.php ENDPATH**/ ?>