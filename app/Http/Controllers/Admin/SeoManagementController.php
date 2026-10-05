<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeoSetting;

class SeoManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:seo');
    }

    // SEO List
    public function index()
    {
        $seoPages = SeoSetting::latest()->paginate(10);

        return view('admin.seo.index', compact('seoPages'));
    }

    // create funcation

    // Create SEO Page
public function create()
{
    
    return view('admin.seo.create');
}

// Store SEO
public function store(Request $request)
{
    $request->validate([
        'page_name'        => 'required',
        'page_slug'        => 'required|unique:seo_settings,page_slug',
        'meta_title'       => 'nullable',
        'meta_description' => 'nullable',
        'og_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $seo = new SeoSetting();

    if ($request->hasFile('og_image')) {
        $seo->og_image = $request->file('og_image')
            ->store('seo', 'public');
    }

    $seo->page_name = $request->page_name;
    $seo->page_slug = $request->page_slug;
    $seo->meta_title = $request->meta_title;
    $seo->meta_description = $request->meta_description;
    $seo->meta_keywords = $request->meta_keywords;
    $seo->canonical_url = $request->canonical_url;
    $seo->robots = $request->robots;
    $seo->og_title = $request->og_title;
    $seo->og_description = $request->og_description;

    $seo->save();

    return redirect()
        ->route('admin.seo.index')
        ->with('success', 'SEO Created Successfully');
}

    // Edit SEO
    public function edit($id)
    {
        $seo = SeoSetting::findOrFail($id);

        return view('admin.seo.edit', compact('seo'));
    }

    // Update SEO
    public function update(Request $request, $id)
    {
        $seo = SeoSetting::findOrFail($id);

        $request->validate([
            'page_name' => 'required',
            'page_slug' => 'required',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
        ]);

        // Upload OG Image
        if ($request->hasFile('og_image')) {

            $image = $request->file('og_image')
                ->store('seo', 'public');

            $seo->og_image = $image;
        }

        $seo->page_name = $request->page_name;
        $seo->page_slug = $request->page_slug;

        $seo->meta_title = $request->meta_title;
        $seo->meta_description = $request->meta_description;
        $seo->meta_keywords = $request->meta_keywords;

        $seo->canonical_url = $request->canonical_url;
        $seo->robots = $request->robots;

        $seo->og_title = $request->og_title;
        $seo->og_description = $request->og_description;

        $seo->save();

        return redirect()
            ->route('admin.seo.index')
            ->with('success', 'SEO Updated Successfully');
    }


public function destroy($id)
{
$seo = SeoSetting::findOrFail($id);

// Agar image delete karni ho to
if ($seo->og_image && \Storage::disk('public')->exists($seo->og_image)) {
    \Storage::disk('public')->delete($seo->og_image);
}

$seo->delete();

return redirect()
    ->route('admin.seo.index')
    ->with('success', 'SEO Deleted Successfully');

}


}