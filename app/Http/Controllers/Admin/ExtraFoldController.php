<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExtraFold;
use Illuminate\Support\Facades\Storage;

class ExtraFoldController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:extra-folds');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $folds = ExtraFold::orderBy('sort_order', 'asc')->paginate(15);

        return view('admin.extrafold.index', compact('folds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.extrafold.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'page_url'    => 'required',
            'title'       => 'nullable',
            'heading'     => 'nullable',
            'description' => 'nullable',
            'image'       => 'nullable|image',
            'sort_order'  => 'nullable|integer',
            'status'      => 'nullable',
            'button_name' => 'nullable',
            'button_url'  => 'nullable',
        ]);

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $fileName = $file->getClientOriginalName();

            $data['image'] = $file->storeAs('extrafolds', $fileName, 'public');
        }

        ExtraFold::create($data);

        return redirect()
            ->route('admin.extrafold.index')
            ->with('success', 'Extra Fold created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExtraFold $extrafold)
    {
        $fold = $extrafold;

        return view('admin.extrafold.edit', compact('fold'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExtraFold $extrafold)
    {
        $data = $request->validate([
            'page_url'    => 'required',
            'title'       => 'nullable',
            'heading'     => 'nullable',
            'description' => 'nullable',
            'image'       => 'nullable|image',
            'sort_order'  => 'nullable|integer',
            'status'      => 'nullable',
            'button_name' => 'nullable',
            'button_url'  => 'nullable',
        ]);

       if ($request->hasFile('image')) {

            // Delete old image
            if ($extrafold->image && Storage::disk('public')->exists($extrafold->image)) {
                Storage::disk('public')->delete($extrafold->image);
            }

            $file = $request->file('image');

            $fileName = $file->getClientOriginalName();

            $data['image'] = $file->storeAs('extrafolds', $fileName, 'public');

        } else {
            unset($data['image']);
        }

        $extrafold->update($data);

        return redirect()
            ->route('admin.extrafold.index')
            ->with('success', 'Extra Fold updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExtraFold $extrafold)
    {
        if ($extrafold->image && \Storage::disk('public')->exists($extrafold->image)) {
            \Storage::disk('public')->delete($extrafold->image);
        }

        $extrafold->delete();

        return redirect()
            ->route('admin.extrafold.index')
            ->with('success', 'Extra Fold deleted successfully.');
    }
}
