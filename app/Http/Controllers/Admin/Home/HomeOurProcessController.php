<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeOurProcess;

class HomeOurProcessController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:home-page');
    }

    /**
     * Edit Page
     */
    public function edit()
    {
        $process = HomeOurProcess::first();

        return view(
            'admin.home.our-process.edit',
            compact('process')
        );
    }

    /**
     * Update
     */
    public function update(Request $request)
    {
        $process = HomeOurProcess::first();

        if (!$process) {

            $process = new HomeOurProcess();
        }

        $items = [];

        if ($request->process_title) {

            foreach ($request->process_title as $key => $title) {

                $items[] = [

                    'step' => $request->process_step[$key] ?? '',

                    'icon' => $request->process_icon[$key] ?? '',

                    'title' => $title,

                    'description_1' => $request->process_description_1[$key] ?? '',

                    'description_2' => $request->process_description_2[$key] ?? '',
                ];
            }
        }

        $process->sub_title = $request->sub_title;

        $process->title = $request->title;

        $process->description_1 = $request->description_1;

        $process->description_2 = $request->description_2;

        $process->button_text = $request->button_text;

        $process->button_link = $request->button_link;

        $process->process_items = $items;

        $process->status = $request->status;

        $process->save();

        return back()->with(
            'success',
            'Our Process Section Updated Successfully.'
        );
    }
}