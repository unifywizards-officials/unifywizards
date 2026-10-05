<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SitePage;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class SitePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:site-pages');
    }

    public function termsConditions()
    {
        $page = SitePage::firstOrCreate([
            'page_key' => 'terms_conditions'
        ]);

        return view('admin.site-pages.terms-conditions', compact('page'));
    }

    public function saveTermsConditions(Request $request)
    {
        SitePage::updateOrCreate(
            ['page_key' => 'terms_conditions'],
            ['description' => Purifier::clean($request->description)]
        );

        return back()->with('success', 'Terms & Conditions updated successfully.');
    }

    public function privacyPolicy()
    {
        $page = SitePage::firstOrCreate([
            'page_key' => 'privacy_policy'
        ]);

        return view('admin.site-pages.privacy-policy', compact('page'));
    }

    public function savePrivacyPolicy(Request $request)
    {
        SitePage::updateOrCreate(
            ['page_key' => 'privacy_policy'],
            ['description' => Purifier::clean($request->description)]
        );

        return back()->with('success', 'Privacy Policy updated successfully.');
    }
}