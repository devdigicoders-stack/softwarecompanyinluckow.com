<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redirect;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function index(): View
    {
        $redirects = Redirect::latest()->paginate(20);

        return view('admin.redirects.index', compact('redirects'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'old_url' => ['required', 'string', 'max:255', 'unique:redirects,old_url'],
            'new_url' => ['required', 'string', 'max:255'],
            'status_code' => ['required', 'integer', 'in:301,302'],
        ]);

        Redirect::create([
            ...$validated,
            'is_active' => true,
        ]);

        return redirect()->route('admin.redirects.index')->with('success', '301 Redirect created.');
    }

    public function destroy(Redirect $redirect): RedirectResponse
    {
        $redirect->delete();

        return redirect()->route('admin.redirects.index')->with('success', 'Redirect deleted.');
    }
}
