



<?php $__env->startSection('title', 'Edit Digital Marketing Page'); ?>

<?php $__env->startSection('content'); ?>

    
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.home')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dm.page.index')); ?>">Digital Marketing Pages</a></li>
        <li class="breadcrumb-item active">Edit Page</li>
    </ol>

    <h1 class="page-header">Edit Digital Marketing Page</h1>

    
    <form action="<?php echo e(route('admin.dm.page.update', $page->id)); ?>" method="POST" enctype="multipart/form-data" id="dmPageForm">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
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
                            <?php $__currentLoopData = App\Models\DmPage::headerMenus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>"
                                    <?php echo e(old('header_menu', $page->header_menu ?? '') == $key ? 'selected' : ''); ?>>
                                    <?php echo e($menu); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['header_menu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger small"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Service Type <span class="text-danger">*</span></label>
                        <select name="service_type" id="service_type" class="form-select">
                            <option value="">Select Service Type</option>
                            <?php
                                $selectedMenu = old('header_menu', $page->header_menu ?? '');
                                $types = App\Models\DmPage::serviceTypes();
                            ?>
                            <?php if(isset($types[$selectedMenu])): ?>
                                <?php $__currentLoopData = $types[$selectedMenu]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"
                                        <?php echo e(old('service_type', $page->service_type ?? '') == $key ? 'selected' : ''); ?>>
                                        <?php echo e($type); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                        <?php $__errorArgs = ['service_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger small"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Page Name <span class="text-danger">*</span></label>
                        <input type="text" name="page_name" class="form-control" placeholder="e.g. Digital Marketing"
                            value="<?php echo e($page->page_name ?? old('page_name')); ?>">
                        <?php $__errorArgs = ['page_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger small"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Page Slug <span class="text-danger">*</span></label>
                        <input type="text" name="page_slug" class="form-control" placeholder="e.g. digital-marketing"
                            value="<?php echo e($page->slug ?? old('page_slug')); ?>">
                        <small class="text-muted">Used in menu URL. Lowercase, hyphens only.</small>
                        <?php $__errorArgs = ['page_slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger small"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🏠 Section 1 — Get To Know Us (Banner)</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s1_banner[status]" id="s1Status" value="active" data-target="s1Body"
                            <?php echo e(old('s1_banner.status', $page->s1_banner['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s1Body"
                style="<?php echo e(old('s1_banner.status', $page->s1_banner['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s1_banner[sub_title]" class="form-control" placeholder="Get to Know Us"
                            value="<?php echo e(old('s1_banner.sub_title', $page->s1_banner['sub_title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="s1_banner[phone_number]" class="form-control"
                            placeholder="1-888-452-1505"
                            value="<?php echo e($page->s1_banner['phone_number'] ?? old('s1_banner.phone_number')); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Banner Title</label>
                        <input type="text" name="s1_banner[banner_title]" class="form-control"
                            placeholder="Driving Excellence Through Evolution & Trust."
                            value="<?php echo e($page->s1_banner['banner_title'] ?? old('s1_banner.banner_title')); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s1_banner[description]" rows="3" class="form-control" placeholder="Short description..."><?php echo e($page->s1_banner['description'] ?? old('s1_banner.description')); ?></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s1_banner[button_text]" class="form-control"
                            placeholder="Learn More"
                            value="<?php echo e($page->s1_banner['button_text'] ?? old('s1_banner.button_text')); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s1_banner[button_url]" class="form-control" placeholder="/contact"
                            value="<?php echo e($page->s1_banner['button_url'] ?? old('s1_banner.button_url')); ?>">
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
                    <?php if(!empty($page->s1_banner['logos'])): ?>
                        <?php $__currentLoopData = $page->s1_banner['logos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="repeat-row border rounded p-2 mb-2 bg-light">
                                <div class="row align-items-center">
                                    <div class="col-md-10">
                                        <label class="form-label small">Logo Image</label>
                                        <input type="file" name="s1_logos[<?php echo e($key); ?>][image]"
                                            class="form-control form-control-sm" accept="image/*">
                                        <?php if(!empty($logo['image'])): ?>
                                            <img src="<?php echo e(asset('storage/' . $logo['image'])); ?>" width="80"
                                                class="mt-2 border rounded">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-sm btn-danger w-100 mt-4"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🎯 Section 2 — Top Digital Marketing Services</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s2_top_services[status]" id="s2Status" value="active" data-target="s2Body"
                            <?php echo e(old('s2_top_services.status', $page->s2_top_services['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s2Body"
                style="<?php echo e(old('s2_top_services.status', $page->s2_top_services['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Section Heading</label>
                        <input type="text" name="s2_top_services[heading]" class="form-control"
                            placeholder="Top Digital Marketing Services"
                            value="<?php echo e(old('s2_top_services.heading', $page->s2_top_services['heading'] ?? '')); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Highlighted Brand Name</label>
                        <input type="text" name="s2_top_services[name]" class="form-control"
                            placeholder="Unify Wizards"
                            value="<?php echo e(old('s2_top_services.name', $page->s2_top_services['name'] ?? '')); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s2_top_services[description]" rows="2" class="form-control"
                            placeholder="Section description..."><?php echo e(old('s2_top_services.description', $page->s2_top_services['description'] ?? '')); ?></textarea>
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
                    <?php if(!empty($page->s2_top_services['items'])): ?>
                        <?php $__currentLoopData = $page->s2_top_services['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Title</label>
                                        <input type="text" name="s2_items[<?php echo e($key); ?>][title]"
                                            class="form-control form-control-sm" value="<?php echo e($item['title'] ?? ''); ?>"
                                            placeholder="SEO">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label small">Description</label>
                                        <textarea name="s2_items[<?php echo e($key); ?>][description]" rows="2" class="form-control form-control-sm"
                                            placeholder="Short description..."><?php echo e($item['description'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label small">URL</label>
                                        <input type="text" name="s2_items[<?php echo e($key); ?>][url]"
                                            class="form-control form-control-sm" value="<?php echo e($item['url'] ?? ''); ?>"
                                            placeholder="/services/seo">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🏭 Section 3 — Industries We Serve</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s3_industries[status]" id="s3Status" value="active" data-target="s3Body"
                            <?php echo e(old('s3_industries.status', $page->s3_industries['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s3Body"
                style="<?php echo e(old('s3_industries.status', $page->s3_industries['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s3_industries[sub_title]" class="form-control"
                            placeholder="Industries We Serve"
                            value="<?php echo e(old('s3_industries.sub_title', $page->s3_industries['sub_title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s3_industries[heading]" class="form-control"
                            placeholder="Focused experience across high-impact industries"
                            value="<?php echo e(old('s3_industries.heading', $page->s3_industries['heading'] ?? '')); ?>">
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
                    <?php if(!empty($page->s3_industries['items'])): ?>
                        <?php $__currentLoopData = $page->s3_industries['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Icon Class</label>
                                        <input type="text" name="s3_items[<?php echo e($key); ?>][icon]"
                                            class="form-control form-control-sm" value="<?php echo e($item['icon'] ?? ''); ?>"
                                            placeholder="fa fa-thin fa-magic-wand-sparkles">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Color Class</label>
                                        <select name="s3_items[<?php echo e($key); ?>][color_class]"
                                            class="form-select form-select-sm">
                                            <option value="google-blue"
                                                <?php echo e(($item['color_class'] ?? '') == 'google-blue' ? 'selected' : ''); ?>>
                                                Google Blue</option>
                                            <option value="google-red"
                                                <?php echo e(($item['color_class'] ?? '') == 'google-red' ? 'selected' : ''); ?>>Google
                                                Red</option>
                                            <option value="google-yellow"
                                                <?php echo e(($item['color_class'] ?? '') == 'google-yellow' ? 'selected' : ''); ?>>
                                                Google Yellow</option>
                                            <option value="google-green"
                                                <?php echo e(($item['color_class'] ?? '') == 'google-green' ? 'selected' : ''); ?>>
                                                Google Green</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Name</label>
                                        <input type="text" name="s3_items[<?php echo e($key); ?>][name]"
                                            class="form-control form-control-sm" value="<?php echo e($item['name'] ?? ''); ?>"
                                            placeholder="Makeup">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label small">Description</label>
                                        <input type="text" name="s3_items[<?php echo e($key); ?>][description]"
                                            class="form-control form-control-sm" value="<?php echo e($item['description'] ?? ''); ?>"
                                            placeholder="Short description">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">📊 Section 4 — Get to Know Us (About)</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s4_about[status]" id="s4Status" value="active" data-target="s4Body"
                            <?php echo e(old('s4_about.status', $page->s4_about['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s4Body"
                style="<?php echo e(old('s4_about.status', $page->s4_about['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s4_about[sub_title]" class="form-control"
                            placeholder="Get to Know Us"
                            value="<?php echo e(old('s4_about.sub_title', $page->s4_about['sub_title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section Title</label>
                        <input type="text" name="s4_about[title]" class="form-control"
                            placeholder="Committed Delivering Our Measurable Result"
                            value="<?php echo e(old('s4_about.title', $page->s4_about['title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Counter Number</label>
                        <input type="text" name="s4_about[counter_number]" class="form-control" placeholder="30"
                            value="<?php echo e(old('s4_about.counter_number', $page->s4_about['counter_number'] ?? '')); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Counter Suffix</label>
                        <input type="text" name="s4_about[counter_suffix]" class="form-control" placeholder="+"
                            value="<?php echo e(old('s4_about.counter_suffix', $page->s4_about['counter_suffix'] ?? '+')); ?>">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Counter Label</label>
                        <input type="text" name="s4_about[counter_label]" class="form-control"
                            placeholder="Years of Corporate Experience."
                            value="<?php echo e(old('s4_about.counter_label', $page->s4_about['counter_label'] ?? '')); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Description Paragraph 1</label>
                        <textarea name="s4_about[description_1]" rows="3" class="form-control" placeholder="First paragraph..."><?php echo e(old('s4_about.description_1', $page->s4_about['description_1'] ?? '')); ?></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Description Paragraph 2</label>
                        <textarea name="s4_about[description_2]" rows="3" class="form-control" placeholder="Second paragraph..."><?php echo e(old('s4_about.description_2', $page->s4_about['description_2'] ?? '')); ?></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section Image</label>
                        <input type="file" name="s4_about[image]" class="form-control" accept="image/*">
                        <?php if(!empty($page->s4_about['image_path'])): ?>
                            <img src="<?php echo e(asset('storage/' . $page->s4_about['image_path'])); ?>" width="120"
                                class="mt-2 border rounded">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s4_about[button_text]" class="form-control" placeholder="Learn More"
                            value="<?php echo e(old('s4_about.button_text', $page->s4_about['button_text'] ?? '')); ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s4_about[button_url]" class="form-control" placeholder="/about"
                            value="<?php echo e(old('s4_about.button_url', $page->s4_about['button_url'] ?? '')); ?>">
                    </div>
                </div>
            </div>
        </div>

        
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">⭐ Section 5 — Testimonials</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s5_testimonials[status]" id="s5Status" value="active" data-target="s5Body"
                            <?php echo e(old('s5_testimonials.status', $page->s5_testimonials['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s5Body"
                style="<?php echo e(old('s5_testimonials.status', $page->s5_testimonials['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s5_testimonials[sub_title]" class="form-control"
                            placeholder="Clients Testimonials"
                            value="<?php echo e(old('s5_testimonials.sub_title', $page->s5_testimonials['sub_title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s5_testimonials[heading]" class="form-control"
                            placeholder="Our Trusted Clients."
                            value="<?php echo e(old('s5_testimonials.heading', $page->s5_testimonials['heading'] ?? '')); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Background Video</label>
                        <input type="file" name="s5_testimonials[video]" class="form-control" accept="video/*">
                        <?php if(!empty($page->s5_testimonials['video_path'])): ?>
                            <div class="mt-2"><video width="150" controls>
                                    <source src="<?php echo e(asset('storage/' . $page->s5_testimonials['video_path'])); ?>">
                                </video></div>
                        <?php endif; ?>
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
                    <?php if(!empty($page->s5_testimonials['items'])): ?>
                        <?php $__currentLoopData = $page->s5_testimonials['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-1 mb-2">
                                        <label class="form-label small">Stars</label>
                                        <select name="s5_items[<?php echo e($key); ?>][stars]"
                                            class="form-select form-select-sm">
                                            <option value="5" <?php echo e(($item['stars'] ?? '') == '5' ? 'selected' : ''); ?>>5
                                                ★</option>
                                            <option value="4" <?php echo e(($item['stars'] ?? '') == '4' ? 'selected' : ''); ?>>4
                                                ★</option>
                                            <option value="3" <?php echo e(($item['stars'] ?? '') == '3' ? 'selected' : ''); ?>>3
                                                ★</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5 mb-2">
                                        <label class="form-label small">Testimonial Text</label>
                                        <textarea name="s5_items[<?php echo e($key); ?>][description]" rows="3" class="form-control form-control-sm"
                                            placeholder="Write testimonial text here..."><?php echo e($item['description'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Client Name</label>
                                        <input type="text" name="s5_items[<?php echo e($key); ?>][name]"
                                            class="form-control form-control-sm" value="<?php echo e($item['name'] ?? ''); ?>"
                                            placeholder="Nathaniel Ellington">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Designation</label>
                                        <input type="text" name="s5_items[<?php echo e($key); ?>][designation]"
                                            class="form-control form-control-sm" value="<?php echo e($item['designation'] ?? ''); ?>"
                                            placeholder="Chief Executive">
                                    </div>
                                    <div class="col-md-1 mb-2">
                                        <label class="form-label small">Avatar</label>
                                        <input type="file" name="s5_items[<?php echo e($key); ?>][avatar]"
                                            class="form-control form-control-sm" accept="image/*">
                                        <?php if(!empty($item['avatar_path'])): ?>
                                            <img src="<?php echo e(asset('storage/' . $item['avatar_path'])); ?>" width="50"
                                                class="mt-2 rounded border">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
         <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🏢 Section 6 — Our Company</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s6_our_company[status]" id="s6Status" value="active" data-target="s6Body"
                            <?php echo e(old('s6_our_company.status', $page->s6_our_company['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s6Body"
                style="<?php echo e(old('s6_our_company.status', $page->s6_our_company['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s6_our_company[sub_title]" class="form-control"
                            placeholder="OUR COMPANY"
                            value="<?php echo e(old('s6_our_company.sub_title', $page->s6_our_company['sub_title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="s6_our_company[title]" class="form-control"
                            placeholder="Innovating Today for Build Smarter, Stronger."
                            value="<?php echo e(old('s6_our_company.title', $page->s6_our_company['title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description Paragraph 1</label>
                        <textarea name="s6_our_company[description_1]" rows="5" class="form-control summernote" id="summernote"
                            placeholder="Paragraph 1..."><?php echo e(old('s6_our_company.description_1', $page->s6_our_company['description_1'] ?? '')); ?></textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Section Image</label>
                        <input type="file" name="s6_our_company[image]" class="form-control" accept="image/*">
                        <?php if(!empty($page->s6_our_company['image_path'])): ?>
                            <img src="<?php echo e(asset('storage/' . $page->s6_our_company['image_path'])); ?>" width="120"
                                class="mt-2 border rounded">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s6_our_company[button_text]" class="form-control"
                            placeholder="Know More Us"
                            value="<?php echo e(old('s6_our_company.button_text', $page->s6_our_company['button_text'] ?? '')); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s6_our_company[button_url]" class="form-control"
                            placeholder="/contact"
                            value="<?php echo e(old('s6_our_company.button_url', $page->s6_our_company['button_url'] ?? '')); ?>">
                    </div>
                </div>
            </div>
        </div>
        
       <?php $__env->startPush('css'); ?>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
    <?php $__env->stopPush(); ?>
        
        <?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
        
        
        
        
        
        
        

        
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🚀 Section 7 — Proud Projects</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s7_proud_projects[status]" id="s7Status" value="active" data-target="s7Body"
                            <?php echo e(old('s7_proud_projects.status', $page->s7_proud_projects['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s7Body"
                style="<?php echo e(old('s7_proud_projects.status', $page->s7_proud_projects['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s7_proud_projects[sub_title]" class="form-control"
                            placeholder="Proud Projects"
                            value="<?php echo e(old('s7_proud_projects.sub_title', $page->s7_proud_projects['sub_title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="s7_proud_projects[title]" class="form-control"
                            placeholder="Breaking Boundaries, Building Dreams."
                            value="<?php echo e(old('s7_proud_projects.title', $page->s7_proud_projects['title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s7_proud_projects[button_text]" class="form-control"
                            placeholder="More Projects"
                            value="<?php echo e(old('s7_proud_projects.button_text', $page->s7_proud_projects['button_text'] ?? '')); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s7_proud_projects[button_url]" class="form-control"
                            placeholder="/portfolio"
                            value="<?php echo e(old('s7_proud_projects.button_url', $page->s7_proud_projects['button_url'] ?? '')); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s7_proud_projects[description]" rows="2" class="form-control"
                            placeholder="We work closely with our clients..."><?php echo e(old('s7_proud_projects.description', $page->s7_proud_projects['description'] ?? '')); ?></textarea>
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
                    <?php if(!empty($page->s7_proud_projects['items'])): ?>
                        <?php $__currentLoopData = $page->s7_proud_projects['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Project Image</label>
                                        <input type="file" name="s7_items[<?php echo e($key); ?>][image]"
                                            class="form-control form-control-sm" accept="image/*">
                                        <?php if(!empty($item['image_path'])): ?>
                                            <img src="<?php echo e(asset('storage/' . $item['image_path'])); ?>" width="80"
                                                class="mt-2 border rounded">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Category</label>
                                        <input type="text" name="s7_items[<?php echo e($key); ?>][category]"
                                            class="form-control form-control-sm" value="<?php echo e($item['category'] ?? ''); ?>"
                                            placeholder="Connect">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label small">Project Name</label>
                                        <input type="text" name="s7_items[<?php echo e($key); ?>][name]"
                                            class="form-control form-control-sm" value="<?php echo e($item['name'] ?? ''); ?>"
                                            placeholder="Event Management Platform">
                                    </div>
                                    <div class="col-md-1 mb-2">
                                        <label class="form-label small">Link URL</label>
                                        <input type="text" name="s7_items[<?php echo e($key); ?>][link_url]"
                                            class="form-control form-control-sm" value="<?php echo e($item['link_url'] ?? ''); ?>"
                                            placeholder="/portfolio/1">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">⚡ Section 8 — Powered By (Agency Software)</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s8_powered_by[status]" id="s8Status" value="active" data-target="s8Body"
                            <?php echo e(old('s8_powered_by.status', $page->s8_powered_by['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s8Body"
                style="<?php echo e(old('s8_powered_by.status', $page->s8_powered_by['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s8_powered_by[sub_title]" class="form-control"
                            placeholder="Powered By"
                            value="<?php echo e(old('s8_powered_by.sub_title', $page->s8_powered_by['sub_title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s8_powered_by[heading]" class="form-control"
                            placeholder="The World's Most Advanced Agency Software"
                            value="<?php echo e(old('s8_powered_by.heading', $page->s8_powered_by['heading'] ?? '')); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s8_powered_by[button_text]" class="form-control"
                            placeholder="More Services"
                            value="<?php echo e(old('s8_powered_by.button_text', $page->s8_powered_by['button_text'] ?? '')); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s8_powered_by[button_url]" class="form-control"
                            placeholder="/services"
                            value="<?php echo e(old('s8_powered_by.button_url', $page->s8_powered_by['button_url'] ?? '')); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s8_powered_by[description]" rows="2" class="form-control" placeholder="Description..."><?php echo e(old('s8_powered_by.description', $page->s8_powered_by['description'] ?? '')); ?></textarea>
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
                    <?php if(!empty($page->s8_powered_by['items'])): ?>
                        <?php $__currentLoopData = $page->s8_powered_by['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Icon Class</label>
                                        <input type="text" name="s8_items[<?php echo e($key); ?>][icon]"
                                            class="form-control form-control-sm" value="<?php echo e($item['icon'] ?? ''); ?>"
                                            placeholder="tji-service-1">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Heading</label>
                                        <input type="text" name="s8_items[<?php echo e($key); ?>][heading]"
                                            class="form-control form-control-sm" value="<?php echo e($item['heading'] ?? ''); ?>"
                                            placeholder="Integrations...">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Description</label>
                                        <textarea name="s8_items[<?php echo e($key); ?>][description]" rows="2" class="form-control form-control-sm"
                                            placeholder="(Google Analytics...)"><?php echo e($item['description'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Background Image</label>
                                        <input type="file" name="s8_items[<?php echo e($key); ?>][image]"
                                            class="form-control form-control-sm" accept="image/*">
                                        <?php if(!empty($item['image_path'])): ?>
                                            <img src="<?php echo e(asset('storage/' . $item['image_path'])); ?>" width="70"
                                                class="mt-2 border rounded">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-1 mb-2">
                                        <label class="form-label small">Link</label>
                                        <input type="text" name="s8_items[<?php echo e($key); ?>][link_url]"
                                            class="form-control form-control-sm" value="<?php echo e($item['link_url'] ?? ''); ?>"
                                            placeholder="/service-details">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">💡 Section 9 — Who Should Invest</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s9_who_should_invest[status]" id="s9Status" value="active" data-target="s9Body"
                            <?php echo e(old('s9_who_should_invest.status', $page->s9_who_should_invest['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s9Body"
                style="<?php echo e(old('s9_who_should_invest.status', $page->s9_who_should_invest['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Chip Label</label>
                        <input type="text" name="s9_who_should_invest[chip_label]" class="form-control"
                            placeholder="Who Should Invest"
                            value="<?php echo e(old('s9_who_should_invest.chip_label', $page->s9_who_should_invest['chip_label'] ?? '')); ?>">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s9_who_should_invest[heading]" class="form-control"
                            placeholder="Who Should Invest In Digital Marketing?"
                            value="<?php echo e(old('s9_who_should_invest.heading', $page->s9_who_should_invest['heading'] ?? '')); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Intro Description</label>
                        <textarea name="s9_who_should_invest[description]" rows="3" class="form-control"
                            placeholder="Every business needs a good strategy..."><?php echo e(old('s9_who_should_invest.description', $page->s9_who_should_invest['description'] ?? '')); ?></textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Questions Label</label>
                        <input type="text" name="s9_who_should_invest[questions_label]" class="form-control"
                            placeholder="5 quick questions to ask yourself:"
                            value="<?php echo e(old('s9_who_should_invest.questions_label', $page->s9_who_should_invest['questions_label'] ?? '')); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Divider Label</label>
                        <input type="text" name="s9_who_should_invest[divider_label]" class="form-control"
                            placeholder="If you answered 'no' to any of the above"
                            value="<?php echo e(old('s9_who_should_invest.divider_label', $page->s9_who_should_invest['divider_label'] ?? '')); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s9_who_should_invest[button_text]" class="form-control"
                            placeholder="Learn More"
                            value="<?php echo e(old('s9_who_should_invest.button_text', $page->s9_who_should_invest['button_text'] ?? '')); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s9_who_should_invest[button_url]" class="form-control"
                            placeholder="#"
                            value="<?php echo e(old('s9_who_should_invest.button_url', $page->s9_who_should_invest['button_url'] ?? '')); ?>">
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
                    <?php if(!empty($page->s9_who_should_invest['questions'])): ?>
                        <?php $__currentLoopData = $page->s9_who_should_invest['questions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Icon (Emoji)</label>
                                        <input type="text" name="s9_questions[<?php echo e($key); ?>][icon]"
                                            class="form-control form-control-sm" value="<?php echo e($question['icon'] ?? ''); ?>"
                                            placeholder="🧭">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Color Class</label>
                                        <select name="s9_questions[<?php echo e($key); ?>][color_class]"
                                            class="form-select form-select-sm">
                                            <option value="wsi__q-card--blue"
                                                <?php echo e(($question['color_class'] ?? '') == 'wsi__q-card--blue' ? 'selected' : ''); ?>>
                                                Blue</option>
                                            <option value="wsi__q-card--red"
                                                <?php echo e(($question['color_class'] ?? '') == 'wsi__q-card--red' ? 'selected' : ''); ?>>
                                                Red</option>
                                            <option value="wsi__q-card--yellow"
                                                <?php echo e(($question['color_class'] ?? '') == 'wsi__q-card--yellow' ? 'selected' : ''); ?>>
                                                Yellow</option>
                                            <option value="wsi__q-card--green"
                                                <?php echo e(($question['color_class'] ?? '') == 'wsi__q-card--green' ? 'selected' : ''); ?>>
                                                Green</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7 mb-2">
                                        <label class="form-label small">Question Text</label>
                                        <input type="text" name="s9_questions[<?php echo e($key); ?>][heading]"
                                            class="form-control form-control-sm"
                                            value="<?php echo e($question['heading'] ?? ''); ?>"
                                            placeholder="Do you have a vision for your business...">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
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
                    <?php if(!empty($page->s9_who_should_invest['answers'])): ?>
                        <?php $__currentLoopData = $page->s9_who_should_invest['answers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Accent Color</label>
                                        <select name="s9_answers[<?php echo e($key); ?>][accent_color]"
                                            class="form-select form-select-sm">
                                            <option value="green"
                                                <?php echo e(($answer['accent_color'] ?? '') == 'green' ? 'selected' : ''); ?>>Green
                                            </option>
                                            <option value="blue"
                                                <?php echo e(($answer['accent_color'] ?? '') == 'blue' ? 'selected' : ''); ?>>Blue
                                            </option>
                                            <option value="red"
                                                <?php echo e(($answer['accent_color'] ?? '') == 'red' ? 'selected' : ''); ?>>Red
                                            </option>
                                            <option value="yellow"
                                                <?php echo e(($answer['accent_color'] ?? '') == 'yellow' ? 'selected' : ''); ?>>Yellow
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Heading</label>
                                        <input type="text" name="s9_answers[<?php echo e($key); ?>][heading]"
                                            class="form-control form-control-sm"
                                            value="<?php echo e($answer['heading'] ?? ''); ?>" placeholder="Clear Goals & Action">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label small">Description</label>
                                        <textarea name="s9_answers[<?php echo e($key); ?>][description]" rows="2"
                                            class="form-control form-control-sm" placeholder="Ensuring your business's success..."><?php echo e($answer['description'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">✅ Section 10 — Why Choose Us</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s10_why_choose[status]" id="s10Status" value="active" data-target="s10Body"
                            <?php echo e(old('s10_why_choose.status', $page->s10_why_choose['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s10Body"
                style="<?php echo e(old('s10_why_choose.status', $page->s10_why_choose['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="s10_why_choose[title]" class="form-control"
                            placeholder="Why Choose Unify Wizards?"
                            value="<?php echo e(old('s10_why_choose.title', $page->s10_why_choose['title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s10_why_choose[sub_title]" class="form-control"
                            placeholder="Boost Your Growth Rate"
                            value="<?php echo e(old('s10_why_choose.sub_title', $page->s10_why_choose['sub_title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Intro Description</label>
                        <textarea name="s10_why_choose[description]" rows="3" class="form-control"
                            placeholder="Unify Wizards is a results-driven digital agency..."><?php echo e(old('s10_why_choose.description', $page->s10_why_choose['description'] ?? '')); ?></textarea>
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
                    <?php if(!empty($page->s10_why_choose['items'])): ?>
                        <?php $__currentLoopData = $page->s10_why_choose['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Color Class</label>
                                        <select name="s10_items[<?php echo e($key); ?>][color_class]"
                                            class="form-select form-select-sm">
                                            <option value="uw-blue"
                                                <?php echo e(($item['color_class'] ?? '') == 'uw-blue' ? 'selected' : ''); ?>>Blue
                                            </option>
                                            <option value="uw-red"
                                                <?php echo e(($item['color_class'] ?? '') == 'uw-red' ? 'selected' : ''); ?>>Red
                                            </option>
                                            <option value="uw-yellow"
                                                <?php echo e(($item['color_class'] ?? '') == 'uw-yellow' ? 'selected' : ''); ?>>Yellow
                                            </option>
                                            <option value="uw-green"
                                                <?php echo e(($item['color_class'] ?? '') == 'uw-green' ? 'selected' : ''); ?>>Green
                                            </option>
                                            <option value="uw-google-green"
                                                <?php echo e(($item['color_class'] ?? '') == 'uw-google-green' ? 'selected' : ''); ?>>
                                                Google Green</option>
                                            <option value="uw-google-orange"
                                                <?php echo e(($item['color_class'] ?? '') == 'uw-google-orange' ? 'selected' : ''); ?>>
                                                Orange</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Icon SVG / Class</label>
                                        <textarea name="s10_items[<?php echo e($key); ?>][icon_svg]" rows="2" class="form-control form-control-sm"
                                            placeholder="Paste raw SVG markup here..."><?php echo e($item['icon_svg'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Heading</label>
                                        <input type="text" name="s10_items[<?php echo e($key); ?>][heading]"
                                            class="form-control form-control-sm" value="<?php echo e($item['heading'] ?? ''); ?>"
                                            placeholder="Data-Driven Results">
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Description</label>
                                        <textarea name="s10_items[<?php echo e($key); ?>][description]" rows="2" class="form-control form-control-sm"
                                            placeholder="We use advanced analytics..."><?php echo e($item['description'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🪄 Section 11 — The Wizards Spell</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s11_wizards_spell[status]" id="s11Status" value="active" data-target="s11Body"
                            <?php echo e(old('s11_wizards_spell.status', $page->s11_wizards_spell['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s11Body"
                style="<?php echo e(old('s11_wizards_spell.status', $page->s11_wizards_spell['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s11_wizards_spell[heading]" class="form-control"
                            placeholder="The Wizards Spell"
                            value="<?php echo e(old('s11_wizards_spell.heading', $page->s11_wizards_spell['heading'] ?? '')); ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s11_wizards_spell[button_text]" class="form-control"
                            placeholder="Learn About Us"
                            value="<?php echo e(old('s11_wizards_spell.button_text', $page->s11_wizards_spell['button_text'] ?? '')); ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s11_wizards_spell[button_url]" class="form-control"
                            placeholder="/about"
                            value="<?php echo e(old('s11_wizards_spell.button_url', $page->s11_wizards_spell['button_url'] ?? '')); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s11_wizards_spell[description]" rows="3" class="form-control"
                            placeholder="The Wizards Spell is how we turn vision into measurable growth..."><?php echo e(old('s11_wizards_spell.description', $page->s11_wizards_spell['description'] ?? '')); ?></textarea>
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
                    <?php if(!empty($page->s11_wizards_spell['cards'])): ?>
                        <?php $__currentLoopData = $page->s11_wizards_spell['cards']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Card Color Class</label>
                                        <select name="s11_cards[<?php echo e($key); ?>][color_class]"
                                            class="form-select form-select-sm">
                                            <option value="atm-card-0"
                                                <?php echo e(($card['color_class'] ?? '') == 'atm-card-0' ? 'selected' : ''); ?>>Blue
                                                (Discover)
                                            </option>
                                            <option value="atm-card-1"
                                                <?php echo e(($card['color_class'] ?? '') == 'atm-card-1' ? 'selected' : ''); ?>>Red
                                                (Create)</option>
                                            <option value="atm-card-2"
                                                <?php echo e(($card['color_class'] ?? '') == 'atm-card-2' ? 'selected' : ''); ?>>
                                                Yellow (Grow)</option>
                                            <option value="atm-card-3"
                                                <?php echo e(($card['color_class'] ?? '') == 'atm-card-3' ? 'selected' : ''); ?>>Green
                                                (Optimise)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Name / Label</label>
                                        <input type="text" name="s11_cards[<?php echo e($key); ?>][name]"
                                            class="form-control form-control-sm" value="<?php echo e($card['name'] ?? ''); ?>"
                                            placeholder="Discover">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label small">Icon SVG</label>
                                        <textarea name="s11_cards[<?php echo e($key); ?>][icon_svg]" rows="2" class="form-control form-control-sm"
                                            placeholder="Paste raw SVG markup here..."><?php echo e($card['icon_svg'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small">Description</label>
                                        <textarea name="s11_cards[<?php echo e($key); ?>][description]" rows="2" class="form-control form-control-sm"
                                            placeholder="The best brands improve, not settle..."><?php echo e($card['description'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">📣 Section 12 — CTA (Call To Action)</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s12_cta[status]" id="s12Status" value="active" data-target="s12Body"
                            <?php echo e(old('s12_cta.status', $page->s12_cta['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s12Body"
                style="<?php echo e(old('s12_cta.status', $page->s12_cta['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Eyebrow (small label above heading)</label>
                        <input type="text" name="s12_cta[sub_title]" class="form-control"
                            placeholder="Let's Work Together"
                            value="<?php echo e(old('s12_cta.sub_title', $page->s12_cta['sub_title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Heading</label>
                        <input type="text" name="s12_cta[heading]" class="form-control"
                            placeholder="Let's Build Future Together."
                            value="<?php echo e(old('s12_cta.heading', $page->s12_cta['heading'] ?? '')); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="s12_cta[description]" rows="1" class="form-control"
                            placeholder="Short supporting line under the heading"><?php echo e(old('s12_cta.description', $page->s12_cta['description'] ?? '')); ?></textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="s12_cta[button_text]" class="form-control"
                            placeholder="Get Started Now"
                            value="<?php echo e(old('s12_cta.button_text', $page->s12_cta['button_text'] ?? '')); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Button URL</label>
                        <input type="text" name="s12_cta[button_url]" class="form-control" placeholder="/contact"
                            value="<?php echo e(old('s12_cta.button_url', $page->s12_cta['button_url'] ?? '')); ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Background Image</label>
                        <input type="file" name="s12_cta[image]" class="form-control" accept="image/*">
                        <?php if(!empty($page->s12_cta['image_path'])): ?>
                            <div class="mt-2"><img src="<?php echo e(asset('storage/' . $page->s12_cta['image_path'])); ?>"
                                    width="100" class="img-thumbnail"></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        
        <?php
            $s13 = $page->s13_technologies ?? [];
            $technologyGroups = $s13['technology_groups'] ?? [];
        ?>
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">✅ Section 13 — Technologies</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s13_technologies[status]" id="s13Status" value="active" data-target="s13Body"
                            <?php echo e(old('s13_technologies.status', $page->s13_technologies['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s13Body"
                style="<?php echo e(old('s13_technologies.status', $page->s13_technologies['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="s13_technologies[title]" class="form-control"
                            placeholder="Technologies We Work With"
                            value="<?php echo e(old('s13_technologies.title', $s13['title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s13_technologies[sub_title]" class="form-control"
                            placeholder="Modern Tools & Frameworks"
                            value="<?php echo e(old('s13_technologies.sub_title', $s13['sub_title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Intro Description</label>
                        <textarea name="s13_technologies[description]" rows="3" class="form-control"
                            placeholder="We use modern frontend and backend technologies..."><?php echo e(old('s13_technologies.description', $s13['description'] ?? '')); ?></textarea>
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
                    <?php if(!empty($technologyGroups)): ?>
                        <?php $__currentLoopData = $technologyGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupIndex => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="repeat-row border rounded p-3 mb-3 bg-light technology-group">
                                <div class="row">
                                    <div class="col-md-5 mb-3">
                                        <label class="form-label fw-bold">Technology Heading</label>
                                        <input type="text" name="technology_groups[<?php echo e($groupIndex); ?>][heading]"
                                            class="form-control" placeholder="Frontend"
                                            value="<?php echo e($group['heading'] ?? ''); ?>">
                                    </div>
                                    <div class="col-md-2 mb-3 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger w-100"
                                            onclick="removeTechnologyGroup(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                                <div class="technology-items">
                                    <?php if(!empty($group['items'])): ?>
                                        <?php $__currentLoopData = $group['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemIndex => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="row technology-item mb-2">
                                                <div class="col-md-5">
                                                    <label class="form-label small">Technology Name</label>
                                                    <input type="text"
                                                        name="technology_groups[<?php echo e($groupIndex); ?>][items][<?php echo e($itemIndex); ?>][name]"
                                                        class="form-control form-control-sm" placeholder="React"
                                                        value="<?php echo e($item['name'] ?? ''); ?>">
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label small">Icon Class / SVG</label>
                                                    <input type="text"
                                                        name="technology_groups[<?php echo e($groupIndex); ?>][items][<?php echo e($itemIndex); ?>][icon]"
                                                        class="form-control form-control-sm" placeholder="fab fa-react"
                                                        value="<?php echo e($item['icon'] ?? ''); ?>">
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                                        onclick="removeTechnologyItem(this)"><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-success mt-2"
                                    onclick="addTechnologyItem(this)">
                                    <i class="fa fa-plus"></i> Add Technology
                                </button>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <?php
            $process = old('s14_our_process', $page->s14_our_process ?? []);
            $s14Items = $process['items'] ?? [];
        ?>
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">🎯 Section 14 — Our Process</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s14_our_process[status]" id="s14Status" value="active" data-target="s14Body"
                            <?php echo e(old('s14_our_process.status', $page->s14_our_process['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s14Body"
                style="<?php echo e(old('s14_our_process.status', $page->s14_our_process['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section Heading</label>
                        <input type="text" name="s14_our_process[heading]" class="form-control"
                            value="<?php echo e($process['heading'] ?? ''); ?>" placeholder="OUR PROCESS">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section Description</label>
                        <input type="text" name="s14_our_process[description]" class="form-control"
                            value="<?php echo e($process['description'] ?? ''); ?>" placeholder="Short description about process">
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
                    <?php if(!empty($s14Items)): ?>
                        <?php $__currentLoopData = $s14Items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="repeat-row border rounded p-3 mb-2 bg-light">
                                <div class="row">
                                    <div class="col-md-2 mb-2">
                                        <label class="form-label small">Step No</label>
                                        <input type="text" name="s14_items[<?php echo e($key); ?>][step]"
                                            class="form-control form-control-sm" value="<?php echo e($item['step'] ?? ''); ?>"
                                            placeholder="01">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label small">Title</label>
                                        <input type="text" name="s14_items[<?php echo e($key); ?>][title]"
                                            class="form-control form-control-sm" value="<?php echo e($item['title'] ?? ''); ?>"
                                            placeholder="Discovery & Planning">
                                    </div>
                                    <div class="col-md-5 mb-2">
                                        <label class="form-label small">Description</label>
                                        <textarea name="s14_items[<?php echo e($key); ?>][description]" rows="2" class="form-control form-control-sm"
                                            placeholder="Short description..."><?php echo e($item['description'] ?? ''); ?></textarea>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end mb-2">
                                        <button type="button" class="btn btn-sm btn-danger w-100"
                                            onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">💰 Section 15 — Development Pricing Table</h4>
                <div class="panel-heading-btn d-flex align-items-center gap-2">
                    <div class="form-check form-switch mb-0 me-2">
                        <input class="form-check-input section-toggle" type="checkbox" role="switch"
                            name="s15_development[status]" id="s15Status" value="active" data-target="s15Body"
                            <?php echo e(old('s15_development.status', $page->s15_development_items['status'] ?? '') === 'active' ? 'checked' : ''); ?>>
                    </div>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                            class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body" id="s15Body"
                style="<?php echo e(old('s15_development.status', $page->s15_development_items['status'] ?? '') !== 'active' ? 'display:none;' : ''); ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Title</label>
                        <input type="text" name="s15_development[sub_title]" class="form-control"
                            placeholder="Our Pricing"
                            value="<?php echo e(old('s15_development.sub_title', $page->s15_development_items['sub_title'] ?? '')); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Main Heading</label>
                        <input type="text" name="s15_development[heading]" class="form-control"
                            placeholder="What Is The Cost Of Best In Class Services?"
                            value="<?php echo e(old('s15_development.heading', $page->s15_development_items['heading'] ?? '')); ?>">
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
                    <?php $s15Items = old('s15_development_items', $page->s15_development_items['items'] ?? []); ?>
                    <?php $__empty_1 = true; $__currentLoopData = $s15Items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="repeat-row border rounded p-3 mb-3 bg-light">
                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <label class="form-label small">Title</label>
                                    <input type="text" name="s15_development_items[<?php echo e($index); ?>][title]"
                                        class="form-control form-control-sm" placeholder="SEO"
                                        value="<?php echo e($item['title'] ?? ''); ?>">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="form-label small">Heading</label>
                                    <input type="text" name="s15_development_items[<?php echo e($index); ?>][heading]"
                                        class="form-control form-control-sm" placeholder="Search Engine Optimization"
                                        value="<?php echo e($item['heading'] ?? ''); ?>">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label small">Price</label>
                                    <input type="text" name="s15_development_items[<?php echo e($index); ?>][price]"
                                        class="form-control form-control-sm" placeholder="$250"
                                        value="<?php echo e($item['price'] ?? ''); ?>">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label small">Category</label>
                                    <input type="text" name="s15_development_items[<?php echo e($index); ?>][category]"
                                        class="form-control form-control-sm" placeholder="Search"
                                        value="<?php echo e($item['category'] ?? ''); ?>">
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label class="form-label small">Button 1</label>
                                    <input type="text" name="s15_development_items[<?php echo e($index); ?>][btn_one]"
                                        class="form-control form-control-sm" placeholder="Explore"
                                        value="<?php echo e($item['btn_one'] ?? ''); ?>">
                                </div>
                                <div class="col-md-1 mb-2">
                                    <label class="form-label small">Button 2</label>
                                    <input type="text" name="s15_development_items[<?php echo e($index); ?>][btn_two]"
                                        class="form-control form-control-sm" placeholder="Contact"
                                        value="<?php echo e($item['btn_two'] ?? ''); ?>">
                                </div>
                                <div class="col-md-1 d-flex align-items-end mb-2">
                                    <button type="button" class="btn btn-sm btn-danger w-100"
                                        onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="panel panel-inverse">
            <div class="panel-body">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fa fa-save me-1"></i> Save All Sections
                    </button>
                    <a href="<?php echo e(route('admin.dm.page.index')); ?>" class="btn btn-secondary btn-lg">
                        <i class="fa fa-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>
        </div>

    </form>

    
    <script>
        document.querySelectorAll('.section-toggle').forEach(function(toggle) {
            toggle.addEventListener('change', function() {
                var target = document.getElementById(this.dataset.target);
                if (target) target.style.display = this.checked ? 'block' : 'none';
            });
        });
    </script>

    
    <script>
        let technologyGroupIndex = <?php echo e(count($technologyGroups)); ?>;
    </script>

    <?php echo $__env->make('admin.digital_marketing.scripts_edit', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\backend\unify-wizards-new\resources\views/admin/digital_marketing/edit.blade.php ENDPATH**/ ?>