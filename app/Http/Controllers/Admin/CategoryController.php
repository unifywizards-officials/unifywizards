<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view categories')->only(['index', 'show']);
        $this->middleware('permission:create categories')->only(['create', 'store']);
        $this->middleware('permission:edit categories')->only(['edit', 'update']);
        $this->middleware('permission:delete categories')->only(['destroy']);
    }

    public function index()
    {
      $categories = Category::get();
        return view('admin.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.pages.categories.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required',
        ]);
        Category::create($validatedData);
        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully!');
      }

      public function edit($id)
        {
            $category = Category::findOrFail($id);
            return view('admin.pages.categories.edit', compact('category'));
        }

      public function update(Request $request, $id)
       {
           $validatedData = $request->validate([
               'category_name' => 'required',
           ]);
            $category = Category::findOrFail($id);
           $category->update($validatedData);
            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
       }

       public function show($id)
      {
          $category = Category::findOrFail($id);
          return view('admin.pages.categories.show', compact('category'));
      }

      public function destroy($id)
      {
          $category = Category::findOrFail($id);
          $category->delete();
          return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
      }

}
