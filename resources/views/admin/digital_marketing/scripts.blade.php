<script>
    // ══════════════════════════════════════════════════════════════════
    // SHARED UTILITIES
    // ══════════════════════════════════════════════════════════════════

    // Generic row adder
    function addRow(containerId, templateFn) {
        const container = document.getElementById(containerId);
        const existingRows = container.querySelectorAll('.repeat-row').length;
        const wrapper = document.createElement('div');
        wrapper.innerHTML = templateFn(existingRows);
        container.appendChild(wrapper.firstElementChild);
    }

    // Remove nearest repeat-row
    function removeRow(btn) {
        const row = btn.closest('.repeat-row');
        if (row) row.remove();
    }

    // Auto slug from page name (create page only)
    const pageNameInput = document.getElementById('pageNameInput');
    const pageSlugInput = document.getElementById('pageSlugInput');
    if (pageNameInput && pageSlugInput) {
        pageNameInput.addEventListener('input', function() {
            if (!pageSlugInput.dataset.manual) {
                pageSlugInput.value = this.value
                    .toLowerCase().trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-');
            }
        });
        pageSlugInput.addEventListener('input', function() {
            this.dataset.manual = 'true';
        });
    }

    // ══════════════════════════════════════════════════════════════════
    // LOGO — Special handler (s1_logos)
    // Uses existing row count so index never clashes
    // ══════════════════════════════════════════════════════════════════
    function addLogoRow() {
        const container = document.getElementById('s1-logos');
        const idx = container.querySelectorAll('.repeat-row').length;
        const html = `
<div class="repeat-row border rounded p-2 mb-2 bg-light">
    <div class="row align-items-center">
        <div class="col-md-10">
            <label class="form-label small">Logo Image</label>
            <input type="file" name="s1_logos[${idx}][image]"
                   class="form-control form-control-sm" accept="image/*">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-sm btn-danger w-100 mt-4"
                    onclick="removeRow(this)">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>
</div>`;
        container.insertAdjacentHTML('beforeend', html);
    }

    // ══════════════════════════════════════════════════════════════════
    // ROW TEMPLATES
    // ══════════════════════════════════════════════════════════════════

    function logoRowTemplate(i) {
        return `
<div class="repeat-row border rounded p-2 mb-2 bg-light">
    <div class="row align-items-center">
        <div class="col-md-10">
            <label class="form-label small">Logo Image</label>
            <input type="file" name="s1_logos[${i}][image]"
                   class="form-control form-control-sm" accept="image/*">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-sm btn-danger w-100 mt-4"
                    onclick="removeRow(this)">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>
</div>`;
    }
    function s2ItemTemplate(i) {
        return `
<div class="repeat-row border rounded p-3 mb-2 bg-light">
    <div class="row">

        <div class="col-md-3 mb-2">
            <label class="form-label small">Title</label>
            <input type="text"
                   name="s2_items[${i}][title]"
                   class="form-control form-control-sm"
                   placeholder="Service Title">
        </div>

        <div class="col-md-4 mb-2">
            <label class="form-label small">Description</label>
            <textarea name="s2_items[${i}][description]"
                      rows="2"
                      class="form-control form-control-sm"
                      placeholder="Short description..."></textarea>
        </div>

        <div class="col-md-4 mb-2">
            <label class="form-label small">URL</label>
            <input type="text"
                   name="s2_items[${i}][url]"
                   class="form-control form-control-sm"
                   placeholder="/services/seo-services">
        </div>

        <div class="col-md-1 d-flex align-items-end mb-2">
            <button type="button"
                    class="btn btn-sm btn-danger w-100"
                    onclick="removeRow(this)">
                <i class="fa fa-trash"></i>
            </button>
        </div>

    </div>
</div>`;
    }

    function s3ItemTemplate(i) {
        return `
<div class="repeat-row border rounded p-3 mb-2 bg-light">
    <div class="row">
        <div class="col-md-3 mb-2">
            <label class="form-label small">Icon Class</label>
            <input type="text" name="s3_items[${i}][icon]"
                   class="form-control form-control-sm" placeholder="fa fa-thin fa-spa">
        </div>
        <div class="col-md-2 mb-2">
            <label class="form-label small">Color Class</label>
            <select name="s3_items[${i}][color_class]" class="form-select form-select-sm">
                <option value="google-blue">Google Blue</option>
                <option value="google-red">Google Red</option>
                <option value="google-yellow">Google Yellow</option>
                <option value="google-green">Google Green</option>
            </select>
        </div>
        <div class="col-md-2 mb-2">
            <label class="form-label small">Name</label>
            <input type="text" name="s3_items[${i}][name]"
                   class="form-control form-control-sm" placeholder="Industry Name">
        </div>
        <div class="col-md-4 mb-2">
            <label class="form-label small">Description</label>
            <input type="text" name="s3_items[${i}][description]"
                   class="form-control form-control-sm" placeholder="Short description">
        </div>
        <div class="col-md-1 d-flex align-items-end mb-2">
            <button type="button" class="btn btn-sm btn-danger w-100"
                    onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
        </div>
    </div>
</div>`;
    }

    function s5ItemTemplate(i) {
        return `
<div class="repeat-row border rounded p-3 mb-2 bg-light">
    <div class="row">
        <div class="col-md-1 mb-2">
            <label class="form-label small">Stars</label>
            <select name="s5_items[${i}][stars]" class="form-select form-select-sm">
                <option value="5" selected>5 ★</option>
                <option value="4">4 ★</option>
                <option value="3">3 ★</option>
            </select>
        </div>
        <div class="col-md-4 mb-2">
            <label class="form-label small">Testimonial Text</label>
            <textarea name="s5_items[${i}][description]" rows="3"
                      class="form-control form-control-sm" placeholder="Testimonial..."></textarea>
        </div>
        <div class="col-md-2 mb-2">
            <label class="form-label small">Client Name</label>
            <input type="text" name="s5_items[${i}][name]"
                   class="form-control form-control-sm" placeholder="Client Name">
        </div>
        <div class="col-md-2 mb-2">
            <label class="form-label small">Designation</label>
            <input type="text" name="s5_items[${i}][designation]"
                   class="form-control form-control-sm" placeholder="CEO">
        </div>
        <div class="col-md-2 mb-2">
            <label class="form-label small">Avatar</label>
            <input type="file" name="s5_items[${i}][avatar]"
                   class="form-control form-control-sm" accept="image/*">
        </div>
        <div class="col-md-1 d-flex align-items-end mb-2">
            <button type="button" class="btn btn-sm btn-danger w-100"
                    onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
        </div>
    </div>
</div>`;
    }

    function s7ItemTemplate(i) {
        return `
<div class="repeat-row border rounded p-3 mb-2 bg-light">
    <div class="row">
        <div class="col-md-3 mb-2">
            <label class="form-label small">Project Image</label>
            <input type="file" name="s7_items[${i}][image]"
                   class="form-control form-control-sm" accept="image/*">
        </div>
        <div class="col-md-3 mb-2">
            <label class="form-label small">Category</label>
            <input type="text" name="s7_items[${i}][category]"
                   class="form-control form-control-sm" placeholder="Connect">
        </div>
        <div class="col-md-4 mb-2">
            <label class="form-label small">Project Name</label>
            <input type="text" name="s7_items[${i}][name]"
                   class="form-control form-control-sm" placeholder="Project Name">
        </div>
        <div class="col-md-1 mb-2">
            <label class="form-label small">Link</label>
            <input type="text" name="s7_items[${i}][link_url]"
                   class="form-control form-control-sm" placeholder="/portfolio/1">
        </div>
        <div class="col-md-1 d-flex align-items-end mb-2">
            <button type="button" class="btn btn-sm btn-danger w-100"
                    onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
        </div>
    </div>
</div>`;
    }

    function s8ItemTemplate(i) {
        return `
<div class="repeat-row border rounded p-3 mb-2 bg-light">
    <div class="row">
        <div class="col-md-2 mb-2">
            <label class="form-label small">Icon Class</label>
            <input type="text" name="s8_items[${i}][icon]"
                   class="form-control form-control-sm" placeholder="tji-service-2">
        </div>
        <div class="col-md-3 mb-2">
            <label class="form-label small">Heading</label>
            <input type="text" name="s8_items[${i}][heading]"
                   class="form-control form-control-sm" placeholder="Tool Heading">
        </div>
        <div class="col-md-3 mb-2">
            <label class="form-label small">Description</label>
            <textarea name="s8_items[${i}][description]" rows="2"
                      class="form-control form-control-sm"></textarea>
        </div>
        <div class="col-md-2 mb-2">
            <label class="form-label small">Background Image</label>
            <input type="file" name="s8_items[${i}][image]"
                   class="form-control form-control-sm" accept="image/*">
        </div>
        <div class="col-md-1 mb-2">
            <label class="form-label small">Link</label>
            <input type="text" name="s8_items[${i}][link_url]"
                   class="form-control form-control-sm">
        </div>
        <div class="col-md-1 d-flex align-items-end mb-2">
            <button type="button" class="btn btn-sm btn-danger w-100"
                    onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
        </div>
    </div>
</div>`;
    }

    function s9QuestionTemplate(i) {
        return `
<div class="repeat-row border rounded p-3 mb-2 bg-light">
    <div class="row">
        <div class="col-md-2 mb-2">
            <label class="form-label small">Icon (Emoji)</label>
            <input type="text" name="s9_questions[${i}][icon]"
                   class="form-control form-control-sm" placeholder="🎯">
        </div>
        <div class="col-md-2 mb-2">
            <label class="form-label small">Color Class</label>
            <select name="s9_questions[${i}][color_class]" class="form-select form-select-sm">
                <option value="wsi__q-card--blue">Blue</option>
                <option value="wsi__q-card--red">Red</option>
                <option value="wsi__q-card--yellow">Yellow</option>
                <option value="wsi__q-card--green">Green</option>
            </select>
        </div>
        <div class="col-md-7 mb-2">
            <label class="form-label small">Question Text</label>
            <input type="text" name="s9_questions[${i}][heading]"
                   class="form-control form-control-sm" placeholder="Question...">
        </div>
        <div class="col-md-1 d-flex align-items-end mb-2">
            <button type="button" class="btn btn-sm btn-danger w-100"
                    onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
        </div>
    </div>
</div>`;
    }

    function s9AnswerTemplate(i) {
        return `
<div class="repeat-row border rounded p-3 mb-2 bg-light">
    <div class="row">
        <div class="col-md-2 mb-2">
            <label class="form-label small">Accent Color</label>
            <select name="s9_answers[${i}][accent_color]" class="form-select form-select-sm">
                <option value="green">Green</option>
                <option value="blue">Blue</option>
                <option value="red">Red</option>
                <option value="yellow">Yellow</option>
            </select>
        </div>
        <div class="col-md-3 mb-2">
            <label class="form-label small">Heading</label>
            <input type="text" name="s9_answers[${i}][heading]"
                   class="form-control form-control-sm" placeholder="Stay Competitive">
        </div>
        <div class="col-md-6 mb-2">
            <label class="form-label small">Description</label>
            <textarea name="s9_answers[${i}][description]" rows="2"
                      class="form-control form-control-sm"></textarea>
        </div>
        <div class="col-md-1 d-flex align-items-end mb-2">
            <button type="button" class="btn btn-sm btn-danger w-100"
                    onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
        </div>
    </div>
</div>`;
    }

    function s10ItemTemplate(i) {
        return `
<div class="repeat-row border rounded p-3 mb-2 bg-light">
    <div class="row">
        <div class="col-md-2 mb-2">
            <label class="form-label small">Color Class</label>
            <select name="s10_items[${i}][color_class]" class="form-select form-select-sm">
                <option value="uw-blue">Blue</option>
                <option value="uw-red">Red</option>
                <option value="uw-yellow">Yellow</option>
                <option value="uw-green">Green</option>
                <option value="uw-google-green">Google Green</option>
                <option value="uw-google-orange">Orange</option>
            </select>
        </div>
        <div class="col-md-3 mb-2">
            <label class="form-label small">Icon SVG</label>
            <textarea name="s10_items[${i}][icon_svg]" rows="2"
                      class="form-control form-control-sm" placeholder="SVG markup..."></textarea>
        </div>
        <div class="col-md-3 mb-2">
            <label class="form-label small">Heading</label>
            <input type="text" name="s10_items[${i}][heading]"
                   class="form-control form-control-sm" placeholder="Feature heading">
        </div>
        <div class="col-md-3 mb-2">
            <label class="form-label small">Description</label>
            <textarea name="s10_items[${i}][description]" rows="2"
                      class="form-control form-control-sm"></textarea>
        </div>
        <div class="col-md-1 d-flex align-items-end mb-2">
            <button type="button" class="btn btn-sm btn-danger w-100"
                    onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
        </div>
    </div>
</div>`;
    }

    function s11CardTemplate(i) {
        return `
<div class="repeat-row border rounded p-3 mb-2 bg-light">
    <div class="row">
        <div class="col-md-2 mb-2">
            <label class="form-label small">Color Class</label>
            <select name="s11_cards[${i}][color_class]" class="form-select form-select-sm">
                <option value="atm-card-0">Blue (Discover)</option>
                <option value="atm-card-1">Red (Create)</option>
                <option value="atm-card-2">Yellow (Grow)</option>
                <option value="atm-card-3">Green (Optimise)</option>
            </select>
        </div>
        <div class="col-md-2 mb-2">
            <label class="form-label small">Name / Label</label>
            <input type="text" name="s11_cards[${i}][name]"
                   class="form-control form-control-sm" placeholder="Discover">
        </div>
        <div class="col-md-4 mb-2">
            <label class="form-label small">Icon SVG</label>
            <textarea name="s11_cards[${i}][icon_svg]" rows="2"
                      class="form-control form-control-sm" placeholder="SVG markup..."></textarea>
        </div>
        <div class="col-md-3 mb-2">
            <label class="form-label small">Description</label>
            <textarea name="s11_cards[${i}][description]" rows="2"
                      class="form-control form-control-sm"></textarea>
        </div>
        <div class="col-md-1 d-flex align-items-end mb-2">
            <button type="button" class="btn btn-sm btn-danger w-100"
                    onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
        </div>
    </div>
</div>`;
    }
</script>



<script>
    const serviceTypes = @json(App\Models\DmPage::serviceTypes());

    document.getElementById('header_menu').addEventListener('change', function() {

        //alert('Dropdown Changed');

        let selectedMenu = this.value;

        let typeDropdown = document.getElementById('service_type');

        typeDropdown.innerHTML = '<option value="">Select Service Type</option>';

        if (selectedMenu && serviceTypes[selectedMenu]) {

            for (const key in serviceTypes[selectedMenu]) {

                typeDropdown.innerHTML += `
                    <option value="${key}">
                        ${serviceTypes[selectedMenu][key]}
                    </option>
                `;

            }

        }

    });
</script>


{{-- Technology used: JavaScript (Vanilla JS) for dynamic form handling and Laravel Blade for templating. --}}

<script>
    let technologyGroupIndex = 1;

    // Add Technology Group
    function addTechnologyGroup() {

        let html = `
        
        <div class="repeat-row border rounded p-3 mb-3 bg-light technology-group">

            <div class="row">

                <div class="col-md-5 mb-3">

                    <label class="form-label fw-bold">
                        Technology Heading
                    </label>

                    <input type="text"
                        name="technology_groups[${technologyGroupIndex}][heading]"
                        class="form-control"
                        placeholder="Backend">

                </div>

                <div class="col-md-2 mb-3 d-flex align-items-end">

                    <button type="button"
                        class="btn btn-danger w-100"
                        onclick="removeRow(this)">

                        <i class="fa fa-trash"></i>

                    </button>

                </div>

            </div>

            <div class="technology-items">

                <div class="row technology-item mb-2">

                    <div class="col-md-5">

                        <label class="form-label small">
                            Technology Name
                        </label>

                        <input type="text"
                            name="technology_groups[${technologyGroupIndex}][items][0][name]"
                            class="form-control form-control-sm"
                            placeholder="Node.js">

                    </div>

                    <div class="col-md-5">

                        <label class="form-label small">
                            Icon Class / SVG
                        </label>

                        <input type="text"
                            name="technology_groups[${technologyGroupIndex}][items][0][icon]"
                            class="form-control form-control-sm"
                            placeholder="fab fa-node-js">

                    </div>

                    <div class="col-md-2 d-flex align-items-end">

                        <button type="button"
                            class="btn btn-sm btn-danger w-100"
                            onclick="removeRow(this)">

                            <i class="fa fa-trash"></i>

                        </button>

                    </div>

                </div>

            </div>

            <button type="button"
                class="btn btn-sm btn-outline-success mt-2"
                onclick="addTechnologyItem(this)">

                <i class="fa fa-plus"></i>
                Add Technology

            </button>

        </div>
        
        `;

        document.getElementById('technology-groups').insertAdjacentHTML('beforeend', html);

        technologyGroupIndex++;

    }



    // Add Technology Item
    function addTechnologyItem(button) {

        let group = button.closest('.technology-group');

        let itemsWrapper = group.querySelector('.technology-items');

        let itemCount = itemsWrapper.querySelectorAll('.technology-item').length;

        let groupIndex = [...document.querySelectorAll('.technology-group')].indexOf(group);

        let html = `
        
        <div class="row technology-item mb-2">

            <div class="col-md-5">

                <input type="text"
                    name="technology_groups[${groupIndex}][items][${itemCount}][name]"
                    class="form-control form-control-sm"
                    placeholder="Vue.js">

            </div>

            <div class="col-md-5">

                <input type="text"
                    name="technology_groups[${groupIndex}][items][${itemCount}][icon]"
                    class="form-control form-control-sm"
                    placeholder="fab fa-vuejs">

            </div>

            <div class="col-md-2 d-flex align-items-end">

                <button type="button"
                    class="btn btn-sm btn-danger w-100"
                    onclick="removeRow(this)">

                    <i class="fa fa-trash"></i>

                </button>

            </div>

        </div>
        
        `;

        itemsWrapper.insertAdjacentHTML('beforeend', html);

    }



    // Remove Row
    function removeRow(button) {

        button.closest('.repeat-row, .technology-item').remove();

    }
</script>

{{-- section14 OUR Process - Repeater for steps (icon, heading, description) --}}

<script>
    let s14Index = 1;

    let s14ItemTemplate = `
<div class="repeat-row border rounded p-3 mb-2 bg-light">
    <div class="row">

        <div class="col-md-2 mb-2">
            <label class="form-label small">Step No</label>
            <input type="text" name="s14_items[INDEX][step]" class="form-control form-control-sm" placeholder="01">
        </div>

        <div class="col-md-4 mb-2">
            <label class="form-label small">Title</label>
            <input type="text" name="s14_items[INDEX][title]" class="form-control form-control-sm" placeholder="Title">
        </div>

        <div class="col-md-5 mb-2">
            <label class="form-label small">Description</label>
            <textarea name="s14_items[INDEX][description]" rows="2" class="form-control form-control-sm" placeholder="Description"></textarea>
        </div>

        <div class="col-md-1 d-flex align-items-end mb-2">
            <button type="button" class="btn btn-sm btn-danger w-100" onclick="removeS14Row(this)">
                <i class="fa fa-trash"></i>
            </button>
        </div>

    </div>
</div>
`;

    function addS14Row(containerId, template) {
        let container = document.getElementById(containerId);

        let html = template.replaceAll('INDEX', s14Index);

        container.insertAdjacentHTML('beforeend', html);

        s14Index++;
    }

    function removeS14Row(btn) {
        btn.closest('.repeat-row').remove();
    }
</script>


{{-- s15 Development page section - Repeater for development steps (icon, heading, description) --}}


<script>
    let s15DevelopmentIndex = 1;

    const s15DevelopmentTemplate = () => `
    
    <div class="repeat-row border rounded p-3 mb-3 bg-light">

        <div class="row">

            <div class="col-md-2 mb-2">
                <label class="form-label small">Title</label>

                <input type="text"
                    name="s15_development_items[${s15DevelopmentIndex}][title]"
                    class="form-control form-control-sm"
                    placeholder="SEO">
            </div>

            <div class="col-md-3 mb-2">
                <label class="form-label small">Heading</label>

                <input type="text"
                    name="s15_development_items[${s15DevelopmentIndex}][heading]"
                    class="form-control form-control-sm"
                    placeholder="Search Engine Optimization">
            </div>

            <div class="col-md-2 mb-2">
                <label class="form-label small">Price</label>

                <input type="text"
                    name="s15_development_items[${s15DevelopmentIndex}][price]"
                    class="form-control form-control-sm"
                    placeholder="$250">
            </div>

            <div class="col-md-2 mb-2">
                <label class="form-label small">Category</label>

                <input type="text"
                    name="s15_development_items[${s15DevelopmentIndex}][category]"
                    class="form-control form-control-sm"
                    placeholder="Search">
            </div>

            <div class="col-md-1 mb-2">
                <label class="form-label small">Button 1</label>

                <input type="text"
                    name="s15_development_items[${s15DevelopmentIndex}][btn_one]"
                    class="form-control form-control-sm"
                    placeholder="Explore">
            </div>

            <div class="col-md-1 mb-2">
                <label class="form-label small">Button 2</label>

                <input type="text"
                    name="s15_development_items[${s15DevelopmentIndex}][btn_two]"
                    class="form-control form-control-sm"
                    placeholder="Contact">
            </div>

            <div class="col-md-1 d-flex align-items-end mb-2">
                <button type="button"
                    class="btn btn-sm btn-danger w-100"
                    onclick="removeRow(this)">
                    <i class="fa fa-trash"></i>
                </button>
            </div>

        </div>

    </div>

    `;

    function add15Row(wrapperId, templateFunction) {

        const wrapper = document.getElementById(wrapperId);

        wrapper.insertAdjacentHTML('beforeend', templateFunction());

        s15DevelopmentIndex++;
    }

    function removeRow(button) {

        button.closest('.repeat-row').remove();
    }
</script>
