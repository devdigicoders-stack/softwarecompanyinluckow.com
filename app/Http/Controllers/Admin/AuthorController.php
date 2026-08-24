<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    public function index(): View
    {
        $authors = Author::withCount('posts')->latest()->paginate(10);

        return view('admin.authors.index', compact('authors'));
    }

    public function create(): View
    {
        return view('admin.authors.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:authors,slug'],
            'role' => ['nullable', 'string', 'max:255'],
            'avatar_file' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
            'bio' => ['nullable', 'string'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar_file')) {
            $file = $request->file('avatar_file');
            $filename = time().'_'.Str::slug($validated['name']).'.'.$file->getClientOriginalExtension();
            $targetDir = public_path('uploads/authors');
            if (! file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $file->move($targetDir, $filename);
            $avatarPath = 'uploads/authors/'.$filename;
        }

        $slug = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);

        Author::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'role' => $validated['role'] ?? 'Senior Tech Editor',
            'avatar' => $avatarPath,
            'bio' => $validated['bio'] ?? null,
            'twitter' => $validated['twitter'] ?? null,
            'linkedin' => $validated['linkedin'] ?? null,
        ]);

        return redirect()->route('admin.authors.index')->with('success', 'Author created successfully.');
    }

    public function edit(Author $author): View
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:authors,slug,'.$author->id],
            'role' => ['nullable', 'string', 'max:255'],
            'avatar_file' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
            'bio' => ['nullable', 'string'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
        ]);

        $avatarPath = $author->avatar;
        if ($request->hasFile('avatar_file')) {
            $file = $request->file('avatar_file');
            $filename = time().'_'.Str::slug($validated['name']).'.'.$file->getClientOriginalExtension();
            $targetDir = public_path('uploads/authors');
            if (! file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $file->move($targetDir, $filename);
            $avatarPath = 'uploads/authors/'.$filename;
        }

        $author->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['slug']),
            'role' => $validated['role'] ?? 'Senior Tech Editor',
            'avatar' => $avatarPath,
            'bio' => $validated['bio'] ?? null,
            'twitter' => $validated['twitter'] ?? null,
            'linkedin' => $validated['linkedin'] ?? null,
        ]);

        return redirect()->route('admin.authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author): RedirectResponse
    {
        if ($author->posts()->count() > 0) {
            return back()->with('error', 'Cannot delete author associated with existing blog articles. Reassign articles first.');
        }

        $author->delete();

        return redirect()->route('admin.authors.index')->with('success', 'Author deleted successfully.');
    }
}
