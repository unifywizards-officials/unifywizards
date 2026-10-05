<section class="tj-contact-section section-gap section-gap-x">

    <div class="container">

        <div class="row align-items-stretch g-0">

            {{-- LEFT SIDE --}}
            <div class="col-lg-6">

                <div class="global-map wow fadeInUp"
                    data-wow-delay=".3s"
                    style="
                        position:relative;
                        overflow:hidden;
                        min-height:520px;
                        width:100%;
                        padding:0;
                        margin:0;
                        box-sizing:border-box;
                    ">

                    {{-- MAP BACKGROUND --}}
                    <div class="global-map-img"
                        style="
                            position:absolute;
                            inset:0;
                            opacity:0.5;
                            z-index:1;
                            margin:0;
                            padding:0;
                        ">

                        <img src="{{ asset('home_assets/images/bg/map.svg') }}"
                            alt="Satisfied Customers Around The World"
                            style="
                                width:100%;
                                height:100%;
                                object-fit:cover;
                                display:block;
                            ">

                    </div>


                    {{-- LEFT CONTENT --}}
                    <div class="customers-content"
                        style="
                            position:absolute;
                            top:50%;
                            left:0;
                            right:0;
                            transform:translateY(-50%);
                            z-index:2;
                            width:100%;
                            max-width:100%;
                            box-sizing:border-box;
                            text-align:center;
                            padding:0 70px;
                            margin:0 auto;
                        ">

                        <h2 style="
                            color:#fff;
                            font-size:30px;
                            font-weight:700;
                            line-height:1.3;
                            margin:0 auto 16px;
                            max-width:400px;
                        ">
                            Trusted By Businesses Worldwide
                        </h2>


                        <p style="
                            color:#c9cfe6;
                            font-size:15px;
                            line-height:1.6;
                            margin:0 auto 30px;
                            max-width:400px;
                        ">
                        Unify Wizards Has Delighted Customers in 20+ Countries Worldwide
                        </p>


                        {{-- COUNTRIES --}}
                        <div style="
                            text-align:center;
                            margin:0 auto;
                        ">

                            <hr style="
                                width:50px;
                                border:0;
                                border-top:1px solid #6c76a8;
                                margin:0 auto 14px;
                            ">


                            <p style="
                                color:#c9cfe6;
                                font-size:13px;
                                letter-spacing:1px;
                                text-transform:uppercase;
                                margin:0 0 6px;
                            ">
                               We’ve Served Clients In Over
                            </p>


                            <div style="
                                color:#4ea1ff;
                                font-size:48px;
                                font-weight:800;
                                line-height:1;
                                margin:0;
                            ">
                                20+
                            </div>


                            <p style="
                                color:#c9cfe6;
                                font-size:13px;
                                letter-spacing:1px;
                                text-transform:uppercase;
                                margin:7px 0 0;
                            ">
                                Countries
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- RIGHT SIDE --}}
            <div class="col-lg-6">

                <div class="contact-form style-2 wow fadeInUp"
                    data-wow-delay=".4s"
                    style="
                        min-height:520px;
                        box-sizing:border-box;
                    ">

                    <div class="sec-heading">

                        <span class="sub-title text-white google-text">

                            <i class="tji-box google-text"></i>

                            Get in Touch

                        </span>


                        <h3 class="sec-title title-anim">
                            Share your details so we can start
                            your digital marketing journey.
                        </h3>

                    </div>


                    <form id="contact-form-2"
                        method="POST"
                        action="{{ route('contact.inquiry.store') }}">

                        @csrf

                        <div class="row wow fadeInUp"
                            data-wow-delay=".5s">

                            {{-- FULL NAME --}}
                            <div class="col-sm-6">

                                <div class="form-input">

                                    <input type="text"
                                        name="full_name"
                                        placeholder="Full Name *"
                                        required>

                                </div>

                            </div>


                            {{-- EMAIL --}}
                            <div class="col-sm-6">

                                <div class="form-input">

                                    <input type="email"
                                        name="email"
                                        placeholder="Email Address *"
                                        required>

                                </div>

                            </div>


                            {{-- PHONE --}}
                            <div class="col-sm-6">

                                <div class="form-input">

                                    <input type="tel"
                                        name="phone"
                                        placeholder="Phone Number *"
                                        required>

                                </div>

                            </div>


                            {{-- SUBJECT --}}
                            <div class="col-sm-6">

                                <div class="form-input">

                                    <div class="tj-nice-select-box">

                                        <div class="tj-select">

                                            <select name="subject">

                                                <option value="">
                                                    Choose an option
                                                </option>

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

                            </div>


                            {{-- MESSAGE --}}
                            <div class="col-sm-12">

                                <div class="form-input message-input">

                                    <textarea name="message"
                                        placeholder="Describe your Project *"
                                        required></textarea>

                                </div>

                            </div>


                            {{-- SUBMIT --}}
                            <div class="submit-btn">

                                <button class="tj-primary-btn"
                                    type="submit"
                                    id="contactSubmitBtn">

                                    <span class="btn-text">

                                        <span>
                                            Send Message
                                        </span>

                                    </span>

                                    <span class="btn-icon">

                                        <i class="tji-arrow-right-long"></i>

                                    </span>

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- SWEET ALERT --}}
<script src="{{ asset('home_assets/js/getintouch.js') }}"></script>