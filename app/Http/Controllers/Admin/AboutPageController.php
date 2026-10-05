<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutSection;
use App\Models\Industry;
use App\Models\Introduction;
use App\Models\WhyChoose;
use App\Models\Client;
use App\Models\Review;
use App\Models\AboutCTA;

class AboutPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:about-page');
    }

    /*
    |--------------------------------------------------------------------------
    | HERO SECTION PAGE
    |--------------------------------------------------------------------------
    */

    public function hero()
    {
        $hero = AboutSection::where('section_key', 'hero')->first();
       // $introductions = Introduction::where('type', 'stat')->orderBy('sort_order', 'asc')->get();

        return view('admin.about-us.hero.index', compact('hero'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE HERO SECTION
    |--------------------------------------------------------------------------
    */

    public function updateHero(Request $request)
{
    $request->validate([
        'small_label'      => 'nullable|string|max:255',
        'main_heading'     => 'nullable|string|max:255',
        'highlight_text'   => 'nullable|string|max:255',
        'description'      => 'nullable|string',

        'button_1_text'    => 'nullable|string|max:255',
        'button_1_url'     => 'nullable|string|max:255',

        'button_2_text'    => 'nullable|string|max:255',
        'button_2_url'     => 'nullable|string|max:255',

        'background_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        'status'           => 'required|in:0,1',
    ]);

    // Find Hero Section
    $hero = AboutSection::where('section_key', 'hero')->first();

    // Create New If Not Exists
    if (!$hero) {
        $hero = new AboutSection();
        $hero->section_key = 'hero';
    }

    /*
    |--------------------------------------------------------------------------
    | BASIC CONTENT
    |--------------------------------------------------------------------------
    */

    $hero->title = $request->main_heading;

    $hero->subtitle = $request->small_label;

    // Save only hero text inside description
    $hero->description = json_encode([
        'highlight_text' => $request->highlight_text,
        'description'    => $request->description,
    ]);

    /*
    |--------------------------------------------------------------------------
    | BUTTON DATA
    |--------------------------------------------------------------------------
    */

    $hero->button_text  = $request->button_1_text;

    $hero->button_link  = $request->button_1_url;

    $hero->button_text2 = $request->button_2_text;

    $hero->button_link2 = $request->button_2_url;

    /*
    |--------------------------------------------------------------------------
    | IMAGE UPLOAD
    |--------------------------------------------------------------------------
    */

     if ($request->hasFile('background_image')) {

    // Delete old image
    if ($hero->image && file_exists(public_path($hero->image))) {
        unlink(public_path($hero->image));
    }

    $image = $request->file('background_image');

    // Original filename
    $imageName = $image->getClientOriginalName();

    // Folder path
    $path = public_path('uploads/about-us');

    // Create folder if not exists
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }

    // Upload image
    $image->move($path, $imageName);

    // Save image path
    $hero->image = 'uploads/about-us/' . $imageName;
}

    /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

    $hero->status = $request->status;

    // Save Data
    $hero->save();

    return redirect()
        ->back()
        ->with('success', 'Hero Section Updated Successfully');
}

   /*
    |--------------------------------------------------------------------------
    | INDUSTRY PAGE
    |--------------------------------------------------------------------------
    */

    public function industry()
    {
        $industries = Industry::orderBy('sort_order', 'asc')->get();

        return view('admin.about-us.industry.index', compact('industries'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE INDUSTRY
    |--------------------------------------------------------------------------
    */

    public function updateIndustry(Request $request, $id = null)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'icon'        => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer',
            'status'      => 'required'
        ]);

        if ($id) {

            $industry = Industry::findOrFail($id);

        } else {

            $industry = new Industry();
        }

        $industry->title       = $request->title;
        $industry->description = $request->description;
        $industry->icon        = $request->icon;
        $industry->sort_order  = $request->sort_order ?? 0;
        $industry->status      = $request->status;

        $industry->save();

        return redirect()
            ->route('admin.about-us.industry.index')
            ->with('success', 'Industry Updated Successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE INDUSTRY
    |--------------------------------------------------------------------------
    */

public function destroy($id)
{
    $industry = Industry::findOrFail($id);
    $industry->delete();

    return redirect()->back()->with('success', 'Industry deleted successfully');
}


// Intrduction section strat



  public function introduction()
{
    $main = Introduction::where('type', 'main')->orderBy('id', 'desc')->first()
        ?? new Introduction(['type' => 'main']);

    $stats = Introduction::where('type', 'stat')->orderBy('sort_order', 'asc')->get();

    return view('admin.about-us.introduction.index', compact('main', 'stats'));
}

    // UPDATE / CREATE Main + Handle Repeatable Items
public function updateIntroduction(Request $request, $id)
{
    $data = $request->validate([
        'name'             => 'nullable|string|max:255',
        'title'            => 'nullable|string|max:255',
        'long_description' => 'nullable|string',
        'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp',
    ]);

    $introduction = $id == 0
        ? new Introduction()
        : Introduction::findOrFail($id);

    /*
    |--------------------------------------------------------------------------
    | Image Upload
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('image')) {

        if (
            !empty($introduction->image) &&
            file_exists(public_path($introduction->image))
        ) {
            unlink(public_path($introduction->image));
        }

        $image = $request->file('image');

        $imageName = $image->getClientOriginalName();

        $image->move(
            public_path('uploads/about-us'),
            $imageName
        );

        $data['image'] = 'uploads/about-us/' . $imageName;
    }

    /*
    |--------------------------------------------------------------------------
    | Stats Items JSON
    |--------------------------------------------------------------------------
    */

    $statsItems = [];

    $numbers  = $request->input('number', []);
    $headings = $request->input('heading', []);
    $icons    = $request->input('icon', []);
    $suffixes = $request->input('suffix', []);

    foreach ($numbers as $index => $number) {

        if (
            empty($number) &&
            empty($headings[$index]) &&
            empty($icons[$index]) &&
            empty($suffixes[$index])
        ) {
            continue;
        }

        $statsItems[] = [
            'number'  => $number,
            'heading' => $headings[$index] ?? '',
            'icon'    => $icons[$index] ?? '',
            'suffix'  => $suffixes[$index] ?? '',
        ];
    }

    $data['stats_items'] = $statsItems;

    /*
    |--------------------------------------------------------------------------
    | Defaults
    |--------------------------------------------------------------------------
    */

    $data['type'] = 'main';
    $data['status'] = 1;

    $introduction->fill($data);
    $introduction->save();

    return redirect()->back()->with(
        'success',
        'Introduction saved successfully.'
    );
}

    // DELETE
    public function destroyIntroduction($id)
    {
        $item = Introduction::findOrFail($id);

        // Delete image if exists
        if ($item->image && file_exists(public_path($item->image))) {
            unlink(public_path($item->image));
        }

        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully');
    }

    // statisitics page controller funcationlity



    
    public function statistics()
    {


        return view('admin.about-us.statistics.index');
    }



    // why-choose-us page controller funcationlity

    public function index()
    {
        $whyChooseItems = WhyChoose::orderBy('sort_order', 'ASC')->get();

        $mainData = WhyChoose::first();

        return view(
            'admin.about-us.why-choose-us.index',
            compact('whyChooseItems', 'mainData')
        );
    }

 public function update(Request $request)
    {
        $request->validate([

            'whychoose_title'   => 'nullable|string',

            'whychoose_heading' => 'nullable|string',

            'title.*'           => 'required',

            'description.*'     => 'required',

            'icon.*'            => 'nullable|image|mimes:jpg,jpeg,png,webp'

        ]);

        /*
        |--------------------------------------------------------------------------
        | Delete Old Rows
        |--------------------------------------------------------------------------
        */

        WhyChoose::truncate();

        /*
        |--------------------------------------------------------------------------
        | Save Data
        |--------------------------------------------------------------------------
        */

        if ($request->title) {

            foreach ($request->title as $key => $title) {

                /*
                |--------------------------------------------------------------------------
                | OLD ICON
                |--------------------------------------------------------------------------
                */

                $iconName = $request->old_icon[$key] ?? null;

                /*
                |--------------------------------------------------------------------------
                | NEW ICON UPLOAD
                |--------------------------------------------------------------------------
                */

                if ($request->hasFile("icon.$key")) {

                    $file = $request->file("icon.$key");

                    $iconName = $file->getClientOriginalName();

                    $file->move(
                        public_path('uploads/why-choose'),
                        $iconName
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | SAVE
                |--------------------------------------------------------------------------
                */

                WhyChoose::create([

                    'whychoose_title'   => $request->whychoose_title,

                    'whychoose_heading' => $request->whychoose_heading,

                    'icon'              => $iconName,

                    'title'             => $title,

                    'description'       => $request->description[$key],

                    'sort_order'        => $key + 1,

                    'status'            => 1

                ]);
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Why Choose Us Updated Successfully');
    }






    // clients page controller funcationlity


  public function clients()
    {
        $clients = Client::orderBy('sort_order', 'ASC')->get();

        $mainData = Client::first();

        return view(
            'admin.about-us.clients.index',
            compact('clients', 'mainData')
        );
    }


     public function updateClients(Request $request)
    {
        $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Main Data
            |--------------------------------------------------------------------------
            */

            'client_title'   => 'nullable|string',

            'client_heading' => 'nullable|string',

            /*
            |--------------------------------------------------------------------------
            | Item List
            |--------------------------------------------------------------------------
            */

            'name.*'         => 'required',

            'website.*'      => 'nullable',

            'logo.*'         => 'nullable|image|mimes:jpg,jpeg,png,webp'

        ]);

        /*
        |--------------------------------------------------------------------------
        | Delete Old Data
        |--------------------------------------------------------------------------
        */

        Client::truncate();

        /*
        |--------------------------------------------------------------------------
        | Save Multiple Rows
        |--------------------------------------------------------------------------
        */

        if ($request->name) {

            foreach ($request->name as $key => $name) {

                /*
                |--------------------------------------------------------------------------
                | OLD LOGO
                |--------------------------------------------------------------------------
                */

                $logoName = $request->old_logo[$key] ?? null;

                /*
                |--------------------------------------------------------------------------
                | NEW LOGO
                |--------------------------------------------------------------------------
                */

                if ($request->hasFile("logo.$key")) {

                    $file = $request->file("logo.$key");

                     $logoName = $file->getClientOriginalName();

                    $file->move(
                        public_path('uploads/clients'),
                        $logoName
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | SAVE
                |--------------------------------------------------------------------------
                */

                Client::create([

                    /*
                    |--------------------------------------------------------------------------
                    | Main Section Data
                    |--------------------------------------------------------------------------
                    */

                    'client_title'   => $request->client_title,

                    'client_heading' => $request->client_heading,

                    /*
                    |--------------------------------------------------------------------------
                    | Item List
                    |--------------------------------------------------------------------------
                    */

                    'name'           => $name,

                    'logo'           => $logoName,

                    'website'        => $request->website[$key] ?? null,

                    'sort_order'     => $key + 1,

                    'status'         => 1

                ]);
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Clients Updated Successfully');
    }


    // reviews  page controller funcationlity

public function reviews()
{
    $review = Review::getSingle();

    return view('admin.about-us.reviews.index', compact('review'));
}




public function updateReviews(Request $request, $id)
{
    $request->validate([
        // Main content
        'badge'             => 'nullable|string|max:255',
        'heading'           => 'nullable|string|max:255',
        'description_1'     => 'nullable|string',
        'description_2'     => 'nullable|string',
        'retention_rate'    => 'nullable|string|max:50',
        'satisfaction_rate' => 'nullable|string|max:50',

        // Platform reviews arrays
        'platform_title.*'      => 'nullable|string|max:255',
        'platform_rating.*'     => 'nullable|string|max:50',
        'platform_small_text.*' => 'nullable|string|max:255',
        'platform_icon.*'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'existing_icon.*'       => 'nullable|string',   // existing filename from hidden input

        // Testimonials arrays
        'testimonial_review.*'      => 'nullable|string',
        'testimonial_name.*'        => 'nullable|string|max:255',
        'testimonial_designation.*' => 'nullable|string|max:255',
    ]);

    // --------------------------------------------------------
    // 1. Build review_items JSON array
    // --------------------------------------------------------
    $reviewItems = [];

    if (!empty($request->platform_title)) {
        foreach ($request->platform_title as $key => $title) {

            // Skip completely empty rows
            if (
                empty($title) &&
                empty($request->platform_rating[$key] ?? '') &&
                empty($request->platform_small_text[$key] ?? '')
            ) {
                continue;
            }

            // Start with existing icon filename (from hidden field)
            $iconName = $request->existing_icon[$key] ?? null;

            // If new file uploaded — save it and replace
            if ($request->hasFile("platform_icon.$key")) {
                $file     = $request->file("platform_icon.$key");
                $iconName = $file->getClientOriginalName();
                $file->move(public_path('uploads/reviews'), $iconName);
            }

            $reviewItems[] = [
                'icon'       => $iconName,
                'title'      => $title,
                'rating'     => $request->platform_rating[$key]      ?? null,
                'small_text' => $request->platform_small_text[$key]  ?? null,
            ];
        }
    }

    // --------------------------------------------------------
    // 2. Build testimonial_items JSON array
    // --------------------------------------------------------
    $testimonialItems = [];

    if (!empty($request->testimonial_name)) {
        foreach ($request->testimonial_name as $key => $name) {

            // Skip completely empty rows
            if (
                empty($name) &&
                empty($request->testimonial_review[$key] ?? '') &&
                empty($request->testimonial_designation[$key] ?? '')
            ) {
                continue;
            }

            $testimonialItems[] = [
                'review'      => $request->testimonial_review[$key]      ?? null,
                'name'        => $name,
                'designation' => $request->testimonial_designation[$key] ?? null,
            ];
        }
    }

    // --------------------------------------------------------
    // 3. Upsert — always update id=1 row
    // --------------------------------------------------------
    Review::updateOrCreate(
        ['id' => 1],
        [
            'badge'             => $request->badge,
            'heading'           => $request->heading,
            'description_1'     => $request->description_1,
            'description_2'     => $request->description_2,
            'review_items'      => $reviewItems,      // saved as JSON automatically
            'testimonial_items' => $testimonialItems, // saved as JSON automatically
            'retention_rate'    => $request->retention_rate,
            'satisfaction_rate' => $request->satisfaction_rate,
        ]
    );

    return redirect()
        ->back()
        ->with('success', 'Reviews Section Updated Successfully!');
}


     // cta   page controller funcationlity

        public function cta()
    {
        $cta = AboutCTA::first();

        return view(
            'admin.about-us.cta.index',
            compact('cta')
        );
    }


        public function updateCta(Request $request, $id)
    {

        $cta = AboutCTA::find($id);

        if (!$cta) {

            $cta = new AboutCTA();

        }

        $cta->small_label   = $request->small_label;
        $cta->main_heading  = $request->main_heading;
        $cta->description   = $request->description;

        $cta->button_1_text = $request->button_1_text;
        $cta->button_1_url  = $request->button_1_url;

        $cta->button_2_text = $request->button_2_text;
        $cta->button_2_url  = $request->button_2_url;

        $cta->save();

        return redirect()
            ->back()
            ->with(
                'success',
                'CTA Section Updated Successfully.'
            );
    }

}