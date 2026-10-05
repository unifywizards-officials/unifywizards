<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="col-xl-4 col-lg-5 col-md-6">

    <div class="footer-widget widget-subscribe wow fadeInUp" data-wow-delay=".7s">

        <span class="span-newsletter-title">
            Subscribe to Our Newsletter.
        </span>

        <div class="subscribe-form">

            <form id="newsletterForm" data-action="{{ route('newsletter.subscribe') }}">

                @csrf

                <input type="email" name="email" placeholder="Enter email" required />

                <button type="submit">

                    <i class="tji-plane"></i>

                </button>


            </form>

        </div>

    </div>

</div>

<script src="{{ asset('home_assets/js/newsletter.js') }}"></script>
