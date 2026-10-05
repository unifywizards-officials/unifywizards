<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['industry']));

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

foreach (array_filter((['industry']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $industries = [];

    if (!empty($industry->industries)) {
        $industries = is_string($industry->industries)
            ? json_decode($industry->industries, true)
            : $industry->industries;
    }
?>

<section class="h5-project">
    <div class="tj-scroll-slider section-gap" style="padding-top:20px;">
        <div class="container">

            
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading-wrap style-3"
                        style="display:flex; flex-direction:column; align-items:center; text-align:center; margin-bottom:10px;">

                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s">
                            <i class="tji-box"></i>
                            <?php echo e($industry->sub_title); ?>

                        </span>

                        <div class="heading-wrap-content"
                            style="display:flex; flex-direction:column; align-items:center; text-align:center; width:100%;">

                            <div class="sec-heading style-3" style="text-align:center;">
                                <h2 class="sec-title" style="font-size:37px; line-height:1.3; max-width:700px; margin:0 auto;">
                                    <?php echo e($industry->title); ?>

                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-12">
                    <div class="project-wrapper h5-project-wrapper">

                       <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <?php

        $offerItems = [];
        $steps = [];

        $lines = preg_split('/\r\n|\r|\n/', $item['description_2']);

        $mode = '';
        $currentStep = [];

        foreach ($lines as $line) {

            $line = trim($line);

            if ($line == '') {
                continue;
            }

            if (strtolower($line) == 'what we offer') {
                $mode = 'offer';
                continue;
            }

            if (strtolower($line) == 'how it works') {
                $mode = 'steps';
                continue;
            }

            if ($mode == 'offer') {
                $offerItems[] = $line;
                continue;
            }

            if ($mode == 'steps') {

                if (preg_match('/^\d+\./', $line)) {

                    if (!empty($currentStep)) {
                        $steps[] = $currentStep;
                    }

                    $number = preg_replace('/\..*/', '', $line);

                    $title = trim(
                        preg_replace('/^\d+\.\s*/', '', $line)
                    );

                    $currentStep = [
                        'number' => $number,
                        'title' => $title,
                        'sub' => '',
                    ];

                } else {

                    if (!empty($currentStep)) {
                        $currentStep['sub'] .=
                            ($currentStep['sub'] ? ' ' : '') . $line;
                    }

                }
            }
        }

        if (!empty($currentStep)) {
            $steps[] = $currentStep;
        }

    ?>
                            <div class="h5-project-item-wrapper tj-scroll-slider-item">

                                <div class="project-item h4-project-item h5-project-item">

                                    
                                    <div class="project-img">
                                        <img src="<?php echo e(asset($item['image'])); ?>" alt="<?php echo e($item['title']); ?>">
                                    </div>

                                    <div class="hcw-content">

                                        
                                        <div class="hcw-left">

                                            <div>

                                                <div class="hcw-tag">
                                                    <svg viewBox="0 0 24 24" aria-hidden="true">
                                                        <path
                                                            d="M12 2a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4z" />
                                                    </svg>

                                                    <?php echo e($item['tag']); ?>

                                                </div>

                                                <h2 class="hcw-title">
                                                    <?php echo e($item['title']); ?>

                                                </h2>

                                                <p class="hcw-desc">
                                                    <?php echo nl2br(e($item['description_1'])); ?>

                                                </p>

                                            </div>

                                            <!--<a class="hcw-btn" href="<?php echo e($item['button_link']); ?>">-->

                                            <!--    <?php echo e($item['button_text']); ?>-->

                                            <!--    <span class="hcw-btn-icon">-->
                                            <!--        <svg viewBox="0 0 24 24" aria-hidden="true">-->
                                            <!--            <line x1="7" y1="17" x2="17"-->
                                            <!--                y2="7" />-->
                                            <!--            <polyline points="7 7 17 7 17 17" />-->
                                            <!--        </svg>-->
                                            <!--    </span>-->

                                            <!--</a>-->

                                        </div>

                                        
                                        <div class="hcw-right">

                                            
                                            <div>

                                                <p class="hcw-section-label">
                                                    What we offer
                                                </p>

                                                <div class="hcw-pills">

                                                    <?php $__currentLoopData = $offerItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <span class="hcw-pill">

                                                            <svg viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">

                                                                <circle cx="12" cy="12" r="10" />

                                                            </svg>

                                                            <?php echo e($offer); ?>


                                                        </span>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </div>

                                            </div>

                                            <hr class="hcw-divider">

                                            
                                        <div>
    <p class="hcw-section-label">
        How it works
    </p>

    <div class="hcw-steps">

        <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="hcw-step">

                <div class="hcw-step-num">
                    <?php echo e($step['number']); ?>

                </div>

                <div>

                    <p class="hcw-step-title">
                        <?php echo e($step['title']); ?>

                    </p>

                    <p class="hcw-step-sub">
                        <?php echo e($step['sub']); ?>

                    </p>

                </div>

            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-12">
                    <div class="btn-area wow fadeInUp" data-wow-delay=".8s"
                        style="display:flex; justify-content:center; margin-top:55px;">
                        <a class="tj-primary-btn" href="<?php echo e($industry->button_link); ?>">
                            <span class="btn-text">
                                <span><?php echo e($industry->button_text); ?></span>
                            </span>
                            <span class="btn-icon">
                                <i class="tji-arrow-right-long"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/industries.blade.php ENDPATH**/ ?>