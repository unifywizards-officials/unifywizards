<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeWhyChoose;
use Illuminate\Http\Request;

class HomeWhyChooseController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:home-page');
    }

    public function edit()
    {
        $whyChoose = HomeWhyChoose::first();

        return view(
            'admin.home.why-choose.edit',
            compact('whyChoose')
        );
    }

    public function update(Request $request)
    {
        $items = [];

        if ($request->item_title) {

            foreach ($request->item_title as $key => $value) {

                if (trim($value) === '' && trim($request->item_description[$key] ?? '') === '') {
                    continue;
                }

                $items[] = [

                    'title' => $value,

                    'description' => $request->item_description[$key] ?? '',
                ];
            }
        }

        HomeWhyChoose::updateOrCreate(

            ['id' => 1],

            [

                'sub_title' => $request->sub_title,

                'title' => $request->title,

                'description' => $request->description,

                'items' => $items,

                'status' => $request->status
            ]
        );

        return redirect()->back()->with(

            'success',
            'Why Choose Us (Home) Section Updated Successfully.'
        );
    }
}
