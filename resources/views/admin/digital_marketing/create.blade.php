@extends('layouts.app')

@section('title', 'Add Digital Marketing Page')

@section('content')

    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.dm.page.index') }}">Services Pages</a></li>
        <li class="breadcrumb-item active">Add Page</li>
    </ol>

    <h1 class="page-header">Services Page</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.dm.page.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ═══════════════════════ PAGE META ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">📄 Page Info</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            Header Menu
                            <span class="text-danger">*</span>
                        </label>
                        <select name="header_menu" id="header_menu" class="form-select">
                            <option value="">Select Header Menu</option>
                            @foreach (App\Models\DmPage::headerMenus() as $key => $menu)
                                <option value="{{ $key }}">{{ $menu }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            Service Type
                            <span class="text-danger">*</span>
                        </label>
                        <select name="service_type" id="service_type" class="form-select">
                            <option value="">Select Service Type</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Page Name <span class="text-danger">*</span></label>
                        <input type="text" name="page_name" id="pageNameInput" class="form-control"
                            placeholder="e.g. Digital Marketing" value="{{ old('page_name') }}">
                        @error('page_name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Page Slug <span class="text-danger">*</span></label>
                        <input type="text" name="page_slug" id="pageSlugInput" class="form-control"
                            placeholder="e.g. digital-marketing" value="{{ old('page_slug') }}">
                        <small class="text-muted">Auto-generated from Page Name. Lowercase, hyphens only.</small>
                        @error('page_slug')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════ SECTION 1: BANNER ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🏠 Section 1 — Get To Know Us (Banner)</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s1_banner[status]" id="s1Status" value="active" data-target="s1Body" checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s1Body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s1_banner[sub_title]" class="form-control" placeholder="Get to Know Us"
                            value="{{ old('s1_banner.sub_title') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="s1_banner[phone_number]" class="form-control"
                            placeholder="1-888-452-1505" value="{{ old('s1_banner.phone_number') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Banner Title</label>
                        <input type="text" name="s1_banner[banner_title]" class="form-control"
                            placeholder="Driving Excellence Through Evolution & Trust."
                            value="{{ old('s1_banner.banner_title') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s1_banner[description]" rows="3" class="form-control" placeholder="Short description...">{{ old('s1_banner.description') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s1_banner[button_text]" class="form-control"
                            placeholder="Learn More" value="{{ old('s1_banner.button_text') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s1_banner[button_url]" class="form-control" placeholder="/contact"
                            value="{{ old('s1_banner.button_url') }}">
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">🏅 Award Logos (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addLogoRow()">
                        <i class="fa fa-plus"></i> Add Logo
                    </button>
                </div>
                <div id="s1-logos">
                    <div class="repeat-row border rounded p-2 mb-2 bg-light">
                        <div class="row align-items-center">
                            <div class="col-md-10">
                                <label class="form-label small">Logo Image</label>
                                <input type="file" name="s1_logos[0][image]" class="form-control form-control-sm"
                                    accept="image/*">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-sm btn-danger w-100 mt-4"
                                    onclick="removeRow(this)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════ SECTION 2: TOP SERVICES ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🎯 Section 2 — Top Digital Marketing Services</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s2_top_services[status]" id="s2Status" value="active" data-target="s2Body" checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s2Body">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Section Heading</label>
                        <input type="text" name="s2_top_services[heading]" class="form-control"
                            placeholder="Top Digital Marketing Services at Unify Wizards"
                            value="{{ old('s2_top_services.heading') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Highlighted Brand Name</label>
                        <input type="text" name="s2_top_services[name]" class="form-control"
                            placeholder="Unify Wizards" value="{{ old('s2_top_services.name') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s2_top_services[description]" rows="2" class="form-control"
                            placeholder="Section description...">{{ old('s2_top_services.description') }}</textarea>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">📋 Service Items (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addRow('s2-items', s2ItemTemplate)">
                        <i class="fa fa-plus"></i> Add Item
                    </button>
                </div>
             <div id="s2-items">
                    <div class="repeat-row border rounded p-3 mb-2 bg-light">
                        <div class="row">

                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Title</label>
                                <input type="text" name="s2_items[0][title]" class="form-control form-control-sm"
                                    placeholder="Search Engine Optimization (SEO)">
                            </div>

                            <div class="col-md-4 mb-2">
                                <label class="form-label small">Description</label>
                                <textarea name="s2_items[0][description]" rows="2" class="form-control form-control-sm"
                                    placeholder="Short description..."></textarea>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label class="form-label small">URL</label>
                                <input type="text" name="s2_items[0][url]" class="form-control form-control-sm"
                                    placeholder="/services/seo-services">
                            </div>

                            <div class="col-md-1 d-flex align-items-end mb-2">
                                <button type="button" class="btn btn-sm btn-danger w-100" onclick="removeRow(this)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        {{-- ═══════════════════════ SECTION 3: INDUSTRIES ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🏭 Section 3 — Industries We Serve</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s3_industries[status]" id="s3Status" value="active" data-target="s3Body" checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s3Body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s3_industries[sub_title]" class="form-control"
                            placeholder="Industries We Serve" value="{{ old('s3_industries.sub_title') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s3_industries[heading]" class="form-control"
                            placeholder="Focused experience across high-impact industries"
                            value="{{ old('s3_industries.heading') }}">
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">🏷️ Industry Cards (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addRow('s3-items', s3ItemTemplate)">
                        <i class="fa fa-plus"></i> Add Industry
                    </button>
                </div>
                <div id="s3-items">
                    <div class="repeat-row border rounded p-3 mb-2 bg-light">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Icon Class</label>
                                <input type="text" name="s3_items[0][icon]" class="form-control form-control-sm"
                                    placeholder="fa fa-thin fa-magic-wand-sparkles">
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Color Class</label>
                                <select name="s3_items[0][color_class]" class="form-select form-select-sm">
                                    <option value="google-blue">Google Blue</option>
                                    <option value="google-red">Google Red</option>
                                    <option value="google-yellow">Google Yellow</option>
                                    <option value="google-green">Google Green</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Name</label>
                                <input type="text" name="s3_items[0][name]" class="form-control form-control-sm"
                                    placeholder="Makeup">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label small">Description</label>
                                <input type="text" name="s3_items[0][description]"
                                    class="form-control form-control-sm"
                                    placeholder="Enhance beauty with professional makeup products">
                            </div>
                            <div class="col-md-1 d-flex align-items-end mb-2">
                                <button type="button" class="btn btn-sm btn-danger w-100" onclick="removeRow(this)"><i
                                        class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════ SECTION 4: ABOUT ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">📊 Section 4 — Get to Know Us (About)</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s4_about[status]" id="s4Status" value="active" data-target="s4Body" checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s4Body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s4_about[sub_title]" class="form-control"
                            placeholder="Get to Know Us" value="{{ old('s4_about.sub_title') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section Title</label>
                        <input type="text" name="s4_about[title]" class="form-control"
                            placeholder="Committed Delivering Our Measurable Result..."
                            value="{{ old('s4_about.title') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Counter Number</label>
                        <input type="text" name="s4_about[counter_number]" class="form-control" placeholder="30"
                            value="{{ old('s4_about.counter_number') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Counter Suffix</label>
                        <input type="text" name="s4_about[counter_suffix]" class="form-control" placeholder="+"
                            value="{{ old('s4_about.counter_suffix', '+') }}">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Counter Label</label>
                        <input type="text" name="s4_about[counter_label]" class="form-control"
                            placeholder="Years of Corporate Experience." value="{{ old('s4_about.counter_label') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Description Paragraph 1</label>
                        <textarea name="s4_about[description_1]" rows="3" class="form-control" placeholder="First paragraph...">{{ old('s4_about.description_1') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Description Paragraph 2</label>
                        <textarea name="s4_about[description_2]" rows="3" class="form-control" placeholder="Second paragraph...">{{ old('s4_about.description_2') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section Image</label>
                        <input type="file" name="s4_about[image]" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s4_about[button_text]" class="form-control" placeholder="Learn More"
                            value="{{ old('s4_about.button_text') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s4_about[button_url]" class="form-control" placeholder="/about"
                            value="{{ old('s4_about.button_url') }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════ SECTION 5: TESTIMONIALS ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">⭐ Section 5 — Testimonials</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s5_testimonials[status]" id="s5Status" value="active" data-target="s5Body" checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s5Body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s5_testimonials[sub_title]" class="form-control"
                            placeholder="Clients Testimonials" value="{{ old('s5_testimonials.sub_title') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s5_testimonials[heading]" class="form-control"
                            placeholder="Our Trusted Clients." value="{{ old('s5_testimonials.heading') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Background Video</label>
                        <input type="file" name="s5_testimonials[video]" class="form-control" accept="video/*">
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">💬 Testimonial Cards (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addRow('s5-items', s5ItemTemplate)">
                        <i class="fa fa-plus"></i> Add Testimonial
                    </button>
                </div>
                <div id="s5-items">
                    <div class="repeat-row border rounded p-3 mb-2 bg-light">
                        <div class="row">
                            <div class="col-md-1 mb-2">
                                <label class="form-label small">Stars</label>
                                <select name="s5_items[0][stars]" class="form-select form-select-sm">
                                    <option value="5" selected>5 ★</option>
                                    <option value="4">4 ★</option>
                                    <option value="3">3 ★</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label small">Testimonial Text</label>
                                <textarea name="s5_items[0][description]" rows="3" class="form-control form-control-sm"
                                    placeholder="Write testimonial text here..."></textarea>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Client Name</label>
                                <input type="text" name="s5_items[0][name]" class="form-control form-control-sm"
                                    placeholder="Nathaniel Ellington">
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Designation</label>
                                <input type="text" name="s5_items[0][designation]"
                                    class="form-control form-control-sm" placeholder="Chief Executive">
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Avatar</label>
                                <input type="file" name="s5_items[0][avatar]" class="form-control form-control-sm"
                                    accept="image/*">
                            </div>
                            <div class="col-md-1 d-flex align-items-end mb-2">
                                <button type="button" class="btn btn-sm btn-danger w-100" onclick="removeRow(this)"><i
                                        class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════ SECTION 6: OUR COMPANY ═══════════════════════ --}}
        
         <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🏢 Section 6 — Our Company</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s6_our_company[status]" id="s6Status" value="active" data-target="s6Body" checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s6Body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s6_our_company[sub_title]" class="form-control"
                            placeholder="OUR COMPANY" value="{{ old('s6_our_company.sub_title') }}">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="s6_our_company[title]" class="form-control"
                            placeholder="Innovating Today for Build Smarter, Stronger, and More Successful."
                            value="{{ old('s6_our_company.title') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description Paragraph 1</label>
                        <textarea name="s6_our_company[description_1]" rows="5" class="form-control summernote-editor"
                            placeholder="Paragraph 1...">{{ old('s6_our_company.description_1') }}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Section Image</label>
                        <input type="file" name="s6_our_company[image]" class="form-control" accept="image/*">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s6_our_company[button_text]" class="form-control"
                            placeholder="Know More Us" value="{{ old('s6_our_company.button_text') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s6_our_company[button_url]" class="form-control"
                            placeholder="/contact" value="{{ old('s6_our_company.button_url') }}">
                    </div>
                </div>
            </div>
        </div>

        @push('css')
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" />
        @endpush

        @push('scripts')
            {{-- jQuery pehle se page me load hona chahiye (vendor.min.js) --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

            <script>
                $(document).ready(function() {

                    $('.summernote-editor').summernote({

                        placeholder: 'Write blog content...',

                        height: 300,

                        tabsize: 2

                    });


                });
            </script>
        @endpush

        {{-- ═══════════════════════ SECTION 7: PROUD PROJECTS ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🚀 Section 7 — Proud Projects</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s7_proud_projects[status]" id="s7Status" value="active" data-target="s7Body" checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s7Body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s7_proud_projects[sub_title]" class="form-control"
                            placeholder="Proud Projects" value="{{ old('s7_proud_projects.sub_title') }}">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="s7_proud_projects[title]" class="form-control"
                            placeholder="Breaking Boundaries, Building Dreams."
                            value="{{ old('s7_proud_projects.title') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s7_proud_projects[button_text]" class="form-control"
                            placeholder="More Projects" value="{{ old('s7_proud_projects.button_text') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s7_proud_projects[button_url]" class="form-control"
                            placeholder="/portfolio" value="{{ old('s7_proud_projects.button_url') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s7_proud_projects[description]" rows="2" class="form-control"
                            placeholder="We work closely with our clients...">{{ old('s7_proud_projects.description') }}</textarea>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">📁 Project Items (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addRow('s7-items', s7ItemTemplate)">
                        <i class="fa fa-plus"></i> Add Project
                    </button>
                </div>
                <div id="s7-items">
                    <div class="repeat-row border rounded p-3 mb-2 bg-light">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Project Image</label>
                                <input type="file" name="s7_items[0][image]" class="form-control form-control-sm"
                                    accept="image/*">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Category</label>
                                <input type="text" name="s7_items[0][category]" class="form-control form-control-sm"
                                    placeholder="Connect">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label small">Project Name</label>
                                <input type="text" name="s7_items[0][name]" class="form-control form-control-sm"
                                    placeholder="Event Management Platform">
                            </div>
                            <div class="col-md-1 mb-2">
                                <label class="form-label small">Link URL</label>
                                <input type="text" name="s7_items[0][link_url]" class="form-control form-control-sm"
                                    placeholder="/portfolio/1">
                            </div>
                            <div class="col-md-1 d-flex align-items-end mb-2">
                                <button type="button" class="btn btn-sm btn-danger w-100" onclick="removeRow(this)"><i
                                        class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════ SECTION 8: POWERED BY ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">⚡ Section 8 — Powered By (Agency Software)</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s8_powered_by[status]" id="s8Status" value="active" data-target="s8Body" checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s8Body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s8_powered_by[sub_title]" class="form-control"
                            placeholder="Powered By" value="{{ old('s8_powered_by.sub_title') }}">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s8_powered_by[heading]" class="form-control"
                            placeholder="The World's Most Advanced Agency Software"
                            value="{{ old('s8_powered_by.heading') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s8_powered_by[button_text]" class="form-control"
                            placeholder="More Services" value="{{ old('s8_powered_by.button_text') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s8_powered_by[button_url]" class="form-control"
                            placeholder="/services" value="{{ old('s8_powered_by.button_url') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s8_powered_by[description]" rows="2" class="form-control"
                            placeholder="Unify Wizards has become a top-rated SEO services company...">{{ old('s8_powered_by.description') }}</textarea>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">🛠️ Software Items (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addRow('s8-items', s8ItemTemplate)">
                        <i class="fa fa-plus"></i> Add Item
                    </button>
                </div>
                <div id="s8-items">
                    <div class="repeat-row border rounded p-3 mb-2 bg-light">
                        <div class="row">
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Icon Class</label>
                                <input type="text" name="s8_items[0][icon]" class="form-control form-control-sm"
                                    placeholder="tji-service-1">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Heading</label>
                                <input type="text" name="s8_items[0][heading]" class="form-control form-control-sm"
                                    placeholder="Integrations with every best-in-class...">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Description</label>
                                <textarea name="s8_items[0][description]" rows="2" class="form-control form-control-sm"
                                    placeholder="(Google Analytics, Semrush...)"></textarea>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Background Image</label>
                                <input type="file" name="s8_items[0][image]" class="form-control form-control-sm"
                                    accept="image/*">
                            </div>
                            <div class="col-md-1 mb-2">
                                <label class="form-label small">Link</label>
                                <input type="text" name="s8_items[0][link_url]" class="form-control form-control-sm"
                                    placeholder="/service-details">
                            </div>
                            <div class="col-md-1 d-flex align-items-end mb-2">
                                <button type="button" class="btn btn-sm btn-danger w-100" onclick="removeRow(this)"><i
                                        class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════ SECTION 9: WHO SHOULD INVEST ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">💡 Section 9 — Who Should Invest</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s9_who_should_invest[status]" id="s9Status" value="active" data-target="s9Body"
                            checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s9Body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Chip Label</label>
                        <input type="text" name="s9_who_should_invest[chip_label]" class="form-control"
                            placeholder="Who Should Invest" value="{{ old('s9_who_should_invest.chip_label') }}">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s9_who_should_invest[heading]" class="form-control"
                            placeholder="Who Should Invest In Digital Marketing Strategy Services?"
                            value="{{ old('s9_who_should_invest.heading') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Intro Description</label>
                        <textarea name="s9_who_should_invest[description]" rows="3" class="form-control"
                            placeholder="Every business needs a good strategy...">{{ old('s9_who_should_invest.description') }}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Questions Label</label>
                        <input type="text" name="s9_who_should_invest[questions_label]" class="form-control"
                            placeholder="5 quick questions to ask yourself:"
                            value="{{ old('s9_who_should_invest.questions_label') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Divider Label</label>
                        <input type="text" name="s9_who_should_invest[divider_label]" class="form-control"
                            placeholder="If you answered 'no' to any of the above"
                            value="{{ old('s9_who_should_invest.divider_label') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s9_who_should_invest[button_text]" class="form-control"
                            placeholder="Learn More" value="{{ old('s9_who_should_invest.button_text') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s9_who_should_invest[button_url]" class="form-control"
                            placeholder="#" value="{{ old('s9_who_should_invest.button_url') }}">
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">❓ Question Cards (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addRow('s9-questions', s9QuestionTemplate)">
                        <i class="fa fa-plus"></i> Add Question
                    </button>
                </div>
                <div id="s9-questions">
                    <div class="repeat-row border rounded p-3 mb-2 bg-light">
                        <div class="row">
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Icon (Emoji)</label>
                                <input type="text" name="s9_questions[0][icon]" class="form-control form-control-sm"
                                    placeholder="🧭">
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Color Class</label>
                                <select name="s9_questions[0][color_class]" class="form-select form-select-sm">
                                    <option value="wsi__q-card--blue">Blue</option>
                                    <option value="wsi__q-card--red">Red</option>
                                    <option value="wsi__q-card--yellow">Yellow</option>
                                    <option value="wsi__q-card--green">Green</option>
                                </select>
                            </div>
                            <div class="col-md-7 mb-2">
                                <label class="form-label small">Question Text</label>
                                <input type="text" name="s9_questions[0][heading]"
                                    class="form-control form-control-sm"
                                    placeholder="Do you have a vision for your business...">
                            </div>
                            <div class="col-md-1 d-flex align-items-end mb-2">
                                <button type="button" class="btn btn-sm btn-danger w-100" onclick="removeRow(this)"><i
                                        class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">✅ Answer Info Cards (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addRow('s9-answers', s9AnswerTemplate)">
                        <i class="fa fa-plus"></i> Add Answer Card
                    </button>
                </div>
                <div id="s9-answers">
                    <div class="repeat-row border rounded p-3 mb-2 bg-light">
                        <div class="row">
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Accent Color</label>
                                <select name="s9_answers[0][accent_color]" class="form-select form-select-sm">
                                    <option value="green">Green</option>
                                    <option value="blue">Blue</option>
                                    <option value="red">Red</option>
                                    <option value="yellow">Yellow</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Heading</label>
                                <input type="text" name="s9_answers[0][heading]" class="form-control form-control-sm"
                                    placeholder="Clear Goals & Action">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Description</label>
                                <textarea name="s9_answers[0][description]" rows="2" class="form-control form-control-sm"
                                    placeholder="Ensuring your business's success involves..."></textarea>
                            </div>
                            <div class="col-md-1 d-flex align-items-end mb-2">
                                <button type="button" class="btn btn-sm btn-danger w-100" onclick="removeRow(this)"><i
                                        class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════ SECTION 10: WHY CHOOSE ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">✅ Section 10 — Why Choose Us</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s10_why_choose[status]" id="s10Status" value="active" data-target="s10Body" checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s10Body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="s10_why_choose[title]" class="form-control"
                            placeholder="Why Choose Unify Wizards As Your Digital Partner?"
                            value="{{ old('s10_why_choose.title') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s10_why_choose[sub_title]" class="form-control"
                            placeholder="Boost Your Growth Rate and Achieve Online Success"
                            value="{{ old('s10_why_choose.sub_title') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Intro Description</label>
                        <textarea name="s10_why_choose[description]" rows="3" class="form-control"
                            placeholder="Unify Wizards is a results-driven digital agency...">{{ old('s10_why_choose.description') }}</textarea>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">🃏 Feature Cards (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addRow('s10-items', s10ItemTemplate)">
                        <i class="fa fa-plus"></i> Add Card
                    </button>
                </div>
                <div id="s10-items">
                    <div class="repeat-row border rounded p-3 mb-2 bg-light">
                        <div class="row">
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Color Class</label>
                                <select name="s10_items[0][color_class]" class="form-select form-select-sm">
                                    <option value="uw-blue">Blue</option>
                                    <option value="uw-red">Red</option>
                                    <option value="uw-yellow">Yellow</option>
                                    <option value="uw-green">Green</option>
                                    <option value="uw-google-green">Google Green</option>
                                    <option value="uw-google-orange">Orange</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Icon SVG / Class</label>
                                <textarea name="s10_items[0][icon_svg]" rows="2" class="form-control form-control-sm"
                                    placeholder="Paste raw SVG markup here..."></textarea>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Heading</label>
                                <input type="text" name="s10_items[0][heading]" class="form-control form-control-sm"
                                    placeholder="Data-Driven Results">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Description</label>
                                <textarea name="s10_items[0][description]" rows="2" class="form-control form-control-sm"
                                    placeholder="We use advanced analytics..."></textarea>
                            </div>
                            <div class="col-md-1 d-flex align-items-end mb-2">
                                <button type="button" class="btn btn-sm btn-danger w-100" onclick="removeRow(this)"><i
                                        class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════ SECTION 11: WIZARDS SPELL ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🪄 Section 11 — The Wizards Spell</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s11_wizards_spell[status]" id="s11Status" value="active" data-target="s11Body"
                            checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s11Body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s11_wizards_spell[heading]" class="form-control"
                            placeholder="The Wizards Spell" value="{{ old('s11_wizards_spell.heading') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s11_wizards_spell[button_text]" class="form-control"
                            placeholder="Learn About Us" value="{{ old('s11_wizards_spell.button_text') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s11_wizards_spell[button_url]" class="form-control"
                            placeholder="/about" value="{{ old('s11_wizards_spell.button_url') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s11_wizards_spell[description]" rows="3" class="form-control"
                            placeholder="The Wizards Spell is how we turn vision into measurable growth...">{{ old('s11_wizards_spell.description') }}</textarea>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">🃏 Step Cards — Discover / Create / Grow / Optimise (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addRow('s11-cards', s11CardTemplate)">
                        <i class="fa fa-plus"></i> Add Card
                    </button>
                </div>
                <div id="s11-cards">
                    <div class="repeat-row border rounded p-3 mb-2 bg-light">
                        <div class="row">
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Card Color Class</label>
                                <select name="s11_cards[0][color_class]" class="form-select form-select-sm">
                                    <option value="atm-card-0">Blue (Discover)</option>
                                    <option value="atm-card-1">Red (Create)</option>
                                    <option value="atm-card-2">Yellow (Grow)</option>
                                    <option value="atm-card-3">Green (Optimise)</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Name / Label</label>
                                <input type="text" name="s11_cards[0][name]" class="form-control form-control-sm"
                                    placeholder="Discover">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label small">Icon SVG</label>
                                <textarea name="s11_cards[0][icon_svg]" rows="2" class="form-control form-control-sm"
                                    placeholder="Paste raw SVG markup here..."></textarea>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Description</label>
                                <textarea name="s11_cards[0][description]" rows="2" class="form-control form-control-sm"
                                    placeholder="The best brands improve, not settle..."></textarea>
                            </div>
                            <div class="col-md-1 d-flex align-items-end mb-2">
                                <button type="button" class="btn btn-sm btn-danger w-100"
                                    onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════ SECTION 12: CTA ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">📣 Section 12 — CTA (Call To Action)</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s12_cta[status]" id="s12Status" value="active" data-target="s12Body" checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s12Body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Eyebrow (small label above heading)</label>
                        <input type="text" name="s12_cta[sub_title]" class="form-control"
                            placeholder="Let's Work Together" value="{{ old('s12_cta.sub_title') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s12_cta[heading]" class="form-control"
                            placeholder="Let's Build Future Together." value="{{ old('s12_cta.heading') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s12_cta[description]" rows="1" class="form-control"
                            placeholder="Short supporting line under the heading">{{ old('s12_cta.description') }}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s12_cta[button_text]" class="form-control"
                            placeholder="Get Started Now" value="{{ old('s12_cta.button_text') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s12_cta[button_url]" class="form-control" placeholder="/contact"
                            value="{{ old('s12_cta.button_url') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Background Image</label>
                        <input type="file" name="s12_cta[image]" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════ SECTION 13: TECHNOLOGIES ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">✅ Section 13 — Technologies</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s13_technologies[status]" id="s13Status" value="active" data-target="s13Body"
                            checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s13Body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="s13_technologies[title]" class="form-control"
                            placeholder="Technologies We Work With" value="{{ old('s13_technologies.title') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s13_technologies[sub_title]" class="form-control"
                            placeholder="Modern Tools & Frameworks" value="{{ old('s13_technologies.sub_title') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Intro Description</label>
                        <textarea name="s13_technologies[description]" rows="3" class="form-control"
                            placeholder="We use modern frontend and backend technologies...">{{ old('s13_technologies.description') }}</textarea>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">🧩 Technology Categories</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addTechnologyGroup()">
                        <i class="fa fa-plus"></i> Add Technology Group
                    </button>
                </div>
                <div id="technology-groups">
                    <div class="repeat-row border rounded p-3 mb-3 bg-light technology-group">
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label class="form-label fw-bold">Technology Heading</label>
                                <input type="text" name="technology_groups[0][heading]" class="form-control"
                                    placeholder="Frontend">
                            </div>
                            <div class="col-md-2 mb-3 d-flex align-items-end">
                                <button type="button" class="btn btn-danger w-100" onclick="removeRow(this)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="technology-items">
                            <div class="row technology-item mb-2">
                                <div class="col-md-5">
                                    <label class="form-label small">Technology Name</label>
                                    <input type="text" name="technology_groups[0][items][0][name]"
                                        class="form-control form-control-sm" placeholder="React">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label small">Icon Class / SVG</label>
                                    <input type="text" name="technology_groups[0][items][0][icon]"
                                        class="form-control form-control-sm" placeholder="fab fa-react">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                        onclick="removeRow(this)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-success mt-2"
                            onclick="addTechnologyItem(this)">
                            <i class="fa fa-plus"></i> Add Technology
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════ SECTION 14: OUR PROCESS ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🎯 Section 14 — Our Process</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s14_our_process[status]" id="s14Status" value="active" data-target="s14Body"
                            checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse">
                        <i class="fa fa-minus"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body" id="s14Body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section Heading</label>
                        <input type="text" name="s14_our_process[heading]" class="form-control"
                            placeholder="OUR PROCESS" value="{{ old('s14_our_process.heading') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section Description</label>
                        <input type="text" name="s14_our_process[description]" class="form-control"
                            placeholder="Short description about process"
                            value="{{ old('s14_our_process.description') }}">
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">📋 Process Steps (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addS14Row('s14-items', s14ItemTemplate)">
                        <i class="fa fa-plus"></i> Add Step
                    </button>
                </div>
                <div id="s14-items">
                    <div class="repeat-row border rounded p-3 mb-2 bg-light">
                        <div class="row">
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Step No</label>
                                <input type="text" name="s14_items[0][step]" class="form-control form-control-sm"
                                    placeholder="01">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label small">Title</label>
                                <input type="text" name="s14_items[0][title]" class="form-control form-control-sm"
                                    placeholder="Discovery & Planning">
                            </div>
                            <div class="col-md-5 mb-2">
                                <label class="form-label small">Description</label>
                                <textarea name="s14_items[0][description]" rows="2" class="form-control form-control-sm"
                                    placeholder="Short description..."></textarea>
                            </div>
                            <div class="col-md-1 d-flex align-items-end mb-2">
                                <button type="button" class="btn btn-sm btn-danger w-100"
                                    onclick="removeS14Row(this)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════ SECTION 15: DEVELOPMENT PRICING TABLE ═══════════════════════ --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">💰 Section 15 — Development Pricing Table</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s15_development[status]" id="s15Status" value="active" data-target="s15Body"
                            checked>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse">
                        <i class="fa fa-minus"></i>
                    </a>
                </div>
            </div>
            <div class="panel-body" id="s15Body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s15_development[sub_title]" class="form-control"
                            placeholder="Our Pricing" value="{{ old('s15_development.sub_title') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Main Heading</label>
                        <input type="text" name="s15_development[heading]" class="form-control"
                            placeholder="What Is The Cost Of Best In Class Services?"
                            value="{{ old('s15_development.heading') }}">
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0 text-primary">📦 Pricing Table Items</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="add15Row('s15-development-items', s15DevelopmentTemplate)">
                        <i class="fa fa-plus"></i> Add More
                    </button>
                </div>
                <div id="s15-development-items">
                    <div class="repeat-row border rounded p-3 mb-3 bg-light">
                        <div class="row">
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Title</label>
                                <input type="text" name="s15_development_items[0][title]"
                                    class="form-control form-control-sm" placeholder="SEO">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label small">Heading</label>
                                <input type="text" name="s15_development_items[0][heading]"
                                    class="form-control form-control-sm" placeholder="Search Engine Optimization">
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Price</label>
                                <input type="text" name="s15_development_items[0][price]"
                                    class="form-control form-control-sm" placeholder="$250">
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label small">Category</label>
                                <input type="text" name="s15_development_items[0][category]"
                                    class="form-control form-control-sm" placeholder="Search">
                            </div>
                            <div class="col-md-1 mb-2">
                                <label class="form-label small">Button 1</label>
                                <input type="text" name="s15_development_items[0][btn_one]"
                                    class="form-control form-control-sm" placeholder="Explore">
                            </div>
                            <div class="col-md-1 mb-2">
                                <label class="form-label small">Button 2</label>
                                <input type="text" name="s15_development_items[0][btn_two]"
                                    class="form-control form-control-sm" placeholder="Contact">
                            </div>
                            <div class="col-md-1 d-flex align-items-end mb-2">
                                <button type="button" class="btn btn-sm btn-danger w-100" onclick="removeRow(this)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SUBMIT --}}
        <div class="panel panel-inverse">
            <div class="panel-body">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fa fa-save me-1"></i> Save All Sections
                    </button>
                    <a href="{{ route('admin.dm.page.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fa fa-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>

    </form>

    {{-- ═══════════════════════ GLOBAL SECTION TOGGLE JS ═══════════════════════ --}}
    <script>
        document.querySelectorAll('.section-toggle').forEach(function(toggle) {
            toggle.addEventListener('change', function() {
                var target = document.getElementById(this.dataset.target);
                if (target) {
                    target.style.display = this.checked ? 'block' : 'none';
                }
            });
        });
    </script>

    {{-- ═══════════════════════ TECHNOLOGY JS ═══════════════════════ --}}
    <script>
        let technologyGroupIndex = 1;

        function addTechnologyGroup() {
            let html = `<div class="repeat-row border rounded p-3 mb-3 bg-light technology-group">
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label class="form-label fw-bold">Technology Heading</label>
                        <input type="text" name="technology_groups[${technologyGroupIndex}][heading]" class="form-control" placeholder="Frontend">
                    </div>
                    <div class="col-md-2 mb-3 d-flex align-items-end">
                        <button type="button" class="btn btn-danger w-100" onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="technology-items">
                    <div class="row technology-item mb-2">
                        <div class="col-md-5">
                            <label class="form-label small">Technology Name</label>
                            <input type="text" name="technology_groups[${technologyGroupIndex}][items][0][name]" class="form-control form-control-sm" placeholder="React">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label small">Icon Class / SVG</label>
                            <input type="text" name="technology_groups[${technologyGroupIndex}][items][0][icon]" class="form-control form-control-sm" placeholder="fab fa-react">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-sm btn-danger w-100" onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-success mt-2" onclick="addTechnologyItem(this)">
                    <i class="fa fa-plus"></i> Add Technology
                </button>
            </div>`;
            document.getElementById('technology-groups').insertAdjacentHTML('beforeend', html);
            technologyGroupIndex++;
        }

        function addTechnologyItem(button) {
            let group = button.closest('.technology-group');
            let itemsWrapper = group.querySelector('.technology-items');
            let itemCount = itemsWrapper.querySelectorAll('.technology-item').length;
            let groupIndex = [...document.querySelectorAll('.technology-group')].indexOf(group);
            let html = `<div class="row technology-item mb-2">
                <div class="col-md-5">
                    <input type="text" name="technology_groups[${groupIndex}][items][${itemCount}][name]" class="form-control form-control-sm" placeholder="Vue.js">
                </div>
                <div class="col-md-5">
                    <input type="text" name="technology_groups[${groupIndex}][items][${itemCount}][icon]" class="form-control form-control-sm" placeholder="fab fa-vuejs">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-danger w-100" onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                </div>
            </div>`;
            itemsWrapper.insertAdjacentHTML('beforeend', html);
        }

        function removeRow(button) {
            let row = button.closest('.technology-item');
            if (row) {
                row.remove();
                return;
            }
            let group = button.closest('.technology-group');
            if (group) {
                group.remove();
            }
        }
    </script>

    @include('admin.digital_marketing.scripts')

@endsection
