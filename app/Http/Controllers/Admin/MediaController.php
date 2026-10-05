<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:media');
    }

    public function index()
    {
        $media = Media::latest()->get();

        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:5120'
        ]);

        $file = $request->file('image');

        $path = $file->store('uploads/media', 'public');

        Media::create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => 'storage/'.$path,
            'file_url' => asset('storage/'.$path),
            'file_type' => $file->getClientMimeType(),
        ]);

        return back()->with('success','Image Uploaded');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        if(File::exists(public_path($media->file_path))){
            File::delete(public_path($media->file_path));
        }

        $media->delete();

        return back()->with('success','Deleted Successfully');
    }
}