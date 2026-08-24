<?php

use App\Mail\NewFormSubmissionMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

test('submitting quick modal enquiry triggers global email notification', function () {
    Mail::fake();

    $response = $this->postJson(route('enquiries.store'), [
        'name' => 'Amitabh Bachchan',
        'mobile' => '9876543210',
        'email' => 'amitabh@example.com',
        'requirement' => 'ERP & Web App Quote',
        'source_page' => 'homepage',
    ]);

    $response->assertStatus(200);

    Mail::assertSent(NewFormSubmissionMail::class, function ($mail) {
        return $mail->formType === 'Quick Modal Enquiry' &&
            $mail->data['Name'] === 'Amitabh Bachchan' &&
            $mail->data['Mobile'] === '+91 9876543210';
    });
});

test('submitting contact form triggers global email notification', function () {
    Mail::fake();

    $response = $this->post(route('contact.submit'), [
        'name' => 'Rohan Sharma',
        'email' => 'rohan@example.com',
        'phone' => '9123456789',
        'service' => 'ERP Solutions',
        'message' => 'Need ERP software quote.',
    ]);

    $response->assertRedirect();

    Mail::assertSent(NewFormSubmissionMail::class, function ($mail) {
        return $mail->formType === 'Contact Us Submission' &&
            $mail->data['Name'] === 'Rohan Sharma' &&
            $mail->data['Service'] === 'ERP Solutions';
    });
});

test('submitting newsletter subscription triggers global email notification', function () {
    Mail::fake();

    $response = $this->post(route('newsletter.subscribe'), [
        'email' => 'subscriber@example.com',
    ]);

    $response->assertRedirect();

    Mail::assertSent(NewFormSubmissionMail::class, function ($mail) {
        return $mail->formType === 'Newsletter Subscription' &&
            $mail->data['Subscriber Email'] === 'subscriber@example.com';
    });
});
