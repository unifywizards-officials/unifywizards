@php
    $settings = \App\Models\Setting::first();

    // ── MARKETING ──────────────────────────────────────────────────────────────
    $seoPages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'marketing')
        ->where('service_type', 'digital_marketing')
        ->get();

    $paidAdPages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'marketing')
        ->where('service_type', 'paid_advertising')
        ->get();

    $onlineMarketingPages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'marketing')
        ->where('service_type', 'online_marketing')
        ->get();

    $marketingCasePages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'marketing')
        ->where('service_type', 'case_studies')
        ->get();

    // ── DESIGN & BRANDING ──────────────────────────────────────────────────────
    $brandingPages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'design_and_branding')
        ->where('service_type', 'branding')
        ->get();

    $graphicDesignPages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'design_and_branding')
        ->where('service_type', 'graphic_design')
        ->get();

    $creativeMediaPages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'design_and_branding')
        ->where('service_type', 'creative_media_services')
        ->get();

    $designCasePages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'design_and_branding')
        ->where('service_type', 'case_studies')
        ->get();

    // ── DEVELOPMENT ────────────────────────────────────────────────────────────
    $byGoalPages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'development')
        ->where('service_type', 'by_website_goal')
        ->get();

    $byPlatformPages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'development')
        ->where('service_type', 'by_platforms')
        ->get();

    $byIndustryPages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'development')
        ->where('service_type', 'by_industry')
        ->get();

    $devCasePages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'development')
        ->where('service_type', 'case_studies')
        ->get();

    // ── AI ─────────────────────────────────────────────────────────────────────
    $aiServicePages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'ai')
        ->where('service_type', 'ai_services')
        ->get();

    $aiSolutionPages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'ai')
        ->where('service_type', 'ai_solutions')
        ->get();

    $aiCasePages = \App\Models\DmPage::where('is_active', 1)
        ->where('header_menu', 'ai')
        ->where('service_type', 'case_studies')
        ->get();
@endphp
<nav class="ng-navbar">
    <div class="ng-nav-inner" id="navInner">

        <div class="site_logo">
            <a class="logo" href="{{ url('/') }}"><img src="{{ asset('storage/' . $settings->footer_logo) }}"
                    alt="" /></a>
        </div>

        <ul class="ng-nav-links" id="navLinks">

            <!-- DIGITAL MARKETING -->
            <li class="ng-nav-item" data-menu>
                <a class="ng-nav-link" href="#" onclick="return false;"> Marketing
                    <svg class="chv" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </a>
                <div class="ng-dropdown">
                    <div class="ng-drop-col">
                        <div class="ng-drop-head">
                            <div class="ng-drop-icon green"><svg viewBox="0 0 24 24">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.35-4.35" />
                                </svg></div>
                            <span class="ng-drop-col-title">Digital Marketing</span>
                        </div>
                        <ul class="ng-drop-links g">
                            @forelse($seoPages as $p)
                                <li>
                                    <a href="{{ route('services.show', ['slug' => $p->slug]) }}">
                                        <span class="dot"></span>{{ $p->page_name }}
                                    </a>
                                </li>
                            @empty
                                <li><a href="#"><span class="dot"></span>Search Engine Optimization</a></li>
                                <li><a href="#"><span class="dot"></span>AI SEO <span
                                            class="ng-badge new">New</span></a></li>
                               
                            @endforelse
                        </ul>
                    </div>
                    <div class="ng-drop-col">
                        <div class="ng-drop-head">
                            <div class="ng-drop-icon red"><svg viewBox="0 0 24 24">
                                    <rect x="2" y="3" width="20" height="14" rx="2" />
                                    <path d="M8 21h8M12 17v4" />
                                </svg></div>
                            <span class="ng-drop-col-title">Paid Advertising</span>
                        </div>
                        <ul class="ng-drop-links r">
                            @forelse($paidAdPages as $p)
                                <li>
                                    <a href="{{ route('services.show', ['slug' => $p->slug]) }}">
                                        <span class="dot"></span>{{ $p->page_name }}
                                    </a>
                                </li>
                            @empty
                                <li><a href="#"><span class="dot"></span>Google Ads <span
                                            class="ng-badge hot">Popular</span></a></li>
                                <li><a href="#"><span class="dot"></span>Facebook Ads</a></li>
                               
                            @endforelse
                        </ul>
                    </div>
                    <div class="ng-drop-col">
                        <div class="ng-drop-head">
                            <div class="ng-drop-icon blue"><svg viewBox="0 0 24 24">
                                    <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                                </svg></div>
                            <span class="ng-drop-col-title">Online Marketing</span>
                        </div>
                        <ul class="ng-drop-links b">
                            @forelse($onlineMarketingPages as $p)
                                <li>
                                    <a href="{{ route('services.show', ['slug' => $p->slug]) }}">
                                        <span class="dot"></span>{{ $p->page_name }}
                                    </a>
                                </li>
                            @empty
                                <li><a href="#"><span class="dot"></span>Social Media Marketing</a></li>
                              
                                <li><a href="#"><span class="dot"></span>Email Marketing</a></li>
                         
                            @endforelse
                        </ul>
                    </div>
                    <div class="ng-drop-col">
                        <div class="ng-drop-head">
                            <div class="ng-drop-icon cases"><svg viewBox="0 0 24 24">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14,2 14,8 20,8" />
                                </svg></div>
                            <span class="ng-drop-col-title">Case Studies</span>
                        </div>
                        <div class="ng-drop-cases">
                            @forelse($marketingCasePages as $p)
                                <a href="{{ route('services.show', ['slug' => $p->slug]) }}" class="ng-case-card">
                                    <div class="ng-case-thumb t1">{{ Str::limit($p->page_name, 12) }}</div>
                                    <div class="ng-case-body">
                                        <span class="ng-case-tag green">Marketing</span>
                                        <div class="ng-case-title">{{ $p->page_name }}</div>
                                    </div>
                                </a>
                            @empty
                                <a href="#" class="ng-case-card">
                                    <div class="ng-case-thumb t1">Fashion Brand</div>
                                    <div class="ng-case-body">
                                        <span class="ng-case-tag green">Ecommerce</span>
                                        <div class="ng-case-title">Fashion brand grows revenue by $6M+ with SEO</div>
                                        <div class="ng-case-metric">↑ 340% organic traffic</div>
                                    </div>
                                </a>
                                <a href="#" class="ng-case-card">
                                    <div class="ng-case-thumb t4">Healthcare</div>
                                    <div class="ng-case-body">
                                        <span class="ng-case-tag red">Lead Gen</span>
                                        <div class="ng-case-title">Dentist grows 4X through paid ads</div>
                                        <div class="ng-case-metric">↑ 280% qualified leads</div>
                                    </div>
                                </a>
                            @endforelse
                        </div>
                    </div>
                </div>
            </li>

            <!-- DESIGN AND BRANDING -->
            <li class="ng-nav-item" data-menu>
                <a class="ng-nav-link" href="#" onclick="return false;">Design
                    <svg class="chv" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </a>
                <div class="ng-dropdown">
                    <div class="ng-drop-col">
                        <div class="ng-drop-head">
                            <div class="ng-drop-icon green"><svg viewBox="0 0 24 24">
                                    <circle cx="11" cy="11" r="8" />
                                    <path d="m21 21-4.35-4.35" />
                                </svg></div>
                            <span class="ng-drop-col-title">Branding</span>
                        </div>
                        <ul class="ng-drop-links g">
                            @forelse($brandingPages as $p)
                                <li>
                                    <a href="{{ route('services.show', ['slug' => $p->slug]) }}">
                                        <span class="dot"></span>{{ $p->page_name }}
                                    </a>
                                </li>
                            @empty
                                <li><a href="#"><span class="dot"></span>Logo design</a></li>
                               
                            @endforelse
                        </ul>
                    </div>
                    <div class="ng-drop-col">
                        <div class="ng-drop-head">
                            <div class="ng-drop-icon red"><svg viewBox="0 0 24 24">
                                    <circle cx="9" cy="21" r="1" />
                                    <circle cx="20" cy="21" r="1" />
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                                </svg></div>
                            <span class="ng-drop-col-title">Graphic Design</span>
                        </div>
                        <ul class="ng-drop-links r">
                            @forelse($graphicDesignPages as $p)
                                <li>
                                    <a href="{{ route('services.show', ['slug' => $p->slug]) }}">
                                        <span class="dot"></span>{{ $p->page_name }}
                                    </a>
                                </li>
                            @empty
                              
                            @endforelse
                        </ul>
                    </div>
                    <div class="ng-drop-col">
                        <div class="ng-drop-head">
                            <div class="ng-drop-icon blue"><svg viewBox="0 0 24 24">
                                    <line x1="18" y1="20" x2="18" y2="10" />
                                    <line x1="12" y1="20" x2="12" y2="4" />
                                    <line x1="6" y1="20" x2="6" y2="14" />
                                </svg></div>
                            <span class="ng-drop-col-title">Creative & Media Services</span>
                        </div>
                        <ul class="ng-drop-links b">
                            @forelse($creativeMediaPages as $p)
                                <li>
                                    <a href="{{ route('services.show', ['slug' => $p->slug]) }}">
                                        <span class="dot"></span>{{ $p->page_name }}
                                    </a>
                                </li>
                            @empty
                                <li><a href="#"><span class="dot"></span>Video editing</a></li>
 
                                <li><a href="#" class="ng-see-more">See More <svg viewBox="0 0 24 24">
                                            <path d="M5 12h14M12 5l7 7-7 7" />
                                        </svg></a></li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="ng-drop-col">
                        <div class="ng-drop-head">
                            <div class="ng-drop-icon cases"><svg viewBox="0 0 24 24">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14,2 14,8 20,8" />
                                </svg></div>
                            <span class="ng-drop-col-title">Case Studies</span>
                        </div>
                        <div class="ng-drop-cases">
                            @forelse($designCasePages as $p)
                                <a href="{{ route('services.show', ['slug' => $p->slug]) }}" class="ng-case-card">
                                    <div class="ng-case-thumb t2">{{ Str::limit($p->page_name, 12) }}</div>
                                    <div class="ng-case-body">
                                        <span class="ng-case-tag green">Design</span>
                                        <div class="ng-case-title">{{ $p->page_name }}</div>
                                    </div>
                                </a>
                            @empty
                                <a href="#" class="ng-case-card">
                                    <div class="ng-case-thumb t2">Jeweler</div>
                                    <div class="ng-case-body">
                                        <span class="ng-case-tag green">Ecommerce</span>
                                        <div class="ng-case-title">Niche jeweler $160k→$315k/mo in one year</div>
                                        <div class="ng-case-metric">↑ 97% revenue growth</div>
                                    </div>
                                </a>
                                <a href="#" class="ng-case-card">
                                    <div class="ng-case-thumb t4">Lead Gen</div>
                                    <div class="ng-case-body">
                                        <span class="ng-case-tag red">Lead Gen</span>
                                        <div class="ng-case-title">Lease Advisors — 400% leads, 60% lower cost</div>
                                        <div class="ng-case-metric">↑ 400% leads</div>
                                    </div>
                                </a>
                            @endforelse
                        </div>
                    </div>
                </div>
            </li>

            <!-- DEVELOPMENT -->
            <li class="ng-nav-item" data-menu>
                <a class="ng-nav-link" href="#" onclick="return false;">Development
                    <svg class="chv" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </a>
                <div class="ng-dropdown development-dropdown">
                    <div class="ng-drop-col">
                        <div class="ng-drop-head">
                            <div class="ng-drop-icon green"><svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <circle cx="12" cy="12" r="6" />
                                    <circle cx="12" cy="12" r="2" />
                                </svg></div>
                            <span class="ng-drop-col-title">By Website Goal</span>
                        </div>
                        <ul class="ng-drop-links g">
                            @forelse($byGoalPages as $p)
                                <li>
                                    <a href="{{ route('services.show', ['slug' => $p->slug]) }}">
                                        <span class="dot"></span>{{ $p->page_name }}
                                    </a>
                                </li>
                            @empty
                                <li><a href="#"><span class="dot"></span>Web Design</a></li>
                                <li><a href="#"><span class="dot"></span>Ecommerce Web Design</a></li>
                                <li><a href="#"><span class="dot"></span>Lead Gen Web Design</a></li>
                                <li><a href="#"><span class="dot"></span>Headless Web Design</a></li>
                                <li><a href="#"><span class="dot"></span>AI Development <span
                                            class="ng-badge new">New</span></a></li>
                                <li><a href="#"><span class="dot"></span>CRM Integration</a></li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="ng-drop-col">
                        <div class="ng-drop-head">
                            <div class="ng-drop-icon red"><svg viewBox="0 0 24 24">
                                    <rect x="2" y="3" width="20" height="14" rx="2" />
                                    <path d="M8 21h8M12 17v4" />
                                </svg></div>
                            <span class="ng-drop-col-title">By Platforms</span>
                        </div>
                        <ul class="ng-drop-links r">
                            @forelse($byPlatformPages as $p)
                                <li>
                                    <a href="{{ route('services.show', ['slug' => $p->slug]) }}">
                                        <span class="dot"></span>{{ $p->page_name }}
                                    </a>
                                </li>
                            @empty
                                <li><a href="#"><span class="dot"></span>Shopify Web Design <span
                                            class="ng-badge hot">Popular</span></a></li>
                               
                            @endforelse
                        </ul>
                    </div>

                    <div class="ng-drop-col">
                        <div class="ng-drop-head">
                            <div class="ng-drop-icon cases"><svg viewBox="0 0 24 24">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14,2 14,8 20,8" />
                                </svg></div>
                            <span class="ng-drop-col-title">Case Studies</span>
                        </div>
                        <div class="ng-drop-cases">
                            @forelse($devCasePages as $p)
                                <a href="{{ route('services.show', ['slug' => $p->slug]) }}" class="ng-case-card">
                                    <div class="ng-case-thumb t3">{{ Str::limit($p->page_name, 12) }}</div>
                                    <div class="ng-case-body">
                                        <span class="ng-case-tag blue">Development</span>
                                        <div class="ng-case-title">{{ $p->page_name }}</div>
                                    </div>
                                </a>
                            @empty
                                <a href="#" class="ng-case-card">
                                    <div class="ng-case-thumb t3">Tech Product</div>
                                    <div class="ng-case-body">
                                        <span class="ng-case-tag blue">Web Design</span>
                                        <div class="ng-case-title">New website generates 868% ROI</div>
                                        <div class="ng-case-metric">↑ 868% return on investment</div>
                                    </div>
                                </a>
                                <a href="#" class="ng-case-card">
                                    <div class="ng-case-thumb t1">Native Union</div>
                                    <div class="ng-case-body">
                                        <span class="ng-case-tag green">Ecommerce</span>
                                        <div class="ng-case-title">Native Union grows traffic 58%, conversion 37%</div>
                                        <div class="ng-case-metric">↑ 37% conversion rate</div>
                                    </div>
                                </a>
                            @endforelse
                        </div>
                    </div>
                </div>
            </li>

            <!-- AI -->
            <li class="ng-nav-item" data-menu>
                <a class="ng-nav-link" href="#" onclick="return false;">AI
                    <svg class="chv" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </a>
                <div class="ng-dropdown" style="width:700px; grid-template-columns:1fr 1fr 1fr;">
                    <div class="ng-drop-col">
                        <div class="ng-drop-head">
                            <div class="ng-drop-icon green"><svg viewBox="0 0 24 24">
                                    <path d="M12 2a10 10 0 1 0 10 10" />
                                    <path d="M12 6v6l4 2" />
                                </svg></div>
                            <span class="ng-drop-col-title">AI Services</span>
                        </div>
                        <ul class="ng-drop-links g">
                            @forelse($aiServicePages as $p)
                                <li>
                                    <a href="{{ route('services.show', ['slug' => $p->slug]) }}">
                                        <span class="dot"></span>{{ $p->page_name }}
                                    </a>
                                </li>
                            @empty
                                <li><a href="#"><span class="dot"></span>AI SEO <span
                                            class="ng-badge new">New</span></a></li>
                                <li><a href="#"><span class="dot"></span>AI Content Strategy</a></li>
                                <li><a href="#"><span class="dot"></span>AI Development</a></li>
                                <li><a href="#"><span class="dot"></span>AI Analytics &amp; Reporting</a>
                                </li>
                                <li><a href="#"><span class="dot"></span>AI Automation</a></li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="ng-drop-col">
                        <div class="ng-drop-head">
                            <div class="ng-drop-icon red"><svg viewBox="0 0 24 24">
                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
                                </svg></div>
                            <span class="ng-drop-col-title">AI Solutions</span>
                        </div>
                        <ul class="ng-drop-links r">
                            @forelse($aiSolutionPages as $p)
                                <li>
                                    <a href="{{ route('services.show', ['slug' => $p->slug]) }}">
                                        <span class="dot"></span>{{ $p->page_name }}
                                    </a>
                                </li>
                            @empty
                                <li><a href="#"><span class="dot"></span>Predictive Analytics</a></li>
                                <li><a href="#"><span class="dot"></span>Chatbot Development</a></li>
                                <li><a href="#"><span class="dot"></span>AI Ad Optimization</a></li>
                                <li><a href="#"><span class="dot"></span>NLP Processing</a></li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="ng-drop-col" style="border-right:none; background:#fafbfc;">
                        <div class="ng-drop-head">
                            <div class="ng-drop-icon cases"><svg viewBox="0 0 24 24">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14,2 14,8 20,8" />
                                </svg></div>
                            <span class="ng-drop-col-title">Case Study</span>
                        </div>
                        <div class="ng-drop-cases">
                            @forelse($aiCasePages as $p)
                                <a href="{{ route('services.show', ['slug' => $p->slug]) }}" class="ng-case-card">
                                    <div class="ng-case-thumb t2">{{ Str::limit($p->page_name, 12) }}</div>
                                    <div class="ng-case-body">
                                        <span class="ng-case-tag green">AI</span>
                                        <div class="ng-case-title">{{ $p->page_name }}</div>
                                    </div>
                                </a>
                            @empty
                                <a href="#" class="ng-case-card">
                                    <div class="ng-case-thumb t2">AI Campaign</div>
                                    <div class="ng-case-body">
                                        <span class="ng-case-tag green">AI SEO</span>
                                        <div class="ng-case-title">AI-powered SEO triples organic revenue in 6 months
                                        </div>
                                        <div class="ng-case-metric">↑ 3X revenue growth</div>
                                    </div>
                                </a>
                            @endforelse
                        </div>
                    </div>
                </div>
            </li>

            <li class="ng-nav-item"><a class="ng-nav-link" href="{{ route('aboutus') }}">About Us</a></li>
            
            <li class="ng-nav-item"><a class="ng-nav-link" href="{{ route('blogs.show') }}">Blogs</a></li>

            <li class="ng-nav-item"><a class="ng-nav-link" href="{{ url('contact') }}">Contact Us</a></li>
        </ul>

        <div class="ng-nav-right">

            <a href="#" class="ng-nav-proposal">Get Free Proposal</a>
        </div>

        <button class="ng-hamburger" id="ng-hamburger" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>


<script src="{{ asset('home_assets/js/header.js') }}"></script>

