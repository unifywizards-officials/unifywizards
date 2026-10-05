@php
    $settings = \App\Models\Setting::first();

    $socialLinks = [];

    if ($settings && !empty($settings->social_links)) {
        $socialLinks = is_array($settings->social_links)
            ? $settings->social_links
            : json_decode($settings->social_links, true);
    }
@endphp

<footer class="tj-footer-section footer-1 section-gap-x">
    <div class="footer-main-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget wow fadeInUp" data-wow-delay=".1s">
                        <div class="footer-logo">
                            <a href="{{ '/' }}">
                                <img src="{{ asset('storage/'.$settings->footer_logo) }}" alt="Logo" />
                            </a>
                        </div>
                        <div class="footer-text">
                            <p>
                                {{ $settings->footer_description }}
                            </p>
                        </div>
                        <div class="award-logo-area">
                            <div class="award-logo">
                                <img src="{{ asset('storage/'.$settings->dark_footer_logo1) }}" alt="" />
                            </div>
                            <div class="award-logo">
                                <img src="{{ asset('storage/'.$settings->dark_footer_logo2) }}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                
                @php
                $footerServices = \App\Models\DmPage::where('footer_status', 1)
                    ->where('is_active', 1)
                    ->orderBy('page_name')
                    ->get();
            @endphp
                            
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="footer-widget widget-nav-menu wow fadeInUp" data-wow-delay=".3s">
                        <span class="span-footer-title">Services</span><br>
                       <ul class="footer-link">

                            @foreach ($footerServices as $service)
                                <li>
                                    <a href="{{ route('services.show', $service->slug) }}">
                                        {{ $service->page_name }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="footer-widget widget-nav-menu wow fadeInUp" data-wow-delay=".5s">
                        <span class="span-footer-title">Info</span><br>
                        <ul class="footer-link">
                            <li><a href="{{ url('aboutus') }}">About</a></li>
                            <li><a href="{{ url('blog') }}">Blog</a></li>
                            <li><a href="{{ url('contact') }}"> Contact Us</a></li>
                           
                            <li><a href="{{route('privacy.policy')}}">Privacy Policy</a></li>
                            <li><a href="{{route('terms.condition')}}">Terms & Condition</a></li>
                        </ul>
                    </div>
                </div>

                <x-newsletter />

            </div>
        </div>
    </div>
    <div class="tj-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright-content-area">
                        <div class="footer-contact">
                            <ul>
                                <li>
                                    <a href="tel:{{ $settings->footer_number }}">
                                        <span class="icon"><i class="tji-phone-2"></i></span>
                                        <span class="text">{{ $settings->footer_number }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:{{ $settings->footer_email }}">
                                        <span class="icon"><i class="tji-envelop-2"></i></span>
                                        <span class="text">{{ $settings->footer_email }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="social-links">
                            <ul>
                                @foreach ($socialLinks as $social)
                                    @php
                                        $icon = 'fa-globe';

                                        if (str_contains(strtolower($social['name']), 'facebook')) {
                                            $icon = 'fa-facebook-f';
                                        } elseif (str_contains(strtolower($social['name']), 'instagram')) {
                                            $icon = 'fa-instagram';
                                        } elseif (
                                            str_contains(strtolower($social['name']), 'twitter') ||
                                            str_contains(strtolower($social['name']), 'x')
                                        ) {
                                            $icon = 'fa-x-twitter';
                                        } elseif (str_contains(strtolower($social['name']), 'linkedin')) {
                                            $icon = 'fa-linkedin-in';
                                        } elseif (str_contains(strtolower($social['name']), 'indeed')) {
                                            $icon = 'fa-briefcase';
                                        }
                                    @endphp

                                    <li>
                                        <a href="{{ $social['link'] }}" target="_blank">
                                            <i class="fa-brands {{ $icon }}"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="copyright-text">
                            <p>
                                &copy; 2026
                                <a href="https://themeforest.net/user/theme-junction/portfolio" target="_blank">Unify
                                    Wizards</a>
                                All right reserved
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-shape-1">
        <img src="{{ asset('home_assets/images/shape/pattern-2.svg') }}" alt="" />
    </div>
    <div class="bg-shape-2">
        <img src="{{ asset('home_assets/images/shape/pattern-3.svg') }}" alt="" />
    </div>
</footer>
