<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthRedirectTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_redirects_to_admin_dashboard_when_no_intended_url(): void
    {
        $admin = User::factory()->create([
            'usertype' => 'admin',
            'email_verified_at' => now(),
        ]);

        $response = $this->post(route('login.store'), [
            'login' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_admin_login_respects_intended_admin_url(): void
    {
        $admin = User::factory()->create([
            'usertype' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->withSession([
            'url.intended' => '/admin/orders',
        ]);

        $response = $this->post(route('login.store'), [
            'login' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin/orders');
        $this->assertAuthenticatedAs($admin);
    }

    public function test_user_login_does_not_redirect_to_admin_pages(): void
    {
        $user = User::factory()->create([
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        $this->withSession([
            'url.intended' => '/admin/dashboard',
        ]);

        $response = $this->post(route('login.store'), [
            'login' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }
}
