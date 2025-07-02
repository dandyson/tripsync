<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('profile information is returned', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this
        ->get('/api/profile');

    $response->assertOk()
        ->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
            ],
        ]);
});

test('profile information can be updated', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this
        ->patch('/api/profile', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

    $response
        ->assertOk()
        ->assertJson([
            'message' => 'Profile updated successfully',
        ])
        ->assertJsonStructure([
            'message',
            'user' => [
                'id',
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at',
            ],
        ]);

    $user->refresh();

    $this->assertSame('Test User', $user->name);
    $this->assertSame('test@example.com', $user->email);
    $this->assertNull($user->email_verified_at);
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this
        ->patch('/api/profile', [
            'name' => 'Test User',
            'email' => $user->email,
        ]);

    $response
        ->assertOk()
        ->assertJson([
            'message' => 'Profile updated successfully',
        ]);

    $this->assertNotNull($user->refresh()->email_verified_at);
});

test('user can delete their account', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this
        ->delete('/api/profile', [
            'password' => 'password',
        ]);

    $response
        ->assertOk()
        ->assertJson([
            'message' => 'Account deleted successfully',
        ]);

    $this->assertNull($user->fresh());
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this
        ->withHeaders(['Accept' => 'application/json'])
        ->delete('/api/profile', [
            'password' => 'wrong-password',
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['password']);

    $this->assertNotNull($user->fresh());
});
