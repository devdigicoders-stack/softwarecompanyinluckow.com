<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LocationPage;
use App\Models\Post;
use App\Models\Service;
use App\Models\SoftwareSolution;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $posts = Post::where('is_published', true)->latest('updated_at')->get();
        $categories = Category::all();
        $services = Service::where('is_active', true)->get();
        $solutions = SoftwareSolution::where('is_active', true)->get();
        $locations = LocationPage::where('is_active', true)->get();

        $content = view('sitemap', compact(
            'posts',
            'categories',
            'services',
            'solutions',
            'locations'
        ))->render();

        return response($content, 200, [
            'Content-Type' => 'text/xml',
        ]);
    }
}
