<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeRecognitionPress;

class HomeRecognitionPressController extends Controller
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
        $recognition = HomeRecognitionPress::first();

        if (!$recognition) {

            $recognition = HomeRecognitionPress::create([
                'status' => 1
            ]);
        }

        return view(
            'admin.home.recognition-press.edit',
            compact('recognition')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {
        $recognition = HomeRecognitionPress::first();

        if (!$recognition) {

            $recognition = new HomeRecognitionPress();
        }

        $pressItems = [];

        if ($request->press_name) {

            foreach ($request->press_name as $key => $value) {

                $logo = null;

                /*
                |--------------------------------------------------------------------------
                | LOGO UPLOAD
                |--------------------------------------------------------------------------
                */
                if ($request->hasFile("press_logo.$key")) {
                
                    $file = $request->file("press_logo.$key");
                
                    // Real file name
                    $filename = $file->getClientOriginalName();
                
                    $file->move(
                        public_path('uploads/recognition-press'),
                        $filename
                    );
                
                    $logo = 'uploads/recognition-press/' . $filename;
                
                } else {
                
                    $logo = $request->old_press_logo[$key] ?? null;
                }

                /*
                |--------------------------------------------------------------------------
                | PRESS ITEMS ARRAY
                |--------------------------------------------------------------------------
                */

                $pressItems[] = [

                    'logo' => $logo,

                    'name' => $request->press_name[$key] ?? '',

                    'label' => $request->press_label[$key] ?? '',
                ];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE DATA
        |--------------------------------------------------------------------------
        */

        $recognition->sub_title =
            $request->sub_title;

        $recognition->title =
            $request->title;

        $recognition->description =
            $request->description;

        $recognition->press_items =
            $pressItems;

        $recognition->status =
            $request->status;

        $recognition->save();

        return back()->with(
            'success',
            'Recognition & Press Section Updated Successfully'
        );
    }
}