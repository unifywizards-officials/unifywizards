 <?php
     $currentPage = request()->path() == '/' ? '/' : '/' . request()->path();

     $schema = \App\Models\Schema::where('status', 1)
         ->whereHas('pages', function ($q) use ($currentPage) {
             $q->where('page', $currentPage);
         })
         ->first();

     $faqSchema = $schema ? json_decode($schema->json_data, true) : [];

     $faqs = $faqSchema['faq']['mainEntity'] ?? [];
 ?>

 <?php if(count($faqs)): ?>

     <div class="accordion tj-faq tj-arrange-item-2" id="faqOne">

         <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <div class="accordion-item <?php echo e($i == 0 ? 'active' : ''); ?>">

                 <button class="faq-title <?php echo e($i != 0 ? 'collapsed' : ''); ?>" type="button" data-bs-toggle="collapse"
                     data-bs-target="#faq-<?php echo e($i); ?>" aria-expanded="<?php echo e($i == 0 ? 'true' : 'false'); ?>">
                     <?php echo e($faq['name']); ?>

                 </button>

                 <div id="faq-<?php echo e($i); ?>" class="collapse <?php echo e($i == 0 ? 'show' : ''); ?>" data-bs-parent="#faqOne">
                     <div class="accordion-body faq-text">
                         <p>
                             <?php echo e($faq['acceptedAnswer']['text']); ?>

                         </p>
                     </div>
                 </div>

             </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

     </div>

 <?php endif; ?>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/faq-schemas.blade.php ENDPATH**/ ?>