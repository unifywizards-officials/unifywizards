<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientRecommend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientRecommendController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:client-recommendations');
    }

    /**
     * Show edit page.
     */
    public function edit()
    {
        $clientRecommend = ClientRecommend::first();

        if (!$clientRecommend) {
            $clientRecommend = new ClientRecommend([
                'title'       => '',
                'description' => '',
                'status'      => true,
                'clients'     => [],
            ]);
        }

        return view('admin.client-recommend.edit', compact('clientRecommend'));
    }

    /**
     * Update (or create, if none exists yet) Clients Recommend section.
     */
    public function update(Request $request)
    {
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'nullable|boolean',

            'clients'               => 'nullable|array',
            'clients.*.name'        => 'nullable|string|max:255',
            'clients.*.designation' => 'nullable|string|max:255',
            'clients.*.destination' => 'nullable|string|max:255',
            'clients.*.image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'clients.*.video'       => 'nullable|file|mimes:mp4,mov,avi,webm|max:20480',
            'clients.*.old_image'   => 'nullable|string',
            'clients.*.old_video'   => 'nullable|string',
        ]);

        $clientRecommend = ClientRecommend::first();

        $clientsInput = $request->input('clients', []);
        $clients = [];

        foreach ($clientsInput as $i => $data) {

            if (!is_array($data)) {
                continue;
            }

            $client = [
                'name'        => $data['name'] ?? null,
                'designation' => $data['designation'] ?? null,
                'destination' => $data['destination'] ?? null,
                'image'       => $data['old_image'] ?? null,
                'video'       => $data['old_video'] ?? null,
            ];

            /*
            |--------------------------------------------------------------------------
            | Image (nested file input: clients.$i.image)
            |--------------------------------------------------------------------------
            */
            $newImage = $request->file("clients.$i.image");

            if ($newImage) {

                if (!empty($client['image'])) {
                    Storage::disk('public')->delete($client['image']);
                }

                $client['image'] = $newImage->store('client-recommend/images', 'public');
            }

            /*
            |--------------------------------------------------------------------------
            | Video (nested file input: clients.$i.video)
            |--------------------------------------------------------------------------
            */
            $newVideo = $request->file("clients.$i.video");

            if ($newVideo) {

                if (!empty($client['video'])) {
                    Storage::disk('public')->delete($client['video']);
                }

                $client['video'] = $newVideo->store('client-recommend/videos', 'public');
            }

            /*
            |--------------------------------------------------------------------------
            | Skip fully empty rows
            |--------------------------------------------------------------------------
            */
            if (
                empty($client['name']) &&
                empty($client['designation']) &&
                empty($client['destination']) &&
                empty($client['image']) &&
                empty($client['video'])
            ) {
                continue;
            }

            $clients[] = $client;
        }

        ClientRecommend::updateOrCreate(
            ['id' => optional($clientRecommend)->id ?? 1],
            [
                'title'       => $request->title,
                'description' => $request->description,
                'status'      => $request->boolean('status'),
                'clients'     => $clients,
            ]
        );

        return redirect()
            ->route('client-recommend.edit')
            ->with('success', 'Clients Recommend section updated successfully.');
    }
}
