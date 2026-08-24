<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use App\Models\Faq;
use App\Services\FormNotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show(): View
    {
        $breadcrumbs = [
            'Home' => route('home'),
            'Contact Us' => null,
        ];

        $contactFaqs = Faq::getForPage('contact');

        return view('contact', compact('breadcrumbs', 'contactFaqs'));
    }

    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[6-9]\d{9}$/'],
            'service' => ['required', 'string', 'max:255'],
            'custom_service' => ['nullable', 'required_if:service,Other', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:3000'],
        ], [
            'name.required' => 'Please enter your full name.',
            'email.required' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter your mobile number.',
            'phone.regex' => 'Mobile number must be exactly 10 digits and start with 9, 8, 7, or 6.',
            'service.required' => 'Please select a required software service.',
            'custom_service.required_if' => 'Please type your custom service or subject requirement.',
            'message.required' => 'Please provide your project overview or message.',
        ]);

        $finalService = ($validated['service'] === 'Other' && ! empty($validated['custom_service']))
            ? $validated['custom_service']
            : $validated['service'];

        $submission = ContactSubmission::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'service' => $finalService,
            'message' => $validated['message'],
            'ip_address' => $request->ip(),
            'status' => 'new',
        ]);

        // Trigger Global Email Notification
        FormNotificationService::sendNotification('Contact Us Submission', [
            'Name' => $submission->name,
            'Email' => $submission->email,
            'Phone' => '+91 '.$submission->phone,
            'Service' => $submission->service,
            'Message' => $submission->message,
            'IP Address' => $submission->ip_address,
        ]);

        return back()->with('success', 'Thank you for reaching out! Our senior software consultant will contact you within 24 hours to discuss your project requirements.');
    }
}
