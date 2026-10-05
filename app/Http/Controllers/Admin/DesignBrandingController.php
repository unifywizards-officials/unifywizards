<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesignBrandingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:design-branding');
    }

    public function index()
    {
        return view('admin.design_branding.index');
    }



     public function create()
    {
        return view('admin.design_branding.create');
    }


      public function edit($id)
    {
        // future me data fetch kar lena
        return view('admin.design_branding.edit', compact('id'));
    }
}
