<?php

namespace App\Providers;

use App\Models\ContactSubmission;
use App\Models\Enquiry;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('admin.*', function ($view) {
            if (Schema::hasTable('enquiries')) {
                $view->with('unreadEnquiryCount', Enquiry::where('status', 'unread')->count());
            } else {
                $view->with('unreadEnquiryCount', 0);
            }

            if (Schema::hasTable('contact_submissions')) {
                $view->with('unreadContactCount', ContactSubmission::where('status', 'unread')->count());
            } else {
                $view->with('unreadContactCount', 0);
            }
        });
    }
}
