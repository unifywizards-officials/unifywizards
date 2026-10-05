<x-layouts.app>
    <div class="space-for-header"></div>
    <!-- start: Banner Section -->

    <section class="tj-banner-section-2 section-gap-x top-space-30">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="banner-content-2">
                        <span class="sub-title" data-wow-delay=".2s">
                            <i class="tji-box"></i> Get to Know Us
                        </span>
                        <h1 class="banner-title">
                            Custom Development
                            <a class="title-video video-popup" data-wow-delay="1.3s" data-autoplay="true"
                                data-vbtype="video" data-maxwidth="1200px"
                                href="https://www.youtube.com/watch?v=MLpWrANjFbI&ab_channel=eidelchteinadvogados">
                                <i class="tji-play"></i>
                                <img src="assets/images/hero/title-img.webp" alt="" />
                            </a>
                            Solutions For Your Business.
                        </h1>
                        <p class="desc">
                            Unify Wizards delivers cutting-edge web and mobile development
                            solutions, helping clients scale their digital presence with
                            high-performance, secure, and maintainable applications.
                        </p>
                        <div class="btn-area mb-40" data-wow-delay=".8s">
                            <a class="tj-primary-btn" href="contact.html">
                                <span class="btn-text"><span>Learn More</span></span>
                                <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                            </a>
                            <a class="number" href="tel:18884521505"><i
                                    class="tji-phone"></i><span>1-888-452-1505</span></a>
                        </div>
                        <div class="row">
                            <div class="col-6 col-lg-3 justify-content-center d-flex">
                                <img src="{{ asset('home_assets/images/awards/1.webp') }}" alt=""
                                    class="award-width" />
                            </div>
                            <div class="col-6 col-lg-3 justify-content-center d-flex">
                                <img src="{{ asset('home_assets/images/awards/2.webp') }}" alt=""
                                    class="award-width" />
                            </div>
                            <div class="col-6 col-lg-3 justify-content-center d-flex">
                                <img src="{{ asset('home_assets/images/awards/3.webp') }}" alt=""
                                    class="award-width" />
                            </div>
                            <div class="col-6 col-lg-3 justify-content-center d-flex">
                                <img src="{{ asset('home_assets/images/awards/4.webp') }}" alt=""
                                    class="award-width" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="banner-img-area wow fadeInUp" data-wow-delay=".3s">
                        <div class="banner-img">
                            <div class="uw2-wrap" id="uw2Container">
                                <div class="uw2-accent-bar"></div>

                                <!-- ── Form Body ── -->
                                <x-Proposal />

                                <!-- ── Success State ── -->
                                <div class="uw2-success" id="uw2Success">
                                    <div class="uw2-success-icon">
                                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                                            <path d="M5 12L10 17L19 7" stroke="#22c55e" stroke-width="2.2"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <h3>Proposal Request Sent!</h3>
                                    <p>
                                        Our team will review your project and get back to
                                        you within 24 hours.
                                    </p>
                                </div>
                            </div>

                            <div class="brand-name wow fadeIn" data-wow-delay="2.2s">
                                <div class="marquee-vr">
                                    <span class="text">Web Development<span class="icon">/</span></span>
                                    <span class="text">Web Development<span class="icon">/</span></span>
                                    <span class="text">Web Development<span class="icon">/</span></span>
                                    <span class="text">Web Development<span class="icon">/</span></span>
                                    <span class="text">Web Development<span class="icon">/</span></span>
                                    <span class="text">Web Development<span class="icon">/</span></span>
                                    <span class="text">Web Development<span class="icon">/</span></span>
                                </div>
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
        <div class="banner-scroll wow fadeInDown" data-wow-delay="2.5s">
            <a href="#choose" class="scroll-down tj-scroll-btn">
                <span><i class="tji-arrow-down-long"></i></span>
                Scroll Down
            </a>
        </div>
    </section>



    <section class="tj-team-section section-separator">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading text-center style-2">
                        <h2 class="sec-title">
                            Top Development Services at
                            <span>Unify Wizards</span>
                        </h2>
                        <p class="desc">
                            Unify Wizards delivers cutting-edge web and mobile development
                            solutions, helping clients scale their digital presence with
                            high-performance, secure, and maintainable applications.
                        </p>
                    </div>
                </div>
            </div>
            <div class="details-content-box row">
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="#" class="service-details-item wow fadeInUp" data-wow-delay=".2s">
                        <span class="number">01.</span>
                        <h6 class="title">Web Application Development</h6>
                        <div class="desc">
                            <p>
                                Build scalable, responsive web applications using modern
                                frameworks and best practices for optimal performance
                                and user experience.
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="#" class="service-details-item wow fadeInUp" data-wow-delay=".4s">
                        <div class="service-number">
                            <span class="number">02.</span>
                            <h6 class="title">Mobile App Development</h6>
                            <div class="desc">
                                <p>
                                    Create native and cross-platform mobile applications
                                    for iOS and Android with seamless performance and
                                    intuitive user interfaces.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="#" class="service-details-item wow fadeInUp" data-wow-delay=".6s">
                        <div class="service-number">
                            <span class="number">03.</span>
                            <h6 class="title">Full-Stack Development</h6>
                            <div class="desc">
                                <p>
                                    Complete end-to-end development combining frontend,
                                    backend, and database expertise to deliver comprehensive
                                    digital solutions.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="#" class="service-details-item wow fadeInUp" data-wow-delay=".2s">
                        <span class="number">04.</span>
                        <h6 class="title">Cloud Solutions & DevOps</h6>
                        <div class="desc">
                            <p>
                                Deploy and manage applications on AWS, Azure, or GCP with
                                automated CI/CD pipelines, containerization, and
                                infrastructure optimization.
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="#" class="service-details-item wow fadeInUp" data-wow-delay=".4s">
                        <div class="service-number">
                            <span class="number">05.</span>
                            <h6 class="title">API Development & Integration</h6>
                            <div class="desc">
                                <p>
                                    Design and develop robust APIs with comprehensive
                                    documentation and integrate third-party services
                                    seamlessly into your applications.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="#" class="service-details-item wow fadeInUp" data-wow-delay=".6s">
                        <div class="service-number">
                            <span class="number">06.</span>
                            <h6 class="title">Ecommerce Development</h6>
                            <div class="desc">
                                <p>
                                    Build high-converting ecommerce platforms with secure
                                    payment processing, inventory management, and
                                    seamless shopping experiences.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="#" class="service-details-item wow fadeInUp" data-wow-delay=".2s">
                        <span class="number">07.</span>
                        <h6 class="title">AI & Machine Learning Integration</h6>
                        <div class="desc">
                            <p>
                                Integrate AI/ML capabilities into your applications for
                                predictive analytics, automation, and intelligent
                                decision-making systems.
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="#" class="service-details-item wow fadeInUp" data-wow-delay=".4s">
                        <div class="service-number">
                            <span class="number">08.</span>
                            <h6 class="title">Maintenance & Support</h6>
                            <div class="desc">
                                <p>
                                    Ongoing technical support, bug fixes, security updates,
                                    and performance optimization to keep your applications
                                    running smoothly.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <section class="tj-industries-section section-gap section-separator">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="sec-heading-wrap style-3 text-center">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i>Industries
                            We
                            Serve</span>

                        <div class="sec-heading style-3">
                            <h2 class="sec-title">
                                Focused experience across high-impact industries
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-3 justify-content-center">
                <div class="col-6 col-md-2">
                    <a href="#" class="industries-card" data-wow-delay=".2s">
                        <div class="industries-icon google-blue">
                            <i class="fa fa-thin fa-magic-wand-sparkles"></i>
                        </div>
                        <p class="industries-title">Makeup</p>
                        <p class="industries-description">
                            Enhance beauty with professional makeup products
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a href="#" class="industries-card" data-wow-delay=".25s">
                        <div class="industries-icon google-red">
                            <i class="fa fa-thin fa-spa"></i>
                        </div>
                        <p class="industries-title">Beauty &amp; Skincare</p>
                        <p class="industries-description">
                            Premium skincare for healthy glowing complexion
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a href="#" class="industries-card" data-wow-delay=".3s">
                        <div class="industries-icon google-yellow">
                            <i class="fa fa-thin fa-dumbbell"></i>
                        </div>
                        <p class="industries-title">Fitness</p>
                        <p class="industries-description">
                            Achieve goals with expert programs equipment
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a href="#" class="industries-card" data-wow-delay=".35s">
                        <div class="industries-icon google-green">
                            <i class="fa fa-thin fa-shirt"></i>
                        </div>
                        <p class="industries-title">Fashion</p>
                        <p class="industries-description">
                            Latest fashion styles and trendy collections
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a href="#" class="industries-card" data-wow-delay=".4s">
                        <div class="industries-icon google-blue">
                            <i class="fa fa-thin fa-gem"></i>
                        </div>
                        <p class="industries-title">Jewelry</p>
                        <p class="industries-description">
                            Elegant designs for every occasion celebration
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a href="#" class="industries-card" data-wow-delay=".45s">
                        <div class="industries-icon google-red">
                            <i class="fa fa-thin fa-mobile-screen-button"></i>
                        </div>
                        <p class="industries-title">Cell Phone Accessories</p>
                        <p class="industries-description">
                            Durable protection for all smartphone devices
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a href="#" class="industries-card" data-wow-delay=".5s">
                        <div class="industries-icon google-yellow">
                            <i class="fa fa-thin fa-gavel"></i>
                        </div>
                        <p class="industries-title">Lawyers</p>
                        <p class="industries-description">
                            Expert legal services and consultations available
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a href="#" class="industries-card" data-wow-delay=".55s">
                        <div class="industries-icon google-green">
                            <i class="fa fa-thin fa-cannabis"></i>
                        </div>
                        <p class="industries-title">Cannabis / Weed / Marijuana</p>
                        <p class="industries-description">
                            Compliant products for wellness and needs
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a href="#" class="industries-card" data-wow-delay=".6s">
                        <div class="industries-icon google-blue">
                            <i class="fa fa-thin fa-heart"></i>
                        </div>
                        <p class="industries-title">Adult Toys</p>
                        <p class="industries-description">
                            Premium intimate products for wellness relationships
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a href="#" class="industries-card" data-wow-delay=".65s">
                        <div class="industries-icon google-red">
                            <i class="fa fa-thin fa-tooth"></i>
                        </div>
                        <p class="industries-title">Dental Practice / Dentistry</p>
                        <p class="industries-description">
                            Professional care for healthy strong teeth
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a href="#" class="industries-card" data-wow-delay=".7s">
                        <div class="industries-icon google-yellow">
                            <i class="fa fa-thin fa-credit-card"></i>
                        </div>
                        <p class="industries-title">
                            Credit cards / Payment gateways
                        </p>
                        <p class="industries-description">
                            Secure solutions with rewards and benefits
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a href="#" class="industries-card" data-wow-delay=".75s">
                        <div class="industries-icon google-green">
                            <i class="fa fa-thin fa-shield-halved"></i>
                        </div>
                        <p class="industries-title">Guns / Weapons</p>
                        <p class="industries-description">
                            Quality firearms for safety sport purposes
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a href="#" class="industries-card" data-wow-delay=".8s">
                        <div class="industries-icon google-blue">
                            <i class="fa fa-thin fa-car"></i>
                        </div>
                        <p class="industries-title">Car Rentals</p>
                        <p class="industries-description">
                            Convenient vehicle rentals for travel needs
                        </p>
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a href="#" class="industries-card" data-wow-delay=".85s">
                        <div class="industries-icon google-red">
                            <i class="fa fa-thin fa-wine-bottle"></i>
                        </div>
                        <p class="industries-title">Alcohol / Beverage</p>
                        <p class="industries-description">
                            Premium spirits for celebration and enjoyment
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="tj-about-section h8-about section-gap">
        <div class="container">
            <div class="row row-gap-4">
                <div class="col-12">
                    <div class="about-content-area-2 wow fadeInUp" data-wow-delay=".3s">
                        <div class="sec-heading style-3">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="h8-about-left">
                                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i
                                                class="tji-box"></i>Get to Know
                                            Us</span>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="h8-about-content-inner">
                                        <h2 class="sec-title title-highlight">
                                            Committed Delivering Our Measurable Result and in
                                            Building
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-4">
                                    <div class=" ">
                                        <img src="{{ asset('home_assets/images/about/h8-about.webp') }}"
                                            alt="" />
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="h8-about-item-wrapper">
                                        <div class="h8-about-item h8-about-item-counter">
                                            <div class="countup-item style-2">
                                                <div class="count-inner">
                                                    <div class="inline-content">
                                                        <span class="odometer countup-number" data-count="30"></span>
                                                        <sup class="count-plus">+</sup>
                                                    </div>
                                                    <span class="count-text">Years of Corporate Experience.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="h8-about-item h8-about-item-desc">
                                            <div class="h8-about-item-content">
                                                <p class="desc">
                                                    Our approach to customer experience comhensive
                                                    and data-driven. We begin assessing you
                                                    current customer touchpoints, identifying
                                                    areas for improvement, an using insights to
                                                    develop strategies in that meet your
                                                    customers’ evolving needs. From optimizing
                                                    digital platforms.
                                                </p>
                                                <p class="desc">
                                                    Our approach to customer experience comhensive
                                                    and data-driven. We begin assessing you
                                                    current customer touchpoints, identifying
                                                    areas for improvement, an using insights to
                                                    develop strategies in that meet your
                                                    customers’ evolving needs. From optimizing
                                                    digital platforms.
                                                </p>
                                                <div class="about-btn-area-2 wow fadeInUp" data-wow-delay="1s">
                                                    <a class="tj-primary-btn" href="about.html">
                                                        <span class="btn-text"><span>Learn More</span></span>
                                                        <span class="btn-icon"><i
                                                                class="tji-arrow-right-long"></i></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technologies Section -->
    <section class="tj-technologies-section bg-light section-gap">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8">
                    <div class="section-heading mb-50 text-center">
                        <span class="sub-title" data-wow-delay=".2s">
                            <i class="fa fa-code"></i> Tech Stack
                        </span>
                        <h2 class="section-title" data-wow-delay=".4s">
                            Technologies We Use
                        </h2>
                        <p class="section-desc" data-wow-delay=".6s">
                            We leverage cutting-edge technologies and frameworks to build scalable, performant, and
                            maintainable
                            solutions tailored to your business needs.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="tech-card wow fadeInUp" data-wow-delay=".2s">
                        <h4 class="tech-title">Frontend</h4>
                        <div class="tech-items">
                            <div class="tech-item">
                                <i class="fab fa-react"></i>
                                <span>React</span>
                            </div>
                            <div class="tech-item">
                                <i class="fab fa-vuejs"></i>
                                <span>Vue.js</span>
                            </div>
                            <div class="tech-item">
                                <i class="fab fa-js-square"></i>
                                <span>TypeScript</span>
                            </div>
                            <div class="tech-item">
                                <i class="fab fa-css3-alt"></i>
                                <span>Tailwind CSS</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="tech-card wow fadeInUp" data-wow-delay=".4s">
                        <h4 class="tech-title">Backend</h4>
                        <div class="tech-items">
                            <div class="tech-item">
                                <i class="fab fa-node-js"></i>
                                <span>Node.js</span>
                            </div>
                            <div class="tech-item">
                                <i class="fab fa-python"></i>
                                <span>Python</span>
                            </div>
                            <div class="tech-item">
                                <i class="fab fa-java"></i>
                                <span>Java</span>
                            </div>
                            <div class="tech-item">
                                <i class="fab fa-microsoft"></i>
                                <span>C#/.NET</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="tech-card wow fadeInUp" data-wow-delay=".6s">
                        <h4 class="tech-title">Databases</h4>
                        <div class="tech-items">
                            <div class="tech-item">
                                <i class="fa fa-database"></i>
                                <span>PostgreSQL</span>
                            </div>
                            <div class="tech-item">
                                <i class="fa fa-leaf"></i>
                                <span>MongoDB</span>
                            </div>
                            <div class="tech-item">
                                <i class="fa fa-server"></i>
                                <span>MySQL</span>
                            </div>
                            <div class="tech-item">
                                <i class="fa fa-fire"></i>
                                <span>Firebase</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="tech-card wow fadeInUp" data-wow-delay=".8s">
                        <h4 class="tech-title">DevOps</h4>
                        <div class="tech-items">
                            <div class="tech-item">
                                <i class="fa fa-cloud"></i>
                                <span>AWS</span>
                            </div>
                            <div class="tech-item">
                                <i class="fab fa-docker"></i>
                                <span>Docker</span>
                            </div>
                            <div class="tech-item">
                                <i class="fa fa-cubes"></i>
                                <span>Kubernetes</span>
                            </div>
                            <div class="tech-item">
                                <i class="fa fa-code-branch"></i>
                                <span>CI/CD</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="section-gap container">

        <!-- Header -->
        <div class="pt-header">
            <div class="pt-label">
                <span class="pt-dot pt-dot--blue"></span>
                <span class="pt-dot pt-dot--red"></span>
                <span class="pt-dot pt-dot--yellow"></span>
                <span class="pt-dot pt-dot--green"></span>
                Our Pricing
            </div>
            <h2 class="pt-title">What Is The Cost Of <span class="pt-title__accent">Best In Class</span> Services?
            </h2>
        </div>

        <!-- Table -->
        <div class="pt-table-wrapper">

            <!-- Head -->
            <div class="pt-table-head">
                <div class="pt-table-head__cell">Service</div>
                <div class="pt-table-head__cell pt-table-head__cell--center">Price / mo</div>
                <div class="pt-table-head__cell pt-table-head__cell--center">Category</div>
                <div class="pt-table-head__cell pt-table-head__cell--center">Action</div>
            </div>

            <!-- Row 1: SEO -->
            <div class="pt-row">
                <div class="pt-service">
                    <div class="pt-icon pt-icon--blue">
                        <i class="ti ti-search" aria-hidden="true"></i>
                    </div>
                    <div class="pt-service__info">
                        <div class="pt-service__name-row">
                            <span class="pt-service__name">SEO</span>
                        </div>
                        <div class="pt-service__sub">Search Engine Optimization</div>
                    </div>
                </div>
                <div class="pt-price">$250</div>
                <div class="pt-chip-cell"><span class="pt-chip pt-chip--blue">Search</span></div>
                <div class="pt-actions">
                    <button class="pt-btn-primary">Explore</button>
                    <button class="pt-btn-secondary">Contact</button>
                </div>
            </div>

            <!-- Row 2: PPC -->
            <div class="pt-row">
                <div class="pt-service">
                    <div class="pt-icon pt-icon--red">
                        <i class="ti ti-speakerphone" aria-hidden="true"></i>
                    </div>
                    <div class="pt-service__info">
                        <div class="pt-service__name-row">
                            <span class="pt-service__name">PPC</span>
                        </div>
                        <div class="pt-service__sub">Pay-Per-Click Advertising</div>
                    </div>
                </div>
                <div class="pt-price">$200</div>
                <div class="pt-chip-cell"><span class="pt-chip pt-chip--red">Ads</span></div>
                <div class="pt-actions">
                    <button class="pt-btn-primary">Explore</button>
                    <button class="pt-btn-secondary">Contact</button>
                </div>
            </div>

            <!-- Row 3: AI SEO (Popular) -->
            <div class="pt-row">
                <div class="pt-service">
                    <div class="pt-icon pt-icon--green">
                        <i class="ti ti-stack-2" aria-hidden="true"></i>
                    </div>
                    <div class="pt-service__info">
                        <div class="pt-service__name-row">
                            <span class="pt-service__name">AI SEO</span>
                            <span class="pt-badge-popular">Popular</span>
                        </div>
                        <div class="pt-service__sub">AI-Powered Optimization</div>
                    </div>
                </div>
                <div class="pt-price">$300</div>
                <div class="pt-chip-cell"><span class="pt-chip pt-chip--green">AI</span></div>
                <div class="pt-actions">
                    <button class="pt-btn-primary">Explore</button>
                    <button class="pt-btn-secondary">Contact</button>
                </div>
            </div>

            <!-- Row 4: Digital Marketing -->
            <div class="pt-row">
                <div class="pt-service">
                    <div class="pt-icon pt-icon--yellow">
                        <i class="ti ti-chart-line" aria-hidden="true"></i>
                    </div>
                    <div class="pt-service__info">
                        <div class="pt-service__name-row">
                            <span class="pt-service__name">Digital Marketing</span>
                        </div>
                        <div class="pt-service__sub">Full-Funnel Marketing</div>
                    </div>
                </div>
                <div class="pt-price">$350</div>
                <div class="pt-chip-cell"><span class="pt-chip pt-chip--yellow">Growth</span></div>
                <div class="pt-actions">
                    <button class="pt-btn-primary">Explore</button>
                    <button class="pt-btn-secondary">Contact</button>
                </div>
            </div>

            <!-- Row 5: Link Building -->
            <div class="pt-row">
                <div class="pt-service">
                    <div class="pt-icon pt-icon--blue">
                        <i class="ti ti-link" aria-hidden="true"></i>
                    </div>
                    <div class="pt-service__info">
                        <div class="pt-service__name-row">
                            <span class="pt-service__name">Link Building</span>
                        </div>
                        <div class="pt-service__sub">Authority &amp; Backlinks</div>
                    </div>
                </div>
                <div class="pt-price">$200</div>
                <div class="pt-chip-cell"><span class="pt-chip pt-chip--blue">Authority</span></div>
                <div class="pt-actions">
                    <button class="pt-btn-primary">Explore</button>
                    <button class="pt-btn-secondary">Contact</button>
                </div>
            </div>

            <!-- Row 6: Social Media -->
            <div class="pt-row">
                <div class="pt-service">
                    <div class="pt-icon pt-icon--green">
                        <i class="ti ti-world" aria-hidden="true"></i>
                    </div>
                    <div class="pt-service__info">
                        <div class="pt-service__name-row">
                            <span class="pt-service__name">Social Media</span>
                        </div>
                        <div class="pt-service__sub">Growth &amp; Engagement</div>
                    </div>
                </div>
                <div class="pt-price">$180</div>
                <div class="pt-chip-cell"><span class="pt-chip pt-chip--green">Social</span></div>
                <div class="pt-actions">
                    <button class="pt-btn-primary">Explore</button>
                    <button class="pt-btn-secondary">Contact</button>
                </div>
            </div>

        </div>
    </section>




    <section class="h9-testimonial bg-white section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 order-2 order-lg-1">
                    <div class="h9-testimonial-wrap">
                        <div class="testimonial-item wow fadeInUpBig" data-wow-delay=".2s">
                            <div class="star-ratings">
                                <div class="fill-ratings" style="width: 100%">
                                    <span>★★★★★</span>
                                </div>
                                <div class="empty-ratings">
                                    <span>★★★★★</span>
                                </div>
                            </div>
                            <div class="desc">
                                <p>
                                    “Working with Bexon has been a game-changer business.
                                    Their team's profession alism, attention to detail,
                                    and innovative solutions have help streamline
                                    operations our goals faster than imagined. We truly
                                    feel like a valued partner.”
                                </p>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-inner">
                                    <div class="author-header">
                                        <h5 class="title">Nathaniel Ellington</h5>
                                        <span class="designation">Chief Executive</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-item style-2 wow fadeInUpBig" data-wow-delay=".4s">
                            <div class="star-ratings">
                                <div class="fill-ratings" style="width: 100%">
                                    <span>★★★★★</span>
                                </div>
                                <div class="empty-ratings">
                                    <span>★★★★★</span>
                                </div>
                            </div>
                            <div class="desc">
                                <p>
                                    “Working with Bexon has been a game-changer business.
                                    Their team's profession alism, attention to detail,
                                    and innovative solutions have help streamline
                                    operations our goals faster than imagined. We truly
                                    feel like a valued partner.”
                                </p>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-inner">
                                    <div class="author-header">
                                        <h5 class="title">Nathaniel Ellington</h5>
                                        <span class="designation">Chief Executive</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-1 order-lg-2">
                    <div class="h9-testimonial-heading">
                        <div class="sec-heading style-8">
                            <span class="sub-title wow fadeInUp" data-wow-delay=".3s">Clients Testimonials</span>
                            <h2 class="sec-title  ">Our Trusted Clients.</h2>
                        </div>
                        <div class="testimonial-img wow fadeInUpBig" data-wow-delay=".3s">

                            <video autoplay loop muted playsinline class="testimonial-video">

                                <source src="{{ asset('home_assets/video/testimonial.mp4') }}" type="video/mp4">

                                <track src="{{ asset('home_assets/video/testimonial.vtt') }}" kind="captions"
                                    srclang="en" label="English">

                            </video>

                        </div>

                        <div class="shape-icon wow fadeIn" data-wow-delay=".5s">
                            <img src="{{ asset('home_assets/images/shape/big-icon.png') }}" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-3 order-lg-3">
                    <div class="h9-testimonial-wrap style-2">
                        <div class="testimonial-item style-2 wow fadeInUpBig" data-wow-delay=".2s">
                            <div class="star-ratings">
                                <div class="fill-ratings" style="width: 100%">
                                    <span>★★★★★</span>
                                </div>
                                <div class="empty-ratings">
                                    <span>★★★★★</span>
                                </div>
                            </div>
                            <div class="desc">
                                <p>
                                    “Working with Bexon has been a game-changer business.
                                    Their team's profession alism, attention to detail,
                                    and innovative solutions have help streamline
                                    operations our goals faster than imagined. We truly
                                    feel like a valued partner.”
                                </p>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-inner">
                                    <div class="author-header">
                                        <h5 class="title">Nathaniel Ellington</h5>
                                        <span class="designation">Chief Executive</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-item wow fadeInUpBig" data-wow-delay=".4s">
                            <div class="star-ratings">
                                <div class="fill-ratings" style="width: 100%">
                                    <span>★★★★★</span>
                                </div>
                                <div class="empty-ratings">
                                    <span>★★★★★</span>
                                </div>
                            </div>
                            <div class="desc">
                                <p>
                                    “Working with Bexon has been a game-changer business.
                                    Their team's profession alism, attention to detail,
                                    and innovative solutions have help streamline
                                    operations our goals faster than imagined. We truly
                                    feel like a valued partner.”
                                </p>
                            </div>
                            <div class="testimonial-author">
                                <div class="author-inner">
                                    <div class="author-header">
                                        <h5 class="title">Nathaniel Ellington</h5>
                                        <span class="designation">Chief Executive</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tj-about-section h6-about section-gap section-gap-x">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="about-content-area h6-about-content style-1 wow fadeInLeft" data-wow-delay=".2s">
                        <div class="sec-heading style-2 style-6">
                            <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i>OUR
                                COMPANY</span>
                            <h2 class="sec-title  ">
                                Innovating Today for Build Smarter, Stronger, and More
                                Successful.
                            </h2>
                            <p class="desc mb-1">
                                Our approach to development is comprehensive and
                                results-driven. We begin by assessing your current systems
                                and identifying areas for improvement, and
                                using insights to develop scalable solutions.
                            </p>

                            <p class="desc mb-1">
                                Lorem ipsum dolor sit. amet consectetur adipisicing elit. Voluptas, voluptate
                            </p>
                            <br>
                            <p class="desc mb-1">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore odit maxime excepturi
                                ratione illum labore, asperiores fuga nulla adipisci non dolor nam soluta magni ea!
                                Atque eligendi, fugit aliquam voluptatum numquam, facilis quidem unde et ratione
                                explicabo nemo nesciunt ipsum, voluptatibus delectus porro quisquam. Sed, fugit omnis
                                esse, in velit consequatur illum animi, deleniti itaque dignissimos exercitationem. Modi
                                laudantium velit autem odit temporibus? Eum vitae provident neque vel delectus eos? Cum
                                perferendis ducimus dolor qui doloribus! Impedit cum temporibus odit, quis reprehenderit
                                laudantium quidem dignissimos tempora magni ducimus. Sed quaerat assumenda quas
                                excepturi tenetur ducimus ipsum, asperiores voluptatum? Aperiam?</p>
                        </div>
                        <div class="h6-about-funfact-wrapper">
                            <div class="h6-about-funfact-shape">
                                <img src="{{ asset('home_assets/images/shape/about-counter-shape-blur.svg') }}"
                                    alt="" />
                            </div>
                        </div>

                        <div class="btn-area wow fadeInUp" data-wow-delay=".8s">
                            <a class="tj-primary-btn" href="contact.html">
                                <span class="btn-text"><span>Know More Us</span></span>
                                <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="about-img-area h6-about-img wow fadeInLeft" data-wow-delay=".2s">
                        <div class="about-img overflow-hidden wow fadeInRight" data-wow-delay=".8s">
                            <img data-speed=".8" src="{{ asset('home_assets/images/about/h6-about-banner.webp') }}"
                                alt="" />
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
        <div class="bg-shape-3">
            <img src="{{ asset('home_assets/images/shape/shape-blur.svg') }}" alt="" />
        </div>
    </section>

    <section class="tj-project-section section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading-wrap">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i>Proud
                            Projects</span>
                        <div class="heading-wrap-content">
                            <div class="sec-heading">
                                <h2 class="sec-title  ">
                                    Breaking Boundaries, Building <span>Dreams.</span>
                                </h2>
                            </div>
                            <p class="desc wow fadeInUp" data-wow-delay=".5s">
                                We work closely with our clients to understand their
                                unique needs and craft tailored solutions that address
                                challenges.
                            </p>
                            <div class="btn-wrap wow fadeInUp" data-wow-delay=".6s">
                                <a class="tj-primary-btn" href="portfolio.html">
                                    <span class="btn-text"><span>More Projects</span></span>
                                    <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="project-area tj-arrange-container">
                        <div class="project-item tj-arrange-item">
                            <div class="project-img">

                                <video width="100%" autoplay loop muted playsinline>

                                    <source src="{{ asset('home_assets/video/wide-1.mp4') }}" type="video/mp4">

                                    <track src="{{ asset('home_assets/video/wide-1.vtt') }}" kind="captions"
                                        srclang="en" label="English">

                                </video>

                            </div>
                            <div class="project-content">
                                <span class="categories"><a href="portfolio-details.html">Connect</a></span>
                                <div class="project-text">
                                    <h4 class="title">
                                        <a href="portfolio-details.html">Event Management Platform</a>
                                    </h4>
                                    <a class="project-btn" href="portfolio-details.html">
                                        <i class="tji-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="project-item tj-arrange-item">
                            <div class="project-img">

                                <video width="100%" autoplay loop muted playsinline>

                                    <source src="{{ asset('home_assets/video/download.mp4') }}" type="video/mp4">

                                    <track src="{{ asset('home_assets/video/download.vtt') }}" kind="captions"
                                        srclang="en" label="English">

                                </video>

                            </div>
                            <div class="project-content">
                                <span class="categories"><a href="portfolio-details.html">Empower</a></span>
                                <div class="project-text">
                                    <h4 class="title">
                                        <a href="portfolio-details.html">Enterprise Web Portal Development</a>
                                    </h4>
                                    <a class="project-btn" href="portfolio-details.html">
                                        <i class="tji-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="project-item tj-arrange-item">
                            <div class="project-img">

                                <video width="100%" autoplay loop muted playsinline>

                                    <source src="{{ asset('home_assets/video/mobile-2.mp4') }}" type="video/mp4">

                                    <track src="{{ asset('home_assets/video/mobile-2.vtt') }}" kind="captions"
                                        srclang="en" label="English">

                                </video>

                            </div>
                            <div class="project-content">
                                <span class="categories"><a href="portfolio-details.html">Support</a></span>
                                <div class="project-text">
                                    <h4 class="title">
                                        <a href="portfolio-details.html">Interactive Learning Platform</a>
                                    </h4>
                                    <a class="project-btn" href="portfolio-details.html">
                                        <i class="tji-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="project-item tj-arrange-item">
                            <div class="project-img">

                                <video width="100%" autoplay loop muted playsinline>

                                    <source src="{{ asset('home_assets/video/wide-2.mp4') }}" type="video/mp4">

                                    <track src="{{ asset('home_assets/video/wide-2.vtt') }}" kind="captions"
                                        srclang="en" label="English">

                                </video>

                            </div>
                            <div class="project-content">
                                <span class="categories"><a href="portfolio-details.html">Business</a></span>
                                <div class="project-text">
                                    <h4 class="title">
                                        <a href="portfolio-details.html">Environmental Impact Dashboard</a>
                                    </h4>
                                    <a class="project-btn" href="portfolio-details.html">
                                        <i class="tji-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tj-service-section service-3 section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-heading style-3 text-center max-width-800px">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i>Powered
                            By</span>
                        <h2 class="sec-title  ">
                            The World’s Most Advanced Agency Software
                        </h2>
                        <p class="desc wow fadeInUp" data-wow-delay=".5s">
                            Unify Wizards has become a top-rated development company by building advanced software and
                            leveraging cutting-edge technologies to drive your business forward:
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="service-wrapper">
                        <div class="service-item style-3 wow fadeInUp" data-wow-delay=".3s">
                            <div class="service-content-wrap">
                                <div class="service-title">
                                    <div class="service-icon">
                                        <i class="tji-service-1"></i>
                                    </div>
                                    <h4 class="title">
                                        <a href="service-details.html">Integrations with every best-in-class 3rd party
                                            marketing
                                            software.</a>
                                    </h4>
                                </div>
                                <div class="service-content">
                                    <p class="desc">
                                        (Google Analytics, Semrush, Search Console, WebCEO, Screaming Frog, Google Ads,
                                        and many
                                        more.) (Google Analytics, Semrush, Search Console, WebCEO, Screaming Frog,
                                        Google Ads, and many
                                        more.)
                                    </p>
                                </div>
                            </div>
                            <div class="service-reveal-bg"
                                data-bg-image="{{ asset('home_assets/images/service/service-1.webp') }}">
                            </div>
                        </div>
                        <div class="service-item style-3 wow fadeInUp" data-wow-delay=".3s">
                            <div class="service-content-wrap">
                                <div class="service-title">
                                    <div class="service-icon">
                                        <i class="tji-service-2"></i>
                                    </div>
                                    <h4 class="title">
                                        <a href="service-details.html">Recruiting tools </a>
                                    </h4>
                                </div>
                                <div class="service-content">
                                    <p class="desc">
                                        that allow us to hire only the top 1% of applicants through automated skills
                                        testing
                                        processes, structured scoring and ranking methodologies. through automated
                                        skills testing
                                        processes, structured scoring and ranking methodologies.
                                    </p>
                                </div>
                            </div>
                            <div class="service-reveal-bg"
                                data-bg-image="{{ asset('home_assets/images/service/service-5.webp') }}">
                            </div>
                        </div>
                        <div class="service-item style-3 wow fadeInUp" data-wow-delay=".3s">
                            <div class="service-content-wrap">
                                <div class="service-title">
                                    <div class="service-icon">
                                        <i class="tji-service-3"></i>
                                    </div>
                                    <h4 class="title">
                                        <a href="service-details.html">Checklists and processes</a>
                                    </h4>
                                </div>
                                <div class="service-content">
                                    <p class="desc">
                                        for every service line to ensure that amazing ideas one employee learns for one
                                        client can be
                                        put in place for all clients. that amazing ideas one employee learns for one
                                        client can be
                                        put in place for all clients.
                                    </p>
                                </div>
                            </div>
                            <div class="service-reveal-bg"
                                data-bg-image="{{ asset('home_assets/images/service/service-7.webp') }}">
                            </div>
                        </div>
                        <div class="service-item style-3 wow fadeInUp" data-wow-delay=".3s">
                            <div class="service-content-wrap">
                                <div class="service-title">
                                    <div class="service-icon">
                                        <i class="tji-service-4"></i>
                                    </div>
                                    <h4 class="title">
                                        <a href="service-details.html">185+ Advanced university-level</a>
                                    </h4>
                                </div>
                                <div class="service-content">
                                    <p class="desc">
                                        web development and software engineering courses to train our team in
                                        cutting-edge techniques
                                        and standards. courses to train our team in cutting-edge techniques
                                        and standards.
                                    </p>
                                </div>
                            </div>
                            <div class="service-reveal-bg"
                                data-bg-image="{{ asset('home_assets/images/service/service-6.webp') }}">
                            </div>
                        </div>
                    </div>
                    <div class="service-btn-area text-center wow fadeInUp" data-wow-delay=".3s">
                        <a class="tj-primary-btn" href="service.html">
                            <span class="btn-text"><span>More Services</span></span>
                            <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wsi__section">
        <div class="container">
            <!-- Background blobs -->
            <div class="wsi__blob wsi__blob--1"></div>
            <div class="wsi__blob wsi__blob--2"></div>
            <div class="wsi__blob wsi__blob--3"></div>

            <div class="wsi__center">
                <div class="wsi__chip">
                    <div class="wsi__chip-dot"></div>
                    Who Should Invest
                </div>

                <h2 class="wsi__title">
                    Who Should Invest In<br>
                    <span class="wsi__g">W</span><span class="wsi__r">e</span><span class="wsi__y">b</span>
                    Development Services?
                </h2>

                <p class="wsi__intro">
                    Every business needs quality software, but most small and medium-sized business owners do not
                    have the in-house technical expertise, time, or resources to build it. Development decisions are
                    often
                    made
                    in isolation, without any strategic thinking, which leads to several initiatives failing.
                </p>

                <p class="wsi__sub-label">5 quick questions to ask yourself:</p>
            </div>

            <!-- Question Cards -->
            <div class="wsi__cards-grid">
                <div class="wsi__q-card wsi__q-card--blue">
                    <div class="wsi__q-icon wsi__q-icon--blue">🧭</div>
                    <p class="wsi__q-text">Do you need a scalable web or mobile application to support your business?
                    </p>
                </div>
                <div class="wsi__q-card wsi__q-card--red">
                    <div class="wsi__q-icon wsi__q-icon--red">🎯</div>
                    <p class="wsi__q-text">Are you looking to upgrade or modernize your existing technology stack?</p>
                </div>
                <div class="wsi__q-card wsi__q-card--yellow">
                    <div class="wsi__q-icon wsi__q-icon--yellow">✨</div>
                    <p class="wsi__q-text">Do you need robust cloud infrastructure, DevOps, or system optimization?
                    </p>
                </div>
                <div class="wsi__q-card wsi__q-card--green">
                    <div class="wsi__q-icon wsi__q-icon--green">📋</div>
                    <p class="wsi__q-text">Are you seeking to integrate third-party APIs or build custom solutions?
                    </p>
                </div>
                <div class="wsi__q-card wsi__q-card--blue">
                    <div class="wsi__q-icon wsi__q-icon--blue">📊</div>
                    <p class="wsi__q-text">Do you need ongoing technical support, maintenance, and security updates?
                    </p>
                </div>
            </div>

            <!-- Divider -->
            <div class="wsi__divider-row">
                <div class="wsi__divider-line"></div>
                <span class="wsi__divider-label">If you answered "no" to any of the above</span>
                <div class="wsi__divider-line"></div>
            </div>

            <!-- Bottom Info Cards -->
            <div class="wsi__bottom-grid">
                <div class="wsi__info-card">
                    <div class="wsi__info-accent wsi__info-accent--green"></div>
                    <div class="wsi__info-body">
                        <strong class="wsi__info-title">Clear Goals &amp; Action</strong>
                        <p class="wsi__info-text">
                            Ensuring your business's success involves having clear goals and targets, and then
                            implementing practical steps to reach them. Strategy and planning keep you focused
                            and on track.
                        </p>
                    </div>
                </div>
                <div class="wsi__info-card">
                    <div class="wsi__info-accent wsi__info-accent--blue"></div>
                    <div class="wsi__info-body">
                        <strong class="wsi__info-title">Stay Competitive</strong>
                        <p class="wsi__info-text">
                            Having a strategy and plan allows you to respond to virtually anything that occurs
                            within your business, and you'll never miss another opportunity to compete effectively.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="wsi__cta-row">
                <a href="#" class="wsi__cta-btn">
                    Learn More
                    <span class="wsi__cta-arrow">↗</span>
                </a>
            </div>
        </div>
    </section>


    <!-- start: Why Choose Us Section -->
    <section id="choose" class="uw-choose-section section-gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center mb-4">
                    <h2 class="sec-title mb-2">Why Choose Unify Wizards As Your Development Partner?</h2>
                    <div class="uw-choose-subtitle mb-2">Build Scalable Solutions & Accelerate Your Digital
                        Transformation
                    </div>
                    <p class="uw-choose-intro mb-4">Unify Wizards is a results-driven digital agency focused on
                        maximizing
                        your brand’s online impact. We combine data, creativity, and human expertise to deliver
                        measurable
                        results—without locking you into long-term contracts. Here’s what sets us apart:</p>
                </div>
            </div>
            <div class="row uw-choose-cards g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="uw-choose-card uw-blue">
                        <div class="uw-choose-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M3 17v2a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-2" />
                                <polyline points="8 17 8 11 12 7 16 11 16 17" />
                            </svg>
                        </div>
                        <h5>Technical Excellence</h5>
                        <p>We use proven development methodologies and architecture patterns to build scalable,
                            maintainable
                            solutions that grow with your business.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="uw-choose-card uw-red">
                        <div class="uw-choose-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="7" r="4" />
                                <path d="M5.5 21h13l-2.5-7h-8z" />
                            </svg>
                        </div>
                        <h5>Expert Development Team</h5>
                        <p>Our team brings extensive experience across multiple programming languages, frameworks, and
                            cloud
                            platforms to deliver best-in-class solutions.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="uw-choose-card uw-yellow">
                        <div class="uw-choose-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M4 12v-2a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v2" />
                                <path d="M2 16l4 4 4-4" />
                                <path d="M22 16l-4 4-4-4" />
                            </svg>
                        </div>
                        <h5>No Long-Term Contracts</h5>
                        <p>We earn your business every month with flexible, high-impact services—no restrictive
                            commitments
                            required.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="uw-choose-card uw-green">
                        <div class="uw-choose-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M12 2a7 7 0 0 0-7 7v2a7 7 0 0 0 7 7 7 7 0 0 0 7-7V9a7 7 0 0 0-7-7z" />
                                <path d="M9 12h6" />
                                <path d="M12 9v6" />
                            </svg>
                        </div>
                        <h5>Modern Architecture & Scalability</h5>
                        <p>We design systems with scalability in mind, using cloud-native approaches and microservices
                            to
                            handle growth without disruption.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="uw-choose-card uw-google-green">
                        <div class="uw-choose-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <ellipse cx="12" cy="12" rx="10" ry="4" />
                                <path d="M2 12a10 10 0 0 0 20 0" />
                            </svg>
                        </div>
                        <h5>Industry-Leading Security</h5>
                        <p>We follow security best practices and implement comprehensive safeguards to protect your data
                            and
                            applications from threats.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="uw-choose-card uw-google-orange">
                        <div class="uw-choose-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M20.59 13.41L11 3.83V2h-2v2.83l-9.59 9.58a2 2 0 0 0 0 2.83l7.59 7.59a2 2 0 0 0 2.83 0l9.59-9.59a2 2 0 0 0 0-2.83z" />
                                <circle cx="7.5" cy="7.5" r="1.5" />
                            </svg>
                        </div>
                        <h5>Transparent, Fair Pricing</h5>
                        <p>Get premium development services with clear project timelines—no hidden fees, just honest
                            pricing
                            that delivers real value.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Why Choose Us Section -->



    <section class="h5-working-process section-gap section-gap-x ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sec-heading sec-heading-centered style-3">
                        <span class="sub-title wow fadeInUp" data-wow-delay=".3s"><i class="tji-box"></i> OUR
                            PROCESS</span>
                        <h2 class="sec-title text-anim  text-white">Seamless Process and
                            Great Results.</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="h5-working-process-inner">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="working-process-area h5-working-process-wrapper">
                            <div class="process-item h5-working-process-item wow bounceInUp" data-wow-delay=".3s">
                                <h5 class="h5-working-process-indicator">Step 01</h5>
                                <div class="process-step">
                                    <span>01</span>
                                </div>
                                <div class="process-content">
                                    <h4 class="title">Discovery & Planning</h4>
                                    <p class="desc">The first step in our process is understanding your unique
                                        business needs,
                                        objectives,
                                        and our cutomes challenges.</p>
                                </div>
                            </div>
                            <div class="process-item h5-working-process-item wow bounceInUp" data-wow-delay=".4s">
                                <h5 class="h5-working-process-indicator">Step 02</h5>
                                <div class="process-step">
                                    <span>02</span>
                                </div>
                                <div class="process-content">
                                    <h4 class="title">Execution & Delivery</h4>
                                    <p class="desc">Once the plan is in place, our team moves forward with
                                        execution, turning
                                        strategies
                                        into actiony to deliver.</p>
                                </div>
                            </div>
                            <div class="process-item h5-working-process-item wow bounceInUp" data-wow-delay=".5s">
                                <h5 class="h5-working-process-indicator">Step 03</h5>
                                <div class="process-step">
                                    <span>03</span>
                                </div>
                                <div class="process-content">
                                    <h4 class="title">Review & Support</h4>
                                    <p class="desc">After project completion, we conduct a thorough review to ensure
                                        everything
                                        aligns
                                        with your goals and requirements.</p>
                                </div>
                            </div>
                            <div class="process-item h5-working-process-item wow bounceInUp" data-wow-delay=".5s">
                                <h5 class="h5-working-process-indicator">Step 04</h5>
                                <div class="process-step">
                                    <span>04</span>
                                </div>
                                <div class="process-content">
                                    <h4 class="title">Review & Support</h4>
                                    <p class="desc">After project completion, we conduct a thorough review to ensure
                                        everything
                                        aligns
                                        with your goals and requirements.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-shape-1">
            <img src="{{ asset('home_assets/images/shape/pattern-2.svg') }}" alt="">
        </div>
        <div class="bg-shape-2">
            <img src="{{ asset('home_assets/images/shape/pattern-3.svg') }}" alt="">
        </div>
        <div class="bg-shape-3">
            <img src="{{ asset('home_assets/images/shape/shape-blur.svg') }}" alt="">
        </div>
        <div class="bg-shape-4">
            <img src="{{ asset('home_assets/images/shape/shape-blur.svg') }}" alt="">
        </div>
        <div class="bg-shape-4">
            <img src="{{ asset('home_assets/images/shape/shape-blur.svg') }}" alt="">
        </div>
        <div class="bg-shape-4">
            <img src="{{ asset('home_assets/images/shape/shape-blur.svg') }}" alt="">
        </div>
        <div class="bg-shape-4">
            <img src="{{ asset('home_assets/images/shape/shape-blur.svg') }}" alt="">
        </div>
    </section>



    <div class="atm-wrap container">
        <span class="atm-dot"></span>
        <h1 class="atm-main-title">The Wizards Spell</h1>
        <p class="atm-sub-text">
            The Wizards Spell is how we turn your vision into scalable software solutions. It's a proven development
            process
            that blends strategic planning, technical excellence, and continuous optimization, ensuring every line of
            code is
            intentional, robust, and built for long-term success.
        </p>
        <button class="atm-learn-btn">Learn About Us</button>

        <div class="atm-cards-row " id="atm-deck">

            <!-- Discover — Google Blue -->
            <div class="atm-card atm-card-0">
                <div class="atm-card-label">Discover</div>
                <div class="atm-icon-wrap">
                    <svg width="52" height="52" viewBox="0 0 52 52" fill="none">
                        <rect x="6" y="6" width="18" height="18" rx="3" stroke="#1a73e8"
                            stroke-width="2.5" fill="none" />
                        <rect x="28" y="6" width="18" height="18" rx="3" stroke="#1a73e8"
                            stroke-width="2.5" fill="none" />
                        <rect x="6" y="28" width="18" height="18" rx="3" stroke="#1a73e8"
                            stroke-width="2.5" fill="none" />
                        <rect x="28" y="28" width="18" height="18" rx="3" stroke="#1a73e8"
                            stroke-width="2.5" fill="none" />
                    </svg>
                </div>
                <p class="atm-card-desc">The best brands improve, not settle. We review, plan, and refine your digital
                    strategies. This transforms data into opportunities, prevents revenue loss, and promotes faster,
                    lasting
                    growth.</p>
            </div>

            <!-- Create — Google Red -->
            <div class="atm-card atm-card-1">
                <div class="atm-card-label">Create</div>
                <div class="atm-icon-wrap">
                    <svg width="52" height="52" viewBox="0 0 52 52" fill="none">
                        <path d="M36 10 L42 16 L18 40 L10 42 L12 34 Z" stroke="#fff" stroke-width="2.5"
                            stroke-linejoin="round" fill="none" />
                        <line x1="30" y1="16" x2="36" y2="22" stroke="#fff"
                            stroke-width="2.5" />
                    </svg>
                </div>
                <p class="atm-card-desc">With clear direction, we design robust architecture and write clean code.
                    From
                    planning to deployment, every component is built for scalability and excellence.</p>
            </div>

            <!-- Grow — Google Yellow -->
            <div class="atm-card atm-card-2">
                <div class="atm-card-label">Grow</div>
                <div class="atm-icon-wrap">
                    <svg width="52" height="52" viewBox="0 0 52 52" fill="none">
                        <rect x="8" y="8" width="36" height="36" rx="6" stroke="#7c5003"
                            stroke-width="2.5" fill="none" />
                        <polyline points="16,30 22,20 30,26 38,14" stroke="#7c5003" stroke-width="2.5"
                            stroke-linejoin="round" fill="none" />
                        <polyline points="34,14 38,14 38,18" stroke="#7c5003" stroke-width="2.5"
                            fill="none" />
                    </svg>
                </div>
                <p class="atm-card-desc">We launch projects carefully and adjust in real time to improve results. By
                    increasing reach, raising engagement, and driving conversions, we provide clear outcomes and a
                    lasting
                    effect for your brand.</p>
            </div>

            <!-- Optimise — Google Green -->
            <div class="atm-card atm-card-3">
                <div class="atm-card-label">Optimise</div>
                <div class="atm-icon-wrap">
                    <svg width="52" height="52" viewBox="0 0 52 52" fill="none">
                        <polyline points="8,40 14,28 20,34 28,20 36,28 44,12" stroke="#fff" stroke-width="2.5"
                            stroke-linejoin="round" fill="none" />
                        <line x1="10" y1="44" x2="10" y2="38" stroke="#fff"
                            stroke-width="2" stroke-linecap="round" />
                        <line x1="18" y1="44" x2="18" y2="34" stroke="#fff"
                            stroke-width="2" stroke-linecap="round" />
                        <line x1="26" y1="44" x2="26" y2="28" stroke="#fff"
                            stroke-width="2" stroke-linecap="round" />
                        <line x1="34" y1="44" x2="34" y2="22" stroke="#fff"
                            stroke-width="2" stroke-linecap="round" />
                        <line x1="42" y1="44" x2="42" y2="16" stroke="#fff"
                            stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <p class="atm-card-desc">Great performance is just the beginning. We analyse every metric, identify
                    new
                    opportunities, and fine-tune our approach so your brand stays ahead — not just today, but in the
                    months
                    and years to come.</p>
            </div>

        </div>
    </div>





    <section class="tj-cta-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-area">
                        <div class="cta-content">
                            <h2 class="title  ">
                                Let’s Build Future Together.
                            </h2>
                            <div class="cta-btn wow fadeInUp" data-wow-delay=".6s">
                                <a class="tj-primary-btn btn-dark" href="contact.html">
                                    <span class="btn-text"><span>Get Started Now</span></span>
                                    <span class="btn-icon"><i class="tji-arrow-right-long"></i></span>
                                </a>
                            </div>
                        </div>
                        <div class="cta-img">
                            <img src="{{ asset('home_assets/images/cta/cta-bg.webp') }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const deck = document.getElementById('atm-deck');
        const cards = deck.querySelectorAll('.atm-card');

        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                deck.classList.add('atm-hovered');
                card.classList.add('atm-focused');
            });
            card.addEventListener('mouseleave', () => {
                deck.classList.remove('atm-hovered');
                card.classList.remove('atm-focused');
            });
        });
    </script>
</x-layouts.app>
