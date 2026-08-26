<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(Request $request): View
    {
        $query = Faq::query();

        if ($pageName = $request->input('page_name')) {
            $query->where('page_name', $pageName);
        }

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                    ->orWhere('answer', 'like', "%{$search}%")
                    ->orWhere('page_name', 'like', "%{$search}%");
            });
        }

        $faqs = $query->orderBy('page_name')->orderBy('order_index')->paginate(20)->withQueryString();
        $totalFaqs = Faq::count();
        $distinctPages = Faq::distinct()->pluck('page_name')->toArray();

        return view('admin.faqs.index', compact('faqs', 'totalFaqs', 'distinctPages'));
    }

    public function create(): View
    {
        $distinctPages = Faq::distinct()->pluck('page_name')->toArray();
        $defaultPages = ['contact', 'home', 'about', 'solutions', 'services', 'technology', 'locations', 'cost-guides', 'blogs', 'blog', 'best-technology-for-website-development'];
        $pages = array_unique(array_merge($defaultPages, $distinctPages));
        sort($pages);

        return view('admin.faqs.create', compact('pages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'page_name' => ['required', 'string', 'max:255'],
            'custom_page_name' => ['nullable', 'string', 'max:255'],
            'question' => ['required', 'string', 'max:1000'],
            'answer' => ['required', 'string', 'max:5000'],
            'order_index' => ['required', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $pageName = ($validated['page_name'] === 'other' && ! empty($validated['custom_page_name']))
            ? trim(strtolower($validated['custom_page_name']))
            : trim(strtolower($validated['page_name']));

        Faq::create([
            'page_name' => $pageName,
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'order_index' => $validated['order_index'] ?? 1,
            'is_active' => $request->has('is_active') ? (bool) $request->input('is_active') : true,
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ added successfully.');
    }

    public function edit(Faq $faq): View
    {
        $distinctPages = Faq::distinct()->pluck('page_name')->toArray();
        $defaultPages = ['contact', 'home', 'about', 'solutions', 'services', 'technology', 'locations', 'cost-guides', 'blogs', 'blog', 'best-technology-for-website-development'];
        $pages = array_unique(array_merge($defaultPages, $distinctPages));
        sort($pages);

        return view('admin.faqs.edit', compact('faq', 'pages'));
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $request->validate([
            'page_name' => ['required', 'string', 'max:255'],
            'custom_page_name' => ['nullable', 'string', 'max:255'],
            'question' => ['required', 'string', 'max:1000'],
            'answer' => ['required', 'string', 'max:5000'],
            'order_index' => ['required', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $pageName = ($validated['page_name'] === 'other' && ! empty($validated['custom_page_name']))
            ? trim(strtolower($validated['custom_page_name']))
            : trim(strtolower($validated['page_name']));

        $faq->update([
            'page_name' => $pageName,
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'order_index' => $validated['order_index'],
            'is_active' => $request->has('is_active') ? (bool) $request->input('is_active') : false,
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq): JsonResponse|RedirectResponse
    {
        $faq->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'FAQ deleted successfully.',
            ]);
        }

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }

    public function bulkDelete(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['exists:faqs,id'],
        ]);

        $count = Faq::whereIn('id', $request->input('ids'))->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Successfully deleted {$count} FAQs.",
            ]);
        }

        return redirect()->route('admin.faqs.index')->with('success', "Successfully deleted {$count} FAQs.");
    }
}
