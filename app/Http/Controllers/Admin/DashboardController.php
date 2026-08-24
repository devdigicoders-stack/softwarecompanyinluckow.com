<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\ContactSubmission;
use App\Models\Faq;
use App\Models\NewsletterSubscriber;
use App\Models\Post;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPosts = Post::count();
        $publishedPostsCount = Post::where('is_published', true)->count();
        $draftPostsCount = Post::where('is_published', false)->count();
        $totalContacts = ContactSubmission::count();
        $newContactsCount = ContactSubmission::where('status', 'new')->count();
        $totalSubscribers = NewsletterSubscriber::count();
        $totalFaqsCount = Faq::count();

        $recentPosts = Post::with('category')->latest()->take(5)->get();
        $recentContacts = ContactSubmission::latest()->take(5)->get();
        $recentActivityLogs = ActivityLog::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPosts',
            'publishedPostsCount',
            'draftPostsCount',
            'totalContacts',
            'newContactsCount',
            'totalSubscribers',
            'totalFaqsCount',
            'recentPosts',
            'recentContacts',
            'recentActivityLogs'
        ));
    }
}
