<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoMetadata;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index(): View
    {
        $metadatas = SeoMetadata::latest()->paginate(20);

        return view('admin.seo.index', compact('metadatas'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'route_name' => ['required', 'string', 'max:255', 'unique:seo_metadatas,route_name'],
            'meta_title' => ['required', 'string', 'max:255'],
            'meta_description' => ['required', 'string'],
            'canonical_url' => ['nullable', 'string', 'max:255'],
            'og_image' => ['nullable', 'string', 'max:255'],
        ]);

        SeoMetadata::create($validated);

        return redirect()->route('admin.seo.index')->with('success', 'SEO Metadata saved.');
    }

    public function destroy(SeoMetadata $seo): RedirectResponse
    {
        $seo->delete();

        return redirect()->route('admin.seo.index')->with('success', 'SEO Metadata deleted.');
    }
}
