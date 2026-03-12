<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_admin_dashboard()
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_regular_users_cannot_access_admin_dashboard()
    {
        $user = User::factory()->create([
            'usertype' => 'user',
        ]);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertRedirect('/');
    }

    public function test_admins_can_access_admin_dashboard()
    {
        $admin = User::factory()->create([
            'usertype' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('admin.index');
    }

    public function test_admins_can_access_admin_pages()
    {
        $admin = User::factory()->create([
            'usertype' => 'admin',
        ]);

        $this->actingAs($admin)
            ->get('/admin/products')
            ->assertStatus(200)
            ->assertViewIs('admin.products.index');

        $this->actingAs($admin)
            ->get('/admin/categories')
            ->assertStatus(200)
            ->assertViewIs('admin.categories.index');

        $this->actingAs($admin)
            ->get('/admin/coupons')
            ->assertStatus(200)
            ->assertViewIs('admin.coupons.index');

        $this->actingAs($admin)
            ->get('/admin/subscribes')
            ->assertStatus(200)
            ->assertViewIs('admin.subscribes.index');

        $this->actingAs($admin)
            ->get('/admin/reports')
            ->assertStatus(200)
            ->assertViewIs('admin.reports.index');
    }

    public function test_regular_users_cannot_access_admin_pages()
    {
        $user = User::factory()->create([
            'usertype' => 'user',
        ]);

        $this->actingAs($user)->get('/admin/products')->assertRedirect('/');
        $this->actingAs($user)->get('/admin/categories')->assertRedirect('/');
        $this->actingAs($user)->get('/admin/coupons')->assertRedirect('/');
        $this->actingAs($user)->get('/admin/subscribes')->assertRedirect('/');
        $this->actingAs($user)->get('/admin/reports')->assertRedirect('/');
    }
}
