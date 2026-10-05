<?php
    $results = $getoutstandingresult->results ?? [];

    if (!is_array($results)) {
        $results = json_decode($results, true) ?? [];
    }

    /*
    |--------------------------------------------------------------------------
    | Normalize into a list of category entries. Supports:
    | - current shape: a list of ['key' => ..., 'label' => ..., ...]
    | - old fixed-key shape: ['insurance' => [...] | 'path' | null, ...]
    |--------------------------------------------------------------------------
    */

    $isList = array_is_list($results) && isset($results[0]['key']);

    if (!$isList) {

        $legacyLabels = [
            'insurance' => 'Insurance',
            'automobile' => 'Automobile',
            'hotel_tourism' => 'Hotel & Tourism',
            'advertising_agency' => 'Advertising Agency',
        ];

        $normalized = [];

        foreach ($results as $key => $value) {

            if (is_array($value)) {
                $normalized[] = array_merge(['key' => $key, 'label' => $legacyLabels[$key] ?? $key], $value);
            } else {
                $normalized[] = [
                    'key' => $key,
                    'label' => $legacyLabels[$key] ?? $key,
                    'analytics_image' => $value ?: null,
                ];
            }
        }

        $results = $normalized;
    }
?>

<?php if($getoutstandingresult && $getoutstandingresult->status && !empty($results)): ?>

    <section class="tj-outstanding-section section-gap">
        <div class="container">

            <div class="sec-heading-wrap">
                <div class="sec-heading sec-heading-centered  sec-heading-centered-style-2">

                    <span class="sub-title">
                        <i class="tji-growth"></i>
                        Proven Results
                    </span>

                    <h3 class="sec-title">
                        <?php echo e($getoutstandingresult->heading); ?>

                    </h3>

                    <?php if($getoutstandingresult->description): ?>
                        <p class="desc">
                            <?php echo e($getoutstandingresult->description); ?>

                        </p>
                    <?php endif; ?>

                </div>
            </div>

            <div class="or-tabs" role="tablist">

                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button type="button" class="or-tab-btn <?php echo e($loop->first ? 'active' : ''); ?>"
                        data-tab="<?php echo e($entry['key']); ?>" role="tab" aria-selected="<?php echo e($loop->first ? 'true' : 'false'); ?>">
                        <?php echo e($entry['label'] ?? $entry['key']); ?>

                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

            <div class="or-panels">

                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php
                        $label = $entry['label'] ?? $entry['key'];
                        $keywords = $entry['keywords'] ?? [];

                        $hasStructuredData = !empty($entry['website']) ||
                            !empty($entry['challenge']) ||
                            !empty($entry['results_percentage']) ||
                            !empty($entry['results_summary']) ||
                            !empty($keywords) ||
                            !empty($entry['case_study_link']) ||
                            !empty($entry['analytics_image']);
                    ?>

                    <div class="or-panel <?php echo e($loop->first ? 'active' : ''); ?>" data-panel="<?php echo e($entry['key']); ?>">

                        <?php if($hasStructuredData): ?>

                            <div class="or-panel-inner">

                                
                                <div class="or-panel-left">

                                    <?php if(!empty($entry['website'])): ?>
                                        <span class="or-website-tag">
                                            <?php echo e($entry['website']); ?>

                                        </span>
                                    <?php endif; ?>

                                    <?php if(!empty($entry['challenge'])): ?>
                                        <h4 class="or-eyebrow">Challenge</h4>
                                        <p class="or-block-text">
                                            <?php echo e($entry['challenge']); ?>

                                        </p>
                                    <?php endif; ?>

                                    <?php if(!empty($entry['results_percentage']) || !empty($entry['results_summary'])): ?>
                                        <h4 class="or-eyebrow">Results</h4>

                                        <?php if(!empty($entry['results_percentage'])): ?>
                                            <div class="or-result-percentage">
                                                <?php echo e($entry['results_percentage']); ?>

                                            </div>
                                        <?php endif; ?>

                                        <?php if(!empty($entry['results_summary'])): ?>
                                            <p class="or-block-text">
                                                <?php echo e($entry['results_summary']); ?>

                                            </p>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if(!empty($keywords)): ?>
                                        <div class="or-keyword-table-wrap">
                                            <table class="or-keyword-table">
                                                <thead>
                                                    <tr>
                                                        <th>Keyword</th>
                                                        <th>Ranking</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($row['keyword'] ?? ''); ?></td>
                                                            <td><?php echo e($row['ranking'] ?? ''); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endif; ?>

                                </div>

                                
                                <div class="or-panel-right">

                                    <h4 class="or-eyebrow">
                                        <?php echo e($entry['analytics_heading'] ?? 'Traffic & Rankings'); ?>

                                    </h4>

                                    <div class="or-analytics-card">

                                        <?php if(!empty($entry['analytics_image'])): ?>
                                            <img src="<?php echo e(asset('storage/' . $entry['analytics_image'])); ?>"
                                                alt="<?php echo e($label); ?> analytics" class="or-analytics-img">
                                        <?php else: ?>
                                            <div class="or-analytics-empty">
                                                Analytics screenshot coming soon
                                            </div>
                                        <?php endif; ?>

                                    </div>

                                    <?php if(!empty($entry['case_study_link'])): ?>
                                        <a href="<?php echo e($entry['case_study_link']); ?>" class="or-case-study-link">
                                            View Case Study
                                            <i class="tji-arrow-right-long"></i>
                                        </a>
                                    <?php endif; ?>

                                </div>

                            </div>

                        <?php else: ?>

                            <div class="or-panel-empty">
                                <span><?php echo e($label); ?> case study coming soon</span>
                            </div>

                        <?php endif; ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>
    </section>

<?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/Home/outstanding-results.blade.php ENDPATH**/ ?>