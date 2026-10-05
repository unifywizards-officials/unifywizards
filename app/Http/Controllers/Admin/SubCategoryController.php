<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view sub-categories')->only(['index', 'show']);
        $this->middleware('permission:create sub-categories')->only(['create', 'store']);
        $this->middleware('permission:edit sub-categories')->only(['edit', 'update']);
        $this->middleware('permission:delete sub-categories')->only(['destroy']);
    }

    public function index()
    {
      $subcategorys = SubCategory::get();
        return view('admin.pages.subcategories.index', compact('subcategorys'));
    }

    public function create()
    {
        return view('admin.pages.subcategories.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sub_category_name' => 'required',
        ]);
        SubCategory::create($validatedData);
        return redirect()->route('admin.sub-categories.index')->with('success', 'Sub Category added successfully!');
      }

      public function edit($id)
        {
            $SubCategory = SubCategory::findOrFail($id);
            return view('admin.pages.subcategories.edit', compact('SubCategory'));
        }

      public function update(Request $request, $id)
       {
           $validatedData = $request->validate([
               'sub_category_name' => 'required',
           ]);
            $SubCategory = SubCategory::findOrFail($id);
           $SubCategory->update($validatedData);
            return redirect()->route('admin.sub-categories.index')->with('success', 'Sub Category updated successfully!');
       }

       public function show($id)
      {
          $SubCategory = SubCategory::findOrFail($id);
          return view('admin.pages.subcategories.show', compact('SubCategory'));
      }

      public function destroy($id)
      {
          $SubCategory = SubCategory::findOrFail($id);
          $SubCategory->delete();
          return redirect()->route('admin.sub-categories.index')->with('success', 'Sub Category deleted successfully!');
      }

}
