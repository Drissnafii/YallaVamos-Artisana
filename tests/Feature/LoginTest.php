<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123')
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    /** @test */
/** @test */
public function admin_is_redirected_to_admin_dashboard()
{
    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => Hash::make('password123'),
        'role' => 'admin'
    ]);

    $response = $this->post('/login', [
        'email' => 'admin@example.com',
        'password' => 'password123'
    ]);

    $response->assertRedirect('/admin/dashboard');
    $this->assertAuthenticated();
}

/** @test */
public function regular_user_is_redirected_to_user_dashboard()
{
    $user = User::factory()->create([
        'email' => 'user@example.com',
        'password' => Hash::make('password123'),
        'role' => 'user'
    ]);

    $response = $this->post('/login', [
        'email' => 'user@example.com',
        'password' => 'password123'
    ]);

    $response->assertRedirect('/dashboard');
    $this->assertAuthenticated();
}

/** @test */
public function admin_can_access_admin_dashboard()
{
    $admin = User::factory()->create([
        'role' => 'admin'
    ]);

    $response = $this->actingAs($admin)
                     ->get('/admin/dashboard');

    $response->assertStatus(200);
    $response->assertViewIs('dashboard.admin');
}

/** @test */
public function regular_user_cannot_access_admin_dashboard()
{
    $user = User::factory()->create([
        'role' => 'user'
    ]);

    $response = $this->actingAs($user)
                     ->get('/admin/dashboard');

    $response->assertStatus(403);
}


    /** @test */
    public function login_fails_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123')
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrong-password'
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    /** @test */
    public function login_requires_email_and_password()
    {
        $response = $this->post('/login', []);

        $response->assertSessionHasErrors(['email', 'password']);
    }

    /** @test */
    // public function user_can_logout()
    // {
    //     $user = User::factory()->create();

    //     $this->actingAs($user);
    //     $this->assertAuthenticated();

    //     $response = $this->post('/logout');

    //     $response->assertRedirect('/');
    //     $this->assertGuest();
    // }
}
