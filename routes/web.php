<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SeoManagementController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\DigitalMarketingController;
use App\Http\Controllers\Admin\DesignBrandingController;
use App\Http\Controllers\ContactProposalController;
use App\Http\Controllers\NewsletterSubscriberController;
use App\Http\Controllers\ContactInquiryController;
use App\Http\Controllers\Admin\Home\HomeHeroSectionController;
use App\Http\Controllers\Admin\Home\HomeClientsLogoController;
use App\Http\Controllers\Admin\Home\HomeOurSolutionController;
use App\Http\Controllers\Admin\Home\HomePricingController;
use App\Http\Controllers\Admin\Home\HomeIndustryController;
use App\Http\Controllers\Admin\Home\HomeRecognitionPressController;
use App\Http\Controllers\Admin\Home\HomeCompanyOverviewController;
use App\Http\Controllers\Admin\Home\HomeOurProcessController;
use App\Http\Controllers\Admin\Home\HomeAwardRecognitionController;
use App\Http\Controllers\Admin\Home\HomeWhyChooseController;
use App\Http\Controllers\Admin\Home\MarketingSectionController;
use App\Http\Controllers\Admin\Home\HomePortfolioController;
use App\Http\Controllers\Admin\Home\HomeTestimonialController;
use App\Http\Controllers\Admin\Home\HomeCtaController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\SchemaController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\Admin\SitePageController;
use App\Http\Controllers\BlogFormController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\OutstandingResultController;
use App\Http\Controllers\Admin\ClientRecommendController;
use App\Http\Controllers\Admin\RecentAwardController;
use App\Http\Controllers\Admin\ReviewScreenshotController;
use App\Http\Controllers\Admin\BusinessChooseUsController;

// model list AboutUs page
use App\Models\Blog;
use App\Models\BlogForm;
use App\Models\ContactProposal;
use App\Models\ContactInquiry;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\SitePage;
use App\Models\HomeCta;
 use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/clear-route', function () {
         Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        return back();

    });

    Route::get('/create-storage-link', function () {
    $source = storage_path('app/public');
    $destination = public_path('storage');

    // Delete existing 'public/storage' folder if it exists
    if (File::exists($destination)) {
        File::deleteDirectory($destination);
    }

    // Create destination folder if not exists
    if (!File::exists($destination)) {
        File::makeDirectory($destination, 0755, true);
    }

    // Copy files from storage/app/public to public/storage
    File::copyDirectory($source, $destination);

    return back();
});

   
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontHomeController::class, 'index']);


Route::get('/aboutus', [AboutUsController::class, 'index'])
    ->name('aboutus');

Route::get('/contact', function () {

$getdata =Setting::first();
//dd($getdata);\
$gethomecta = HomeCta::first();

    return view('contact',compact('getdata','gethomecta'));
})->name('contact.show');

Route::post('/contact-submit', [ContactController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('contact.submit');


Route::get('/Ai-marketing', function () {
    return view('Ai-marketing');
});

Route::get('/developing-service', function () {
    return view('developing-service');
});

Route::get('/services', [FrontHomeController::class, 'services'])->name('services');

Route::get('/services/{slug}', [FrontHomeController::class, 'show'])
    ->name('services.show');

Route::get('/ui-ux', function () {
    return view('ui-ux');
});

Route::post('/submit-proposal', [ContactProposalController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('proposal.store');

Route::post('/newsletter-subscribe', [NewsletterSubscriberController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('newsletter.subscribe');

Route::post(
    '/contact-inquiry',
    [ContactInquiryController::class, 'store']
)->middleware('throttle:10,1')->name('contact.inquiry.store');

Route::get('/blog', function (\Illuminate\Http\Request $request) {

    $query = Blog::with('user')->latest();

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('excerpt', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%");
        });
    }

    $blogs = $query->paginate(6)->appends($request->query());

    if ($request->ajax()) {
        return response()->json([
            'html' => view('partials.blog-card', compact('blogs'))->render(),
            'next_page_url' => $blogs->hasMorePages() ? $blogs->nextPageUrl() : null,
        ]);
    }

    return view('blog', compact('blogs'));

})->name('blogs.show');

Route::get('/blog/{slug}', function ($slug) {

    $blog = Blog::where('slug', $slug)
        ->where('status', 'published')
        ->firstOrFail();
     

    $relatedBlogs = Blog::where('status', 'published')
        ->where('id', '!=', $blog->id)
        ->latest()
        ->take(3)
        ->get();
     //   dd($relatedBlogs);

    return view('blog-details', compact('blog', 'relatedBlogs'));

})->name('blog.details');
Route::post('/blog-form-submit', [BlogFormController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('blog.form.submit');

Route::get('admin/login', function () {
    return view('admin.login');
});

Route::get('/term-condition', function () {
 $getdataterms = SitePage::where('page_key', 'terms_conditions')->first();
return view('term-condition',compact('getdataterms'));
})->name('terms.condition');


Route::get('/privacy-policy', function () {
$getdataprivacy = SitePage::where('page_key', 'privacy_policy')->first();
 return view('privacy-policy',compact('getdataprivacy'));
})->name('privacy.policy');





Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {
    Route::get('/2fa/verify', [\App\Http\Controllers\Auth\TwoFactorController::class, 'showVerify'])->name('2fa.verify');
    Route::post('/2fa/verify', [\App\Http\Controllers\Auth\TwoFactorController::class, 'verify'])->name('2fa.verify.submit');
    Route::get('/2fa/setup', [\App\Http\Controllers\Auth\TwoFactorController::class, 'showSetup'])->name('2fa.setup');
    Route::post('/2fa/enable', [\App\Http\Controllers\Auth\TwoFactorController::class, 'enable'])->name('2fa.enable');
    Route::post('/2fa/disable', [\App\Http\Controllers\Auth\TwoFactorController::class, 'disable'])->name('2fa.disable');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'twofactor'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);

    // Role & Permission Management
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    // Assign roles to users
    Route::prefix('users')->group(function () {
        Route::get('{id}/roles', [UserRoleController::class, 'showRoles'])->name('users.roles');
        Route::post('{id}/roles', [UserRoleController::class, 'assignRoles'])->name('users.roles.assign');
       Route::post('{id}/role', [UserRoleController::class, 'updateRole'])->name('users.update-role');
      

    });

    Route::get('password/change', [PasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('password/change', [PasswordController::class, 'changePassword'])->name('password.update');

    Route::get('profile/edit', [HomeController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile/edit', [HomeController::class, 'updateProfile'])->name('profile.update');

    Route::get('/login-history', [\App\Http\Controllers\Admin\LoginHistoryController::class, 'index'])->name('login-history.index');
//   Setting Routes
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
     Route::post('/settings/update', [SettingController::class, 'update'])->name('settings.update');

    // Seo Management Routes

    Route::get('/seo-management', [SeoManagementController::class, 'index'])->name('seo.index');

    Route::get('/seo-management/create', [SeoManagementController::class, 'create'])->name('seo.create');
    Route::post('/seo-management/store', [SeoManagementController::class, 'store'])->name('seo.store');

    Route::get('/seo-management/{id}/edit', [SeoManagementController::class, 'edit'])->name('seo.edit');

    Route::post('/seo-management/update/{id}', [SeoManagementController::class, 'update'])->name('seo.update');
    Route::delete('/seo-management/{id}', [SeoManagementController::class, 'destroy'])
    ->name('seo.destroy');

//  Schema page Routes
  Route::resource('schemas', SchemaController::class);

    //  About page Routes

     // HERO SECTION
    Route::get('/about-us/hero', [AboutPageController::class, 'hero'])->name('about-us.hero.index');

    Route::post('/about-us/hero/update/{id?}', [AboutPageController::class, 'updateHero'])
    ->name('about-us.hero.update');
    // INTRODUCTION SECTION
    Route::get('/about-us/introduction', [AboutPageController::class, 'introduction'])
        ->name('about-us.introduction.index');

    Route::post('/about-us/introduction/update/{id?}', [AboutPageController::class, 'updateIntroduction'])
        ->name('about-us.introduction.update');

    Route::delete('/about-us/introduction/delete/{id}', [AboutPageController::class, 'destroyIntroduction'])
        ->name('about-us.introduction.destroy');
     // STATISTICS SECTION
    Route::get('/about-us/statistics', [AboutPageController::class, 'statistics'])->name('about-us.statistics.index');

    Route::post('/about-us/statistics/update/{id}', [AboutPageController::class, 'updateStatistics'])->name('about-us.statistics.update');


     // WHY CHOOSE US
    Route::get('/about-us/why-choose-us',[AboutPageController::class, 'index'])->name('about-us.why-choose-us.index');
   Route::post('/about-us/why-choose-us/update',[AboutPageController::class, 'update'])->name('about-us.why-choose-us.update');
    // CLIENTS
    Route::get('/about-us/clients', [AboutPageController::class, 'clients'])->name('about-us.clients.index');

   Route::post('/about-us/clients/update',[AboutPageController::class, 'updateClients'])->name('about-us.clients.update');

      // INDUSTRY SECTION
    Route::get('/about-us/industry', [AboutPageController::class, 'industry'])->name('about-us.industry.index');

    Route::post('/about-us/industry/update/{id}', [AboutPageController::class, 'updateIndustry'])->name('about-us.industry.update');
  
    Route::delete('/admin/about-us/industry/{id}', [AboutPageController::class, 'destroy'])
    ->name('about-us.industry.delete');

    // REVIEWS
    Route::get('/about-us/reviews', [AboutPageController::class, 'reviews'])->name('about-us.reviews.index');

    Route::post('/about-us/reviews/update/{id}', [AboutPageController::class, 'updateReviews'])->name('about-us.reviews.update');


    // CTA SECTION
    Route::get('/about-us/cta',[AboutPageController::class, 'cta'])->name('about-us.cta.index');

    Route::post('/about-us/cta/update/{id}',[AboutPageController::class, 'updateCta'])->name('about-us.cta.update');

    // Design & Branding Routes

    Route::get('/design-branding/index', [DesignBrandingController::class, 'index'])->name('design-branding.index');

    Route::get('/design-branding/create', [DesignBrandingController::class, 'create'])->name('design-branding.create');

    Route::get('/design-branding/edit/{id}', [DesignBrandingController::class, 'edit'])->name('design-branding.edit');

    });

    // Digital Marketing Service Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

        Route::prefix('dm/page')->group(function () {

            Route::get('/', [DigitalMarketingController::class, 'index'])
                ->name('dm.page.index');

            Route::get('/create', [DigitalMarketingController::class, 'create'])
                ->name('dm.page.create');

            Route::post('/store', [DigitalMarketingController::class, 'store'])
                ->name('dm.page.store');

            Route::get('/edit/{id}', [DigitalMarketingController::class, 'edit'])
                ->name('dm.page.edit');

            Route::put('/update/{id}', [DigitalMarketingController::class, 'update'])
                ->name('dm.page.update');

           Route::delete('/digital-marketing/{id}', [DigitalMarketingController::class, 'destroy'])
                ->name('dm.page.destroy');
                
            Route::post('/footer-status/{id}',[DigitalMarketingController::class, 'footerStatus'])->name('dm.page.footer.status');

        });

    });



    // Home page routes hero <section></section>


    Route::prefix('admin/home')->name('admin.home.')->middleware('auth')->group(function () {

    Route::get(
        'hero-section',
        [HomeHeroSectionController::class, 'edit']
    )->name('hero.edit');

    Route::post(
        'hero-section-update',
        [HomeHeroSectionController::class, 'update']
    )->name('hero.update');

  Route::get(
        '/clients-logo',
        [HomeClientsLogoController::class, 'edit']
    )->name('clients-logo.edit');

    Route::post(
        '/clients-logo/update',
        [HomeClientsLogoController::class, 'update']
    )->name('clients-logo.update');


 Route::get(
            '/our-solutions',
            [HomeOurSolutionController::class, 'edit']
        )->name('our-solutions.edit');

        Route::post(
            '/our-solutions/update',
            [HomeOurSolutionController::class, 'update']
        )->name('our-solutions.update');


           Route::get(
        '/pricing',
        [HomePricingController::class, 'edit']
    )->name('pricing.edit');

    Route::post(
        'pricing/update',
        [HomePricingController::class, 'update']
    )->name('pricing.update');


      Route::get(
        '/industries',
        [HomeIndustryController::class, 'edit']
    )->name('industries.edit');

    Route::post(
        '/industries/update',
        [HomeIndustryController::class, 'update']
    )->name('industries.update');
  
        Route::get(
        '/recognition-press',
        [HomeRecognitionPressController::class, 'edit']
    )->name('recognition.press.edit');

    Route::post(
        'recognition-press/update',
        [HomeRecognitionPressController::class, 'update']
    )->name('recognition.press.update');



    Route::get(
    '/company-overview',
    [HomeCompanyOverviewController::class, 'edit']
)->name('company.overview.edit');

Route::post(
    'company-overview/update',
    [HomeCompanyOverviewController::class, 'update']
)->name('company.overview.update');


Route::get(
    '/why-choose-us',
    [HomeWhyChooseController::class, 'edit']
)->name('why-choose.edit');

Route::post(
    '/why-choose-us/update',
    [HomeWhyChooseController::class, 'update']
)->name('why-choose.update');


Route::get(
    '/our-process',
    [HomeOurProcessController::class, 'edit']
)->name('our-process.edit');

Route::post(
    '/our-process/update',
    [HomeOurProcessController::class, 'update']
)->name('our-process.update');


Route::get(
    '/awards-recognition',
    [HomeAwardRecognitionController::class, 'edit']
)->name('awards.recognition.edit');

Route::post(
    '/awards-recognition/update',
    [HomeAwardRecognitionController::class, 'update']
)->name('awards.recognition.update');

   Route::get(
        'marketing-sections',
        [MarketingSectionController::class, 'index']
    )->name('marketing-sections.index');

    Route::post(
        'marketing-sections/store-or-update',
        [MarketingSectionController::class, 'storeOrUpdate']
    )->name('marketing-sections.store-or-update');



    Route::get(
    '/home-portfolio',
    [HomePortfolioController::class, 'edit']
)->name('portfolio.edit');


Route::post(
    '/home-portfolio/update',
    [HomePortfolioController::class, 'update']
)->name('portfolio.update');



Route::get(
    '/clients-feedback',
    [HomeTestimonialController::class, 'edit']
)->name('clients-feedback.edit');

Route::post(
    '/clients-feedback/update',
    [HomeTestimonialController::class, 'update']
)->name('clients-feedback.update');


Route::get(
    '/cta-section',
    [HomeCtaController::class, 'edit']
)->name('cta.edit');

Route::post(
    '/cta-section/update',
    [HomeCtaController::class, 'update']
)->name('cta.update');

});

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {


// SEO Analyzer (resource ke UPAR rakho)
Route::post('blogs/analyze-seo', [BlogController::class, 'analyzeSeo'])->name('blogs.analyzeSeo');

Route::post('blogs/analyze-readability', [BlogController::class, 'analyzeReadability'])->name('blogs.analyzeReadability');
// Blogs Management
Route::resource('blogs', BlogController::class);

   Route::get('/blog-forms', function () {

            $forms = \App\Models\BlogForm::latest()->paginate(20);

            return view('admin.blog-forms.index', compact('forms'));

        })->name('blog.forms');


Route::delete('/blog-forms/{id}', function ($id) {

    $blogForm = BlogForm::findOrFail($id);
    $blogForm->delete();

    return redirect()
        ->route('admin.blog.forms')
        ->with('success', 'Record deleted successfully.');

})->name('blog.forms.delete');


Route::get(
    '/blog/services',
    [BlogController::class, 'getServices']
)->name('blog.services');


Route::get('/blogs/{blog}/history', [BlogController::class, 'history'])
    ->name('blogs.history');

    
});




Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        Route::get('/terms-conditions', [SitePageController::class, 'termsConditions'])
            ->name('terms_conditions');

        Route::post('/terms-conditions', [SitePageController::class, 'saveTermsConditions'])
            ->name('terms_conditions.save');

        Route::get('/privacy-policy', [SitePageController::class, 'privacyPolicy'])
            ->name('privacy_policy');

        Route::post('/privacy-policy', [SitePageController::class, 'savePrivacyPolicy'])
            ->name('privacy_policy.save');

Route::get('/contact-perposal', function () {

    $contactProposals = ContactProposal::latest()->paginate(20);

    return view('admin.contact-proposal.index', compact('contactProposals'));

})->name('contact-perposal.index');

Route::delete('/contact-perposal/{id}', function ($id) {

    $proposal = ContactProposal::findOrFail($id);

    $proposal->delete();

    return redirect()
        ->route('admin.contact-perposal.index')
        ->with('success', 'Contact proposal deleted successfully.');

})->name('contact-perposal.delete');


Route::get('/contact-inquiry', function () {

    $contactInquiries = ContactInquiry::latest()->paginate(20);
   
    return view('admin.contact-inquiry.index', compact('contactInquiries'));

})->name('contact-inquiry.index');

Route::delete('/contact-inquiry/{id}', function ($id) {

    ContactInquiry::findOrFail($id)->delete();

    return redirect()
        ->route('admin.contact-inquiry.index')
        ->with('success', 'Inquiry deleted successfully.');

})->name('contact-inquiry.delete');


Route::get('/contact', function () {

    $contact = Contact::latest()->paginate(20);
   
    return view('admin.contact.index', compact('contact'));

})->name('contact.index');


Route::delete('/contact/{id}', function ($id) {

    Contact::findOrFail($id)->delete();

    return redirect()
        ->route('admin.contact.index')
        ->with('success', 'contact deleted successfully.');

})->name('contact.delete');

 });

 Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

  Route::resource(
    'extrafold',
    \App\Http\Controllers\Admin\ExtraFoldController::class
)->names([
    'index'   => 'admin.extrafold.index',
    'create'  => 'admin.extrafold.create',
    'store'   => 'admin.extrafold.store',
    'edit'    => 'admin.extrafold.edit',
    'update'  => 'admin.extrafold.update',
    'destroy' => 'admin.extrafold.destroy',
]);


Route::get('/media',[MediaController::class,'index'])->name('media.index');

Route::post('/media/upload',[MediaController::class,'store'])->name('media.store');

Route::delete('/media/{id}',[MediaController::class,'destroy'])->name('media.destroy');

Route::get('outstanding-results/edit',[OutstandingResultController::class, 'edit'])->name('outstanding-results.edit');
Route::put('outstanding-results/update',[OutstandingResultController::class, 'update'])->name('outstanding-results.update');
Route::post('outstanding-results/category/add',[OutstandingResultController::class, 'addCategory'])->name('outstanding-results.category.add');
Route::delete('outstanding-results/category/{key}',[OutstandingResultController::class, 'removeCategory'])->name('outstanding-results.category.remove');

Route::get('client-recommend/edit', [ClientRecommendController::class, 'edit'])->name('client-recommend.edit');
Route::put('client-recommend/update', [ClientRecommendController::class, 'update'])->name('client-recommend.update');


Route::get('recent-awards/edit',[RecentAwardController::class, 'edit'])->name('recent-awards.edit');

Route::put('recent-awards/update',[RecentAwardController::class, 'update'])->name('recent-awards.update');

Route::get('review-screenshots/edit',[ReviewScreenshotController::class, 'edit'])->name('review-screenshots.edit');

Route::put('review-screenshots/update',[ReviewScreenshotController::class, 'update'])->name('review-screenshots.update');

Route::get('business-choose-us/edit',[BusinessChooseUsController::class, 'edit'])->name('business-choose-us.edit');


Route::put('business-choose-us/update',[BusinessChooseUsController::class, 'update'])->name('business-choose-us.update');


});