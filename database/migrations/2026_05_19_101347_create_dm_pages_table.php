<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dm_pages', function (Blueprint $table) {
            $table->id();

            // ── Page Meta ──────────────────────────────────────────────────────
            $table->string('service_type');
            // Values: digital_marketing | paid_advertising | online_marketing | case_studies

            $table->string('page_name');
            // e.g. "Digital Marketing"

            $table->string('slug')->unique();
            // e.g. "digital-marketing" — menu URL me use hoga

            $table->boolean('is_active')->default(true);

            // ══════════════════════════════════════════════════════════════════
            // SECTION 1 — Get To Know Us (Banner)
            // Single fields + logos[] repeatable array
            // ══════════════════════════════════════════════════════════════════
            $table->json('s1_banner')->nullable();
            /*
            {
                "sub_title":    "Get to Know Us",
                "banner_title": "Driving Excellence Through Evolution & Trust.",
                "description":  "Optimize your website...",
                "button_text":  "Learn More",
                "button_url":   "/contact",
                "phone_number": "1-888-452-1505",
                "logos": [
                    { "image_path": "dm-pages/s1/logo1.webp" },
                    { "image_path": "dm-pages/s1/logo2.webp" }
                ]
            }
            */

            // ══════════════════════════════════════════════════════════════════
            // SECTION 2 — Top Digital Marketing Services
            // Single heading/name/desc + items[] repeatable
            // ══════════════════════════════════════════════════════════════════
            $table->json('s2_top_services')->nullable();
            /*
            {
                "heading":     "Top Digital Marketing Services at Unify Wizards",
                "name":        "Unify Wizards",
                "description": "Unify Wizards delivers measurable growth...",
                "items": [
                    { "title": "SEO",  "description": "Optimize your website..." },
                    { "title": "PPC",  "description": "Targeted paid advertising..." },
                    { "title": "SMM",  "description": "Build brand awareness..." }
                ]
            }
            */

            // ══════════════════════════════════════════════════════════════════
            // SECTION 3 — Industries We Serve
            // Single heading + items[] repeatable
            // ══════════════════════════════════════════════════════════════════
            $table->json('s3_industries')->nullable();
            /*
            {
                "sub_title": "Industries We Serve",
                "heading":   "Focused experience across high-impact industries",
                "items": [
                    {
                        "icon":        "fa fa-thin fa-magic-wand-sparkles",
                        "color_class": "google-blue",
                        "name":        "Makeup",
                        "description": "Enhance beauty with professional makeup products"
                    },
                    {
                        "icon":        "fa fa-thin fa-spa",
                        "color_class": "google-red",
                        "name":        "Beauty & Skincare",
                        "description": "Premium skincare for healthy glowing complexion"
                    }
                ]
            }
            */

            // ══════════════════════════════════════════════════════════════════
            // SECTION 4 — Get to Know Us / About (Committed)
            // Fully single — no repeatable children
            // ══════════════════════════════════════════════════════════════════
            $table->json('s4_about')->nullable();
            /*
            {
                "sub_title":      "Get to Know Us",
                "title":          "Committed Delivering Our Measurable Result and in Building",
                "counter_number": "30",
                "counter_suffix": "+",
                "counter_label":  "Years of Corporate Experience.",
                "description_1":  "Our approach to customer experience...",
                "description_2":  "Our approach to customer experience...",
                "image_path":     "dm-pages/s4/about.webp",
                "button_text":    "Learn More",
                "button_url":     "/about"
            }
            */

            // ══════════════════════════════════════════════════════════════════
            // SECTION 5 — Testimonials
            // Single heading + video + items[] repeatable
            // ══════════════════════════════════════════════════════════════════
            $table->json('s5_testimonials')->nullable();
            /*
            {
                "sub_title":  "Clients Testimonials",
                "heading":    "Our Trusted Clients.",
                "video_path": "dm-pages/s5/testimonial.mp4",
                "items": [
                    {
                        "stars":       5,
                        "description": "Working with Bexon has been a game-changer...",
                        "name":        "Nathaniel Ellington",
                        "designation": "Chief Executive",
                        "avatar_path": "dm-pages/s5/avatars/avatar1.webp"
                    }
                ]
            }
            */

            // ══════════════════════════════════════════════════════════════════
            // SECTION 6 — Our Company
            // Fully single — no repeatable children
            // ══════════════════════════════════════════════════════════════════
            $table->json('s6_our_company')->nullable();
            /*
            {
                "sub_title":     "OUR COMPANY",
                "title":         "Innovating Today for Build Smarter, Stronger...",
                "description_1": "Our approach to customer experience...",
                "description_2": "Our approach to customer experience...",
                "description_3": "Our approach to customer experience...",
                "image_path":    "dm-pages/s6/company.webp",
                "button_text":   "Know More Us",
                "button_url":    "/contact"
            }
            */

            // ══════════════════════════════════════════════════════════════════
            // SECTION 7 — Proud Projects
            // Single heading + items[] repeatable (image, category, name, link)
            // ══════════════════════════════════════════════════════════════════
            $table->json('s7_proud_projects')->nullable();
            /*
            {
                "sub_title":   "Proud Projects",
                "title":       "Breaking Boundaries, Building Dreams.",
                "description": "We work closely with our clients...",
                "button_text": "More Projects",
                "button_url":  "/portfolio",
                "items": [
                    {
                        "image_path": "dm-pages/s7/project1.webp",
                        "category":   "Connect",
                        "name":       "Event Management Platform",
                        "link_url":   "/portfolio/1"
                    },
                    {
                        "image_path": "dm-pages/s7/project2.webp",
                        "category":   "Empower",
                        "name":       "Digital Marketing Campaign",
                        "link_url":   "/portfolio/2"
                    }
                ]
            }
            */

            // ══════════════════════════════════════════════════════════════════
            // SECTION 8 — Powered By
            // Single heading + items[] repeatable (icon, heading, image, desc)
            // ══════════════════════════════════════════════════════════════════
            $table->json('s8_powered_by')->nullable();
            /*
            {
                "sub_title":   "Powered By",
                "heading":     "The World's Most Advanced Agency Software",
                "description": "Unify Wizards has become a top-rated SEO services company...",
                "button_text": "More Services",
                "button_url":  "/services",
                "items": [
                    {
                        "icon":        "tji-service-1",
                        "heading":     "Integrations with every best-in-class 3rd party...",
                        "image_path":  "dm-pages/s8/service1.webp",
                        "description": "(Google Analytics, Semrush, Search Console...)",
                        "link_url":    "/service-details"
                    }
                ]
            }
            */

            // ══════════════════════════════════════════════════════════════════
            // SECTION 9 — Who Should Invest
            // Single fields + questions[] + answers[] both repeatable
            // ══════════════════════════════════════════════════════════════════
            $table->json('s9_who_should_invest')->nullable();
            /*
            {
                "chip_label":      "Who Should Invest",
                "heading":         "Who Should Invest In Digital Marketing Strategy Services?",
                "description":     "Every business needs a good strategy...",
                "questions_label": "5 quick questions to ask yourself:",
                "divider_label":   "If you answered 'no' to any of the above",
                "button_text":     "Learn More",
                "button_url":      "#",
                "questions": [
                    {
                        "icon":        "🧭",
                        "color_class": "wsi__q-card--blue",
                        "heading":     "Do you have a vision for your business?"
                    },
                    {
                        "icon":        "🎯",
                        "color_class": "wsi__q-card--red",
                        "heading":     "Have you fully defined your ideal customer?"
                    }
                ],
                "answers": [
                    {
                        "accent_color": "green",
                        "heading":      "Clear Goals & Action",
                        "description":  "Ensuring your business's success involves..."
                    },
                    {
                        "accent_color": "blue",
                        "heading":      "Stay Competitive",
                        "description":  "Having a strategy and plan allows you..."
                    }
                ]
            }
            */

            // ══════════════════════════════════════════════════════════════════
            // SECTION 10 — Why Choose Us
            // Single heading + items[] repeatable (icon svg, heading, desc)
            // ══════════════════════════════════════════════════════════════════
            $table->json('s10_why_choose')->nullable();
            /*
            {
                "title":       "Why Choose Unify Wizards As Your Digital Partner?",
                "sub_title":   "Boost Your Growth Rate and Achieve Online Success",
                "description": "Unify Wizards is a results-driven digital agency...",
                "items": [
                    {
                        "color_class": "uw-blue",
                        "icon_svg":    "<svg width='32' height='32'>...</svg>",
                        "heading":     "Data-Driven Results",
                        "description": "We use advanced analytics to identify opportunities..."
                    },
                    {
                        "color_class": "uw-red",
                        "icon_svg":    "<svg width='32' height='32'>...</svg>",
                        "heading":     "Industry Experts",
                        "description": "Our team brings decades of digital marketing experience..."
                    }
                ]
            }
            */

            // ══════════════════════════════════════════════════════════════════
            // SECTION 11 — The Wizards Spell
            // Single heading + cards[] repeatable (name, icon svg, desc)
            // ══════════════════════════════════════════════════════════════════
            $table->json('s11_wizards_spell')->nullable();
            /*
            {
                "heading":     "The Wizards Spell",
                "description": "The Wizards Spell is how we turn vision into measurable growth...",
                "button_text": "Learn About Us",
                "button_url":  "/about",
                "cards": [
                    {
                        "color_class": "atm-card-0",
                        "name":        "Discover",
                        "icon_svg":    "<svg>...</svg>",
                        "description": "The best brands improve, not settle..."
                    },
                    {
                        "color_class": "atm-card-1",
                        "name":        "Create",
                        "icon_svg":    "<svg>...</svg>",
                        "description": "With clear direction, we create data-driven strategies..."
                    },
                    {
                        "color_class": "atm-card-2",
                        "name":        "Grow",
                        "icon_svg":    "<svg>...</svg>",
                        "description": "We launch projects carefully and adjust in real time..."
                    },
                    {
                        "color_class": "atm-card-3",
                        "name":        "Optimise",
                        "icon_svg":    "<svg>...</svg>",
                        "description": "Great performance is just the beginning..."
                    }
                ]
            }
            */

            // ══════════════════════════════════════════════════════════════════
            // SECTION 12 — CTA (Call To Action)
            // Fully single — no repeatable children
            // ══════════════════════════════════════════════════════════════════
            $table->json('s12_cta')->nullable();
            /*
            {
                "heading":     "Let's Build Future Together.",
                "button_text": "Get Started Now",
                "button_url":  "/contact",
                "image_path":  "dm-pages/s12/cta-bg.webp"
            }
            */

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dm_pages');
    }
};
