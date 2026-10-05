<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DmPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;

class DigitalMarketingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:digital-marketing');
    }

    // ══════════════════════════════════════════════════════════════════
    // INDEX
    // ══════════════════════════════════════════════════════════════════
    public function index()
    {
        $pages = DmPage::latest()->paginate(15);
        return view('admin.digital_marketing.index', compact('pages'));
    }

    // ══════════════════════════════════════════════════════════════════
    // CREATE
    // ══════════════════════════════════════════════════════════════════
    public function create()
    {
        return view('admin.digital_marketing.create');
    }

    // ══════════════════════════════════════════════════════════════════
    // STORE
    // ══════════════════════════════════════════════════════════════════
    public function store(Request $request)
    {
      //dd($request->all());
        $request->validate([
            'header_menu' => 'required|string',
            'service_type' => 'required|string',
            'page_name'    => 'required|string|max:255',
            'page_slug'    => 'required|string|max:255|unique:dm_pages,slug',
        ]);

        DmPage::create([
            'header_menu'          => $request->header_menu,
            'service_type'         => $request->service_type,
            'page_name'            => $request->page_name,
            'slug'                 => Str::slug($request->page_slug),
            'is_active'            => true,
            's1_banner'            => $this->buildS1($request),
            's2_top_services'      => $this->buildS2($request),
            's3_industries'        => $this->buildS3($request),
            's4_about'             => $this->buildS4($request),
            's5_testimonials'      => $this->buildS5($request),
            's6_our_company'       => $this->buildS6($request),
            's7_proud_projects'    => $this->buildS7($request),
            's8_powered_by'        => $this->buildS8($request),
            's9_who_should_invest' => $this->buildS9($request),
            's10_why_choose'       => $this->buildS10($request),
            's11_wizards_spell'    => $this->buildS11($request),
            's12_cta'              => $this->buildS12($request),
              // NEW
           's13_technologies'     => $this->buildS13($request),
           's14_our_process'     => $this->buildS14($request),
           's15_development_items' => $this->buildS15($request),
        ]);

        return redirect()->route('admin.dm.page.index')
            ->with('success', 'Page created successfully.');
    }

    // ══════════════════════════════════════════════════════════════════
    // EDIT
    // ══════════════════════════════════════════════════════════════════
    public function edit($id)
    {
        $page = DmPage::findOrFail($id);
        
         //dd($page->s2_top_services);
        return view('admin.digital_marketing.edit', compact('page'));
    }

    // ══════════════════════════════════════════════════════════════════
    // UPDATE
    // ══════════════════════════════════════════════════════════════════
    public function update(Request $request, $id)
    {
         //dd($request->all());
        $page = DmPage::findOrFail($id);

        $request->validate([
            'header_menu' => 'required|string',
            'service_type' => 'required|string',
            'page_name'    => 'required|string|max:255',
            'page_slug'    => 'required|string|max:255|unique:dm_pages,slug,' . $page->id,
        ]);
 
        $page->update([
            'header_menu'          => $request->header_menu,
            'service_type'         => $request->service_type,
            'page_name'            => $request->page_name,
            'slug'                 => Str::slug($request->page_slug),
            's1_banner'            => $this->buildS1($request, $page->s1_banner ?? []),
            's2_top_services'      => $this->buildS2($request),
            's3_industries'        => $this->buildS3($request),
            's4_about'             => $this->buildS4($request, $page->s4_about ?? []),
            's5_testimonials'      => $this->buildS5($request, $page->s5_testimonials ?? []),
            's6_our_company'       => $this->buildS6($request, $page->s6_our_company ?? []),
            's7_proud_projects'    => $this->buildS7($request, $page->s7_proud_projects ?? []),
            's8_powered_by'        => $this->buildS8($request, $page->s8_powered_by ?? []),
            's9_who_should_invest' => $this->buildS9($request),
            's10_why_choose'       => $this->buildS10($request),
            's11_wizards_spell'    => $this->buildS11($request),
            's12_cta'              => $this->buildS12($request, $page->s12_cta ?? []),

            // NEW
            's13_technologies'     => $this->buildS13($request),
            's14_our_process'     => $this->buildS14($request),
            's15_development_items' => $this->buildS15($request),
        ]);

        return redirect()->route('admin.dm.page.index')
            ->with('success', 'Page updated successfully.');
    }

    // ══════════════════════════════════════════════════════════════════
    // DESTROY
    // ══════════════════════════════════════════════════════════════════
    public function destroy($id)
    {
        DmPage::findOrFail($id)->delete();
        return redirect()->route('admin.dm.page.index')
            ->with('success', 'Page deleted successfully.');
    }

    // ══════════════════════════════════════════════════════════════════
    // SECTION BUILDERS — private helpers
    // ══════════════════════════════════════════════════════════════════

    /**
     * Section 1 — Banner
     * Form fields: s1_banner[...], s1_logos[N][image]
     */
    private function buildS1(Request $request, ?array $existing = null): array
{
    $s1 = $request->input('s1_banner', []);

    // Pehle purane logos preserve karo
    $logos = $existing['logos'] ?? [];

    $uploadedFiles = $request->file('s1_logos', []);

   foreach ($uploadedFiles as $i => $logoFile) {

        if (
            isset($logoFile['image']) &&
            $logoFile['image'] instanceof \Illuminate\Http\UploadedFile &&
            $logoFile['image']->isValid()
        ) {

            // Agar same index par nayi image upload hui hai
            // to sirf usko replace karo
              $file = $logoFile['image'];

        $fileName = $file->getClientOriginalName();
            $logos[$i] = [
                'image' => $logoFile['image']->storeAs('dm-pages/s1-logos', $fileName, 'public')
            ];
        }
    }

    ksort($logos);

    return [
        'status'       => $s1['status'] ?? null,
        'sub_title'    => $s1['sub_title'] ?? null,
        'banner_title' => $s1['banner_title'] ?? null,
        'description'  => $s1['description'] ?? null,
        'button_text'  => $s1['button_text'] ?? null,
        'button_url'   => $s1['button_url'] ?? null,
        'phone_number' => $s1['phone_number'] ?? null,
        'logos'        => array_values($logos),
    ];
}

    /**
     * Section 2 — Top Services
     * Form fields: s2_top_services[...], s2_items[N][...]
     */
    private function buildS2(Request $request): array
    {
        $s2    = $request->input('s2_top_services', []);
        $items = array_values(array_map(fn($item) => [
            'title'       => $item['title']       ?? null,
            'description' => $item['description'] ?? null,
             'url'         => $item['url'] ?? null,
        ], $request->input('s2_items', [])));

        return [
            'status'    => $s2['status']    ?? null,
            'heading'     => $s2['heading']     ?? null,
            'name'        => $s2['name']        ?? null,
            'description' => $s2['description'] ?? null,
            'items'       => $items,
        ];
    }

    /**
     * Section 3 — Industries
     * Form fields: s3_industries[...], s3_items[N][...]
     */
    private function buildS3(Request $request): array
    {
        $s3    = $request->input('s3_industries', []);
        $items = array_values(array_map(fn($item) => [
            'icon'        => $item['icon']        ?? null,
            'color_class' => $item['color_class'] ?? null,
            'name'        => $item['name']        ?? null,
            'description' => $item['description'] ?? null,
        ], $request->input('s3_items', [])));

        return [
            'status'    => $s3['status']    ?? null,
            'sub_title' => $s3['sub_title'] ?? null,
            'heading'   => $s3['heading']   ?? null,
            'items'     => $items,
        ];
    }

    /**
     * Section 4 — About
     * Form fields: s4_about[...], s4_about[image] (file)
     */
    private function buildS4(Request $request, ?array $existing = null): array
    {
        $s4        = $request->input('s4_about', []);
        $imagePath = $existing['image_path'] ?? null;

          if ($request->hasFile('s4_about.image') && $request->file('s4_about.image')->isValid()) {

            $file = $request->file('s4_about.image');

            // Original filename
            $fileName = $file->getClientOriginalName();

            // Save with original name
            $imagePath = $file->storeAs('dm-pages/s4', $fileName, 'public');
        }

        return [
            'status'    => $s4['status']    ?? null,
            'sub_title'      => $s4['sub_title']      ?? null,
            'title'          => $s4['title']           ?? null,
            'counter_number' => $s4['counter_number']  ?? null,
            'counter_suffix' => $s4['counter_suffix']  ?? '+',
            'counter_label'  => $s4['counter_label']   ?? null,
            'description_1'  => $s4['description_1']   ?? null,
            'description_2'  => $s4['description_2']   ?? null,
            'image_path'     => $imagePath,
            'button_text'    => $s4['button_text']      ?? null,
            'button_url'     => $s4['button_url']       ?? null,
        ];
    }

    /**
     * Section 5 — Testimonials
     * Form fields: s5_testimonials[...], s5_testimonials[video] (file), s5_items[N][avatar] (file)
     */
    private function buildS5(Request $request, ?array $existing = null): array
    {
        $s5        = $request->input('s5_testimonials', []);
        $videoPath = $existing['video_path'] ?? null;

        if ($request->hasFile('s5_testimonials.video') && $request->file('s5_testimonials.video')->isValid()) {
            $videoPath = $request->file('s5_testimonials.video')->store('dm-pages/s5-video', 'public');
        }

        $items = [];
        foreach ($request->input('s5_items', []) as $i => $item) {
            $avatarPath = $existing['items'][$i]['avatar_path'] ?? null;
              if (
            $request->hasFile("s5_items.{$i}.avatar") &&
            $request->file("s5_items.{$i}.avatar")->isValid()
            ) {
                $file = $request->file("s5_items.{$i}.avatar");
    
                $fileName = $file->getClientOriginalName();
    
                $avatarPath = $file->storeAs('dm-pages/s5-avatars', $fileName, 'public');
            }
            $items[] = [
                'stars'       => $item['stars']       ?? 5,
                'description' => $item['description'] ?? null,
                'name'        => $item['name']        ?? null,
                'designation' => $item['designation'] ?? null,
                'avatar_path' => $avatarPath,
            ];
        }

        return [
            'status'    => $s5['status']    ?? null,
            'sub_title'  => $s5['sub_title'] ?? null,
            'heading'    => $s5['heading']   ?? null,
            'video_path' => $videoPath,
            'items'      => $items,
        ];
    }

    /**
     * Section 6 — Our Company
     * Form fields: s6_our_company[...], s6_our_company[image] (file)
     */
    private function buildS6(Request $request, ?array $existing = null): array
    {
        $s6        = $request->input('s6_our_company', []);
        $imagePath = $existing['image_path'] ?? null;

     
       if (
            $request->hasFile('s6_our_company.image') &&
            $request->file('s6_our_company.image')->isValid()
        ) {
            $file = $request->file('s6_our_company.image');

            // Original file name
            $fileName = $file->getClientOriginalName();

            // Save with original name
            $imagePath = $file->storeAs('dm-pages/s6', $fileName, 'public');
        }

        return [
            'status'    => $s6['status']    ?? null,
            'sub_title'     => $s6['sub_title']    ?? null,
            'title'         => $s6['title']         ?? null,
            'description_1' => !empty($s6['description_1']) ? Purifier::clean($s6['description_1']) : null,
            'description_2' => $s6['description_2'] ?? null,
            'description_3' => $s6['description_3'] ?? null,
            'image_path'    => $imagePath,
            'button_text'   => $s6['button_text']   ?? null,
            'button_url'    => $s6['button_url']    ?? null,
        ];
    }

    /**
     * Section 7 — Proud Projects
     * Form fields: s7_proud_projects[...], s7_items[N][image] (file)
     */
    private function buildS7(Request $request, ?array $existing = null): array
    {
        $s7    = $request->input('s7_proud_projects', []);
        $items = [];

        foreach ($request->input('s7_items', []) as $i => $item) {
            $imagePath = $existing['items'][$i]['image_path'] ?? null;
            
            if ($request->hasFile("s7_items.{$i}.image") && $request->file("s7_items.{$i}.image")->isValid()) {

            $file = $request->file("s7_items.{$i}.image");
        
            $fileName = $file->getClientOriginalName();
        
            $imagePath = $file->storeAs(
                'dm-pages/s7-projects',
                $fileName,
                'public'
            );
        }
            
            $items[] = [
                'image_path' => $imagePath,
                'category'   => $item['category'] ?? null,
                'name'       => $item['name']      ?? null,
                'link_url'   => $item['link_url']  ?? null,
            ];
        }

        return [
            'status'    => $s7['status']    ?? null,
            'sub_title'   => $s7['sub_title']   ?? null,
            'title'       => $s7['title']       ?? null,
            'description' => $s7['description'] ?? null,
            'button_text' => $s7['button_text'] ?? null,
            'button_url'  => $s7['button_url']  ?? null,
            'items'       => $items,
        ];
    }

    /**
     * Section 8 — Powered By
     * Form fields: s8_powered_by[...], s8_items[N][image] (file)
     */
    private function buildS8(Request $request, ?array $existing = null): array
    {
        $s8    = $request->input('s8_powered_by', []);
        $items = [];

        foreach ($request->input('s8_items', []) as $i => $item) {
            $imagePath = $existing['items'][$i]['image_path'] ?? null;
            
          if ($request->hasFile("s8_items.{$i}.image") && $request->file("s8_items.{$i}.image")->isValid()) {

            $file = $request->file("s8_items.{$i}.image");
        
            $fileName = time().'_'.$file->getClientOriginalName();
        
            $imagePath = $file->storeAs(
                'dm-pages/s8-powered',
                $fileName,
                'public'
            );
        }
            
            $items[] = [
                'icon'        => $item['icon']        ?? null,
                'heading'     => $item['heading']     ?? null,
                'image_path'  => $imagePath,
                'description' => $item['description'] ?? null,
                'link_url'    => $item['link_url']    ?? null,
            ];
        }

        return [
            'status'    => $s8['status']    ?? null,
            'sub_title'   => $s8['sub_title']   ?? null,
            'heading'     => $s8['heading']     ?? null,
            'description' => $s8['description'] ?? null,
            'button_text' => $s8['button_text'] ?? null,
            'button_url'  => $s8['button_url']  ?? null,
            'items'       => $items,
        ];
    }

    /**
     * Section 9 — Who Should Invest
     * Form fields: s9_who_should_invest[...], s9_questions[N][...], s9_answers[N][...]
     */
    private function buildS9(Request $request): array
    {
        $s9        = $request->input('s9_who_should_invest', []);
        $questions = array_values(array_map(fn($q) => [
            'icon'        => $q['icon']        ?? null,
            'color_class' => $q['color_class'] ?? null,
            'heading'     => $q['heading']     ?? null,
        ], $request->input('s9_questions', [])));

        $answers = array_values(array_map(fn($a) => [
            'accent_color' => $a['accent_color'] ?? null,
            'heading'      => $a['heading']      ?? null,
            'description'  => $a['description']  ?? null,
        ], $request->input('s9_answers', [])));

        return [
            'status'          => $s9['status']          ?? null,
            'chip_label'      => $s9['chip_label']      ?? null,
            'heading'         => $s9['heading']          ?? null,
            'description'     => $s9['description']      ?? null,
            'questions_label' => $s9['questions_label']  ?? null,
            'divider_label'   => $s9['divider_label']    ?? null,
            'button_text'     => $s9['button_text']      ?? null,
            'button_url'      => $s9['button_url']       ?? null,
            'questions'       => $questions,
            'answers'         => $answers,
        ];
    }

    /**
     * Section 10 — Why Choose Us
     * Form fields: s10_why_choose[...], s10_items[N][...]
     */
    private function buildS10(Request $request): array
    {
        $s10   = $request->input('s10_why_choose', []);
        $items = array_values(array_map(fn($item) => [
            'color_class' => $item['color_class'] ?? null,
            'icon_svg'    => $item['icon_svg']    ?? null,
            'heading'     => $item['heading']     ?? null,
            'description' => $item['description'] ?? null,
        ], $request->input('s10_items', [])));

        return [
            'status'    => $s10['status']    ?? null,
            'title'       => $s10['title']       ?? null,
            'sub_title'   => $s10['sub_title']   ?? null,
            'description' => $s10['description'] ?? null,
            'items'       => $items,
        ];
    }

    /**
     * Section 11 — Wizards Spell
     * Form fields: s11_wizards_spell[...], s11_cards[N][...]
     */
    private function buildS11(Request $request): array
    {
        $s11   = $request->input('s11_wizards_spell', []);
        $cards = array_values(array_map(fn($card) => [
            'color_class' => $card['color_class'] ?? null,
            'name'        => $card['name']         ?? null,
            'icon_svg'    => $card['icon_svg']     ?? null,
            'description' => $card['description']  ?? null,
        ], $request->input('s11_cards', [])));

        return [
            'status'    => $s11['status']    ?? null,
             'sub_title'     => $s11['sub_title']     ?? null,
            'heading'     => $s11['heading']     ?? null,
            'description' => $s11['description'] ?? null,
            'button_text' => $s11['button_text'] ?? null,
            'button_url'  => $s11['button_url']  ?? null,
            'cards'       => $cards,
        ];
    }

    /**
     * Section 12 — CTA
     * Form fields: s12_cta[...], s12_cta[image] (file)
     */
    private function buildS12(Request $request, ?array $existing = null): array
    {
        $s12       = $request->input('s12_cta', []);
        $imagePath = $existing['image_path'] ?? null;

       if ($request->hasFile('s12_cta.image') && $request->file('s12_cta.image')->isValid()) {

            $file = $request->file('s12_cta.image');
        
            $fileName = time().'_'.$file->getClientOriginalName();
        
            $imagePath = $file->storeAs(
                'dm-pages/s12-cta',
                $fileName,
                'public'
            );
        }

        return [
            'status'      => $s12['status']      ?? null,
             'sub_title'     => $s12['sub_title']     ?? null,
            'heading'     => $s12['heading']     ?? null,
            'description' => $s12['description'] ?? null,
            'button_text' => $s12['button_text'] ?? null,
            'button_url'  => $s12['button_url']  ?? null,
            'image_path'  => $imagePath,
        ];
    }


    
private function buildS13(Request $request): array
{
    return [

        'status'    => $request->input('s13_technologies.status')    ?? null,
        'title' => $request->input('s13_technologies.title'),

        'sub_title' => $request->input('s13_technologies.sub_title'),

        'description' => $request->input('s13_technologies.description'),

        'technology_groups' => array_values(
            $request->technology_groups ?? []
        ),

    ];
}



private function buildS14(Request $request): array
{
    $items = [];

    $inputItems = $request->input('s14_items', []);

    if (is_array($inputItems)) {
        foreach ($inputItems as $item) {

            if (!empty($item['title']) || !empty($item['description'])) {
                $items[] = [
                   
                    'step' => $item['step'] ?? '',
                    'title' => $item['title'] ?? '',
                    'description' => $item['description'] ?? '',
                ];
            }
        }
    }

    return [
            'status'    => $request->input('s14_our_process.status')    ?? null,
        'heading'     => $request->input('s14_our_process.heading'),
        'description' => $request->input('s14_our_process.description'),
        'items'       => array_values($items)
    ];
}


// s 15 — Development Items funcation
private function buildS15(Request $request): array
{
    $items = [];

    $inputItems = $request->input('s15_development_items', []);

    if (is_array($inputItems)) {

        foreach ($inputItems as $item) {

            if (
                !empty($item['title']) ||
                !empty($item['heading']) ||
                !empty($item['price'])
            ) {

                $items[] = [
                   

                    'title'    => $item['title'] ?? '',

                    'heading'  => $item['heading'] ?? '',

                    'price'    => $item['price'] ?? '',

                    'category' => $item['category'] ?? '',

                    'btn_one'  => $item['btn_one'] ?? '',

                    'btn_two'  => $item['btn_two'] ?? '',

                ];
            }
        }
    }

    return [
            'status'    => $request->input('s15_development.status')    ?? null,
       
        'sub_title' => $request->input('s15_development.sub_title'),

        'heading'   => $request->input('s15_development.heading'),

        'items'     => array_values($items),

    ];
}


public function footerStatus(Request $request, $id)
{
    $service = DmPage::findOrFail($id);

    $service->footer_status = $request->footer_status;
    $service->save();

    return response()->json([
        'success' => true
    ]);
}




}