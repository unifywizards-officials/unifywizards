<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeAwardRecognition;
use Illuminate\Http\Request;

class HomeAwardRecognitionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:home-page');
    }

    public function edit()
    {
        $awards = HomeAwardRecognition::first();

        return view(
            'admin.home.awards-recognition.edit',
            compact('awards')
        );
    }

    public function update(Request $request)
    {
        $awardItems = [];

        if ($request->award_name) {

            foreach ($request->award_name as $key => $value) {

                $awardItems[] = [

                    'year' => $request->award_year[$key] ?? '',

                    'award_name' => $request->award_name[$key] ?? '',

                    'award_by' => $request->award_by[$key] ?? '',

                    'location' => $request->award_location[$key] ?? '',

                    'category' => $request->award_category[$key] ?? '',

                    'icon_class' => $request->award_icon[$key] ?? '',

                    'card_type' => $request->card_type[$key] ?? 'normal',
                ];
            }
        }

        HomeAwardRecognition::updateOrCreate(

            ['id' => 1],

            [

                'sub_title' => $request->sub_title,

                'title' => $request->title,

                'description' => $request->description,

                'button_text' => $request->button_text,

                'button_link' => $request->button_link,

                'bottom_text' => $request->bottom_text,

                'award_items' => $awardItems,

                'status' => $request->status
            ]
        );

        return redirect()->back()->with(

            'success',
            'Awards & Recognition Section Updated Successfully.'
        );
    }
}