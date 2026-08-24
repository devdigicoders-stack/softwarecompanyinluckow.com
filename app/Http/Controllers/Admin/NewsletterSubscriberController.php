<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsletterSubscriberController extends Controller
{
    public function index(Request $request): View
    {
        $query = NewsletterSubscriber::query()->latest();

        if ($search = $request->input('search')) {
            $query->where('email', 'like', "%{$search}%");
        }

        $subscribers = $query->paginate(20)->withQueryString();
        $totalSubscribers = NewsletterSubscriber::count();

        return view('admin.subscribers.index', compact('subscribers', 'totalSubscribers'));
    }

    public function destroy(NewsletterSubscriber $subscriber): JsonResponse|RedirectResponse
    {
        $subscriber->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Subscriber email deleted successfully.',
            ]);
        }

        return redirect()->route('admin.subscribers.index')->with('success', 'Subscriber email deleted successfully.');
    }

    public function bulkDelete(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['exists:newsletter_subscribers,id'],
        ]);

        $count = NewsletterSubscriber::whereIn('id', $request->input('ids'))->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "Successfully deleted {$count} subscriber emails.",
            ]);
        }

        return redirect()->route('admin.subscribers.index')->with('success', "Successfully deleted {$count} subscriber emails.");
    }
}
