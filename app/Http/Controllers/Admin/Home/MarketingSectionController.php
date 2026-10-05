<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\MarketingSection;
use Illuminate\Http\Request;

class MarketingSectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:home-page');
    }

    public function index()
    {
        $section = MarketingSection::first();

        return view(
            'admin.home.marketing_sections.index',
            compact('section')
        );
    }


    public function storeOrUpdate(Request $request)
    {
        $tabs = [];

        if ($request->tab_title) {

            foreach ($request->tab_title as $index => $title) {

                $points = [];
                $tags = [];

                // ================= POINTS =================

                if (isset($request->point_title[$index])) {

                    foreach ($request->point_title[$index] as $pointIndex => $pointTitle) {

                        $points[] = [
                            'title' => $pointTitle,
                            'description' => $request->point_description[$index][$pointIndex] ?? '',
                        ];
                    }
                }

                // ================= TAGS =================

                if (isset($request->tag_text[$index])) {

                    foreach ($request->tag_text[$index] as $tagIndex => $tagText) {

                        $tags[] = [
                            'text' => $tagText,
                            'link' => $request->tag_link[$index][$tagIndex] ?? '',
                        ];
                    }
                }

                // ================= TAB ARRAY =================

                $tabs[] = [
                    'tab_title' => $title,
                    'tab_slug' => $request->tab_slug[$index] ?? '',
                    'points' => $points,
                    'tags' => $tags,
                ];
            }
        }

        MarketingSection::updateOrCreate(
            ['id' => 1],
            [
                'title' => $request->title,
                'highlight_text' => $request->highlight_text,
                'description' => $request->description,
                'link_text' => $request->link_text,
                'link_url' => $request->link_url,
                'tabs' => $tabs,
                'status' => $request->status,
            ]
        );

        return redirect()
            ->back()
            ->with('success', 'Section Saved Successfully');
    }
}