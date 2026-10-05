<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomePricing;
use Illuminate\Http\Request;

class HomePricingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:home-page');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT PAGE
    |--------------------------------------------------------------------------
    */

    public function edit()
    {
        $pricing = HomePricing::first();

        if (!$pricing) {

            $pricing = HomePricing::create([
                'status' => 1
            ]);
        }

        return view(
            'admin.home.pricing.edit',
            compact('pricing')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {
        $pricing = HomePricing::first();

        if (!$pricing) {

            $pricing = new HomePricing();
        }

        $cards = [];

        if ($request->card_title) {

            foreach ($request->card_title as $key => $title) {

                /*
                |--------------------------------------------------------------------------
                | TAGS
                |--------------------------------------------------------------------------
                */

                $tags = [];

                if (
                    isset($request->card_tags[$key]) &&
                    is_array($request->card_tags[$key])
                ) {

                    foreach ($request->card_tags[$key] as $tag) {

                        if (
                            !empty($tag['text']) ||
                            !empty($tag['icon'])
                        ) {

                            $tags[] = [
                                'text' => $tag['text'] ?? '',
                                'icon' => $tag['icon'] ?? '',
                            ];
                        }
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | CARD ARRAY
                |--------------------------------------------------------------------------
                */

                $cards[] = [

                    'layout' =>
                        $request->card_layout[$key] ?? 'normal',

                    'color' =>
                        $request->card_color[$key] ?? 'blue',

                    'featured' =>
                        $request->card_featured[$key] ?? 0,

                    'icon' =>
                        $request->card_icon[$key] ?? '',

                    'title' =>
                        $request->card_title[$key] ?? '',

                    'subtitle' =>
                        $request->card_subtitle[$key] ?? '',

                    'price' =>
                        $request->card_price[$key] ?? '',

                    'price_unit' =>
                        $request->card_price_unit[$key] ?? '',

                    'tags' =>
                        $tags,

                    'explore_button_text' =>
                        $request->explore_button_text[$key] ?? '',

                    'explore_button_link' =>
                        $request->explore_button_link[$key] ?? '',

                    'contact_button_text' =>
                        $request->contact_button_text[$key] ?? '',

                    'contact_button_link' =>
                        $request->contact_button_link[$key] ?? '',
                ];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE SECTION
        |--------------------------------------------------------------------------
        */

        $pricing->title =
            $request->title;

        $pricing->highlight_text =
            $request->highlight_text;

        $pricing->pricing_cards =
            $cards;

        $pricing->status =
            $request->status;

        $pricing->save();

        return back()->with(
            'success',
            'Pricing Section Updated Successfully'
        );
    }
}