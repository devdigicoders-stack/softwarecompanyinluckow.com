<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
});

test('homepage loads successfully with target H1', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Software Company in Lucknow');
});

test('blog index and article detail pages render successfully', function () {
    $indexResponse = $this->get('/blog');
    $indexResponse->assertStatus(200);
    $indexResponse->assertSee('Journal');

    $articleResponse = $this->get('/blog/software-development-cost-in-lucknow');
    $articleResponse->assertStatus(200);
    $articleResponse->assertSee('Software Development Cost in Lucknow');
    $articleResponse->assertSee('schema.org');
});

test('dedicated seo service pages render successfully', function () {
    $response = $this->get('/software-development-company-in-lucknow');

    $response->assertStatus(200);
    $response->assertSee('Software Development Company in Lucknow');
});

test('dedicated software solution pages render successfully', function () {
    $response = $this->get('/hrms-software-in-lucknow');

    $response->assertStatus(200);
    $response->assertSee('HRMS Software in Lucknow');
});

test('lucknow location hub pages render successfully', function () {
    $response = $this->get('/location/gomti-nagar');

    $response->assertStatus(200);
    $response->assertSee('Gomti Nagar');
});

test('search functionality works', function () {
    $response = $this->get('/search?q=Software');

    $response->assertStatus(200);
    $response->assertSee('Search Results for');
});

test('dynamic sitemap and robots.txt serve valid responses', function () {
    $sitemap = $this->get('/sitemap.xml');
    $sitemap->assertStatus(200);
    $sitemap->assertHeader('Content-Type', 'text/xml; charset=UTF-8');

    $robots = $this->get('/robots.txt');
    $robots->assertStatus(200);
    $robots->assertSee('User-agent: *');
    $robots->assertSee('Sitemap:');
});

test('contact form submission stores lead in database', function () {
    $response = $this->post('/contact/submit', [
        'name' => 'Rahul Sharma',
        'email' => 'rahul@example.com',
        'phone' => '9876543210',
        'service' => 'Enterprise ERP Software',
        'message' => 'Need custom ERP software for warehouse management in Gomti Nagar.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('contact_submissions', [
        'email' => 'rahul@example.com',
        'phone' => '9876543210',
    ]);
});

test('contact form submission stores custom service when other is selected', function () {
    $response = $this->post('/contact/submit', [
        'name' => 'Amit Kumar',
        'email' => 'amit@example.com',
        'phone' => '8765432109',
        'service' => 'Other',
        'custom_service' => 'AI Chatbot & Automation Tool',
        'message' => 'We need an AI chatbot integrated with WhatsApp API.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('contact_submissions', [
        'email' => 'amit@example.com',
        'service' => 'AI Chatbot & Automation Tool',
    ]);
});

test('admin dashboard requires authentication', function () {
    $guestResponse = $this->get('/admin');
    $guestResponse->assertRedirect(route('admin.login'));

    $admin = User::where('is_admin', true)->first();
    $authedResponse = $this->actingAs($admin)->get('/admin');
    $authedResponse->assertStatus(200);
    $authedResponse->assertSee('Dashboard Overview');
});
