<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeCta;
use Illuminate\Http\Request;

class HomeCtaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:home-page');
    }

    public function edit()
    {
        $cta = HomeCta::first();

        return view(
            'admin.home.cta.index',
            compact('cta')
        );
    }

    public function update(Request $request)
    {
        $request->validate([

            'title' => 'nullable|string|max:255',

            'description' => 'nullable|string|max:1000',

            'button_text' => 'nullable|string|max:255',

            'button_link' => 'nullable|string|max:255',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg',

            'status' => 'required|boolean',
        ]);

        $cta = HomeCta::first();

        $data = [

            'title' => $request->title,

            'description' => $request->description,

            'button_text' => $request->button_text,

            'button_link' => $request->button_link,

            'status' => $request->status,
        ];

        /*
        |--------------------------------------------------------------------------
        | IMAGE UPLOAD
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

        if (
            $cta &&
            $cta->image &&
            file_exists(public_path($cta->image))
        ) {
            unlink(public_path($cta->image));
        }
    
        $image = $request->file('image');
    
        // Real file name
        $imageName = $image->getClientOriginalName();
    
        $image->move(
            public_path('uploads/home/cta'),
            $imageName
        );
    
        $data['image'] = 'uploads/home/cta/' . $imageName;
    }
            if ($cta) {

            $cta->update($data);

        } else {

            HomeCta::create($data);
        }

        return redirect()
            ->back()
            ->with('success', 'CTA section updated successfully.');
    }
}