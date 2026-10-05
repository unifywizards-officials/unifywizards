<?php
    $section = $page->s11_wizards_spell ?? null;

    if (is_string($section)) {
        $section = json_decode($section, true);
    }
?>

<?php if(!empty($section) && ($section['status'] ?? '') === 'active'): ?>

    <div class="atm-wrap container">
        <span class="atm-dot"></span>

        
        <?php if(!empty($section['heading'])): ?>
            <h4 class="atm-main-title">
                <?php echo e($section['heading']); ?>

            </h4>
        <?php endif; ?>

        
        <?php if(!empty($section['description'])): ?>
            <p class="atm-sub-text">
                <?php echo e($section['description']); ?>

            </p>
        <?php endif; ?>

        
        <?php if(!empty($section['button_text'])): ?>
            <a href="<?php echo e($section['button_url'] ?? '#'); ?>" class="atm-learn-btn">
                <?php echo e($section['button_text']); ?>

            </a>
        <?php endif; ?>

        
        <?php if(!empty($section['cards']) && is_array($section['cards'])): ?>
            <div class="atm-cards-row" id="atm-deck">

                <?php $__currentLoopData = $section['cards']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="atm-card <?php echo e($card['color_class'] ?? 'atm-card-0'); ?>">

                        <?php if(!empty($card['name'])): ?>
                            <div class="atm-card-label">
                                <?php echo e($card['name']); ?>

                            </div>
                        <?php endif; ?>

                        <?php if(!empty($card['icon_svg'])): ?>
                            <div class="atm-icon-wrap">
                                <?php echo $card['icon_svg']; ?>

                            </div>
                        <?php endif; ?>

                        <?php if(!empty($card['description'])): ?>
                            <p class="atm-card-desc">
                                <?php echo e($card['description']); ?>

                            </p>
                        <?php endif; ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        <?php endif; ?>

    </div>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/services/wizards-spell.blade.php ENDPATH**/ ?>