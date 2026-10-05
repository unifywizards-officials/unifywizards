<x-layouts.app>
     <script src="https://cdn.botpress.cloud/webchat/v5.0/inject.js"></script>
    <script src="https://files.bpcontent.cloud/2026/08/14/04/20260814044826-5BH69FYW.js" defer></script>
    <div class="space-for-header"></div>

    {{-- ── PAGE HEADER ── --}}
    <section class="uw-contact-hero">
        <div class="uw-contact-hero__bg"></div>
        <div class="container">
            <div class="uw-contact-hero__inner">

                <h1 class="uw-contact-hero__title">Get In <span class="uw-highlight">Touch</span></h1>

                <nav class="uw-breadcrumb">
                    <a href="{{ url('/') }}"><i class="tji-home"></i> Home</a>
                    <span><i class="tji-arrow-right"></i></span>
                    <span>Contact Us</span>
                </nav>
            </div>
        </div>
        <div class="uw-contact-hero__shapes">
            <div class="uw-shape uw-shape--1"></div>
            <div class="uw-shape uw-shape--2"></div>
            <div class="uw-shape uw-shape--3"></div>
        </div>
    </section>

    {{-- ── CONTACT CARDS ── --}}
    <section class="uw-info-strip">
        <div class="container">
            <div class="uw-info-grid">
                <div class="uw-info-card uw-info-card--blue">
                    <div class="uw-info-icon">
                        <i class="tji-location-3"></i>
                    </div>
                    <div class="uw-info-body">
                        <span style="color:#1c1c1e;font-weight: 600;">Our Location</span>
                        <p>{{ $getdata->location }}</p>
                    </div>
                </div>
                <div class="uw-info-card uw-info-card--green">
                    <div class="uw-info-icon">
                        <i class="tji-envelop"></i>
                    </div>
                    <div class="uw-info-body">
                        <span style="color:#1c1c1e;font-weight: 600;">Email Us</span>
                        <a href="mailto:{{ $getdata->footer_email }}">
                            {{ $getdata->footer_email }}
                        </a>
                    </div>
                </div>
                <div class="uw-info-card uw-info-card--coral">
                    <div class="uw-info-icon">
                        <i class="tji-phone"></i>
                    </div>
                    <div class="uw-info-body">
                        <span style="color:#1c1c1e;font-weight: 600;">Call Us</span>
                        <a href="tel:{{ $getdata->footer_number }}">
                            {{ $getdata->footer_number }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── MAIN FORM + MAP ── --}}
    <section class="uw-contact-main">
        <div class="container">
            <div class="uw-contact-grid">

                {{-- FORM --}}
                <div class="uw-form-wrap">
                    @if (session('success'))
                        <div class="alert alert-success mb-3">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="uw-form-header">
                        <span class="uw-label">Send a Message</span>
                        <h2>Let's Start a <span class="uw-highlight">Conversation</span></h2>
                        <p>Fill in the details below and our team will reach out within 24 hours.</p>
                    </div>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        <div class="uw-form-row">
                            <div class="uw-form-group">
                                <label>Full Name</label>
                                <input type="text" name="conName" value="{{ old('conName') }}" placeholder="John Doe"
                                    required>
                            </div>

                            <div class="uw-form-group">
                                <label>Email Address</label>
                                <input type="email" name="conEmail" value="{{ old('conEmail') }}"
                                    placeholder="john@company.com" required>
                            </div>
                        </div>

                        <div class="uw-form-row">
                            <div class="uw-form-group">
                                <label>Phone Number</label>
                                <input type="tel" name="conPhone" value="{{ old('conPhone') }}"
                                    placeholder="+1 (000) 000-0000" required>
                            </div>

                            <div class="uw-form-group">
                                <label>Subject</label>

                                <div class="uw-select-wrap">
                                    <select name="conSubject">
                                        <option value="">Choose a service</option>

                                        <option value="Business Strategy">
                                            Business Strategy
                                        </option>

                                        <option value="Customer Experience">
                                            Customer Experience
                                        </option>

                                        <option value="Sustainability and ESG">
                                            Sustainability and ESG
                                        </option>

                                        <option value="Training and Development">
                                            Training and Development
                                        </option>

                                        <option value="IT Support & Maintenance">
                                            IT Support & Maintenance
                                        </option>

                                        <option value="Marketing Strategy">
                                            Marketing Strategy
                                        </option>
                                    </select>

                          
                                </div>
                            </div>
                        </div>

                        <div class="uw-form-group uw-form-group--full">
                            <label>Your Message</label>

                            <textarea name="conMessage" rows="5" placeholder="Tell us about your project, goals, timeline..." required>{{ old('conMessage') }}</textarea>
                        </div>

                        <button class="uw-submit-btn" type="submit">
                            <span>Send Message</span>
                            <i class="tji-arrow-right-long"></i>
                        </button>
                    </form>
                </div>

                {{-- MAP --}}
                <div class="uw-map-wrap">
                    <div class="uw-map-header">
                        <span class="uw-label">Find Us</span>
                        <h2>Visit Our <span class="uw-highlight">Office</span></h2>
                        <p>We're centrally located and easy to find. Come say hello!</p>
                        <div class="uw-office-badge">
                            <i class="tji-clock"></i>
                            <div>
                                <strong>Working Hours</strong>
                                <span>Mon – Fri: 10:00 AM – 7:00 PM</span>
                            </div>
                        </div>
                    </div>
                    <div class="uw-map-frame">
                        {!! $getdata->google_map_embed !!}
                    </div>
                </div>

            </div>
        </div>
    </section>
    
       @include('components.Home.cta', [
        'gethomecta' => $gethomecta,
    ])

    {{-- ── STYLES ── --}}
    <link rel="stylesheet" href="{{ asset('home_assets/css/contact.css') }}">
</x-layouts.app>

<style>
    .tj-chatbot-section {
        padding: 80px 0;
    }

    .unify-chatbot-wrapper {
        width: 100%;
        height: 650px;
        border-radius: 15px;
        overflow: hidden;
    }

    #unifywizards-chatbot {
        width: 100%;
        height: 100%;
    }
</style>
