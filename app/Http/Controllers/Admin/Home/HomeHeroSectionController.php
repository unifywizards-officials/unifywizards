<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeHeroSection;

class HomeHeroSectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:home-page');
    }

    public function edit()
    {
        $hero = HomeHeroSection::first();

        return view(
            'admin.home.hero-section.edit',
            compact('hero')
        );
    }

    public function update(Request $request)
{
    $hero = HomeHeroSection::first();

    if (!$hero) {
        $hero = new HomeHeroSection();
    }

    $hero->sub_title      = $request->sub_title;
    $hero->title          = $request->title;
    $hero->highlight_text = $request->highlight_text;
    $hero->description    = $request->description;
    $hero->status         = $request->status;

    $hero->customer_count = $request->customer_count;
    $hero->customer_text  = $request->customer_text;

    /*
    |--------------------------------------------------------------------------
    | Hero Image
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('hero_image')) {

    $file = $request->file('hero_image');

    // Real file name
    $name = $file->getClientOriginalName();

    $file->move(
        public_path('uploads/home/hero'),
        $name
    );

    $hero->hero_image = 'uploads/home/hero/' . $name;
}

    /*
    |--------------------------------------------------------------------------
    | Pattern Shape
    |--------------------------------------------------------------------------
    */

  if ($request->hasFile('pattern_shape')) {

    $file = $request->file('pattern_shape');

    // Real file name
    $name = $file->getClientOriginalName();

    $file->move(
        public_path('uploads/home/pattern'),
        $name
    );

    $hero->pattern_shape = 'uploads/home/pattern/' . $name;
}

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER IMAGES DELETE
    |--------------------------------------------------------------------------
    */

    $customerImages = [];

    if (!empty($hero->customer_images)) {

        $customerImages = is_array($hero->customer_images)
            ? $hero->customer_images
            : json_decode($hero->customer_images, true);
    }

    if ($request->delete_customer_images) {

        foreach ($request->delete_customer_images as $deleteImage) {

            if (($key = array_search($deleteImage, $customerImages)) !== false) {

                if (file_exists(public_path($deleteImage))) {

                    unlink(public_path($deleteImage));
                }

                unset($customerImages[$key]);
            }
        }

        $customerImages = array_values($customerImages);
    }

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER IMAGES ADD
    |--------------------------------------------------------------------------
    */

if ($request->hasFile('customer_images')) {

    foreach ($request->file('customer_images') as $image) {

        if ($image) {

            // Real file name
            $name = $image->getClientOriginalName();

            $image->move(
                public_path('uploads/home/customers'),
                $name
            );

            $customerImages[] = 'uploads/home/customers/' . $name;
        }
    }
}

    $hero->customer_images = json_encode($customerImages);

    /*
    |--------------------------------------------------------------------------
    | AWARD IMAGES DELETE
    |--------------------------------------------------------------------------
    */

    $awardImages = [];

    if (!empty($hero->award_images)) {

        $awardImages = is_array($hero->award_images)
            ? $hero->award_images
            : json_decode($hero->award_images, true);
    }

    if ($request->delete_award_images) {

        foreach ($request->delete_award_images as $deleteImage) {

            if (($key = array_search($deleteImage, $awardImages)) !== false) {

                if (file_exists(public_path($deleteImage))) {

                    unlink(public_path($deleteImage));
                }

                unset($awardImages[$key]);
            }
        }

        $awardImages = array_values($awardImages);
    }

    /*
    |--------------------------------------------------------------------------
    | AWARD IMAGES ADD
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('award_images')) {

    foreach ($request->file('award_images') as $image) {

        if ($image) {

            // Real file name
            $name = $image->getClientOriginalName();

            $image->move(
                public_path('uploads/home/awards'),
                $name
            );

            $awardImages[] = 'uploads/home/awards/' . $name;
        }
    }
}

    $hero->award_images = json_encode($awardImages);

    $hero->save();

    return back()->with(
        'success',
        'Hero Section Updated Successfully'
    );
}


}