<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RecentAward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecentAwardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:recent-awards');
    }

    /**
     * Show Recent Awards edit page.
     */
    public function edit()
    {
        $recentAwards = RecentAward::first();

        /*
        |--------------------------------------------------------------------------
        | If record does not exist, create empty record
        |--------------------------------------------------------------------------
        */

        if (!$recentAwards) {
            $recentAwards = RecentAward::create([
                'title' => 'Recent Awards',
                'description' => '',
                'awards' => [],
            ]);
        }

        return view('admin.recent-awards.edit', compact('recentAwards'));
    }


    /**
     * Update Recent Awards.
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'awards' => [
                'nullable',
                'array',
            ],

            'awards.*.title' => [
                'required',
                'string',
                'max:255',
            ],

            'awards.*.description' => [
                'nullable',
                'string',
            ],

            'awards.*.logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'awards.*.existing_logo' => [
                'nullable',
                'string',
            ],
        ]);


        $recentAwards = RecentAward::first();

        if (!$recentAwards) {
            $recentAwards = new RecentAward();
        }


        /*
        |--------------------------------------------------------------------------
        | Main Section Data
        |--------------------------------------------------------------------------
        */

        $recentAwards->title = $request->title;
        $recentAwards->description = $request->description;


        /*
        |--------------------------------------------------------------------------
        | Existing Awards
        |--------------------------------------------------------------------------
        */

        $oldAwards = $recentAwards->awards ?? [];

        if (!is_array($oldAwards)) {
            $oldAwards = [];
        }


        /*
        |--------------------------------------------------------------------------
        | New Awards
        |--------------------------------------------------------------------------
        */

        $awards = $request->input('awards', []);

        if (!is_array($awards)) {
            $awards = [];
        }


        $finalAwards = [];


        foreach ($awards as $index => $award) {

            $title = $award['title'] ?? '';
            $description = $award['description'] ?? '';

            /*
            |--------------------------------------------------------------------------
            | Existing Logo
            |--------------------------------------------------------------------------
            */

            $logoPath = $award['existing_logo'] ?? null;


            /*
            |--------------------------------------------------------------------------
            | Upload New Logo
            |--------------------------------------------------------------------------
            */

            if (
                $request->hasFile("awards.$index.logo") &&
                $request->file("awards.$index.logo")->isValid()
            ) {

                /*
                |--------------------------------------------------------------------------
                | Delete old logo if replacing
                |--------------------------------------------------------------------------
                */

                if (!empty($logoPath)) {
                    $oldLogoPath = str_replace(
                        asset('storage') . '/',
                        '',
                        $logoPath
                    );

                    if (Storage::disk('public')->exists($oldLogoPath)) {
                        Storage::disk('public')->delete($oldLogoPath);
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | Store New Logo
                |--------------------------------------------------------------------------
                */

                $uploadedLogo = $request->file("awards.$index.logo");

                $logoPath = $uploadedLogo->store(
                    'recent-awards',
                    'public'
                );

                $logoPath = 'storage/' . $logoPath;
            }


            /*
            |--------------------------------------------------------------------------
            | Save Award JSON
            |--------------------------------------------------------------------------
            */

            $finalAwards[] = [
                'title' => $title,
                'description' => $description,
                'logo' => $logoPath,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | Save JSON
        |--------------------------------------------------------------------------
        */

        $recentAwards->awards = $finalAwards;

        $recentAwards->save();


        return redirect()
            ->route('recent-awards.edit')
            ->with('success', 'Recent Awards updated successfully.');
    }
}