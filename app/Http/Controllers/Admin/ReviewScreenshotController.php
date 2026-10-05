<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReviewScreenshot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewScreenshotController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:review-screenshots');
    }

    /**
     * Fixed review platforms (brand identity is not admin-editable —
     * only the screenshot per platform is).
     */
    protected array $platformKeys = [
        'clutch',
        'trustpilot',
        'google',
    ];


    /**
     * Show Review Screenshots edit page.
     */
    public function edit()
    {
        $reviewScreenshot = ReviewScreenshot::first();

        return view('admin.review-screenshots.edit', compact('reviewScreenshot'));
    }


    /**
     * Update Review Screenshots section.
     */
    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',

            'highlight_text' => 'nullable|string|max:255',

            'description' => 'nullable|string',

            'status' => 'nullable|boolean',

            'platform_image' => 'nullable|array',

            'platform_image.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'remove_platform_image' => 'nullable|array',

            'remove_platform_image.*' => 'in:clutch,trustpilot,google',
        ]);

        $reviewScreenshot = ReviewScreenshot::first();

        if (!$reviewScreenshot) {
            $reviewScreenshot = new ReviewScreenshot();
            $reviewScreenshot->images = [];
        }

        /*
        |--------------------------------------------------------------------------
        | Basic Fields
        |--------------------------------------------------------------------------
        */

        $reviewScreenshot->heading = $request->heading;
        $reviewScreenshot->highlight_text = $request->highlight_text;
        $reviewScreenshot->description = $request->description;
        $reviewScreenshot->status = $request->boolean('status', true);

        /*
        |--------------------------------------------------------------------------
        | Existing platform images, backfilled with every known platform
        |--------------------------------------------------------------------------
        */

        $images = $reviewScreenshot->images ?? [];

        if (!is_array($images)) {
            $images = [];
        }

        foreach ($this->platformKeys as $key) {
            $images[$key] = $images[$key] ?? null;
        }

        /*
        |--------------------------------------------------------------------------
        | Remove screenshot(s)
        |--------------------------------------------------------------------------
        */

        foreach ($request->input('remove_platform_image', []) as $key) {

            if (!empty($images[$key]) && Storage::disk('public')->exists($images[$key])) {
                Storage::disk('public')->delete($images[$key]);
            }

            $images[$key] = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Upload new screenshot(s)
        |--------------------------------------------------------------------------
        */

        foreach ($this->platformKeys as $key) {

            if (!$request->hasFile("platform_image.$key")) {
                continue;
            }

            if (!empty($images[$key]) && Storage::disk('public')->exists($images[$key])) {
                Storage::disk('public')->delete($images[$key]);
            }

            $images[$key] = $request
                ->file("platform_image.$key")
                ->store('review-screenshots', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Save
        |--------------------------------------------------------------------------
        */

        $reviewScreenshot->images = $images;

        $reviewScreenshot->save();

        return redirect()
            ->route('review-screenshots.edit')
            ->with('success', 'Review Screenshots updated successfully.');
    }
}
