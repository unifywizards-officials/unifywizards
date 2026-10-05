<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OutstandingResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OutstandingResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:outstanding-results');
    }

    /**
     * Empty data structure for a single category.
     */
    protected function defaultCategoryData(string $key, string $label): array
    {
        return [
            'key' => $key,
            'label' => $label,
            'website' => null,
            'challenge' => null,
            'results_percentage' => null,
            'results_summary' => null,
            'keywords' => [],
            'case_study_link' => null,
            'analytics_heading' => null,
            'analytics_image' => null,
        ];
    }


    /**
     * Starting set of categories for a brand-new record.
     */
    protected function defaultResults(): array
    {
        return [
            $this->defaultCategoryData('insurance', 'Insurance'),
            $this->defaultCategoryData('automobile', 'Automobile'),
            $this->defaultCategoryData('hotel_tourism', 'Hotel & Tourism'),
            $this->defaultCategoryData('advertising_agency', 'Advertising Agency'),
        ];
    }


    /**
     * Normalize whatever is currently stored (old fixed-key shape, legacy
     * screenshot-path strings, or the current list shape) into a clean list
     * of category entries so every admin action can rely on one shape.
     */
    protected function normalizeResults($results): array
    {
        if (!is_array($results) || empty($results)) {
            return [];
        }

        /* Already the current list-of-categories shape */
        if (array_is_list($results) && isset($results[0]['key'])) {

            return array_map(
                fn ($entry) => array_merge(
                    $this->defaultCategoryData($entry['key'], $entry['label'] ?? $entry['key']),
                    $entry
                ),
                $results
            );
        }

        /* Old fixed-key shape: ['insurance' => [...] | 'path' | null, ...] */
        $labels = [
            'insurance' => 'Insurance',
            'automobile' => 'Automobile',
            'hotel_tourism' => 'Hotel & Tourism',
            'advertising_agency' => 'Advertising Agency',
        ];

        $normalized = [];

        foreach ($results as $key => $value) {

            $label = $labels[$key] ?? Str::headline($key);

            if (is_array($value)) {

                $normalized[] = array_merge(
                    $this->defaultCategoryData($key, $value['label'] ?? $label),
                    $value,
                    ['key' => $key]
                );

            } else {

                /* Legacy entry: a plain screenshot path string (or null) */
                $normalized[] = array_merge(
                    $this->defaultCategoryData($key, $label),
                    ['analytics_image' => $value ?: null]
                );
            }
        }

        return $normalized;
    }


    /**
     * Turn a category label into a unique, URL/array-safe key.
     */
    protected function uniqueKey(string $label, array $existing): string
    {
        $base = Str::slug($label, '_') ?: 'category';
        $key = $base;
        $i = 2;

        $existingKeys = array_column($existing, 'key');

        while (in_array($key, $existingKeys, true)) {
            $key = $base . '_' . $i;
            $i++;
        }

        return $key;
    }


    /**
     * Show Outstanding Results edit page.
     */
    public function edit()
    {
        $outstandingResult = OutstandingResult::first();

        if (!$outstandingResult) {

            $outstandingResult = OutstandingResult::create([
                'heading' => 'Outstanding Results',
                'description' => '',
                'results' => $this->defaultResults(),
                'status' => 1,
            ]);

        } else {

            /* Migrate old-shape data transparently on first load */
            $normalized = $this->normalizeResults($outstandingResult->results);

            if ($normalized !== $outstandingResult->results) {
                $outstandingResult->results = $normalized;
                $outstandingResult->save();
            }
        }

        return view(
            'admin.outstanding-results.edit',
            compact('outstandingResult')
        );
    }


    /**
     * Add a new (empty) category.
     */
    public function addCategory(Request $request)
    {
        $request->validate([
            'new_category_label' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $outstandingResult = OutstandingResult::first();

        if (!$outstandingResult) {
            $outstandingResult = new OutstandingResult();
            $outstandingResult->heading = 'Outstanding Results';
            $outstandingResult->status = 1;
            $outstandingResult->results = [];
        }

        $results = $this->normalizeResults($outstandingResult->results);

        $label = trim($request->new_category_label);
        $key = $this->uniqueKey($label, $results);

        $results[] = $this->defaultCategoryData($key, $label);

        $outstandingResult->results = $results;
        $outstandingResult->save();

        return redirect()
            ->route('outstanding-results.edit')
            ->with('success', 'Category added successfully.');
    }


    /**
     * Remove a category (and its uploaded analytics image, if any).
     */
    public function removeCategory(string $key)
    {
        $outstandingResult = OutstandingResult::first();

        if (!$outstandingResult) {
            return redirect()->route('outstanding-results.edit');
        }

        $results = $this->normalizeResults($outstandingResult->results);

        if (count($results) <= 1) {
            return redirect()
                ->route('outstanding-results.edit')
                ->with('error', 'At least one category is required.');
        }

        $remaining = [];

        foreach ($results as $entry) {

            if ($entry['key'] === $key) {

                if (
                    !empty($entry['analytics_image']) &&
                    Storage::disk('public')->exists($entry['analytics_image'])
                ) {
                    Storage::disk('public')->delete($entry['analytics_image']);
                }

                continue;
            }

            $remaining[] = $entry;
        }

        $outstandingResult->results = $remaining;
        $outstandingResult->save();

        return redirect()
            ->route('outstanding-results.edit')
            ->with('success', 'Category removed successfully.');
    }


    /**
     * Update Outstanding Results.
     */
    public function update(Request $request)
    {
        $request->validate([

            'heading' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'category' => [
                'nullable',
                'string',
            ],

            'category_label' => [
                'nullable',
                'string',
                'max:255',
            ],

            'website' => [
                'nullable',
                'string',
                'max:255',
            ],

            'challenge' => [
                'nullable',
                'string',
            ],

            'results_percentage' => [
                'nullable',
                'string',
                'max:50',
            ],

            'results_summary' => [
                'nullable',
                'string',
            ],

            'case_study_link' => [
                'nullable',
                'url',
                'max:255',
            ],

            'analytics_heading' => [
                'nullable',
                'string',
                'max:255',
            ],

            'analytics_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'keywords' => [
                'nullable',
                'array',
            ],

            'keywords.*.keyword' => [
                'nullable',
                'string',
                'max:255',
            ],

            'keywords.*.ranking' => [
                'nullable',
                'string',
                'max:50',
            ],

            'remove_analytics_image' => [
                'nullable',
                'array',
            ],

            'remove_analytics_image.*' => [
                'string',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Get / create record
        |--------------------------------------------------------------------------
        */

        $outstandingResult = OutstandingResult::first();

        if (!$outstandingResult) {
            $outstandingResult = new OutstandingResult();
            $outstandingResult->results = $this->defaultResults();
        }


        /*
        |--------------------------------------------------------------------------
        | Heading / description / status
        |--------------------------------------------------------------------------
        */

        $outstandingResult->heading = $request->heading;

        $outstandingResult->description = $request->description;

        $outstandingResult->status =
            $request->has('status') ? 1 : 0;


        /*
        |--------------------------------------------------------------------------
        | Existing categories, normalized
        |--------------------------------------------------------------------------
        */

        $results = $this->normalizeResults($outstandingResult->results);


        /*
        |--------------------------------------------------------------------------
        | Remove analytics image(s) selected from the preview cards
        |--------------------------------------------------------------------------
        */

        $removeKeys = $request->input('remove_analytics_image', []);

        foreach ($results as &$entry) {

            if (!in_array($entry['key'], $removeKeys, true)) {
                continue;
            }

            if (
                !empty($entry['analytics_image']) &&
                Storage::disk('public')->exists($entry['analytics_image'])
            ) {
                Storage::disk('public')->delete($entry['analytics_image']);
            }

            $entry['analytics_image'] = null;
        }

        unset($entry);


        /*
        |--------------------------------------------------------------------------
        | Save the submitted category's fields
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {

            $categoryKey = $request->category;

            foreach ($results as &$entry) {

                if ($entry['key'] !== $categoryKey) {
                    continue;
                }

                if ($request->filled('category_label')) {
                    $entry['label'] = trim($request->category_label);
                }

                $entry['website'] = $request->input('website');
                $entry['challenge'] = $request->input('challenge');
                $entry['results_percentage'] = $request->input('results_percentage');
                $entry['results_summary'] = $request->input('results_summary');
                $entry['case_study_link'] = $request->input('case_study_link');
                $entry['analytics_heading'] = $request->input('analytics_heading');


                /*
                |--------------------------------------------------------------------------
                | Keywords (drop fully-empty rows)
                |--------------------------------------------------------------------------
                */

                $keywords = [];

                foreach ($request->input('keywords', []) as $row) {

                    $keyword = trim($row['keyword'] ?? '');
                    $ranking = trim($row['ranking'] ?? '');

                    if ($keyword !== '' || $ranking !== '') {
                        $keywords[] = [
                            'keyword' => $keyword,
                            'ranking' => $ranking,
                        ];
                    }
                }

                $entry['keywords'] = $keywords;


                /*
                |--------------------------------------------------------------------------
                | Analytics image upload
                |--------------------------------------------------------------------------
                */

                if ($request->hasFile('analytics_image')) {

                    if (
                        !empty($entry['analytics_image']) &&
                        Storage::disk('public')->exists($entry['analytics_image'])
                    ) {
                        Storage::disk('public')->delete($entry['analytics_image']);
                    }

                    $entry['analytics_image'] = $request
                        ->file('analytics_image')
                        ->store('outstanding-results', 'public');
                }

                break;
            }

            unset($entry);
        }


        /*
        |--------------------------------------------------------------------------
        | Save
        |--------------------------------------------------------------------------
        */

        $outstandingResult->results = $results;

        $outstandingResult->save();


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('outstanding-results.edit')
            ->with(
                'success',
                'Outstanding Results updated successfully.'
            );
    }
}
