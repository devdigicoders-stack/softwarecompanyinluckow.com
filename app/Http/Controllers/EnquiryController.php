<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Services\FormNotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    /**
     * Store a new quick enquiry from modal or form.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'mobile' => ['required', 'string', 'digits:10', 'regex:/^[6-9]\d{9}$/'],
            'email' => 'nullable|email|max:150',
            'requirement' => 'nullable|string|max:1000',
            'source_page' => 'nullable|string|max:100',
        ], [
            'name.required' => 'Please enter your full name.',
            'name.min' => 'Full name must be at least 2 characters.',
            'mobile.required' => 'Please enter your 10-digit mobile number.',
            'mobile.digits' => 'Mobile number must be exactly 10 digits.',
            'mobile.regex' => 'Mobile number must start with 6, 7, 8, or 9.',
            'email.email' => 'Please enter a valid email address.',
        ]);

        $enquiry = Enquiry::create([
            'name' => $validated['name'],
            'mobile' => $validated['mobile'],
            'email' => $validated['email'] ?? null,
            'requirement' => $validated['requirement'] ?? null,
            'source_page' => $validated['source_page'] ?? 'general_modal',
            'status' => 'unread',
            'ip_address' => $request->ip(),
        ]);

        // Trigger Global Email Notification
        FormNotificationService::sendNotification('Quick Modal Enquiry', [
            'Name' => $enquiry->name,
            'Mobile' => '+91 '.$enquiry->mobile,
            'Email' => $enquiry->email ?? 'Not Provided',
            'Requirement' => $enquiry->requirement ?? 'None provided',
            'Source Page' => $enquiry->source_page,
            'IP Address' => $enquiry->ip_address,
        ]);

        $message = 'Thank you! Your enquiry has been received successfully. Our technical team will call you back shortly.';

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $enquiry,
            ]);
        }

        return back()->with('enquiry_success', $message);
    }
}
