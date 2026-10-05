<section class="tj-cta-section">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="cta-area">

                    <div class="cta-content">

                        <span class="cta-eyebrow">Let's Work Together</span>

                        <h4 class="title title-anim">
                            {{ $gethomecta->title }}
                        </h4>

                        @if (!empty($gethomecta->description))
                            <p class="cta-desc">
                                {{ $gethomecta->description }}
                            </p>
                        @endif

                        <ul class="cta-points">
                            <li><i class="fa-solid fa-circle-check"></i> Free strategy consultation</li>
                            <li><i class="fa-solid fa-circle-check"></i> No long-term contracts</li>
                            <li><i class="fa-solid fa-circle-check"></i> Response within 24 hours</li>
                        </ul>

                        @if (!empty($gethomecta->button_text))
                            <div class="cta-btn wow fadeInUp" data-wow-delay=".6s">

                                <a class="tj-primary-btn btn-dark" href="{{ $gethomecta->button_link ?? '#' }}">

                                    <span class="btn-text">
                                        <span>{{ $gethomecta->button_text }}</span>
                                    </span>

                                    <span class="btn-icon">
                                        <i class="tji-arrow-right-long"></i>
                                    </span>

                                </a>

                            </div>
                        @endif

                    </div>

                    <div class="cta-img">

                        <img src="{{ asset($gethomecta->image) }}" alt="{{ $gethomecta->title }}">

                        <div class="cta-img-badge">
                            <span class="cta-img-badge-num">30K+</span>
                            <span class="cta-img-badge-label">Happy Clients Worldwide</span>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
