<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    /**
     * Display a listing of enquiries with search and pagination.
     */
    public function index(Request $request): View
    {
        $query = Enquiry::latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('mobile', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('requirement', 'like', "%{$search}%");
            });
        }

        $enquiries = $query->paginate(15)->withQueryString();
        $unreadCount = Enquiry::where('status', 'unread')->count();

        return view('admin.enquiries.index', compact('enquiries', 'unreadCount'));
    }

    /**
     * Mark single enquiry as read / view details.
     */
    public function show(Enquiry $enquiry): View
    {
        if ($enquiry->status === 'unread') {
            $enquiry->update(['status' => 'read']);
        }

        return view('admin.enquiries.show', compact('enquiry'));
    }

    /**
     * Delete a single enquiry.
     */
    public function destroy(Enquiry $enquiry): RedirectResponse
    {
        $enquiry->delete();

        return redirect()->route('admin.enquiries.index')
            ->with('success', 'Enquiry deleted successfully.');
    }

    /**
     * Delete selected/bulk enquiries.
     */
    public function bulkDestroy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:enquiries,id',
        ], [
            'ids.required' => 'Please select at least one enquiry to delete.',
        ]);

        $count = Enquiry::whereIn('id', $validated['ids'])->delete();

        return redirect()->route('admin.enquiries.index')
            ->with('success', "{$count} selected enquiries deleted successfully.");
    }
}
