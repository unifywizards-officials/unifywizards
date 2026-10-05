<form id="proposalForm" class="proposal-ajax-form" data-action="{{ route('proposal.store') }}">

    @csrf

    <div id="uw2Body">

        <!-- Google trust strip -->
        <div class="uw2-google-strip">
            <div class="uw2-google-logo">
                <span class="uw2-gl uw2-gl-b"></span>
                <span class="uw2-gl uw2-gl-r"></span>
                <span class="uw2-gl uw2-gl-y"></span>
                <span class="uw2-gl uw2-gl-g"></span>
            </div>

            <span class="uw2-google-strip-text">
                <strong>4.6</strong> · Rated on Google Reviews
            </span>

            <div class="uw2-stars">
                <div class="uw2-star"></div>
                <div class="uw2-star"></div>
                <div class="uw2-star"></div>
                <div class="uw2-star"></div>
                <div class="uw2-star"></div>
            </div>
        </div>

        <!-- Badge -->
        <div class="uw2-badge text-white">
            <span class="uw2-badge-dot"></span>
            Free Proposal
        </div>

        <!-- Heading -->
        <span class="uw2-title"><br>
            Let's Build Something<br />
            Remarkable
        </span>

        <p class="uw2-sub">
            Tell us about your project — response within 24 hours.
        </p>

        <!-- Name -->
        <div class="uw2-row">

            <div class="uw2-group">
                <label class="uw2-label">
                    First Name
                </label>

                <input class="uw2-input" type="text" placeholder="John" name="first_name" required>
            </div>

            <div class="uw2-group">
                <label class="uw2-label">
                    Last Name
                </label>

                <input class="uw2-input" type="text" placeholder="Smith" name="last_name">
            </div>

        </div>

        <!-- Email -->
        <div class="uw2-group">

            <label class="uw2-label">
                Email Address
            </label>

            <input class="uw2-input" type="email" placeholder="john@company.com" name="email" required>

        </div>

        <!-- Message -->
        <div class="uw2-group">

            <label class="uw2-label">
                Project Details
            </label>

            <textarea class="uw2-textarea" placeholder="Goals, timeline, or questions..." name="message"></textarea>

        </div>

        <hr class="uw2-divider" />

        <!-- Buttons -->
        <div class="uw2-btn-row">

            <button type="submit" class="uw2-submit text-white">

                Get Free Proposal

                <svg width="15" height="15" viewBox="0 0 16 16" fill="none">

                    <path d="M3 8H13M13 8L9 4M13 8L9 12" stroke="#ffffff" stroke-width="1.8" stroke-linecap="round"
                        stroke-linejoin="round" />

                </svg>

            </button>

        </div>

        <!-- Privacy -->
        <p class="uw2-privacy text-white">

            By submitting, you agree to our
          <strong> <a href="#" class="text-white">Privacy Policy</a>.</strong> 

            No spam, ever.

        </p>

    </div>

</form>

{{-- proposal.js is loaded once, site-wide, from the main layout --}}
