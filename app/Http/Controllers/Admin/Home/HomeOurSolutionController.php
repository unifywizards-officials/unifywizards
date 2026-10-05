<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeOurSolution;
use Illuminate\Http\Request;

class HomeOurSolutionController extends Controller
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
        $solution = HomeOurSolution::first();

        if (!$solution) {

            $solution = HomeOurSolution::create([
                'status' => 1
            ]);
        }

        return view(
            'admin.home.our-solutions.edit',
            compact('solution')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {
        $solution = HomeOurSolution::first();

        if (!$solution) {

            $solution = new HomeOurSolution();
        }

        /*
        |--------------------------------------------------------------------------
        | SERVICES ARRAY
        |--------------------------------------------------------------------------
        */

        $services = [];

        if ($request->service_title) {

            foreach ($request->service_title as $key => $title) {

                /*
                |--------------------------------------------------------------------------
                | OLD IMAGE
                |--------------------------------------------------------------------------
                */

                $oldImage =
                    $request->old_service_image[$key] ?? null;

                $imagePath = $oldImage;

                /*
                |--------------------------------------------------------------------------
                | NEW IMAGE UPLOAD
                |--------------------------------------------------------------------------
                */

               if ($request->hasFile("service_image.$key")) {

                    $file = $request->file("service_image.$key");
                
                    // Real file name
                    $fileName = $file->getClientOriginalName();
                
                    $destination = public_path('uploads/home/solutions');
                
                    if (!file_exists($destination)) {
                        mkdir($destination, 0777, true);
                    }
                
                    $file->move($destination, $fileName);
                
                    $imagePath = 'uploads/home/solutions/' . $fileName;
                }

                /*
                |--------------------------------------------------------------------------
                | TAG BUTTONS
                |--------------------------------------------------------------------------
                */

                $tags = [];

                if (
                    isset($request->service_tags[$key]) &&
                    is_array($request->service_tags[$key])
                ) {

                    foreach ($request->service_tags[$key] as $tag) {

                        if (
                            !empty($tag['text']) ||
                            !empty($tag['link'])
                        ) {

                            $tags[] = [

                                'text' =>
                                    $tag['text'] ?? '',

                                'link' =>
                                    $tag['link'] ?? '',
                            ];
                        }
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | SERVICE ARRAY
                |--------------------------------------------------------------------------
                */

                $services[] = [

                    'icon' =>
                        $request->service_icon[$key] ?? '',

                    'title' =>
                        $request->service_title[$key] ?? '',

                    'description' =>
                        $request->service_description[$key] ?? '',

                    'image' =>
                        $imagePath,

                    'tags' =>
                        $tags,

                    'button_text' =>
                        $request->button_text[$key] ?? '',

                    'button_link' =>
                        $request->button_link[$key] ?? '',
                ];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE SECTION DATA
        |--------------------------------------------------------------------------
        */

        $solution->sub_title =
            $request->sub_title;

        $solution->title =
            $request->title;

        $solution->highlight_text =
            $request->highlight_text;

        $solution->services =
            $services;

        $solution->bottom_text =
            $request->bottom_text;

        $solution->bottom_button_text =
            $request->bottom_button_text;

        $solution->bottom_button_link =
            $request->bottom_button_link;

        $solution->status =
            $request->status;

        $solution->save();

        return back()->with(
            'success',
            'Our Solutions Updated Successfully'
        );
    }
}