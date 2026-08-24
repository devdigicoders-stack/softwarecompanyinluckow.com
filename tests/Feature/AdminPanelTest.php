<?php

use App\Models\Category;
use App\Models\ContactSubmission;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('unauthenticated users are redirected from admin routes to admin login', function () {
    $response = $this->get('/admin/dashboard');
    $response->assertRedirect('/admin/login');
});

test('admin login page renders successfully', function () {
    $response = $this->get('/admin/login');
    $response->assertStatus(200);
    $response->assertSee('Software Company in Lucknow');
});

test('admin can authenticate with valid credentials', function () {
    $admin = User::factory()->create([
        'email' => 'testadmin@softwarecompanyinlucknow.com',
        'password' => 'password123',
        'is_admin' => true,
    ]);

    session(['admin_otp_verified_email' => $admin->email]);

    $response = $this->post('/admin/login', [
        'email' => 'testadmin@softwarecompanyinlucknow.com',
        'password' => 'password123',
    ]);

    $response->assertRedirect(route('admin.dashboard'));
    $this->assertAuthenticatedAs($admin);
});

test('authenticated admin can access dashboard and view stats', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($admin)->get('/admin/dashboard');
    $response->assertStatus(200);
    $response->assertSee('Welcome back, Admin');
});

test('authenticated admin can view blog management page', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($admin)->get('/admin/posts');
    $response->assertStatus(200);
    $response->assertSee('Blog Articles');
});

test('authenticated admin can view contact messages page', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    ContactSubmission::create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '9876543210',
        'message' => 'Need custom software quotation',
        'status' => 'new',
    ]);

    $response = $this->actingAs($admin)->get('/admin/contact-messages');
    $response->assertStatus(200);
    $response->assertSee('John Doe');
});

test('authenticated admin can toggle post trending status', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $category = Category::create(['name' => 'Tech', 'slug' => 'tech']);
    $post = Post::create([
        'title' => 'Test Post',
        'slug' => 'test-post',
        'excerpt' => 'Test excerpt',
        'content' => 'Test content',
        'category_id' => $category->id,
        'is_trending' => false,
    ]);

    $response = $this->actingAs($admin)->post("/admin/blogs/{$post->id}/toggle-trending");
    $response->assertSessionHasNoErrors();
    expect($post->fresh()->is_trending)->toBeTrue();
});

test('authenticated admin can toggle post popular status', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $category = Category::create(['name' => 'Tech', 'slug' => 'tech']);
    $post = Post::create([
        'title' => 'Test Post Popular',
        'slug' => 'test-post-popular',
        'excerpt' => 'Test excerpt',
        'content' => 'Test content',
        'category_id' => $category->id,
        'is_popular' => false,
    ]);

    $response = $this->actingAs($admin)->post("/admin/blogs/{$post->id}/toggle-popular");
    $response->assertSessionHasNoErrors();
    expect($post->fresh()->is_popular)->toBeTrue();
});
