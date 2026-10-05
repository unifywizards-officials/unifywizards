<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\HomePortfolio;
use Illuminate\Http\Request;

class HomePortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:home-page');
    }

    public function edit()
    {
        $portfolio = HomePortfolio::first();

        return view(
            'admin.home.portfolio.index',
            compact('portfolio')
        );
    }

    public function update(Request $request)
    {
        $portfolio = HomePortfolio::first();

        $projects = [];

        if ($request->project_title) {

            foreach ($request->project_title as $key => $title) {

                $imagePath = '';

                /*
                |--------------------------------------------------------------------------
                | OLD IMAGE
                |--------------------------------------------------------------------------
                */

                if (isset($portfolio->projects_json[$key]['image'])) {

                    $imagePath = $portfolio->projects_json[$key]['image'];
                }

                /*
                |--------------------------------------------------------------------------
                | NEW IMAGE UPLOAD
                |--------------------------------------------------------------------------
                */

                if ($request->hasFile("project_image.$key")) {

                    $file = $request->file("project_image.$key");
                
                    // Real file name
                    $filename = $file->getClientOriginalName();
                
                    $destinationPath = public_path('uploads/home/portfolio');
                
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                
                    $file->move($destinationPath, $filename);
                
                    $imagePath = 'uploads/home/portfolio/' . $filename;
                }

                $projects[] = [

                    'category'     => $request->project_category[$key] ?? '',

                    'title'        => $title,

                    'project_link' => $request->project_link[$key] ?? '',

                    'image'        => $imagePath,

                ];
            }
        }

        $data = [

            'sub_title'      => $request->sub_title,

            'title'          => $request->title,

            'highlight_text' => $request->highlight_text,

            'description'    => $request->description,

            'button_text'    => $request->button_text,

            'button_link'    => $request->button_link,

            'projects_json'  => $projects,

            'status'         => $request->status,

        ];

        if ($portfolio) {

            $portfolio->update($data);

        } else {

            HomePortfolio::create($data);
        }

        return redirect()
            ->back()
            ->with('success', 'Portfolio section updated successfully');
    }
}