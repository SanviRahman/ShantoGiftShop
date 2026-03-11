<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_view_invoice_with_token(): void
    {
        $category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
            'is_active' => true,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'title' => 'Test Product',
            'slug' => 'test-product',
            'price' => 499,
            'stock_qty' => 10,
            'is_active' => true,
        ]);

        $order = Order::create([
            'order_number' => 'SGS-TEST-0001',
            'public_token' => Str::lower(Str::random(40)),
            'customer_name' => 'Test Customer',
            'email' => 'test@example.com',
            'phone' => '0123456789',
            'address' => 'Test Address',
            'city' => 'Dhaka',
            'subtotal' => 499,
            'discount_amount' => 0,
            'shipping_amount' => 0,
            'total' => 499,
            'payment_method' => 'bkash',
            'payment_status' => 'initiated',
            'order_status' => 'pending_payment',
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'product_title' => $product->title,
            'unit_price' => 499,
            'quantity' => 1,
            'subtotal' => 499,
        ]);

        $response = $this->get(route('orders.show', [
            'order' => $order,
            'token' => $order->public_token,
        ]));

        $response->assertOk();
        $response->assertSee('INVOICE');
        $response->assertSee($order->order_number);
    }

    public function test_guest_can_download_invoice_html_with_token(): void
    {
        $category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category-2',
            'is_active' => true,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'title' => 'Test Product 2',
            'slug' => 'test-product-2',
            'price' => 499,
            'stock_qty' => 10,
            'is_active' => true,
        ]);

        $order = Order::create([
            'order_number' => 'SGS-TEST-0002',
            'public_token' => Str::lower(Str::random(40)),
            'customer_name' => 'Test Customer',
            'email' => 'test2@example.com',
            'phone' => '0123456789',
            'address' => 'Test Address',
            'city' => 'Dhaka',
            'subtotal' => 499,
            'discount_amount' => 0,
            'shipping_amount' => 0,
            'total' => 499,
            'payment_method' => 'bkash',
            'payment_status' => 'initiated',
            'order_status' => 'pending_payment',
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'product_title' => $product->title,
            'unit_price' => 499,
            'quantity' => 1,
            'subtotal' => 499,
        ]);

        $response = $this->get(route('orders.show', [
            'order' => $order,
            'token' => $order->public_token,
            'download' => 1,
        ]));

        $response->assertOk();
        $response->assertHeader('Content-Disposition');
    }
}

