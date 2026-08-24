<?php

use App\Models\Faq;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
});

test('public pages load dynamic FAQs from database', function () {
    Faq::create([
        'page_name' => 'contact',
        'question' => 'Custom DB Dynamic Question Contact?',
        'answer' => 'Custom DB Dynamic Answer Contact.',
        'order_index' => 1,
        'is_active' => true,
    ]);

    $response = $this->get('/contact');

    $response->assertStatus(200);
    $response->assertSee('Custom DB Dynamic Question Contact?');
    $response->assertSee('Custom DB Dynamic Answer Contact.');
});

test('authenticated admin can view faqs list', function () {
    $admin = User::where('is_admin', true)->first();
    Faq::create([
        'page_name' => 'home',
        'question' => 'What is dynamic FAQ test?',
        'answer' => 'Dynamic FAQ answer.',
        'order_index' => 1,
        'is_active' => true,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.faqs.index'));

    $response->assertStatus(200);
    $response->assertSee('What is dynamic FAQ test?');
});

test('admin can create new faq', function () {
    $admin = User::where('is_admin', true)->first();

    $response = $this->actingAs($admin)->post(route('admin.faqs.store'), [
        'page_name' => 'about',
        'question' => 'New Created FAQ Question?',
        'answer' => 'New Created FAQ Answer.',
        'order_index' => 1,
        'is_active' => 1,
    ]);

    $response->assertRedirect(route('admin.faqs.index'));
    $this->assertDatabaseHas('faqs', [
        'page_name' => 'about',
        'question' => 'New Created FAQ Question?',
    ]);
});

test('admin can edit existing faq', function () {
    $admin = User::where('is_admin', true)->first();
    $faq = Faq::create([
        'page_name' => 'contact',
        'question' => 'Old Question?',
        'answer' => 'Old Answer.',
        'order_index' => 1,
        'is_active' => true,
    ]);

    $response = $this->actingAs($admin)->put(route('admin.faqs.update', $faq->id), [
        'page_name' => 'contact',
        'question' => 'Updated Question Title?',
        'answer' => 'Updated Answer Content.',
        'order_index' => 2,
        'is_active' => 1,
    ]);

    $response->assertRedirect(route('admin.faqs.index'));
    $this->assertDatabaseHas('faqs', [
        'id' => $faq->id,
        'question' => 'Updated Question Title?',
    ]);
});

test('admin can delete single faq', function () {
    $admin = User::where('is_admin', true)->first();
    $faq = Faq::create([
        'page_name' => 'home',
        'question' => 'Delete Me Question?',
        'answer' => 'Delete Me Answer.',
        'order_index' => 1,
        'is_active' => true,
    ]);

    $response = $this->actingAs($admin)->delete(route('admin.faqs.destroy', $faq->id));

    $response->assertRedirect(route('admin.faqs.index'));
    $this->assertDatabaseMissing('faqs', [
        'id' => $faq->id,
    ]);
});

test('admin can bulk delete selected faqs', function () {
    $admin = User::where('is_admin', true)->first();
    $faq1 = Faq::create(['page_name' => 'home', 'question' => 'Q1?', 'answer' => 'A1', 'order_index' => 1]);
    $faq2 = Faq::create(['page_name' => 'home', 'question' => 'Q2?', 'answer' => 'A2', 'order_index' => 2]);
    $faq3 = Faq::create(['page_name' => 'home', 'question' => 'Q3?', 'answer' => 'A3', 'order_index' => 3]);

    $response = $this->actingAs($admin)->post(route('admin.faqs.bulk-delete'), [
        'ids' => [$faq1->id, $faq2->id],
    ]);

    $response->assertRedirect(route('admin.faqs.index'));
    $this->assertDatabaseMissing('faqs', ['id' => $faq1->id]);
    $this->assertDatabaseMissing('faqs', ['id' => $faq2->id]);
    $this->assertDatabaseHas('faqs', ['id' => $faq3->id]);
});
