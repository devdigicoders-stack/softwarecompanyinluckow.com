<?php

use App\Models\NewsletterSubscriber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
});

test('user can subscribe to footer newsletter successfully', function () {
    $response = $this->post(route('newsletter.subscribe'), [
        'email' => 'subscriber@example.com',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('newsletter_success');

    $this->assertDatabaseHas('newsletter_subscribers', [
        'email' => 'subscriber@example.com',
        'is_active' => true,
    ]);
});

test('newsletter subscription rejects invalid email', function () {
    $response = $this->post(route('newsletter.subscribe'), [
        'email' => 'not-an-email',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertDatabaseCount('newsletter_subscribers', 0);
});

test('authenticated admin can view subscribers list', function () {
    $admin = User::where('is_admin', true)->first();
    NewsletterSubscriber::create(['email' => 'sub1@example.com']);
    NewsletterSubscriber::create(['email' => 'sub2@example.com']);

    $response = $this->actingAs($admin)->get(route('admin.subscribers.index'));

    $response->assertStatus(200);
    $response->assertSee('sub1@example.com');
    $response->assertSee('sub2@example.com');
});

test('admin can delete single subscriber', function () {
    $admin = User::where('is_admin', true)->first();
    $sub = NewsletterSubscriber::create(['email' => 'delete-me@example.com']);

    $response = $this->actingAs($admin)->delete(route('admin.subscribers.destroy', $sub->id));

    $response->assertRedirect(route('admin.subscribers.index'));
    $this->assertDatabaseMissing('newsletter_subscribers', [
        'id' => $sub->id,
    ]);
});

test('admin can bulk delete selected subscribers', function () {
    $admin = User::where('is_admin', true)->first();
    $sub1 = NewsletterSubscriber::create(['email' => 'bulk1@example.com']);
    $sub2 = NewsletterSubscriber::create(['email' => 'bulk2@example.com']);
    $sub3 = NewsletterSubscriber::create(['email' => 'keep@example.com']);

    $response = $this->actingAs($admin)->post(route('admin.subscribers.bulk-delete'), [
        'ids' => [$sub1->id, $sub2->id],
    ]);

    $response->assertRedirect(route('admin.subscribers.index'));
    $this->assertDatabaseMissing('newsletter_subscribers', ['id' => $sub1->id]);
    $this->assertDatabaseMissing('newsletter_subscribers', ['id' => $sub2->id]);
    $this->assertDatabaseHas('newsletter_subscribers', ['id' => $sub3->id]);
});
