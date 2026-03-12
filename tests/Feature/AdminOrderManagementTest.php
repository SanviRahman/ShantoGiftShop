<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdminOrderManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_download_invoice_for_any_order(): void
    {
        $admin = User::factory()->create([
            'usertype' => 'admin',
            'email_verified_at' => now(),
        ]);

        $customer = User::factory()->create([
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        $order = Order::create([
            'user_id' => $customer->id,
            'cart_id' => null,
            'order_number' => 'SGS-TEST-'.Str::upper(Str::random(6)),
            'public_token' => Str::lower(Str::random(40)),
            'customer_name' => 'Test Customer',
            'email' => 'customer@example.com',
            'phone' => '01700000000',
            'address' => 'Test Address',
            'city' => 'Dhaka',
            'postal_code' => null,
            'country' => 'BD',
            'subtotal' => 1000,
            'discount_amount' => 0,
            'shipping_amount' => 0,
            'total' => 1000,
            'payment_method' => 'cash_on_delivery',
            'payment_status' => 'unpaid',
            'order_status' => 'pending',
            'notes' => null,
        ]);

        $order->items()->create([
            'product_id' => null,
            'product_title' => 'Test Product',
            'unit_price' => 1000,
            'quantity' => 1,
            'subtotal' => 1000,
        ]);

        $response = $this->actingAs($admin)->get(route('orders.show', [
            'order' => $order,
            'download' => 1,
        ]));

        $response->assertStatus(200);
        $response->assertHeader('Content-Disposition');
    }

    public function test_admin_can_update_and_delete_orders(): void
    {
        $admin = User::factory()->create([
            'usertype' => 'admin',
            'email_verified_at' => now(),
        ]);

        $order = Order::create([
            'user_id' => null,
            'cart_id' => null,
            'order_number' => 'SGS-TEST-'.Str::upper(Str::random(6)),
            'public_token' => Str::lower(Str::random(40)),
            'customer_name' => 'Guest',
            'email' => 'guest@example.com',
            'phone' => '01800000000',
            'address' => 'X',
            'city' => 'Dhaka',
            'postal_code' => null,
            'country' => 'BD',
            'subtotal' => 6000,
            'discount_amount' => 0,
            'shipping_amount' => 0,
            'total' => 6000,
            'payment_method' => 'cash_on_delivery',
            'payment_status' => 'unpaid',
            'order_status' => 'pending',
            'notes' => null,
        ]);

        $this->actingAs($admin)
            ->put(route('admin.orders.update', $order), [
                'order_status' => 'confirmed',
                'payment_status' => 'paid',
                'address' => 'Updated Address',
            ])
            ->assertRedirect();

        $order->refresh();
        $this->assertSame('confirmed', $order->order_status);
        $this->assertSame('paid', $order->payment_status);
        $this->assertSame('Updated Address', $order->address);
        $this->assertNotEmpty($order->risk_level);

        $this->actingAs($admin)
            ->delete(route('admin.orders.destroy', $order))
            ->assertRedirect(route('admin.orders.index'));

        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }
}
