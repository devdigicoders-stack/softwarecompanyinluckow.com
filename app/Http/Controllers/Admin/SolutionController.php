<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SoftwareSolution;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SolutionController extends Controller
{
    public function index(): View
    {
        $solutions = SoftwareSolution::orderBy('sort_order')->paginate(15);

        return view('admin.solutions.index', compact('solutions'));
    }

    public function create(): View
    {
        return view('admin.solutions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:software_solutions,slug'],
            'h1_title' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'featured_image' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'canonical_url' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        SoftwareSolution::create([
            ...$validated,
            'slug' => $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['title']),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.solutions.index')->with('success', 'Software Solution created successfully.');
    }

    public function edit(SoftwareSolution $solution): View
    {
        return view('admin.solutions.edit', compact('solution'));
    }

    public function update(Request $request, SoftwareSolution $solution): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:software_solutions,slug,'.$solution->id],
            'h1_title' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'featured_image' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'canonical_url' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        $solution->update([
            ...$validated,
            'slug' => Str::slug($validated['slug']),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.solutions.index')->with('success', 'Software Solution updated successfully.');
    }

    public function destroy(SoftwareSolution $solution): RedirectResponse
    {
        $solution->delete();

        return redirect()->route('admin.solutions.index')->with('success', 'Software Solution deleted.');
    }
}
