<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeHeroSection;
use App\Models\HomeClientsLogo;
use App\Models\HomeOurSolution;
use App\Models\HomePricing;
use App\Models\HomeIndustry;
use App\Models\HomeRecognitionPress;
use App\Models\HomeCompanyOverview;
use App\Models\HomeOurProcess;
use App\Models\HomeAwardRecognition;
use App\Models\MarketingSection;
use App\Models\HomePortfolio;
use App\Models\HomeCta;
use App\Models\HomeTestimonial;
use App\Models\OutstandingResult;
use App\Models\ClientRecommend;
use App\Models\HomeWhyChoose;
use App\Models\ReviewScreenshot;
use App\Models\Blog;
use App\Models\DmPage;
use App\Models\Setting;


class FrontHomeController extends Controller
{
    public function index()
    {
      $gethero = HomeHeroSection::first();
      $getclientlogo = HomeClientsLogo::first();
      $getoursolution = HomeOurSolution::first();
      $gethomePricing = HomePricing::first();
      $gethomeindustry = HomeIndustry::first();
      $getrecognitionpress = HomeRecognitionPress::first();
      $getcompanyoverview = HomeCompanyOverview::first();
      $getourprocess = HomeOurProcess::first();
      $getawardsrecognition = HomeAwardRecognition::first();
      $getmarketingsection = MarketingSection::first();
      //dd($getmarketingsection);
      $getportfolio = HomePortfolio::first();
      $getoutstandingresult = OutstandingResult::first();
      $gethomecta = HomeCta::first();
      $gettestimonial = HomeTestimonial::first();
      $getclientrecommend = ClientRecommend::first();
      $getwhychoose = HomeWhyChoose::first();
      $getreviewscreenshot = ReviewScreenshot::first();
      $getblogs = Blog::where('status', 'published')->latest()->take(3)->get();
      $getnumber = Setting::first();
    //  dd($getnumber);
     
     //dd($gettestimonial);
      return view('index', compact('gethero',
        'getclientlogo',
        'getoursolution',
        'gethomePricing',
        'gethomeindustry',
        'getrecognitionpress',
        'getcompanyoverview',
        'getourprocess',
        'getawardsrecognition',
        'getmarketingsection',
        'getportfolio',
        'getoutstandingresult',
        'gethomecta',
        'gettestimonial',
        'getclientrecommend',
        'getwhychoose',
        'getreviewscreenshot',
        'getblogs',
        'getnumber'
     
        ));
    }

public function services()
{
    $services = DmPage::all();

    return view('services', compact('services'));
}



public function show($slug)
{
    $page = DmPage::where('slug', $slug)
        ->where('is_active', 1)
        ->firstOrFail();

    $relatedBlogs = Blog::with('user')
        ->where('service_page_id', $page->id)
        ->where('status', 'published')
        ->latest()
        ->take(3)
        ->get();

    return view(
        'services.show',
        compact(
            'page',
            'relatedBlogs'
        )
    );
}

// public function show($slug)

// {
//     //dd($slug);
//     $page = DmPage::where('slug', $slug)
//         ->where('is_active', 1)
//         ->firstOrFail();
//    // dd($page);

//     return view('services.show', compact('page'));
// }



public function showblogtype(Request $request)
{
    $query = Blog::query();

    // Search
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%");
        });
    }

    // Category filter
    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    $blogs = $query
        ->latest()
        ->paginate(6);

    $categories = DmPage::headerMenus();

    if ($request->ajax()) {
        return response()->json([
            'html' => view('partials.blog-card', [
                'blogs' => $blogs
            ])->render(),

            'next_page_url' => $blogs->nextPageUrl(),

            'has_more_pages' => $blogs->hasMorePages(),
        ]);
    }

    return view('blogs', compact(
        'blogs',
        'categories'
    ));
}



}