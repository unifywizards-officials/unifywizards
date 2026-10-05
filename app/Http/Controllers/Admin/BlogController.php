<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\DmPage;
use App\Services\SeoAnalyzerService;
use App\Services\ReadabilityAnalyzerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\BlogHistory;
use Mews\Purifier\Facades\Purifier;



class BlogController extends Controller
{
    public function __construct()
    {
         $this->middleware('permission:blogs');
      
    }

    public function index()
    {
        $blogs = Blog::with('user')->latest()->paginate(10);
        

        return view('admin.blogs.index', compact('blogs'));
    }

 public function create()
{
    $headerMenus = DmPage::headerMenus();

    $blog = null;

    return view(
        'admin.blogs.create',
        compact('headerMenus', 'blog')
    );
}

public function getServices(Request $request)
{
    $services = DmPage::where(
            'header_menu',
            $request->header_menu
        )
        ->orderBy('page_name')
        ->get([
            'id',
            'page_name'
        ]);

    return response()->json($services);
}

   
    public function store(Request $request)
    {
        $request->validate([

           'service_page_id' => 'required|exists:dm_pages,id',

            'title'                => 'required|string|max:255',
            'excerpt'              => 'nullable|string',
            'content'              => 'required|string',

            'featured_image' => 'nullable|image|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/webp|max:2048',

            'meta_title'           => 'nullable|string|max:255',
            'meta_description'     => 'nullable|string',

            'status'               => 'required|in:draft,published,archived',
            'published_at'         => 'nullable|date',

            // SEO
            'focus_keyword'        => 'nullable|string|max:255',
            'seo_score'            => 'nullable|integer',
            'seo_checks'           => 'nullable',

            // Readability
            'readability_errors'   => 'nullable|integer',
            'readability_checks'   => 'nullable',
            'title_checks'         => 'nullable',
        ]);

        $data = $request->all();

        $data['user_id'] = auth()->id();
        $data['slug']    = Str::slug($request->title);
        $data['content'] = Purifier::clean($data['content']);

        // Decode JSON fields
        $data['seo_checks'] = $request->seo_checks
            ? json_decode($request->seo_checks, true)
            : null;

        $data['readability_checks'] = $request->readability_checks
            ? json_decode($request->readability_checks, true)
            : null;

        $data['title_checks'] = $request->title_checks
            ? json_decode($request->title_checks, true)
            : null;

        // Upload image
         if ($request->hasFile('featured_image')) {

        $file = $request->file('featured_image');

        $fileName = $file->getClientOriginalName();

        $data['featured_image'] = $file->storeAs('blogs', $fileName, 'public');
    }

        $blog = Blog::create($data);

        BlogHistory::create([
        'blog_id'    => $blog->id,
        'user_id'    => auth()->id(),
        'action'     => 'Created',
        'blog_title' => $blog->title,
    ]);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');
    }



    public function show(Blog $blog)
    {
      //  dd(123);
        $blog->load('user');

        return view('admin.blogs.show', compact('blog'));
    }

public function edit(Blog $blog)
{
    $headerMenus = DmPage::headerMenus();

    return view(
        'admin.blogs.edit',
        compact(
            'blog',
            'headerMenus'
        )
    );
}

public function update(Request $request, Blog $blog)
{
    $request->validate([

        'service_page_id' => 'nullable|exists:dm_pages,id',
        'title' => 'required|string|max:255',

        'excerpt' => 'nullable|string',

        'content' => 'required|string',

       'featured_image' => 'nullable|image|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/webp|max:2048',

        'meta_title' => 'nullable|string|max:255',

        'meta_description' => 'nullable|string',

        'status' => 'required|in:draft,published,archived',

        'published_at' => 'nullable|date',

        'focus_keyword' => 'nullable|string|max:255',
    ]);

    $data = [

    'service_page_id' => $request->service_page_id,

        'title' => $request->title,

        'slug' => Str::slug($request->title),

        'excerpt' => $request->excerpt,

        'content' => Purifier::clean($request->content),

        'meta_title' => $request->meta_title,

        'meta_description' => $request->meta_description,

        'status' => $request->status,

        'published_at' => $request->published_at,

        'focus_keyword' => $request->focus_keyword,
    ];

    /*
    |--------------------------------------------------------------------------
    | IMAGE UPDATE
    |--------------------------------------------------------------------------
    */

 if ($request->hasFile('featured_image')) {

    // OLD IMAGE DELETE
    if ($blog->featured_image &&
        Storage::disk('public')->exists($blog->featured_image)) {

        Storage::disk('public')->delete($blog->featured_image);
    }

    // NEW IMAGE STORE WITH ORIGINAL FILE NAME
    $file = $request->file('featured_image');

    $fileName = $file->getClientOriginalName();

    $data['featured_image'] = $file->storeAs('blogs', $fileName, 'public');
}

    $blog->update($data);

    BlogHistory::create([
    'blog_id'    => $blog->id,
    'user_id'    => auth()->id(),
    'action'     => 'Updated',
    'blog_title' => $blog->title,
]);

    return redirect()
        ->route('admin.blogs.index')
        ->with('success', 'Blog updated successfully.');
}

    public function destroy(Blog $blog)
    {
        BlogHistory::create([
        'blog_id'    => $blog->id,
        'user_id'    => auth()->id(),
        'action'     => 'Deleted',
        'blog_title' => $blog->title,
    ]);
        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | SEO Analyzer Endpoint
    |--------------------------------------------------------------------------
    */

    public function analyzeSeo(
        Request $request,
        SeoAnalyzerService $seo
    ) {

        $request->validate([

            'focus_keyword'    => 'required|string|max:100',
            'seo_title'        => 'nullable|string',
            'meta_description' => 'nullable|string',
            'url'              => 'nullable|string',
            'content'          => 'nullable|string',
        ]);

        $result = $seo->analyze([

            'focus_keyword'    => $request->focus_keyword,
            'seo_title'        => $request->seo_title ?? '',
            'meta_description' => $request->meta_description ?? '',
            'url'              => $request->url ?? '',
            'content'          => $request->content ?? '',
        ]);

        return response()->json($result);
    }

    /*
    |--------------------------------------------------------------------------
    | Readability Analyzer Endpoint
    |--------------------------------------------------------------------------
    */

    public function analyzeReadability(
        Request $request,
        ReadabilityAnalyzerService $readability
    ) {

        $request->validate([
            'content' => 'required|string',
        ]);

        $result = $readability->analyze(
            $request->content
        );

        return response()->json($result);
    }


public function history(Blog $blog)
{
    $histories = BlogHistory::with('user')
        ->where('blog_id', $blog->id)
        ->latest()
        ->paginate(20);

       // dd($histories);

    return view('admin.blogs.history', compact('blog', 'histories'));
}


}