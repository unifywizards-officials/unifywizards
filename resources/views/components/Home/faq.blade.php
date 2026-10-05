<section class="tj-faq-section section-gap tj-arrange-container-2">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <div class="faq-img-area tj-arrange-item-2">
                    <div class="faq-img overflow-hidden">
                        <img src="{{ asset('home_assets/images/faq/faq.webp') }}" alt="" />
                        <h3 class="title">We have answers for your most asked questions.</h3>
                    </div>
                    <div class="box-area">
                        <div class="call-box">
                            <span class="title" style="font-size:20px;">Get Started Free Call?</span><br>
                            <span class="call-icon"><i class="tji-phone"></i></span>

                            @if ($footerNumber)
                                <a class="number" href="tel:{{ $footerNumber }}">
                                    <span>{{ $footerNumber }}</span>
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            @php
                $currentPage = request()->path() == '/' ? '/' : '/' . request()->path();

                $schema = \App\Models\Schema::where('status', 1)
                    ->whereHas('pages', function ($q) use ($currentPage) {
                        $q->where('page', $currentPage);
                    })
                    ->first();

                $faqSchema = $schema ? json_decode($schema->json_data, true) : [];

                $faqs = $faqSchema['faq']['mainEntity'] ?? [];
            @endphp

            @if (count($faqs))
                <div class="col-lg-6">
                    <div class="accordion tj-faq tj-arrange-item-2" id="faqOne">

                        @foreach ($faqs as $i => $faq)
                            <div class="accordion-item {{ $i == 0 ? 'active' : '' }}">

                                <button class="faq-title {{ $i != 0 ? 'collapsed' : '' }}" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#faq-{{ $i }}"
                                    aria-expanded="{{ $i == 0 ? 'true' : 'false' }}">
                                    {{ $faq['name'] }}
                                </button>

                                <div id="faq-{{ $i }}" class="collapse {{ $i == 0 ? 'show' : '' }}"
                                    data-bs-parent="#faqOne">
                                    <div class="accordion-body faq-text">
                                        <p>
                                            {{ $faq['acceptedAnswer']['text'] }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
