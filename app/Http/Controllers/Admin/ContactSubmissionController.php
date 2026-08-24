<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactSubmissionController extends Controller
{
    public function index(Request $request): View
    {
        $query = ContactSubmission::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $submissions = $query->latest()->paginate(10)->withQueryString();
        $unreadCount = ContactSubmission::where('status', 'new')->count();

        return view('admin.contact.index', compact('submissions', 'unreadCount'));
    }

    public function markAsRead(ContactSubmission $contactMessage): JsonResponse|RedirectResponse
    {
        $contactMessage->update([
            'status' => $contactMessage->status === 'new' ? 'read' : 'new',
        ]);

        $unreadCount = ContactSubmission::where('status', 'new')->count();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'status' => $contactMessage->status,
                'unreadCount' => $unreadCount,
                'message' => $contactMessage->status === 'read' ? 'Message marked as read.' : 'Message marked as new.',
            ]);
        }

        return back()->with('success', 'Contact status updated successfully.');
    }

    public function destroy(ContactSubmission $contactMessage): JsonResponse|RedirectResponse
    {
        $contactMessage->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Contact message deleted successfully.',
            ]);
        }

        return redirect()->route('admin.contact-messages.index')->with('success', 'Contact message deleted successfully.');
    }

    public function bulkDelete(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['exists:contact_submissions,id'],
        ]);

        $count = ContactSubmission::whereIn('id', $request->input('ids'))->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Successfully deleted {$count} contact messages.",
            ]);
        }

        return redirect()->route('admin.contact-messages.index')->with('success', "Successfully deleted {$count} contact messages.");
    }
}
