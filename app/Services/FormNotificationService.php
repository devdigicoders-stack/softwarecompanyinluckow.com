<?php

namespace App\Services;

use App\Mail\NewFormSubmissionMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class FormNotificationService
{
    /**
     * Send email notification for a form submission to admin.
     */
    public static function sendNotification(string $formType, array $formData): void
    {
        try {
            $adminEmail = config('mail.admin_address')
                ?? env('ADMIN_NOTIFICATION_EMAIL')
                ?? 'info@softwarecompanyinlucknow.com';

            Mail::to($adminEmail)->send(new NewFormSubmissionMail($formType, $formData));
        } catch (Throwable $e) {
            // Log mail failure safely without breaking the user experience
            Log::error("Failed to send form submission email ({$formType}): ".$e->getMessage(), [
                'form_type' => $formType,
                'data' => $formData,
            ]);
        }
    }
}
