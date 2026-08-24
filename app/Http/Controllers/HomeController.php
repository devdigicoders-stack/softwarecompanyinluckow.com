<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Post;
use App\Models\Service;
use App\Models\SoftwareSolution;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $latestPosts = Post::where('is_published', true)
            ->latest('published_at')
            ->take(6)
            ->get();

        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        $solutions = SoftwareSolution::where('is_active', true)
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        $homeFaqs = Faq::getForPage('home');

        return view('home', compact(
            'latestPosts',
            'services',
            'solutions',
            'homeFaqs'
        ));
    }

    public function privacyPolicy(): View
    {
        return view('pages.privacy-policy');
    }

    public function terms(): View
    {
        return view('pages.terms');
    }
}
