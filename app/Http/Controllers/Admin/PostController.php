<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $query = Post::with(['category', 'author']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $status = $request->get('status');
            if ($status === 'published') {
                $query->where('is_published', true);
            } elseif ($status === 'draft') {
                $query->where('is_published', false);
            } elseif ($status === 'featured') {
                $query->where('is_featured', true);
            } elseif ($status === 'trending') {
                $query->where('is_trending', true);
            } elseif ($status === 'popular') {
                $query->where('is_popular', true);
            }
        }

        // Category filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->get('category_id'));
        }

        $posts = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::all();
        $authors = Author::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'authors', 'tags'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:posts,slug'],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'author_id' => ['nullable', 'exists:authors,id'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
            'featured_image' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'is_trending' => ['nullable', 'boolean'],
            'is_popular' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'canonical_url' => ['nullable', 'string', 'max:255'],
            'schema_type' => ['nullable', 'string', 'max:100'],
            'tags' => ['nullable', 'array'],
            'faqs' => ['nullable', 'array'],
            'faqs.*.question' => ['nullable', 'string'],
            'faqs.*.answer' => ['nullable', 'string'],
        ]);

        $imagePath = $validated['featured_image'] ?? null;

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time().'_'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/blog'), $filename);
            $imagePath = 'uploads/blog/'.$filename;
        }

        $slug = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $authorId = $validated['author_id'] ?? (Author::first()->id ?? null);
        $wordCount = str_word_count(strip_tags($validated['content']));
        $readingTime = max(1, (int) ceil($wordCount / 200));

        if ($request->boolean('is_featured')) {
            Post::where('is_featured', true)->update(['is_featured' => false]);
        }

        $faqsInput = $request->input('faqs', []);
        $faqs = [];
        if (is_array($faqsInput)) {
            foreach ($faqsInput as $faq) {
                if (! empty($faq['question']) && ! empty($faq['answer'])) {
                    $faqs[] = [
                        'question' => trim($faq['question']),
                        'answer' => trim($faq['answer']),
                    ];
                }
            }
        }

        $post = Post::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'author_id' => $authorId,
            'featured_image' => $imagePath,
            'alt_text' => $validated['alt_text'] ?? $validated['title'],
            'is_published' => $request->boolean('is_published'),
            'is_featured' => $request->boolean('is_featured'),
            'is_trending' => $request->boolean('is_trending'),
            'is_popular' => $request->boolean('is_popular'),
            'reading_time_minutes' => $readingTime,
            'meta_title' => $validated['meta_title'] ?? $validated['title'],
            'meta_description' => $validated['meta_description'] ?? $validated['excerpt'],
            'canonical_url' => $validated['canonical_url'] ?? null,
            'schema_type' => $validated['schema_type'] ?? 'Article',
            'published_at' => $request->boolean('is_published') ? now() : null,
            'faqs' => ! empty($faqs) ? $faqs : null,
        ]);

        if (! empty($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Blog article created successfully.');
    }

    public function edit(Post $post): View
    {
        $categories = Category::all();
        $authors = Author::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'authors', 'tags'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:posts,slug,'.$post->id],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'author_id' => ['nullable', 'exists:authors,id'],
            'image_file' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
            'featured_image' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'is_published' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'is_trending' => ['nullable', 'boolean'],
            'is_popular' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'canonical_url' => ['nullable', 'string', 'max:255'],
            'schema_type' => ['nullable', 'string', 'max:100'],
            'tags' => ['nullable', 'array'],
            'faqs' => ['nullable', 'array'],
            'faqs.*.question' => ['nullable', 'string'],
            'faqs.*.answer' => ['nullable', 'string'],
        ]);

        $imagePath = $post->featured_image;

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time().'_'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/blog'), $filename);
            $imagePath = 'uploads/blog/'.$filename;
        } elseif ($request->filled('featured_image')) {
            $imagePath = $request->get('featured_image');
        }

        $wordCount = str_word_count(strip_tags($validated['content']));
        $readingTime = max(1, (int) ceil($wordCount / 200));

        $wasPublished = $post->is_published;
        $isPublished = $request->boolean('is_published');
        $isFeatured = $request->boolean('is_featured');

        if ($isFeatured && ! $post->is_featured) {
            Post::where('id', '!=', $post->id)->where('is_featured', true)->update(['is_featured' => false]);
        }

        $faqsInput = $request->input('faqs', []);
        $faqs = [];
        if (is_array($faqsInput)) {
            foreach ($faqsInput as $faq) {
                if (! empty($faq['question']) && ! empty($faq['answer'])) {
                    $faqs[] = [
                        'question' => trim($faq['question']),
                        'answer' => trim($faq['answer']),
                    ];
                }
            }
        }

        $post->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['slug']),
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'author_id' => $validated['author_id'] ?? $post->author_id,
            'featured_image' => $imagePath,
            'alt_text' => $validated['alt_text'] ?? $validated['title'],
            'is_published' => $isPublished,
            'is_featured' => $isFeatured,
            'is_trending' => $request->boolean('is_trending'),
            'is_popular' => $request->boolean('is_popular'),
            'reading_time_minutes' => $readingTime,
            'meta_title' => $validated['meta_title'] ?? $validated['title'],
            'meta_description' => $validated['meta_description'] ?? $validated['excerpt'],
            'canonical_url' => $validated['canonical_url'] ?? null,
            'schema_type' => $validated['schema_type'] ?? 'Article',
            'published_at' => $isPublished ? ($post->published_at ?? now()) : null,
            'faqs' => ! empty($faqs) ? $faqs : null,
        ]);

        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.index')->with('success', 'Blog article updated successfully.');
    }

    public function togglePublish(Post $post): JsonResponse|RedirectResponse
    {
        $post->is_published = ! $post->is_published;
        if ($post->is_published && ! $post->published_at) {
            $post->published_at = now();
        }
        $post->save();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_published' => $post->is_published,
                'message' => $post->is_published ? 'Blog published successfully.' : 'Blog moved to drafts.',
            ]);
        }

        return back()->with('success', $post->is_published ? 'Blog published successfully.' : 'Blog moved to drafts.');
    }

    public function toggleFeatured(Post $post): JsonResponse|RedirectResponse
    {
        if (! $post->is_featured) {
            Post::where('id', '!=', $post->id)->where('is_featured', true)->update(['is_featured' => false]);
            $post->is_featured = true;
        } else {
            $post->is_featured = false;
        }
        $post->save();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_featured' => $post->is_featured,
                'message' => $post->is_featured ? 'Article set as Hero Featured Spotlight!' : 'Article removed from Featured Spotlight.',
            ]);
        }

        return back()->with('success', $post->is_featured ? 'Article set as Hero Featured Spotlight!' : 'Article removed from Featured Spotlight.');
    }

    public function toggleTrending(Post $post): JsonResponse|RedirectResponse
    {
        $post->is_trending = ! $post->is_trending;
        $post->save();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_trending' => $post->is_trending,
                'message' => $post->is_trending ? 'Article marked as Trending!' : 'Article removed from Trending.',
            ]);
        }

        return back()->with('success', $post->is_trending ? 'Article marked as Trending!' : 'Article removed from Trending.');
    }

    public function togglePopular(Post $post): JsonResponse|RedirectResponse
    {
        $post->is_popular = ! $post->is_popular;
        $post->save();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_popular' => $post->is_popular,
                'message' => $post->is_popular ? 'Article marked as Popular!' : 'Article removed from Popular.',
            ]);
        }

        return back()->with('success', $post->is_popular ? 'Article marked as Popular!' : 'Article removed from Popular.');
    }

    public function destroy(Post $post): RedirectResponse|JsonResponse
    {
        $post->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Blog article deleted successfully.',
            ]);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Blog article deleted successfully.');
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.Str::random(8).'.'.$file->getClientOriginalExtension();
            $targetDir = public_path('uploads/blog/content');
            if (! file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $file->move($targetDir, $filename);
            $url = asset('uploads/blog/content/'.$filename);

            return response()->json([
                'url' => $url,
            ]);
        }

        return response()->json(['error' => 'Failed to upload image.'], 400);
    }

    public function getIpViews(Post $post): JsonResponse
    {
        $views = $post->views()
            ->latest('id')
            ->get(['ip_address', 'user_agent', 'created_at'])
            ->map(function ($view) {
                return [
                    'ip_address' => $view->ip_address,
                    'user_agent' => $view->user_agent ?? 'Unknown User Agent',
                    'browser_info' => $this->parseUserAgent($view->user_agent),
                    'viewed_at' => $view->created_at ? $view->created_at->format('M d, Y h:i A') : 'N/A',
                ];
            });

        return response()->json([
            'post_title' => $post->title,
            'total_views' => $post->view_count,
            'unique_ips_count' => $views->pluck('ip_address')->unique()->count(),
            'views' => $views,
        ]);
    }

    private function parseUserAgent(?string $ua): string
    {
        if (! $ua) {
            return 'Unknown Browser';
        }

        $platform = 'Unknown OS';
        if (preg_match('/windows|win32|win64/i', $ua)) {
            $platform = 'Windows';
        } elseif (preg_match('/macintosh|mac os x/i', $ua)) {
            $platform = 'macOS';
        } elseif (preg_match('/linux/i', $ua)) {
            $platform = 'Linux';
        } elseif (preg_match('/iphone|ipad|ipod/i', $ua)) {
            $platform = 'iOS';
        } elseif (preg_match('/android/i', $ua)) {
            $platform = 'Android';
        }

        $browser = 'Browser';
        if (preg_match('/chrome|crios/i', $ua) && ! preg_match('/edg|opr/i', $ua)) {
            $browser = 'Chrome';
        } elseif (preg_match('/firefox|fxios/i', $ua)) {
            $browser = 'Firefox';
        } elseif (preg_match('/safari/i', $ua) && ! preg_match('/chrome|crios/i', $ua)) {
            $browser = 'Safari';
        } elseif (preg_match('/edg/i', $ua)) {
            $browser = 'Edge';
        } elseif (preg_match('/opr|opera/i', $ua)) {
            $browser = 'Opera';
        }

        return "{$browser} on {$platform}";
    }
}
