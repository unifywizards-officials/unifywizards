<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeIndustry;
use Illuminate\Http\Request;

class HomeIndustryController extends Controller
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
        $industry = HomeIndustry::first();

        if (!$industry) {

            $industry = HomeIndustry::create([
                'status' => 1
            ]);
        }

        return view(
            'admin.home.industries.edit',
            compact('industry')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {
        $industry = HomeIndustry::first();

        if (!$industry) {

            $industry = new HomeIndustry();
        }

        $industries = [];

        if ($request->industry_title) {

            foreach ($request->industry_title as $key => $title) {

                /*
                |--------------------------------------------------------------------------
                | IMAGE UPLOAD
                |--------------------------------------------------------------------------
                */

             $image = $request->old_industry_image[$key] ?? '';

                if (
                    $request->hasFile('industry_image') &&
                    isset($request->file('industry_image')[$key])
                ) {
                
                    $file = $request->file('industry_image')[$key];
                
                    // Real file name
                    $filename = $file->getClientOriginalName();
                
                    $file->move(
                        public_path('uploads/industries'),
                        $filename
                    );
                
                    $image = 'uploads/industries/' . $filename;
                }

                /*
                |--------------------------------------------------------------------------
                | SAVE ARRAY
                |--------------------------------------------------------------------------
                */

                $industries[] = [

                    'image' =>
                        $image,

                    'tag' =>
                        $request->industry_tag[$key] ?? '',

                    'title' =>
                        $request->industry_title[$key] ?? '',

                    'description_1' =>
                        $request->description_1[$key] ?? '',

                    'description_2' =>
                        $request->description_2[$key] ?? '',

                    'button_text' =>
                        $request->industry_button_text[$key] ?? '',

                    'button_link' =>
                        $request->industry_button_link[$key] ?? '',
                ];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE SECTION
        |--------------------------------------------------------------------------
        */

        $industry->sub_title =
            $request->sub_title;

        $industry->title =
            $request->title;

        $industry->button_text =
            $request->button_text;

        $industry->button_link =
            $request->button_link;

        $industry->industries =
            $industries;

        $industry->status =
            $request->status;

        $industry->save();

        return back()->with(
            'success',
            'Industries Section Updated Successfully'
        );
    }
}