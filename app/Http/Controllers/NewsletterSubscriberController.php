<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use App\Services\FormNotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsletterSubscriberController extends Controller
{
    public function subscribe(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ], [
            'email.required' => 'Please enter your email address to subscribe.',
            'email.email' => 'Please enter a valid email address.',
        ]);

        $subscriber = NewsletterSubscriber::firstOrCreate(
            ['email' => strtolower(trim($validated['email']))],
            ['is_active' => true]
        );

        // Trigger Global Email Notification
        FormNotificationService::sendNotification('Newsletter Subscription', [
            'Subscriber Email' => $subscriber->email,
            'IP Address' => $request->ip(),
        ]);

        return back()->with('newsletter_success', 'Thank you for subscribing to our newsletter! You will receive our latest software updates.');
    }
}
