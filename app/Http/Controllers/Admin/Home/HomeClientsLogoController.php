<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeClientsLogo;

class HomeClientsLogoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:home-page');
    }

    public function edit()
    {
        $clientsLogo = HomeClientsLogo::first();

        return view(
            'admin.home.clients-logo.edit',
            compact('clientsLogo')
        );
    }

    public function update(Request $request)
    {
        $clientsLogo = HomeClientsLogo::first();

        if (!$clientsLogo) {

            $clientsLogo = new HomeClientsLogo();
        }

        $clientsLogo->title            = $request->title;
        $clientsLogo->highlight_number = $request->highlight_number;
        $clientsLogo->highlight_text   = $request->highlight_text;
        $clientsLogo->status           = $request->status;

        /*
        |--------------------------------------------------------------------------
        | LOGOS DELETE
        |--------------------------------------------------------------------------
        */

        $logos = [];

        if (!empty($clientsLogo->logos)) {

            $logos = is_array($clientsLogo->logos)
                ? $clientsLogo->logos
                : json_decode($clientsLogo->logos, true);
        }

        if ($request->delete_logos) {

            foreach ($request->delete_logos as $deleteLogo) {

                if (($key = array_search($deleteLogo, $logos)) !== false) {

                    if (file_exists(public_path($deleteLogo))) {

                        unlink(public_path($deleteLogo));
                    }

                    unset($logos[$key]);
                }
            }

            $logos = array_values($logos);
        }

        /*
        |--------------------------------------------------------------------------
        | LOGOS ADD
        |--------------------------------------------------------------------------
        */

       if ($request->hasFile('logos')) {

        foreach ($request->file('logos') as $image) {
    
            if ($image) {
    
                // Real file name
                $name = $image->getClientOriginalName();
    
                $image->move(
                    public_path('uploads/home/clients-logo'),
                    $name
                );
    
                $logos[] = 'uploads/home/clients-logo/' . $name;
            }
        }
    }

        $clientsLogo->logos = json_encode($logos);

        $clientsLogo->save();

        return back()->with(
            'success',
            'Clients Logo Section Updated Successfully'
        );
    }
}