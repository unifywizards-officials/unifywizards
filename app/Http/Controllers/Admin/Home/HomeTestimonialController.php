<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeTestimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeTestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:home-page');
    }

    public function edit()
    {
        $testimonial = HomeTestimonial::first();

        return view(
            'admin.home.testimonials.index',
            compact('testimonial')
        );
    }

    public function update(Request $request)
    {
        $request->validate([

            'sub_title' => 'nullable|string|max:255',

            'title' => 'nullable|string|max:255',

            'highlight_text' => 'nullable|string|max:255',

            'testimonial_name.*' => 'nullable|string|max:255',

            'testimonial_designation.*' => 'nullable|string|max:255',

            'testimonial_description.*' => 'nullable|string',

            'testimonial_image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $testimonial = HomeTestimonial::first();

        $oldTestimonials = $testimonial->testimonials_json ?? [];

        $testimonials = [];

        if ($request->testimonial_name) {

            foreach ($request->testimonial_name as $key => $name) {

                $imagePath = $oldTestimonials[$key]['image'] ?? null;

                // Upload new image
              
              if ($request->hasFile("testimonial_image.$key")) {
            
                // delete old image
                if ($imagePath && File::exists(public_path($imagePath))) {
                    File::delete(public_path($imagePath));
                }
            
                $file = $request->file("testimonial_image.$key");
            
                // Real file name
                $fileName = $file->getClientOriginalName();
            
                $destinationPath = public_path('uploads/home/testimonials');
            
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
            
                $file->move($destinationPath, $fileName);
            
                $imagePath = 'uploads/home/testimonials/' . $fileName;
            }
              
              
              

                $testimonials[] = [

                    'name' => $name,

                    'designation' => $request->testimonial_designation[$key] ?? '',

                    'description' => $request->testimonial_description[$key] ?? '',

                    'image' => $imagePath,
                ];
            }
        }

        $data = [

            'sub_title'        => $request->sub_title,

            'title'            => $request->title,

            'highlight_text'   => $request->highlight_text,

            'testimonials_json'=> $testimonials,

            'status'           => $request->status,
        ];

        if ($testimonial) {

            $testimonial->update($data);

        } else {

            HomeTestimonial::create($data);
        }

        return redirect()
            ->back()
            ->with('success', 'Testimonials section updated successfully');
    }
}