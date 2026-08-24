<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(): View
    {
        $leads = ContactSubmission::latest()->paginate(20);

        return view('admin.leads.index', compact('leads'));
    }

    public function updateStatus(Request $request, ContactSubmission $lead): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:new,read,contacted,resolved'],
        ]);

        $lead->update(['status' => $validated['status']]);

        return back()->with('success', 'Lead status updated.');
    }

    public function destroy(ContactSubmission $lead): RedirectResponse
    {
        $lead->delete();

        return redirect()->route('admin.leads.index')->with('success', 'Lead submission removed.');
    }
}
