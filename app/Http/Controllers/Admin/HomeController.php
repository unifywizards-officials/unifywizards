<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Blog;
use App\Models\DmPage;
use App\Models\Contact;
use App\Models\ContactInquiry;
use App\Models\ContactProposal;
use App\Models\NewsletterSubscriber;
use App\Models\BlogForm;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalBlogs = Blog::count();
        $publishedBlogs = Blog::published()->count();
        $totalServices = DmPage::count();
        $totalContacts = Contact::count() + ContactInquiry::count() + ContactProposal::count();
        $totalNewsletters = NewsletterSubscriber::count();
        $totalBlogForms = BlogForm::count();

        return view('admin.home', compact(
            'totalBlogs',
            'publishedBlogs',
            'totalServices',
            'totalContacts',
            'totalNewsletters',
            'totalBlogForms'
        ));
    }
    public function editProfile()
    {
        $user = Auth::user();
        return view('admin.pages.profile.edit', compact('user'));
    }

   public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

     if ($request->hasFile('profile_image')) {

    if ($user->profile_image) {
        Storage::delete('public/' . $user->profile_image);
    }

    $file = $request->file('profile_image');

    $fileName = $file->getClientOriginalName();

    $imagePath = $file->storeAs('profile_images', $fileName, 'public');

    $user->profile_image = $imagePath;
}

        $user->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
     }
     
     
    public function logout()
    {
        Auth::user()->logout();
        return redirect()->route('login');
    }
}
