
<style>
    .tab-section-44__nav {
        height: 400px;
        overflow: auto;
    }
</style>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['getmarketingsection']));

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

foreach (array_filter((['getmarketingsection']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    // ── Parse tabs JSON ──────────────────────────────────────
    $tabs = [];
    if (!empty($getmarketingsection->tabs)) {
        $raw = $getmarketingsection->tabs;
        $tabs = is_array($raw) ? $raw : json_decode($raw, true) ?? [];
    }

    // ── Title HTML: inject highlight_text as <span> ──────────
    $rawTitle = $getmarketingsection->title ?? '';
    $highlightText = $getmarketingsection->highlight_text ?? '';
    $description = $getmarketingsection->description ?? '';
    $linkText = $getmarketingsection->link_text ?? '';
    $linkUrl = $getmarketingsection->link_url ?? '#';

    if ($highlightText && str_contains($rawTitle, $highlightText)) {
        // Split on highlight_text, wrap it
        $parts = explode($highlightText, $rawTitle, 2);
        $titleHtml =
            e($parts[0]) .
            '<span class="tab-section-44__title-accent">' .
            e($highlightText) .
            '</span>' .
            e($parts[1] ?? '');
    } else {
        $titleHtml = e($rawTitle);
    }

    // ── Description: optionally wrap link_text in <a> ────────
    $descHtml = e($description);
    if ($linkText && str_contains($description, $linkText)) {
        $descHtml = str_replace(
            e($linkText),
            '<a href="' . e($linkUrl) . '" class="tab-section-44__link">' . e($linkText) . '</a>',
            e($description),
        );
    }
?>

<section class="tab-section-44 section-gap-x" >
    <div class="container">

        
        <div class="tab-section-44__header">
            <h3 class="tab-section-44__title">
                <?php echo $titleHtml; ?>

            </h3>
            <p class="tab-section-44__subtitle">
                <?php echo $descHtml; ?>

            </p>
        </div>

        <?php if(count($tabs)): ?>
            <div class="tab-section-44__container">

                
                <nav class="tab-section-44__nav" role="tablist" aria-label="Digital Marketing Services">
                    <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $slug = $tab['tab_slug'] ?? 'tab-' . $i; ?>
                        <button class="tab-section-44__nav-item<?php echo e($i === 0 ? ' tab-section-44__nav-item--active' : ''); ?>"
                            role="tab" aria-selected="<?php echo e($i === 0 ? 'true' : 'false'); ?>"
                            aria-controls="tab-panel-44-<?php echo e($slug); ?>" data-tab="<?php echo e($slug); ?>"
                            type="button">
                            <?php echo e($tab['tab_title'] ?? ''); ?>

                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </nav>

                
                <div class="tab-section-44__content">
                    <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $slug = $tab['tab_slug'] ?? 'tab-' . $i;
                            $points = $tab['points'] ?? [];
                            $tags = $tab['tags'] ?? [];
                        ?>

                        <div class="tab-section-44__panel<?php echo e($i === 0 ? ' tab-section-44__panel--active' : ''); ?>"
                            id="tab-panel-44-<?php echo e($slug); ?>" role="tabpanel"
                            aria-labelledby="tab-44-<?php echo e($slug); ?>"
                            <?php if($i !== 0): ?> hidden <?php endif; ?>>

                            
                            <?php if(count($points)): ?>
                                <ul class="tab-section-44__list">
                                    <?php $__currentLoopData = $points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="tab-section-44__list-item">
                                            <span class="tab-section-44__point-title">
                                                <?php echo e($point['title'] ?? ''); ?>

                                            </span>
                                            <p class="tab-section-44__point-text">
                                                <?php echo e($point['description'] ?? ''); ?>

                                            </p>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>

                            
                            <?php if(count($tags)): ?>
                                <div class="tab-section-44__tags">
                                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $tagLink = $tag['link'] ?? '#';
                                            // Strip trailing ↗ from stored text — we always render it fresh
                                            $tagText = trim(str_replace('↗', '', $tag['text'] ?? ''));
                                            $isGoogle = str_contains(strtolower($tagText), 'google');
                                        ?>

                                        <?php if($isGoogle): ?>
                                            <a href="<?php echo e($tagLink); ?>"
                                                class="tab-section-44__tag tab-section-44__tag--google">
                                                <span class="tab-section-44__google-dots">
                                                    <span
                                                        class="tab-section-44__gdot tab-section-44__gdot--blue"></span>
                                                    <span class="tab-section-44__gdot tab-section-44__gdot--red"></span>
                                                    <span
                                                        class="tab-section-44__gdot tab-section-44__gdot--yellow"></span>
                                                    <span
                                                        class="tab-section-44__gdot tab-section-44__gdot--green"></span>
                                                </span>
                                                <?php echo e($tagText); ?>

                                                <span class="tab-section-44__tag-arrow">↗</span>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e($tagLink); ?>" class="tab-section-44__tag">
                                                <?php echo e($tagText); ?>

                                                <span class="tab-section-44__tag-arrow">↗</span>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
        <?php endif; ?>

    </div>
</section>

<?php if (! $__env->hasRenderedOnce('85357fca-1ebc-4a25-b751-61c5d9be9672')): $__env->markAsRenderedOnce('85357fca-1ebc-4a25-b751-61c5d9be9672'); ?>
    <?php $__env->startPush('scripts'); ?>
        <script>
            (function() {
                'use strict';

                var nav = document.querySelector('.tab-section-44__nav');
                if (!nav) return;

                var btns = nav.querySelectorAll('.tab-section-44__nav-item');
                var panels = document.querySelectorAll('.tab-section-44__panel');

                function activate(slug) {
                    btns.forEach(function(b) {
                        var active = b.getAttribute('data-tab') === slug;
                        b.classList.toggle('tab-section-44__nav-item--active', active);
                        b.setAttribute('aria-selected', active ? 'true' : 'false');
                    });
                    panels.forEach(function(p) {
                        var active = p.id === 'tab-panel-44-' + slug;
                        p.classList.toggle('tab-section-44__panel--active', active);
                        active ? p.removeAttribute('hidden') : p.setAttribute('hidden', '');
                    });
                }

                // Click
                btns.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        activate(btn.getAttribute('data-tab'));
                    });
                });

                // Keyboard (Arrow keys for accessibility)
                btns.forEach(function(btn, i) {
                    btn.addEventListener('keydown', function(e) {
                        var n = btns.length;
                        if (e.key === 'ArrowDown' || e.key === 'ArrowRight') {
                            e.preventDefault();
                            var next = btns[(i + 1) % n];
                            next.focus();
                            activate(next.getAttribute('data-tab'));
                        }
                        if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') {
                            e.preventDefault();
                            var prev = btns[(i - 1 + n) % n];
                            prev.focus();
                            activate(prev.getAttribute('data-tab'));
                        }
                    });
                });

            }());
        </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/marketing.blade.php ENDPATH**/ ?>