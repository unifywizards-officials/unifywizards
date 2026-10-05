<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:settings');
    }

    public function index()
    {
        $setting = Setting::first();

        return view('admin.settings.index', compact('setting'));
    }

   public function update(Request $request)
{
     
    $request->validate([

        'header_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp',

        'footer_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp',

        'dark_footer_logo1' => 'nullable|image|mimes:jpg,jpeg,png,webp',

        'dark_footer_logo2' => 'nullable|image|mimes:jpg,jpeg,png,webp',

        'favicon' => 'nullable|file|mimes:png,jpg,jpeg,ico,webp',

        'footer_email' => 'nullable|email',

        'footer_description' => 'nullable|string',

        'footer_number' => 'nullable|string|max:30',

        'location' => 'nullable|string',
        'google_map_embed' => 'nullable|string',

    ]);

   // dd($request->google_map_embed);

    $setting = Setting::first();

    if (!$setting) {

        $setting = new Setting();
    }

    /*
    |--------------------------------------------------------------------------
    | Upload Header Logo
    |--------------------------------------------------------------------------
    */

   if ($request->hasFile('header_logo')) {

    $file = $request->file('header_logo');

    $fileName = $file->getClientOriginalName();

    $setting->header_logo = $file->storeAs('settings', $fileName, 'public');
}

    /*
    |--------------------------------------------------------------------------
    | Upload Footer Logo
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('footer_logo')) {

        $file = $request->file('footer_logo');

        $fileName = $file->getClientOriginalName();

        $setting->footer_logo = $file->storeAs('settings', $fileName, 'public');
    }

    /*
    |--------------------------------------------------------------------------
    | Upload Dark Footer Logo 1
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('dark_footer_logo1')) {

        $file = $request->file('dark_footer_logo1');

        $fileName = $file->getClientOriginalName();

        $setting->dark_footer_logo1 = $file->storeAs('settings', $fileName, 'public');
    }

    /*
    |--------------------------------------------------------------------------
    | Upload Dark Footer Logo 2
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('dark_footer_logo2')) {

        $file = $request->file('dark_footer_logo2');

        $fileName = $file->getClientOriginalName();

        $setting->dark_footer_logo2 = $file->storeAs('settings', $fileName, 'public');
    }

    /*
    |--------------------------------------------------------------------------
    | Upload Favicon
    |--------------------------------------------------------------------------
    */
if ($request->hasFile('favicon')) {

    $file = $request->file('favicon');

    $fileName = $file->getClientOriginalName();

    $setting->favicon = $file->storeAs('settings', $fileName, 'public');
}

    /*
    |--------------------------------------------------------------------------
    | Save Basic Settings
    |--------------------------------------------------------------------------
    */

    $setting->footer_description = $request->footer_description;

    $setting->footer_email = $request->footer_email;

    $setting->footer_number = $request->footer_number;

    $setting->location = $request->location;
   $setting->google_map_embed = $this->sanitizeMapEmbed($request->google_map_embed);

    /*
    |--------------------------------------------------------------------------
    | Save Social Links
    |--------------------------------------------------------------------------
    */

    $socialLinks = [];

    if ($request->social_name && $request->social_link) {

        foreach ($request->social_name as $key => $name) {

            if (
                !empty($name) &&
                !empty($request->social_link[$key])
            ) {

                $socialLinks[] = [

                    'name' => $name,

                    'link' => $request->social_link[$key],

                ];
            }
        }
    }

    $setting->social_links = $socialLinks;

    /*
    |--------------------------------------------------------------------------
    | Save Settings
    |--------------------------------------------------------------------------
    */

    $setting->save();

    return redirect()
        ->back()
        ->with(
            'success',
            'Settings Updated Successfully'
        );
}

/**
 * Only Google Maps <iframe> embeds are allowed here. Everything else
 * (scripts, event handlers, non-Google src values) is discarded rather
 * than "cleaned", because an HTML purifier's default safe-tag list
 * doesn't include <iframe> at all and would silently strip a
 * legitimate map embed too.
 */
private function sanitizeMapEmbed(?string $html): ?string
{
    if (empty($html)) {
        return null;
    }

    if (!preg_match('/<iframe[^>]*\ssrc=["\']([^"\']+)["\'][^>]*>/i', $html, $matches)) {
        return null;
    }

    $src = $matches[1];
    $host = parse_url($src, PHP_URL_HOST);

    if (
        !in_array(strtolower(parse_url($src, PHP_URL_SCHEME) ?? ''), ['https'], true)
        || !in_array(strtolower($host ?? ''), ['www.google.com', 'maps.google.com'], true)
    ) {
        return null;
    }

    return '<iframe src="' . htmlspecialchars($src, ENT_QUOTES) . '" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
}
}