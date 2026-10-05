<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:pages');

    }

    public function index()
    {
        $pages = Page::get();
        return view('admin.pages.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.pages.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'               => 'required',
            'date'                => 'required',
            'status'              => 'required',
            'description'         => 'required',
        ]);

        Page::create([
            'status'        => $request->status,
            'description'   => $request->description,
            'date'          => $request->date,
            'title'         => $request->title,
        ]);
        return redirect()->route('admin.pages.index')->with('success', 'Page added successfully!');
    }


        public function edit($id)
          {
            $Page = Page::findOrFail($id);
            return view('admin.pages.pages.edit', compact('Page'));
          }


          public function update(Request $request, $id)
      {
          $request->validate([
            'title'               => 'required',
            'date'                => 'required',
            'status'              => 'required',
            'description'         => 'required',
          ]);
          $Page = Page::findOrFail($id);
          $Page->status = $request->status;
          $Page->title = $request->title;
          $Page->date = $request->date;
          $Page->description = $request->description;
          $Page->save();
          return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully!');
      }

       public function show($id)
      {
          $Page = Page::findOrFail($id);
          return view('admin.pages.pages.show', compact('Page'));
      }

      public function destroy($id)
      {
          $Page = Page::findOrFail($id);
          $Page->delete();
          return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully!');
      }


}
