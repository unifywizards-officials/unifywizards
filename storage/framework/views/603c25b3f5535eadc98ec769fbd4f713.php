<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="col-xl-4 col-lg-5 col-md-6">

    <div class="footer-widget widget-subscribe wow fadeInUp" data-wow-delay=".7s">

        <span class="span-newsletter-title">
            Subscribe to Our Newsletter.
        </span>

        <div class="subscribe-form">

            <form id="newsletterForm" data-action="<?php echo e(route('newsletter.subscribe')); ?>">

                <?php echo csrf_field(); ?>

                <input type="email" name="email" placeholder="Enter email" required />

                <button type="submit">

                    <i class="tji-plane"></i>

                </button>


            </form>

        </div>

    </div>

</div>

<script src="<?php echo e(asset('home_assets/js/newsletter.js')); ?>"></script>
<?php /**PATH D:\backend\unify-wizards-new\resources\views/components/newsletter.blade.php ENDPATH**/ ?>