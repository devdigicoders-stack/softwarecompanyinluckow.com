<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faq;
use App\Models\Post;
use App\Models\PostView;
use App\Models\Service;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        $query = Post::with(['category', 'author', 'tags'])
            ->where('is_published', true);

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->input('category')));
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', fn ($q) => $q->where('slug', $request->input('tag')));
        }

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('excerpt', 'like', "%{$searchTerm}%")
                    ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->input('filter') === 'popular') {
            $query->orderBy('is_popular', 'desc')->orderBy('view_count', 'desc');
        } elseif ($request->input('filter') === 'trending') {
            $query->orderBy('is_trending', 'desc')->latest('published_at');
        } else {
            $query->latest('published_at');
        }

        $posts = $query->paginate(12)->withQueryString();

        if ($request->ajax()) {
            $html = view('blog.partials.posts-grid', compact('posts'))->render();

            return response()->json([
                'html' => $html,
                'pagination' => (string) $posts->links(),
                'total' => $posts->total(),
            ]);
        }

        $categories = Category::withCount('posts')->get();
        $tags = Tag::withCount('posts')->take(15)->get();
        $featuredPost = Post::with(['category', 'author'])
            ->where('is_published', true)
            ->where('is_featured', true)
            ->first();

        $popularPosts = Post::where('is_published', true)
            ->orderBy('is_popular', 'desc')
            ->orderBy('view_count', 'desc')
            ->take(5)
            ->get();

        $faqs = Faq::getForPage('blogs')->concat(Faq::getForPage('blog'))->toArray();

        $breadcrumbs = [
            'Home' => route('home'),
            'Blog & Tech Publication' => null,
        ];

        return view('blog.index', compact(
            'posts',
            'categories',
            'tags',
            'featuredPost',
            'popularPosts',
            'breadcrumbs',
            'faqs'
        ));
    }

    public function show(string $slug): View
    {
        $post = Post::with(['category', 'author', 'tags'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Record unique view per IP address
        $clientIp = request()->ip() ?? '127.0.0.1';
        $hasViewed = PostView::where('post_id', $post->id)
            ->where('ip_address', $clientIp)
            ->exists();

        if (! $hasViewed) {
            PostView::create([
                'post_id' => $post->id,
                'ip_address' => $clientIp,
                'user_agent' => substr(request()->userAgent() ?? '', 0, 255),
            ]);

            $post->increment('view_count');
            $post->refresh();
        }

        $post->faqs = $this->ensureTenPostFaqs($post->faqs ?? [], $post->title);

        $relatedPosts = Post::with(['category', 'author'])
            ->where('is_published', true)
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->take(3)
            ->get();

        if ($relatedPosts->count() < 3) {
            $morePosts = Post::with(['category', 'author'])
                ->where('is_published', true)
                ->where('id', '!=', $post->id)
                ->whereNotIn('id', $relatedPosts->pluck('id'))
                ->latest('published_at')
                ->take(3 - $relatedPosts->count())
                ->get();
            $relatedPosts = $relatedPosts->concat($morePosts);
        }

        $relatedServices = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        $breadcrumbs = [
            'Home' => route('home'),
            'Blogs' => route('blogs.index'),
            $post->category ? $post->category->name : 'Tech News' => $post->category ? route('blogs.index', ['category' => $post->category->slug]) : route('blogs.index'),
            $post->title => null,
        ];

        return view('blog.show', compact('post', 'relatedPosts', 'relatedServices', 'breadcrumbs'));
    }

    private function ensureTenPostFaqs(array $faqs, string $postTitle): array
    {
        if (count($faqs) >= 10) {
            // if (! empty($faqs)) {

            return $faqs;
        }

        $defaultFillers = [
            ['question' => 'What is the main takeaway from this guide on '.$postTitle.'?', 'answer' => 'This guide breaks down technical architecture, key cost drivers, software development best practices, and provider evaluation standards.'],
            ['question' => 'How can businesses apply the insights from this article?', 'answer' => 'Business owners can use these technical insights to define functional specifications, choose optimal tech stacks, and select reliable software development partners.'],
            ['question' => 'Which technology stack is recommended for software projects related to this topic?', 'answer' => 'We recommend modern, scalable tech stacks including Laravel 12 (PHP 8.2+), Flutter for cross-platform mobile apps, React, Vue.js, Node.js, and AWS cloud hosting.'],
            ['question' => 'Who owns the full source code and intellectual property rights?', 'answer' => 'Upon project completion and final milestone payment, 100% full source code ownership and IP rights are transferred to the client.'],
            ['question' => 'Do software development companies in Lucknow sign Non-Disclosure Agreements?', 'answer' => 'Yes. We sign bilateral NDAs before reviewing sensitive business requirements or proprietary technical workflows.'],
            ['question' => 'How is custom software pricing evaluated in Lucknow?', 'answer' => 'Pricing is calculated based on functional scope, custom user roles, third-party API integrations, database scale, and post-deployment support needs.'],
            ['question' => 'What post-launch SLA technical support options are available?', 'answer' => 'We offer structured Service Level Agreements (SLAs) covering 24/7 server health monitoring, security updates, bug fixes, and continuous upgrades.'],
            ['question' => 'Can custom software integrate with payment gateways and third-party APIs?', 'answer' => 'Yes. Our solutions support seamless RESTful/GraphQL API integrations with payment gateways (Razorpay, Paytm), SMS gateways, and accounting tools.'],
            ['question' => 'Is in-person discovery consultation available in Lucknow?', 'answer' => 'Yes! We invite clients to visit our corporate office in Aliganj, Lucknow, for technical discovery sessions and live software prototype demos.'],
            ['question' => 'How can I discuss my project requirements with a software architect?', 'answer' => 'Call 0522-4235604 / +91 6394296293 or submit a consultation request on our contact page to speak with a lead developer.'],
        ];

        foreach ($defaultFillers as $filler) {
            if (count($faqs) >= 10) {
                break;
            }
            $faqs[] = $filler;
        }

        return $faqs;
    }
}
