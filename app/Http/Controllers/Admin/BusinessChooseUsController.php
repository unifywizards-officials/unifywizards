<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessChooseUs;
use Illuminate\Http\Request;

class BusinessChooseUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:business-choose-us');
    }

    /**
     * Edit Businesses Choose Us section
     */
    public function edit()
    {
        $businessChooseUs = BusinessChooseUs::first();

        return view(
            'admin.business-choose-us.edit',
            compact('businessChooseUs')
        );
    }


    /**
     * Update Businesses Choose Us section
     */
    public function update(Request $request)
    {
        $request->validate([
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',

            'choose_items' => 'nullable|array',

            'choose_items.*.title' => 'nullable|string|max:255',

            'choose_items.*.description' => 'nullable|string',

            'status' => 'nullable|boolean',
        ]);

        $businessChooseUs = BusinessChooseUs::first();

        $data = [
            'heading' => $request->heading,
            'description' => $request->description,
            'choose_items' => $request->choose_items,
            'status' => $request->has('status') ? 1 : 0,
        ];

        if ($businessChooseUs) {
            $businessChooseUs->update($data);
        } else {
            BusinessChooseUs::create($data);
        }

        return redirect()
            ->route('business-choose-us.edit')
            ->with(
                'success',
                'Businesses Choose Us section updated successfully.'
            );
    }
}