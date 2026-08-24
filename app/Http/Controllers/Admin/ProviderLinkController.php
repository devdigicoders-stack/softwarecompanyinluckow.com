<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProviderLink;
use App\Models\RecommendedProvider;
use Illuminate\Http\Request;

class ProviderLinkController extends Controller
{
    public function index()
    {
        $links = ProviderLink::with('provider')->latest()->paginate(15);
        $provider = RecommendedProvider::first();

        return view('admin.provider-links.index', compact('links', 'provider'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anchor_text' => 'required|string|max:255',
            'target_url' => 'required|url',
            'service_category' => 'required|string|max:100',
            'context_notes' => 'nullable|string',
        ]);

        $provider = RecommendedProvider::first();
        if ($provider) {
            $validated['recommended_provider_id'] = $provider->id;
        }

        ProviderLink::create($validated);

        return redirect()->route('admin.provider-links.index')
            ->with('success', 'Provider external link map created successfully.');
    }

    public function destroy(ProviderLink $providerLink)
    {
        $providerLink->delete();

        return redirect()->route('admin.provider-links.index')
            ->with('success', 'Provider link deleted successfully.');
    }
}
