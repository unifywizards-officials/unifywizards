<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeCompanyOverview;

class HomeCompanyOverviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:home-page');
    }

    public function edit()
    {
        $overview = HomeCompanyOverview::first();

        return view(
            'admin.home.company-overview.edit',
            compact('overview')
        );
    }

    public function update(Request $request)
    {
        $overview = HomeCompanyOverview::first();

        if (!$overview) {

            $overview = new HomeCompanyOverview();
        }

        /*
        |--------------------------------------------------------------------------
        | Basic Fields
        |--------------------------------------------------------------------------
        */

        $overview->sub_title = $request->sub_title;

        $overview->title = $request->title;

        $overview->button_text = $request->button_text;

        $overview->button_link = $request->button_link;

        $overview->video_url = $request->video_url;

        $overview->customer_text = $request->customer_text;

        $overview->status = $request->status;

        /*
        |--------------------------------------------------------------------------
        | Main Image Upload
        |--------------------------------------------------------------------------
        */

     if ($request->hasFile('main_image')) {

    $file = $request->file('main_image');

    $filename = time() . '_' . $file->getClientOriginalName();

    $file->move(public_path('uploads/company-overview'), $filename);

    $overview->main_image = 'uploads/company-overview/' . $filename;
}

        /*
        |--------------------------------------------------------------------------
        | Customer Background Upload
        |--------------------------------------------------------------------------
        */

       if ($request->hasFile('customer_bg')) {

    $file = $request->file('customer_bg');

    $filename = time() . '_' . $file->getClientOriginalName();

    $file->move(public_path('uploads/company-overview'), $filename);

    $overview->customer_bg = 'uploads/company-overview/' . $filename;
}

        /*
        |--------------------------------------------------------------------------
        | Customer Images Multiple Upload
        |--------------------------------------------------------------------------
        */

        $customerImages = [];

        /*
        | Old Images
        */

        if ($request->old_customer_images) {

            foreach ($request->old_customer_images as $oldImage) {

                $customerImages[] = $oldImage;
            }
        }

        /*
        | New Images
        */

       if ($request->hasFile('customer_images')) {

    foreach ($request->file('customer_images') as $image) {

        if ($image) {

           $filename = $image->getClientOriginalName();

            $image->move(public_path('uploads/company-overview'), $filename);

            $customerImages[] = 'uploads/company-overview/' . $filename;
        }
    }
}

        $overview->customer_images = $customerImages;

        /*
        |--------------------------------------------------------------------------
        | Counter Data
        |--------------------------------------------------------------------------
        */

        $counters = [];

        if ($request->counter_title) {

            foreach ($request->counter_title as $key => $title) {

                $counters[] = [

                    'icon' => $request->counter_icon[$key] ?? '',

                    'title' => $title,

                    'number' => $request->counter_number[$key] ?? ''
                ];
            }
        }

        $overview->counters = $counters;

        /*
        |--------------------------------------------------------------------------
        | Save
        |--------------------------------------------------------------------------
        */

        $overview->save();

        return redirect()
            ->back()
            ->with('success', 'Company Overview Updated Successfully');
    }
}