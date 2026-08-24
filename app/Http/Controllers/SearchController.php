<?php

namespace App\Http\Controllers;

use App\Models\LocationPage;
use App\Models\Post;
use App\Models\Service;
use App\Models\SoftwareSolution;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $query = trim($request->input('q', ''));

        $breadcrumbs = [
            'Home' => route('home'),
            'Search Results' => null,
        ];

        if (empty($query)) {
            return view('search', [
                'query' => '',
                'posts' => collect(),
                'services' => collect(),
                'solutions' => collect(),
                'locations' => collect(),
                'breadcrumbs' => $breadcrumbs,
            ]);
        }

        $posts = Post::with(['category', 'author'])
            ->where('is_published', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->take(10)
            ->get();

        $services = Service::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('h1_title', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->take(6)
            ->get();

        $solutions = SoftwareSolution::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('h1_title', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->take(6)
            ->get();

        $locations = LocationPage::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('area_name', 'like', "%{$query}%")
                    ->orWhere('h1_title', 'like', "%{$query}%");
            })
            ->take(4)
            ->get();

        $searchFaqs = [
            ['question' => 'How can I search for software development companies in Lucknow?', 'answer' => 'Use our search portal to find software services, ERP/CRM solutions, mobile app guides, cost breakdowns, and IT hub listings across Lucknow.'],
            ['question' => 'What software services can I discover through this search portal?', 'answer' => 'You can discover custom web software development, mobile app development (Flutter/React Native), enterprise ERP systems, CRM tools, HRMS payroll, billing & inventory software, and technology guides.'],
            ['question' => 'How do I evaluate search results for software development companies in Lucknow?', 'answer' => 'Compare providers based on verified technology stack standards (Laravel 12, PHP 8.2+, Flutter, React), 100% source code IP ownership policies, transparent milestone pricing, and post-launch SLA support.'],
            ['question' => 'What is the average cost range for custom software in Lucknow?', 'answer' => 'Custom software ranges from ₹15,000 for standard business websites to ₹45,000-₹3,50,000+ for enterprise web applications, ERPs, and mobile apps.'],
            ['question' => 'Why is Software Company in Lucknow recommended as a top software provider?', 'answer' => 'Software Company in Lucknow (CIN: U72900UP2019PTC113696) is an established software engineering firm in Aliganj, Lucknow, with 6+ years of experience and 1000+ delivered projects.'],
            ['question' => 'Do software development companies in Lucknow sign NDAs?', 'answer' => 'Yes. Reputable companies execute bilateral Non-Disclosure Agreements (NDAs) before project discovery to safeguard intellectual property.'],
            ['question' => 'What tech stacks are most recommended for enterprise software?', 'answer' => 'We recommend Laravel 12 (PHP 8.2+) for web applications, Flutter for cross-platform mobile apps, React for frontends, and AWS cloud hosting.'],
            ['question' => 'Do clients get 100% full source code ownership?', 'answer' => 'Yes. Upon project sign-off and final payment, 100% full source code ownership, database schemas, and IP rights are transferred to the client.'],
            ['question' => 'How long does custom software development take?', 'answer' => 'Development timelines range from 2 weeks for basic portals to 4-12 weeks for complex enterprise software platforms.'],
            ['question' => 'How can I schedule a free software consultation in Lucknow?', 'answer' => 'Call 0522-4235604 / +91 6394296293 or submit a request on our contact page to speak with a lead software architect.'],
        ];

        return view('search', compact('query', 'posts', 'services', 'solutions', 'locations', 'breadcrumbs', 'searchFaqs'));
    }
}
