

@extends('layouts.app')

@section('title', 'Edit Digital Marketing Page')

@section('content')

    {{-- ===================== BREADCRUMB ===================== --}}
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.dm.page.index') }}">Digital Marketing Pages</a></li>
        <li class="breadcrumb-item active">Edit Page</li>
    </ol>

    <h1 class="page-header">Edit Digital Marketing Page</h1>

    {{-- FORM opens here — wraps ALL sections --}}
    <form action="{{ route('admin.dm.page.update', $page->id) }}" method="POST" enctype="multipart/form-data" id="dmPageForm">
        @csrf
        @method('PUT')

        {{-- ===================================================
         PAGE META
        ==================================================== --}}
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
                        <label class="form-label fw-bold">Header Menu <span class="text-danger">*</span></label>
                        <select name="header_menu" id="header_menu" class="form-select">
                            <option value="">Select Header Menu</option>
                            @foreach (App\Models\DmPage::headerMenus() as $key => $menu)
                                <option value="{{ $key }}"
                                    {{ old('header_menu', $page->header_menu ?? '') == $key ? 'selected' : '' }}>
                                    {{ $menu }}</option>
                            @endforeach
                        </select>
                        @error('header_menu')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Service Type <span class="text-danger">*</span></label>
                        <select name="service_type" id="service_type" class="form-select">
                            <option value="">Select Service Type</option>
                            @php
                                $selectedMenu = old('header_menu', $page->header_menu ?? '');
                                $types = App\Models\DmPage::serviceTypes();
                            @endphp
                            @if (isset($types[$selectedMenu]))
                                @foreach ($types[$selectedMenu] as $key => $type)
                                    <option value="{{ $key }}"
                                        {{ old('service_type', $page->service_type ?? '') == $key ? 'selected' : '' }}>
                                        {{ $type }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('service_type')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Page Name <span class="text-danger">*</span></label>
                        <input type="text" name="page_name" class="form-control" placeholder="e.g. Digital Marketing"
                            value="{{ $page->page_name ?? old('page_name') }}">
                        @error('page_name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Page Slug <span class="text-danger">*</span></label>
                        <input type="text" name="page_slug" class="form-control" placeholder="e.g. digital-marketing"
                            value="{{ $page->slug ?? old('page_slug') }}">
                        <small class="text-muted">Used in menu URL. Lowercase, hyphens only.</small>
                        @error('page_slug')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>{{-- END Page Meta panel --}}

        {{-- ===================================================
         SECTION 1: BANNER
        ==================================================== --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🏠 Section 1 — Get To Know Us (Banner)</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s1_banner[status]" id="s1Status" value="active" data-target="s1Body"
                            {{ old('s1_banner.status', $page->s1_banner['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s1Body"
                style="{{ old('s1_banner.status', $page->s1_banner['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s1_banner[sub_title]" class="form-control" placeholder="Get to Know Us"
                            value="{{ old('s1_banner.sub_title', $page->s1_banner['sub_title'] ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="s1_banner[phone_number]" class="form-control"
                            placeholder="1-888-452-1505"
                            value="{{ $page->s1_banner['phone_number'] ?? old('s1_banner.phone_number') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Banner Title</label>
                        <input type="text" name="s1_banner[banner_title]" class="form-control"
                            placeholder="Driving Excellence Through Evolution & Trust."
                            value="{{ $page->s1_banner['banner_title'] ?? old('s1_banner.banner_title') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s1_banner[description]" rows="3" class="form-control" placeholder="Short description...">{{ $page->s1_banner['description'] ?? old('s1_banner.description') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s1_banner[button_text]" class="form-control"
                            placeholder="Learn More"
                            value="{{ $page->s1_banner['button_text'] ?? old('s1_banner.button_text') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s1_banner[button_url]" class="form-control" placeholder="/contact"
                            value="{{ $page->s1_banner['button_url'] ?? old('s1_banner.button_url') }}">
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">🏅 Award Logos (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addRow('s1-logos', logoRowTemplate)">
                        <i class="fa fa-plus"></i> Add Logo
                    </button>
                </div>
                <div id="s1-logos">
                    @if (!empty($page->s1_banner['logos']))
                        @foreach ($page->s1_banner['logos'] as $key => $logo)
                            <div class="repeat-row border rounded p-2 mb-2 bg-light">
                                <div class="row align-items-center">
                                    <div class="col-md-10">
                                        <label class="form-label small">Logo Image</label>
                                        <input type="file" name="s1_logos[{{ $key }}][image]"
                                            class="form-control form-control-sm" accept="image/*">
                                        @if (!empty($logo['image']))
                                            <img src="{{ asset('storage/' . $logo['image']) }}" width="80"
                                                class="mt-2 border rounded">
                                        @endif
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-sm btn-danger w-100 mt-4"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="repeat-row border rounded p-2 mb-2 bg-light">
                            <div class="row align-items-center">
                                <div class="col-md-10">
                                    <label class="form-label small">Logo Image</label>
                                    <input type="file" name="s1_logos[0][image]" class="form-control form-control-sm"
                                        accept="image/*">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-sm btn-danger w-100 mt-4"
                                        onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>{{-- END S1 --}}

        {{-- ===================================================
         SECTION 2: TOP SERVICES
        ==================================================== --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🎯 Section 2 — Top Digital Marketing Services</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s2_top_services[status]" id="s2Status" value="active" data-target="s2Body"
                            {{ old('s2_top_services.status', $page->s2_top_services['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s2Body"
                style="{{ old('s2_top_services.status', $page->s2_top_services['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Section Heading</label>
                        <input type="text" name="s2_top_services[heading]" class="form-control"
                            placeholder="Top Digital Marketing Services"
                            value="{{ old('s2_top_services.heading', $page->s2_top_services['heading'] ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Highlighted Brand Name</label>
                        <input type="text" name="s2_top_services[name]" class="form-control"
                            placeholder="Unify Wizards"
                            value="{{ old('s2_top_services.name', $page->s2_top_services['name'] ?? '') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s2_top_services[description]" rows="2" class="form-control"
                            placeholder="Section description...">{{ old('s2_top_services.description', $page->s2_top_services['description'] ?? '') }}</textarea>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">📋 Service Items (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addRow('s2-items', s2ItemTemplate)">
                        <i class="fa fa-plus"></i> Add Service Item
                    </button>
                </div>
                <div id="s2-items">
                    @if (!empty($page->s2_top_services['items']))
                        @foreach ($page->s2_top_services['items'] as $key => $item)
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Title</label>
                                        <input type="text" name="s2_items[{{ $key }}][title]"
                                            class="form-control form-control-sm" value="{{ $item['title'] ?? '' }}"
                                            placeholder="SEO">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label small">Description</label>
                                        <textarea name="s2_items[{{ $key }}][description]" rows="2" class="form-control form-control-sm"
                                            placeholder="Short description...">{{ $item['description'] ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label small">URL</label>
                                        <input type="text" name="s2_items[{{ $key }}][url]"
                                            class="form-control form-control-sm" value="{{ $item['url'] ?? '' }}"
                                            placeholder="/services/seo">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
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
                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                        onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>{{-- END S2 --}}

        {{-- ===================================================
         SECTION 3: INDUSTRIES
        ==================================================== --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🏭 Section 3 — Industries We Serve</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s3_industries[status]" id="s3Status" value="active" data-target="s3Body"
                            {{ old('s3_industries.status', $page->s3_industries['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s3Body"
                style="{{ old('s3_industries.status', $page->s3_industries['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s3_industries[sub_title]" class="form-control"
                            placeholder="Industries We Serve"
                            value="{{ old('s3_industries.sub_title', $page->s3_industries['sub_title'] ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s3_industries[heading]" class="form-control"
                            placeholder="Focused experience across high-impact industries"
                            value="{{ old('s3_industries.heading', $page->s3_industries['heading'] ?? '') }}">
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
                    @if (!empty($page->s3_industries['items']))
                        @foreach ($page->s3_industries['items'] as $key => $item)
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Icon Class</label>
                                        <input type="text" name="s3_items[{{ $key }}][icon]"
                                            class="form-control form-control-sm" value="{{ $item['icon'] ?? '' }}"
                                            placeholder="fa fa-thin fa-magic-wand-sparkles">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Color Class</label>
                                        <select name="s3_items[{{ $key }}][color_class]"
                                            class="form-select form-select-sm">
                                            <option value="google-blue"
                                                {{ ($item['color_class'] ?? '') == 'google-blue' ? 'selected' : '' }}>
                                                Google Blue</option>
                                            <option value="google-red"
                                                {{ ($item['color_class'] ?? '') == 'google-red' ? 'selected' : '' }}>Google
                                                Red</option>
                                            <option value="google-yellow"
                                                {{ ($item['color_class'] ?? '') == 'google-yellow' ? 'selected' : '' }}>
                                                Google Yellow</option>
                                            <option value="google-green"
                                                {{ ($item['color_class'] ?? '') == 'google-green' ? 'selected' : '' }}>
                                                Google Green</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Name</label>
                                        <input type="text" name="s3_items[{{ $key }}][name]"
                                            class="form-control form-control-sm" value="{{ $item['name'] ?? '' }}"
                                            placeholder="Makeup">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label small">Description</label>
                                        <input type="text" name="s3_items[{{ $key }}][description]"
                                            class="form-control form-control-sm" value="{{ $item['description'] ?? '' }}"
                                            placeholder="Short description">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
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
                                        class="form-control form-control-sm" placeholder="Short description">
                                </div>
                                <div class="col-md-1 d-flex align-items-end mb-2">
                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                        onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>{{-- END S3 --}}

        {{-- ===================================================
         SECTION 4: ABOUT
        ==================================================== --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">📊 Section 4 — Get to Know Us (About)</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s4_about[status]" id="s4Status" value="active" data-target="s4Body"
                            {{ old('s4_about.status', $page->s4_about['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s4Body"
                style="{{ old('s4_about.status', $page->s4_about['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s4_about[sub_title]" class="form-control"
                            placeholder="Get to Know Us"
                            value="{{ old('s4_about.sub_title', $page->s4_about['sub_title'] ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section Title</label>
                        <input type="text" name="s4_about[title]" class="form-control"
                            placeholder="Committed Delivering Our Measurable Result"
                            value="{{ old('s4_about.title', $page->s4_about['title'] ?? '') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Counter Number</label>
                        <input type="text" name="s4_about[counter_number]" class="form-control" placeholder="30"
                            value="{{ old('s4_about.counter_number', $page->s4_about['counter_number'] ?? '') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Counter Suffix</label>
                        <input type="text" name="s4_about[counter_suffix]" class="form-control" placeholder="+"
                            value="{{ old('s4_about.counter_suffix', $page->s4_about['counter_suffix'] ?? '+') }}">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Counter Label</label>
                        <input type="text" name="s4_about[counter_label]" class="form-control"
                            placeholder="Years of Corporate Experience."
                            value="{{ old('s4_about.counter_label', $page->s4_about['counter_label'] ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Description Paragraph 1</label>
                        <textarea name="s4_about[description_1]" rows="3" class="form-control" placeholder="First paragraph...">{{ old('s4_about.description_1', $page->s4_about['description_1'] ?? '') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Description Paragraph 2</label>
                        <textarea name="s4_about[description_2]" rows="3" class="form-control" placeholder="Second paragraph...">{{ old('s4_about.description_2', $page->s4_about['description_2'] ?? '') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section Image</label>
                        <input type="file" name="s4_about[image]" class="form-control" accept="image/*">
                        @if (!empty($page->s4_about['image_path']))
                            <img src="{{ asset('storage/' . $page->s4_about['image_path']) }}" width="120"
                                class="mt-2 border rounded">
                        @endif
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s4_about[button_text]" class="form-control" placeholder="Learn More"
                            value="{{ old('s4_about.button_text', $page->s4_about['button_text'] ?? '') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s4_about[button_url]" class="form-control" placeholder="/about"
                            value="{{ old('s4_about.button_url', $page->s4_about['button_url'] ?? '') }}">
                    </div>
                </div>
            </div>
        </div>{{-- END S4 --}}

        {{-- ===================================================
         SECTION 5: TESTIMONIALS
        ==================================================== --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">⭐ Section 5 — Testimonials</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s5_testimonials[status]" id="s5Status" value="active" data-target="s5Body"
                            {{ old('s5_testimonials.status', $page->s5_testimonials['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s5Body"
                style="{{ old('s5_testimonials.status', $page->s5_testimonials['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s5_testimonials[sub_title]" class="form-control"
                            placeholder="Clients Testimonials"
                            value="{{ old('s5_testimonials.sub_title', $page->s5_testimonials['sub_title'] ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s5_testimonials[heading]" class="form-control"
                            placeholder="Our Trusted Clients."
                            value="{{ old('s5_testimonials.heading', $page->s5_testimonials['heading'] ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Background Video</label>
                        <input type="file" name="s5_testimonials[video]" class="form-control" accept="video/*">
                        @if (!empty($page->s5_testimonials['video_path']))
                            <div class="mt-2"><video width="150" controls>
                                    <source src="{{ asset('storage/' . $page->s5_testimonials['video_path']) }}">
                                </video></div>
                        @endif
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
                    @if (!empty($page->s5_testimonials['items']))
                        @foreach ($page->s5_testimonials['items'] as $key => $item)
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-1 mb-2">
                                        <label class="form-label small">Stars</label>
                                        <select name="s5_items[{{ $key }}][stars]"
                                            class="form-select form-select-sm">
                                            <option value="5" {{ ($item['stars'] ?? '') == '5' ? 'selected' : '' }}>5
                                                ★</option>
                                            <option value="4" {{ ($item['stars'] ?? '') == '4' ? 'selected' : '' }}>4
                                                ★</option>
                                            <option value="3" {{ ($item['stars'] ?? '') == '3' ? 'selected' : '' }}>3
                                                ★</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5 mb-2">
                                        <label class="form-label small">Testimonial Text</label>
                                        <textarea name="s5_items[{{ $key }}][description]" rows="3" class="form-control form-control-sm"
                                            placeholder="Write testimonial text here...">{{ $item['description'] ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Client Name</label>
                                        <input type="text" name="s5_items[{{ $key }}][name]"
                                            class="form-control form-control-sm" value="{{ $item['name'] ?? '' }}"
                                            placeholder="Nathaniel Ellington">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Designation</label>
                                        <input type="text" name="s5_items[{{ $key }}][designation]"
                                            class="form-control form-control-sm" value="{{ $item['designation'] ?? '' }}"
                                            placeholder="Chief Executive">
                                    </div>
                                    <div class="col-md-1 mb-2">
                                        <label class="form-label small">Avatar</label>
                                        <input type="file" name="s5_items[{{ $key }}][avatar]"
                                            class="form-control form-control-sm" accept="image/*">
                                        @if (!empty($item['avatar_path']))
                                            <img src="{{ asset('storage/' . $item['avatar_path']) }}" width="50"
                                                class="mt-2 rounded border">
                                        @endif
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
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
                                <div class="col-md-5 mb-2">
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
                                <div class="col-md-1 mb-2">
                                    <label class="form-label small">Avatar</label>
                                    <input type="file" name="s5_items[0][avatar]" class="form-control form-control-sm"
                                        accept="image/*">
                                </div>
                                <div class="col-md-1 d-flex align-items-end mb-2">
                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                        onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>{{-- END S5 --}}

        {{-- ===================================================
         SECTION 6: OUR COMPANY
        ==================================================== --}}
         <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🏢 Section 6 — Our Company</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s6_our_company[status]" id="s6Status" value="active" data-target="s6Body"
                            {{ old('s6_our_company.status', $page->s6_our_company['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s6Body"
                style="{{ old('s6_our_company.status', $page->s6_our_company['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s6_our_company[sub_title]" class="form-control"
                            placeholder="OUR COMPANY"
                            value="{{ old('s6_our_company.sub_title', $page->s6_our_company['sub_title'] ?? '') }}">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="s6_our_company[title]" class="form-control"
                            placeholder="Innovating Today for Build Smarter, Stronger."
                            value="{{ old('s6_our_company.title', $page->s6_our_company['title'] ?? '') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description Paragraph 1</label>
                        <textarea name="s6_our_company[description_1]" rows="5" class="form-control summernote" id="summernote"
                            placeholder="Paragraph 1...">{{ old('s6_our_company.description_1', $page->s6_our_company['description_1'] ?? '') }}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Section Image</label>
                        <input type="file" name="s6_our_company[image]" class="form-control" accept="image/*">
                        @if (!empty($page->s6_our_company['image_path']))
                            <img src="{{ asset('storage/' . $page->s6_our_company['image_path']) }}" width="120"
                                class="mt-2 border rounded">
                        @endif
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s6_our_company[button_text]" class="form-control"
                            placeholder="Know More Us"
                            value="{{ old('s6_our_company.button_text', $page->s6_our_company['button_text'] ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s6_our_company[button_url]" class="form-control"
                            placeholder="/contact"
                            value="{{ old('s6_our_company.button_url', $page->s6_our_company['button_url'] ?? '') }}">
                    </div>
                </div>
            </div>
        </div>{{-- END S6 --}}
        
       @push('css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    @endpush
        
        @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.summernote').summernote({

                placeholder: 'Write blog content...',

                height: 300,

                tabsize: 2

            });


        });
    </script>
@endpush
        
        
        
        
        
        
        {{-- END S6 --}}

        {{-- ===================================================
         SECTION 7: PROUD PROJECTS
        ==================================================== --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🚀 Section 7 — Proud Projects</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s7_proud_projects[status]" id="s7Status" value="active" data-target="s7Body"
                            {{ old('s7_proud_projects.status', $page->s7_proud_projects['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s7Body"
                style="{{ old('s7_proud_projects.status', $page->s7_proud_projects['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s7_proud_projects[sub_title]" class="form-control"
                            placeholder="Proud Projects"
                            value="{{ old('s7_proud_projects.sub_title', $page->s7_proud_projects['sub_title'] ?? '') }}">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="s7_proud_projects[title]" class="form-control"
                            placeholder="Breaking Boundaries, Building Dreams."
                            value="{{ old('s7_proud_projects.title', $page->s7_proud_projects['title'] ?? '') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s7_proud_projects[button_text]" class="form-control"
                            placeholder="More Projects"
                            value="{{ old('s7_proud_projects.button_text', $page->s7_proud_projects['button_text'] ?? '') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s7_proud_projects[button_url]" class="form-control"
                            placeholder="/portfolio"
                            value="{{ old('s7_proud_projects.button_url', $page->s7_proud_projects['button_url'] ?? '') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s7_proud_projects[description]" rows="2" class="form-control"
                            placeholder="We work closely with our clients...">{{ old('s7_proud_projects.description', $page->s7_proud_projects['description'] ?? '') }}</textarea>
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
                    @if (!empty($page->s7_proud_projects['items']))
                        @foreach ($page->s7_proud_projects['items'] as $key => $item)
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Project Image</label>
                                        <input type="file" name="s7_items[{{ $key }}][image]"
                                            class="form-control form-control-sm" accept="image/*">
                                        @if (!empty($item['image_path']))
                                            <img src="{{ asset('storage/' . $item['image_path']) }}" width="80"
                                                class="mt-2 border rounded">
                                        @endif
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Category</label>
                                        <input type="text" name="s7_items[{{ $key }}][category]"
                                            class="form-control form-control-sm" value="{{ $item['category'] ?? '' }}"
                                            placeholder="Connect">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label small">Project Name</label>
                                        <input type="text" name="s7_items[{{ $key }}][name]"
                                            class="form-control form-control-sm" value="{{ $item['name'] ?? '' }}"
                                            placeholder="Event Management Platform">
                                    </div>
                                    <div class="col-md-1 mb-2">
                                        <label class="form-label small">Link URL</label>
                                        <input type="text" name="s7_items[{{ $key }}][link_url]"
                                            class="form-control form-control-sm" value="{{ $item['link_url'] ?? '' }}"
                                            placeholder="/portfolio/1">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="repeat-row border rounded p-3 mb-2 bg-light">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label class="form-label small">Project Image</label>
                                    <input type="file" name="s7_items[0][image]" class="form-control form-control-sm"
                                        accept="image/*">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="form-label small">Category</label>
                                    <input type="text" name="s7_items[0][category]"
                                        class="form-control form-control-sm" placeholder="Connect">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="form-label small">Project Name</label>
                                    <input type="text" name="s7_items[0][name]" class="form-control form-control-sm"
                                        placeholder="Event Management Platform">
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label class="form-label small">Link URL</label>
                                    <input type="text" name="s7_items[0][link_url]"
                                        class="form-control form-control-sm" placeholder="/portfolio/1">
                                </div>
                                <div class="col-md-1 d-flex align-items-end mb-2">
                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                        onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>{{-- END S7 --}}

        {{-- ===================================================
         SECTION 8: POWERED BY
        ==================================================== --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">⚡ Section 8 — Powered By (Agency Software)</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s8_powered_by[status]" id="s8Status" value="active" data-target="s8Body"
                            {{ old('s8_powered_by.status', $page->s8_powered_by['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s8Body"
                style="{{ old('s8_powered_by.status', $page->s8_powered_by['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s8_powered_by[sub_title]" class="form-control"
                            placeholder="Powered By"
                            value="{{ old('s8_powered_by.sub_title', $page->s8_powered_by['sub_title'] ?? '') }}">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s8_powered_by[heading]" class="form-control"
                            placeholder="The World's Most Advanced Agency Software"
                            value="{{ old('s8_powered_by.heading', $page->s8_powered_by['heading'] ?? '') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s8_powered_by[button_text]" class="form-control"
                            placeholder="More Services"
                            value="{{ old('s8_powered_by.button_text', $page->s8_powered_by['button_text'] ?? '') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s8_powered_by[button_url]" class="form-control"
                            placeholder="/services"
                            value="{{ old('s8_powered_by.button_url', $page->s8_powered_by['button_url'] ?? '') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s8_powered_by[description]" rows="2" class="form-control" placeholder="Description...">{{ old('s8_powered_by.description', $page->s8_powered_by['description'] ?? '') }}</textarea>
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
                    @if (!empty($page->s8_powered_by['items']))
                        @foreach ($page->s8_powered_by['items'] as $key => $item)
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Icon Class</label>
                                        <input type="text" name="s8_items[{{ $key }}][icon]"
                                            class="form-control form-control-sm" value="{{ $item['icon'] ?? '' }}"
                                            placeholder="tji-service-1">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Heading</label>
                                        <input type="text" name="s8_items[{{ $key }}][heading]"
                                            class="form-control form-control-sm" value="{{ $item['heading'] ?? '' }}"
                                            placeholder="Integrations...">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Description</label>
                                        <textarea name="s8_items[{{ $key }}][description]" rows="2" class="form-control form-control-sm"
                                            placeholder="(Google Analytics...)">{{ $item['description'] ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Background Image</label>
                                        <input type="file" name="s8_items[{{ $key }}][image]"
                                            class="form-control form-control-sm" accept="image/*">
                                        @if (!empty($item['image_path']))
                                            <img src="{{ asset('storage/' . $item['image_path']) }}" width="70"
                                                class="mt-2 border rounded">
                                        @endif
                                    </div>
                                    <div class="col-md-1 mb-2">
                                        <label class="form-label small">Link</label>
                                        <input type="text" name="s8_items[{{ $key }}][link_url]"
                                            class="form-control form-control-sm" value="{{ $item['link_url'] ?? '' }}"
                                            placeholder="/service-details">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="repeat-row border rounded p-3 mb-2 bg-light">
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <label class="form-label small">Icon Class</label>
                                    <input type="text" name="s8_items[0][icon]" class="form-control form-control-sm"
                                        placeholder="tji-service-1">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="form-label small">Heading</label>
                                    <input type="text" name="s8_items[0][heading]"
                                        class="form-control form-control-sm"
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
                                    <input type="text" name="s8_items[0][link_url]"
                                        class="form-control form-control-sm" placeholder="/service-details">
                                </div>
                                <div class="col-md-1 d-flex align-items-end mb-2">
                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                        onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>{{-- END S8 --}}

        {{-- ===================================================
         SECTION 9: WHO SHOULD INVEST
        ==================================================== --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">💡 Section 9 — Who Should Invest</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s9_who_should_invest[status]" id="s9Status" value="active" data-target="s9Body"
                            {{ old('s9_who_should_invest.status', $page->s9_who_should_invest['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s9Body"
                style="{{ old('s9_who_should_invest.status', $page->s9_who_should_invest['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Chip Label</label>
                        <input type="text" name="s9_who_should_invest[chip_label]" class="form-control"
                            placeholder="Who Should Invest"
                            value="{{ old('s9_who_should_invest.chip_label', $page->s9_who_should_invest['chip_label'] ?? '') }}">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s9_who_should_invest[heading]" class="form-control"
                            placeholder="Who Should Invest In Digital Marketing?"
                            value="{{ old('s9_who_should_invest.heading', $page->s9_who_should_invest['heading'] ?? '') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Intro Description</label>
                        <textarea name="s9_who_should_invest[description]" rows="3" class="form-control"
                            placeholder="Every business needs a good strategy...">{{ old('s9_who_should_invest.description', $page->s9_who_should_invest['description'] ?? '') }}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Questions Label</label>
                        <input type="text" name="s9_who_should_invest[questions_label]" class="form-control"
                            placeholder="5 quick questions to ask yourself:"
                            value="{{ old('s9_who_should_invest.questions_label', $page->s9_who_should_invest['questions_label'] ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Divider Label</label>
                        <input type="text" name="s9_who_should_invest[divider_label]" class="form-control"
                            placeholder="If you answered 'no' to any of the above"
                            value="{{ old('s9_who_should_invest.divider_label', $page->s9_who_should_invest['divider_label'] ?? '') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s9_who_should_invest[button_text]" class="form-control"
                            placeholder="Learn More"
                            value="{{ old('s9_who_should_invest.button_text', $page->s9_who_should_invest['button_text'] ?? '') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s9_who_should_invest[button_url]" class="form-control"
                            placeholder="#"
                            value="{{ old('s9_who_should_invest.button_url', $page->s9_who_should_invest['button_url'] ?? '') }}">
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
                    @if (!empty($page->s9_who_should_invest['questions']))
                        @foreach ($page->s9_who_should_invest['questions'] as $key => $question)
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Icon (Emoji)</label>
                                        <input type="text" name="s9_questions[{{ $key }}][icon]"
                                            class="form-control form-control-sm" value="{{ $question['icon'] ?? '' }}"
                                            placeholder="🧭">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Color Class</label>
                                        <select name="s9_questions[{{ $key }}][color_class]"
                                            class="form-select form-select-sm">
                                            <option value="wsi__q-card--blue"
                                                {{ ($question['color_class'] ?? '') == 'wsi__q-card--blue' ? 'selected' : '' }}>
                                                Blue</option>
                                            <option value="wsi__q-card--red"
                                                {{ ($question['color_class'] ?? '') == 'wsi__q-card--red' ? 'selected' : '' }}>
                                                Red</option>
                                            <option value="wsi__q-card--yellow"
                                                {{ ($question['color_class'] ?? '') == 'wsi__q-card--yellow' ? 'selected' : '' }}>
                                                Yellow</option>
                                            <option value="wsi__q-card--green"
                                                {{ ($question['color_class'] ?? '') == 'wsi__q-card--green' ? 'selected' : '' }}>
                                                Green</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7 mb-2">
                                        <label class="form-label small">Question Text</label>
                                        <input type="text" name="s9_questions[{{ $key }}][heading]"
                                            class="form-control form-control-sm"
                                            value="{{ $question['heading'] ?? '' }}"
                                            placeholder="Do you have a vision for your business...">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
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
                    @if (!empty($page->s9_who_should_invest['answers']))
                        @foreach ($page->s9_who_should_invest['answers'] as $key => $answer)
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Accent Color</label>
                                        <select name="s9_answers[{{ $key }}][accent_color]"
                                            class="form-select form-select-sm">
                                            <option value="green"
                                                {{ ($answer['accent_color'] ?? '') == 'green' ? 'selected' : '' }}>Green
                                            </option>
                                            <option value="blue"
                                                {{ ($answer['accent_color'] ?? '') == 'blue' ? 'selected' : '' }}>Blue
                                            </option>
                                            <option value="red"
                                                {{ ($answer['accent_color'] ?? '') == 'red' ? 'selected' : '' }}>Red
                                            </option>
                                            <option value="yellow"
                                                {{ ($answer['accent_color'] ?? '') == 'yellow' ? 'selected' : '' }}>Yellow
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Heading</label>
                                        <input type="text" name="s9_answers[{{ $key }}][heading]"
                                            class="form-control form-control-sm"
                                            value="{{ $answer['heading'] ?? '' }}" placeholder="Clear Goals & Action">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label small">Description</label>
                                        <textarea name="s9_answers[{{ $key }}][description]" rows="2"
                                            class="form-control form-control-sm" placeholder="Ensuring your business's success...">{{ $answer['description'] ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>{{-- END S9 --}}

        {{-- ===================================================
         SECTION 10: WHY CHOOSE US
        ==================================================== --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">✅ Section 10 — Why Choose Us</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s10_why_choose[status]" id="s10Status" value="active" data-target="s10Body"
                            {{ old('s10_why_choose.status', $page->s10_why_choose['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s10Body"
                style="{{ old('s10_why_choose.status', $page->s10_why_choose['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="s10_why_choose[title]" class="form-control"
                            placeholder="Why Choose Unify Wizards?"
                            value="{{ old('s10_why_choose.title', $page->s10_why_choose['title'] ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s10_why_choose[sub_title]" class="form-control"
                            placeholder="Boost Your Growth Rate"
                            value="{{ old('s10_why_choose.sub_title', $page->s10_why_choose['sub_title'] ?? '') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Intro Description</label>
                        <textarea name="s10_why_choose[description]" rows="3" class="form-control"
                            placeholder="Unify Wizards is a results-driven digital agency...">{{ old('s10_why_choose.description', $page->s10_why_choose['description'] ?? '') }}</textarea>
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
                    @if (!empty($page->s10_why_choose['items']))
                        @foreach ($page->s10_why_choose['items'] as $key => $item)
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Color Class</label>
                                        <select name="s10_items[{{ $key }}][color_class]"
                                            class="form-select form-select-sm">
                                            <option value="uw-blue"
                                                {{ ($item['color_class'] ?? '') == 'uw-blue' ? 'selected' : '' }}>Blue
                                            </option>
                                            <option value="uw-red"
                                                {{ ($item['color_class'] ?? '') == 'uw-red' ? 'selected' : '' }}>Red
                                            </option>
                                            <option value="uw-yellow"
                                                {{ ($item['color_class'] ?? '') == 'uw-yellow' ? 'selected' : '' }}>Yellow
                                            </option>
                                            <option value="uw-green"
                                                {{ ($item['color_class'] ?? '') == 'uw-green' ? 'selected' : '' }}>Green
                                            </option>
                                            <option value="uw-google-green"
                                                {{ ($item['color_class'] ?? '') == 'uw-google-green' ? 'selected' : '' }}>
                                                Google Green</option>
                                            <option value="uw-google-orange"
                                                {{ ($item['color_class'] ?? '') == 'uw-google-orange' ? 'selected' : '' }}>
                                                Orange</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Icon SVG / Class</label>
                                        <textarea name="s10_items[{{ $key }}][icon_svg]" rows="2" class="form-control form-control-sm"
                                            placeholder="Paste raw SVG markup here...">{{ $item['icon_svg'] ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Heading</label>
                                        <input type="text" name="s10_items[{{ $key }}][heading]"
                                            class="form-control form-control-sm" value="{{ $item['heading'] ?? '' }}"
                                            placeholder="Data-Driven Results">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Description</label>
                                        <textarea name="s10_items[{{ $key }}][description]" rows="2" class="form-control form-control-sm"
                                            placeholder="We use advanced analytics...">{{ $item['description'] ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
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
                                    <input type="text" name="s10_items[0][heading]"
                                        class="form-control form-control-sm" placeholder="Data-Driven Results">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="form-label small">Description</label>
                                    <textarea name="s10_items[0][description]" rows="2" class="form-control form-control-sm"
                                        placeholder="We use advanced analytics..."></textarea>
                                </div>
                                <div class="col-md-1 d-flex align-items-end mb-2">
                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                        onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>{{-- END S10 --}}

        {{-- ===================================================
         SECTION 11: WIZARDS SPELL
        ==================================================== --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🪄 Section 11 — The Wizards Spell</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s11_wizards_spell[status]" id="s11Status" value="active" data-target="s11Body"
                            {{ old('s11_wizards_spell.status', $page->s11_wizards_spell['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s11Body"
                style="{{ old('s11_wizards_spell.status', $page->s11_wizards_spell['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s11_wizards_spell[heading]" class="form-control"
                            placeholder="The Wizards Spell"
                            value="{{ old('s11_wizards_spell.heading', $page->s11_wizards_spell['heading'] ?? '') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s11_wizards_spell[button_text]" class="form-control"
                            placeholder="Learn About Us"
                            value="{{ old('s11_wizards_spell.button_text', $page->s11_wizards_spell['button_text'] ?? '') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s11_wizards_spell[button_url]" class="form-control"
                            placeholder="/about"
                            value="{{ old('s11_wizards_spell.button_url', $page->s11_wizards_spell['button_url'] ?? '') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s11_wizards_spell[description]" rows="3" class="form-control"
                            placeholder="The Wizards Spell is how we turn vision into measurable growth...">{{ old('s11_wizards_spell.description', $page->s11_wizards_spell['description'] ?? '') }}</textarea>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">🃏 Step Cards (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addRow('s11-cards', s11CardTemplate)">
                        <i class="fa fa-plus"></i> Add Card
                    </button>
                </div>
                <div id="s11-cards">
                    @if (!empty($page->s11_wizards_spell['cards']))
                        @foreach ($page->s11_wizards_spell['cards'] as $key => $card)
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Card Color Class</label>
                                        <select name="s11_cards[{{ $key }}][color_class]"
                                            class="form-select form-select-sm">
                                            <option value="atm-card-0"
                                                {{ ($card['color_class'] ?? '') == 'atm-card-0' ? 'selected' : '' }}>Blue
                                                (Discover)
                                            </option>
                                            <option value="atm-card-1"
                                                {{ ($card['color_class'] ?? '') == 'atm-card-1' ? 'selected' : '' }}>Red
                                                (Create)</option>
                                            <option value="atm-card-2"
                                                {{ ($card['color_class'] ?? '') == 'atm-card-2' ? 'selected' : '' }}>
                                                Yellow (Grow)</option>
                                            <option value="atm-card-3"
                                                {{ ($card['color_class'] ?? '') == 'atm-card-3' ? 'selected' : '' }}>Green
                                                (Optimise)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Name / Label</label>
                                        <input type="text" name="s11_cards[{{ $key }}][name]"
                                            class="form-control form-control-sm" value="{{ $card['name'] ?? '' }}"
                                            placeholder="Discover">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label small">Icon SVG</label>
                                        <textarea name="s11_cards[{{ $key }}][icon_svg]" rows="2" class="form-control form-control-sm"
                                            placeholder="Paste raw SVG markup here...">{{ $card['icon_svg'] ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Description</label>
                                        <textarea name="s11_cards[{{ $key }}][description]" rows="2" class="form-control form-control-sm"
                                            placeholder="The best brands improve, not settle...">{{ $card['description'] ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
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
                                    <input type="text" name="s11_cards[0][name]"
                                        class="form-control form-control-sm" placeholder="Discover">
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
                    @endif
                </div>
            </div>
        </div>{{-- END S11 --}}

        {{-- ===================================================
         SECTION 12: CTA
        ==================================================== --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">📣 Section 12 — CTA (Call To Action)</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s12_cta[status]" id="s12Status" value="active" data-target="s12Body"
                            {{ old('s12_cta.status', $page->s12_cta['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s12Body"
                style="{{ old('s12_cta.status', $page->s12_cta['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Eyebrow (small label above heading)</label>
                        <input type="text" name="s12_cta[sub_title]" class="form-control"
                            placeholder="Let's Work Together"
                            value="{{ old('s12_cta.sub_title', $page->s12_cta['sub_title'] ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s12_cta[heading]" class="form-control"
                            placeholder="Let's Build Future Together."
                            value="{{ old('s12_cta.heading', $page->s12_cta['heading'] ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s12_cta[description]" rows="1" class="form-control"
                            placeholder="Short supporting line under the heading">{{ old('s12_cta.description', $page->s12_cta['description'] ?? '') }}</textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s12_cta[button_text]" class="form-control"
                            placeholder="Get Started Now"
                            value="{{ old('s12_cta.button_text', $page->s12_cta['button_text'] ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s12_cta[button_url]" class="form-control" placeholder="/contact"
                            value="{{ old('s12_cta.button_url', $page->s12_cta['button_url'] ?? '') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Background Image</label>
                        <input type="file" name="s12_cta[image]" class="form-control" accept="image/*">
                        @if (!empty($page->s12_cta['image_path']))
                            <div class="mt-2"><img src="{{ asset('storage/' . $page->s12_cta['image_path']) }}"
                                    width="100" class="img-thumbnail"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>{{-- END S12 --}}

        {{-- ===================================================
         SECTION 13: TECHNOLOGIES
        ==================================================== --}}
        @php
            $s13 = $page->s13_technologies ?? [];
            $technologyGroups = $s13['technology_groups'] ?? [];
        @endphp
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">✅ Section 13 — Technologies</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s13_technologies[status]" id="s13Status" value="active" data-target="s13Body"
                            {{ old('s13_technologies.status', $page->s13_technologies['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s13Body"
                style="{{ old('s13_technologies.status', $page->s13_technologies['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="s13_technologies[title]" class="form-control"
                            placeholder="Technologies We Work With"
                            value="{{ old('s13_technologies.title', $s13['title'] ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s13_technologies[sub_title]" class="form-control"
                            placeholder="Modern Tools & Frameworks"
                            value="{{ old('s13_technologies.sub_title', $s13['sub_title'] ?? '') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Intro Description</label>
                        <textarea name="s13_technologies[description]" rows="3" class="form-control"
                            placeholder="We use modern frontend and backend technologies...">{{ old('s13_technologies.description', $s13['description'] ?? '') }}</textarea>
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
                    @if (!empty($technologyGroups))
                        @foreach ($technologyGroups as $groupIndex => $group)
                            <div class="repeat-row border rounded p-3 mb-3 bg-light technology-group">
                                <div class="row">
                                    <div class="col-md-5 mb-3">
                                        <label class="form-label fw-bold">Technology Heading</label>
                                        <input type="text" name="technology_groups[{{ $groupIndex }}][heading]"
                                            class="form-control" placeholder="Frontend"
                                            value="{{ $group['heading'] ?? '' }}">
                                    </div>
                                    <div class="col-md-2 mb-3 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger w-100"
                                            onclick="removeTechnologyGroup(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                                <div class="technology-items">
                                    @if (!empty($group['items']))
                                        @foreach ($group['items'] as $itemIndex => $item)
                                            <div class="row technology-item mb-2">
                                                <div class="col-md-5">
                                                    <label class="form-label small">Technology Name</label>
                                                    <input type="text"
                                                        name="technology_groups[{{ $groupIndex }}][items][{{ $itemIndex }}][name]"
                                                        class="form-control form-control-sm" placeholder="React"
                                                        value="{{ $item['name'] ?? '' }}">
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label small">Icon Class / SVG</label>
                                                    <input type="text"
                                                        name="technology_groups[{{ $groupIndex }}][items][{{ $itemIndex }}][icon]"
                                                        class="form-control form-control-sm" placeholder="fab fa-react"
                                                        value="{{ $item['icon'] ?? '' }}">
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                                        onclick="removeTechnologyItem(this)"><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-success mt-2"
                                    onclick="addTechnologyItem(this)">
                                    <i class="fa fa-plus"></i> Add Technology
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>{{-- END S13 --}}

        {{-- ===================================================
         SECTION 14: OUR PROCESS
        ==================================================== --}}
        @php
            $process = old('s14_our_process', $page->s14_our_process ?? []);
            $s14Items = $process['items'] ?? [];
        @endphp
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🎯 Section 14 — Our Process</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s14_our_process[status]" id="s14Status" value="active" data-target="s14Body"
                            {{ old('s14_our_process.status', $page->s14_our_process['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s14Body"
                style="{{ old('s14_our_process.status', $page->s14_our_process['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section Heading</label>
                        <input type="text" name="s14_our_process[heading]" class="form-control"
                            value="{{ $process['heading'] ?? '' }}" placeholder="OUR PROCESS">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section Description</label>
                        <input type="text" name="s14_our_process[description]" class="form-control"
                            value="{{ $process['description'] ?? '' }}" placeholder="Short description about process">
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary">📋 Process Steps (Repeatable)</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addRow('s14-items', s14ItemTemplate)">
                        <i class="fa fa-plus"></i> Add Step
                    </button>
                </div>
                <div id="s14-items">
                    @if (!empty($s14Items))
                        @foreach ($s14Items as $key => $item)
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Step No</label>
                                        <input type="text" name="s14_items[{{ $key }}][step]"
                                            class="form-control form-control-sm" value="{{ $item['step'] ?? '' }}"
                                            placeholder="01">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label small">Title</label>
                                        <input type="text" name="s14_items[{{ $key }}][title]"
                                            class="form-control form-control-sm" value="{{ $item['title'] ?? '' }}"
                                            placeholder="Discovery & Planning">
                                    </div>
                                    <div class="col-md-5 mb-2">
                                        <label class="form-label small">Description</label>
                                        <textarea name="s14_items[{{ $key }}][description]" rows="2" class="form-control form-control-sm"
                                            placeholder="Short description...">{{ $item['description'] ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="repeat-row border rounded p-3 mb-2 bg-light">
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <label class="form-label small">Step No</label>
                                    <input type="text" name="s14_items[0][step]"
                                        class="form-control form-control-sm" placeholder="01">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="form-label small">Title</label>
                                    <input type="text" name="s14_items[0][title]"
                                        class="form-control form-control-sm" placeholder="Discovery & Planning">
                                </div>
                                <div class="col-md-5 mb-2">
                                    <label class="form-label small">Description</label>
                                    <textarea name="s14_items[0][description]" rows="2" class="form-control form-control-sm"
                                        placeholder="Short description..."></textarea>
                                </div>
                                <div class="col-md-1 d-flex align-items-end mb-2">
                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                        onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>{{-- END S14 --}}

        {{-- ===================================================
         SECTION 15: DEVELOPMENT PRICING TABLE
        ==================================================== --}}
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">💰 Section 15 — Development Pricing Table</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s15_development[status]" id="s15Status" value="active" data-target="s15Body"
                            {{ old('s15_development.status', $page->s15_development_items['status'] ?? '') === 'active' ? 'checked' : '' }}>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s15Body"
                style="{{ old('s15_development.status', $page->s15_development_items['status'] ?? '') !== 'active' ? 'display:none;' : '' }}">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s15_development[sub_title]" class="form-control"
                            placeholder="Our Pricing"
                            value="{{ old('s15_development.sub_title', $page->s15_development_items['sub_title'] ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Main Heading</label>
                        <input type="text" name="s15_development[heading]" class="form-control"
                            placeholder="What Is The Cost Of Best In Class Services?"
                            value="{{ old('s15_development.heading', $page->s15_development_items['heading'] ?? '') }}">
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0 text-primary">📦 Pricing Table Items</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        onclick="addRow('s15-development-items', s15DevelopmentTemplate)">
                        <i class="fa fa-plus"></i> Add More
                    </button>
                </div>
                <div id="s15-development-items">
                    @php $s15Items = old('s15_development_items', $page->s15_development_items['items'] ?? []); @endphp
                    @forelse($s15Items as $index => $item)
                        <div class="repeat-row border rounded p-3 mb-3 bg-light">
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <label class="form-label small">Title</label>
                                    <input type="text" name="s15_development_items[{{ $index }}][title]"
                                        class="form-control form-control-sm" placeholder="SEO"
                                        value="{{ $item['title'] ?? '' }}">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="form-label small">Heading</label>
                                    <input type="text" name="s15_development_items[{{ $index }}][heading]"
                                        class="form-control form-control-sm" placeholder="Search Engine Optimization"
                                        value="{{ $item['heading'] ?? '' }}">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label small">Price</label>
                                    <input type="text" name="s15_development_items[{{ $index }}][price]"
                                        class="form-control form-control-sm" placeholder="$250"
                                        value="{{ $item['price'] ?? '' }}">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label small">Category</label>
                                    <input type="text" name="s15_development_items[{{ $index }}][category]"
                                        class="form-control form-control-sm" placeholder="Search"
                                        value="{{ $item['category'] ?? '' }}">
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label class="form-label small">Button 1</label>
                                    <input type="text" name="s15_development_items[{{ $index }}][btn_one]"
                                        class="form-control form-control-sm" placeholder="Explore"
                                        value="{{ $item['btn_one'] ?? '' }}">
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label class="form-label small">Button 2</label>
                                    <input type="text" name="s15_development_items[{{ $index }}][btn_two]"
                                        class="form-control form-control-sm" placeholder="Contact"
                                        value="{{ $item['btn_two'] ?? '' }}">
                                </div>
                                <div class="col-md-1 d-flex align-items-end mb-2">
                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                        onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @empty
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
                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                        onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>{{-- END S15 --}}

        {{-- ===================================================
         SUBMIT
        ==================================================== --}}
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

    </form>{{-- FORM closes here --}}

    {{-- ===================================================
     GLOBAL SECTION TOGGLE JS
    ==================================================== --}}
    <script>
        document.querySelectorAll('.section-toggle').forEach(function(toggle) {
            toggle.addEventListener('change', function() {
                var target = document.getElementById(this.dataset.target);
                if (target) target.style.display = this.checked ? 'block' : 'none';
            });
        });
    </script>

    {{-- technologyGroupIndex must be set before scripts_edit is included --}}
    <script>
        let technologyGroupIndex = {{ count($technologyGroups) }};
    </script>

    @include('admin.digital_marketing.scripts_edit')

@endsection
