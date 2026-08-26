<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\ActivityLogController as AdminActivityLogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ContactSubmissionController as AdminContactSubmissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnquiryController as AdminEnquiryController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\NewsletterSubscriberController as AdminNewsletterSubscriberController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ProviderLinkController as AdminProviderLinkController;
use App\Http\Controllers\Admin\RedirectController as AdminRedirectController;
use App\Http\Controllers\Admin\SeoController as AdminSeoController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SolutionController as AdminSolutionController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClickTrackerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CostGuideController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NewsletterSubscriberController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\TechnologyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'show'])->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/enquiries/store', [EnquiryController::class, 'store'])->name('enquiries.store');
Route::post('/newsletter/subscribe', [NewsletterSubscriberController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Software Company in Lucknow Outbound Tracked Redirect Route
Route::get('/go/provider', [ClickTrackerController::class, 'track'])->name('go.provider');
Route::get('/go/digicoders', [ClickTrackerController::class, 'track'])->name('go.digicoders');

// Technical SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [RobotsController::class, 'index'])->name('robots');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-and-conditions', [HomeController::class, 'terms'])->name('terms');
Route::get('/disclaimer', [HomeController::class, 'terms'])->name('disclaimer');

// Cost Guides Hub & Detail Routes
Route::get('/cost-guides', [CostGuideController::class, 'index'])->name('cost-guides.index');
Route::get('/cost-guides/{slug}', [CostGuideController::class, 'show'])->name('cost-guides.show');

// Technology Framework Routes
Route::get('/best-technology-for-website-development', [TechnologyController::class, 'bestWebTech'])->name('technology.best-web-tech');
Route::get('/technology/{slug}', [TechnologyController::class, 'show'])->name('technology.show');

// Blog & Tech News Routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
// Local Lucknow IT Hub Routes
Route::get('/location/{slug}', [LocationController::class, 'show'])->name('locations.show');

// Main Commercial Intent & Service SEO Pages
$primaryServiceSlugs = [
    'software-company-in-lucknow',
    'best-software-company-in-lucknow',
    'software-development-companies-in-lucknow',
    'it-companies-in-lucknow',
    'software-development-company-in-lucknow',
    'web-development-company-in-lucknow',
    'website-development-company-in-lucknow',
    'mobile-app-development-company-in-lucknow',
    'custom-software-development-lucknow',
    'ecommerce-development-company-in-lucknow',
];

foreach ($primaryServiceSlugs as $slug) {
    Route::get("/{$slug}", [ServiceController::class, 'show'])
        ->defaults('slug', $slug)
        ->name("services.{$slug}");
}
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Software Solution SEO Pages
$primarySolutionSlugs = [
    'erp-software-in-lucknow',
    'crm-software-in-lucknow',
    'hrms-software-in-lucknow',
    'billing-software-in-lucknow',
    'inventory-management-software-in-lucknow',
    'school-management-software-in-lucknow',
    'hospital-management-software-in-lucknow',
    'mlm-software-in-lucknow',
    'restaurant-management-software-in-lucknow',
    'hotel-management-software-in-lucknow',
];

foreach ($primarySolutionSlugs as $slug) {
    Route::get("/{$slug}", [SolutionController::class, 'show'])
        ->defaults('slug', $slug)
        ->name("solutions.{$slug}");
}
Route::get('/solutions/{slug}', [SolutionController::class, 'show'])->name('solutions.show');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login/send-otp', [AuthController::class, 'sendOtp'])->name('admin.login.send-otp');
    Route::post('/login/verify-otp', [AuthController::class, 'verifyOtp'])->name('admin.login.verify-otp');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['admin'])->group(function () {
        // Security Audit & Login Activity Logs
        Route::get('/activity-logs', [AdminActivityLogController::class, 'index'])->name('admin.activity-logs.index');
        Route::get('/login-history', [AdminActivityLogController::class, 'index'])->name('admin.login-history.index');
        Route::post('/activity-logs/pulse', [AdminActivityLogController::class, 'pulse'])->name('admin.activity-logs.pulse');
        Route::get('/activity-logs/export', [AdminActivityLogController::class, 'export'])->name('admin.activity-logs.export');

        // Account Profile & Password Settings
        Route::get('/settings', [AdminProfileController::class, 'edit'])->name('admin.settings.edit');
        Route::put('/settings/profile', [AdminProfileController::class, 'updateProfile'])->name('admin.settings.update-profile');
        Route::put('/settings/password', [AdminProfileController::class, 'updatePassword'])->name('admin.settings.update-password');

        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // Blog Article Management
        Route::post('/posts/upload-image', [AdminPostController::class, 'uploadImage'])->name('admin.posts.upload-image');
        Route::resource('posts', AdminPostController::class, ['as' => 'admin']);
        Route::post('/blogs/{post}/toggle-status', [AdminPostController::class, 'togglePublish'])->name('admin.posts.toggle-status');
        Route::post('/blogs/{post}/toggle-featured', [AdminPostController::class, 'toggleFeatured'])->name('admin.posts.toggle-featured');
        Route::post('/blogs/{post}/toggle-trending', [AdminPostController::class, 'toggleTrending'])->name('admin.posts.toggle-trending');
        Route::post('/blogs/{post}/toggle-popular', [AdminPostController::class, 'togglePopular'])->name('admin.posts.toggle-popular');
        Route::get('/blogs/{post}/ip-views', [AdminPostController::class, 'getIpViews'])->name('admin.posts.ip-views');

        // Category, Tag & Author Management
        Route::resource('categories', AdminCategoryController::class, ['as' => 'admin']);
        Route::resource('tags', AdminTagController::class, ['as' => 'admin']);
        Route::resource('authors', AdminAuthorController::class, ['as' => 'admin']);

        // Quick Modal Enquiries Management
        Route::get('/enquiries', [AdminEnquiryController::class, 'index'])->name('admin.enquiries.index');
        Route::get('/enquiries/{enquiry}', [AdminEnquiryController::class, 'show'])->name('admin.enquiries.show');
        Route::post('/enquiries/bulk-delete', [AdminEnquiryController::class, 'bulkDestroy'])->name('admin.enquiries.bulk-delete');
        Route::delete('/enquiries/{enquiry}', [AdminEnquiryController::class, 'destroy'])->name('admin.enquiries.destroy');

        // Contact Enquiries Management
        Route::get('/contact-messages', [AdminContactSubmissionController::class, 'index'])->name('admin.contact-messages.index');
        Route::post('/contact-messages/{contactMessage}/read', [AdminContactSubmissionController::class, 'markAsRead'])->name('admin.contact-messages.read');
        Route::post('/contact-messages/bulk-delete', [AdminContactSubmissionController::class, 'bulkDelete'])->name('admin.contact-messages.bulk-delete');
        Route::delete('/contact-messages/{contactMessage}', [AdminContactSubmissionController::class, 'destroy'])->name('admin.contact-messages.destroy');

        // Newsletter Subscribers Management
        Route::get('/subscribers', [AdminNewsletterSubscriberController::class, 'index'])->name('admin.subscribers.index');
        Route::post('/subscribers/bulk-delete', [AdminNewsletterSubscriberController::class, 'bulkDelete'])->name('admin.subscribers.bulk-delete');
        Route::delete('/subscribers/{subscriber}', [AdminNewsletterSubscriberController::class, 'destroy'])->name('admin.subscribers.destroy');

        // Dynamic Page FAQs Management
        Route::post('/faqs/bulk-delete', [AdminFaqController::class, 'bulkDelete'])->name('admin.faqs.bulk-delete');
        Route::resource('faqs', AdminFaqController::class, ['as' => 'admin']);

        // Legacy / Secondary Modules
        Route::resource('services', AdminServiceController::class, ['as' => 'admin']);
        Route::resource('solutions', AdminSolutionController::class, ['as' => 'admin']);
        Route::resource('provider-links', AdminProviderLinkController::class, ['as' => 'admin']);
        Route::get('/leads', [LeadController::class, 'index'])->name('admin.leads.index');
        Route::resource('seo', AdminSeoController::class, ['as' => 'admin']);
        Route::resource('redirects', AdminRedirectController::class, ['as' => 'admin']);
    });
});
