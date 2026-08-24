<?php

use App\Models\Enquiry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('public user can submit quick enquiry with valid 10 digit mobile starting with 6-9', function () {
    $response = $this->postJson(route('enquiries.store'), [
        'name' => 'Rahul Sharma',
        'mobile' => '9876543210',
        'email' => 'rahul@example.com',
        'requirement' => 'Need custom ERP software for manufacturing business.',
        'source_page' => 'homepage',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
        ]);

    $this->assertDatabaseHas('enquiries', [
        'name' => 'Rahul Sharma',
        'mobile' => '9876543210',
        'email' => 'rahul@example.com',
        'source_page' => 'homepage',
        'status' => 'unread',
    ]);
});

test('enquiry submission fails if mobile number does not start with 6 7 8 or 9 or is not 10 digits', function ($invalidMobile) {
    $response = $this->postJson(route('enquiries.store'), [
        'name' => 'Amit Kumar',
        'mobile' => $invalidMobile,
        'email' => 'amit@example.com',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['mobile']);
})->with([
    '5987654321', // Starts with 5
    '1234567890', // Starts with 1
    '987654321',  // 9 digits
    '98765432100', // 11 digits
    'abcdefghij',  // alphabetic
]);

test('admin can view enquiries listing and filter by search', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    Enquiry::create([
        'name' => 'Priya Verma',
        'mobile' => '9123456789',
        'email' => 'priya@example.com',
        'requirement' => 'Laravel web app development',
        'status' => 'unread',
    ]);

    $response = $this->actingAs($admin)->get(route('admin.enquiries.index'));
    $response->assertStatus(200);
    $response->assertSee('Priya Verma');
    $response->assertSee('9123456789');

    $searchResponse = $this->actingAs($admin)->get(route('admin.enquiries.index', ['search' => 'Priya']));
    $searchResponse->assertStatus(200);
    $searchResponse->assertSee('Priya Verma');
});

test('admin can view single enquiry and mark as read', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $enquiry = Enquiry::create([
        'name' => 'Vikas Singh',
        'mobile' => '8765432109',
        'email' => 'vikas@example.com',
        'requirement' => 'Flutter mobile app quote',
        'status' => 'unread',
    ]);

    $response = $this->actingAs($admin)->get(route('admin.enquiries.show', $enquiry));
    $response->assertStatus(200);
    $response->assertSee('Vikas Singh');

    $this->assertDatabaseHas('enquiries', [
        'id' => $enquiry->id,
        'status' => 'read',
    ]);
});

test('admin can single delete an enquiry', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $enquiry = Enquiry::create([
        'name' => 'Sanjay Gupta',
        'mobile' => '7654321098',
        'status' => 'unread',
    ]);

    $response = $this->actingAs($admin)->delete(route('admin.enquiries.destroy', $enquiry));
    $response->assertRedirect(route('admin.enquiries.index'));
    $this->assertDatabaseMissing('enquiries', [
        'id' => $enquiry->id,
    ]);
});

test('admin can bulk delete selected enquiries', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $e1 = Enquiry::create(['name' => 'User 1', 'mobile' => '9876543211']);
    $e2 = Enquiry::create(['name' => 'User 2', 'mobile' => '9876543212']);
    $e3 = Enquiry::create(['name' => 'User 3', 'mobile' => '9876543213']);

    $response = $this->actingAs($admin)->post(route('admin.enquiries.bulk-delete'), [
        'ids' => [$e1->id, $e2->id],
    ]);

    $response->assertRedirect(route('admin.enquiries.index'));

    $this->assertDatabaseMissing('enquiries', ['id' => $e1->id]);
    $this->assertDatabaseMissing('enquiries', ['id' => $e2->id]);
    $this->assertDatabaseHas('enquiries', ['id' => $e3->id]);
});
