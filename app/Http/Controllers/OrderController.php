<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cart = $this->resolveCart();
        $cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:50'],
            'country' => ['nullable', 'string', 'max:100'],
            'payment_method' => ['nullable', 'string', 'max:50'],
            'notes' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($cart, $data) {
            $subtotal = $cart->items->sum('subtotal');

            $order = Order::create([
                'user_id' => auth()->id(),
                'cart_id' => $cart->id,
                'order_number' => 'SGS-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4)),
                'customer_name' => $data['customer_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'],
                'postal_code' => $data['postal_code'] ?? null,
                'country' => $data['country'] ?? null,
                'subtotal' => $subtotal,
                'discount_amount' => 0,
                'shipping_amount' => 0,
                'total' => $subtotal,
                'payment_method' => $data['payment_method'] ?? 'cash_on_delivery',
                'payment_status' => 'unpaid',
                'order_status' => 'pending',
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_title' => $item->product->title,
                    'unit_price' => $item->unit_price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->subtotal,
                ]);

                if ($item->product) {
                    $item->product->decrement('stock_qty', $item->quantity);
                }
            }

            $cart->update(['status' => 'converted']);
            $cart->items()->delete();
        });

        return redirect()->route('cart.index')->with('success', 'Order placed successfully.');
    }

    private function resolveCart(): Cart
    {
        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->id())
                ->where('status', 'open')
                ->first();

            if ($cart) {
                return $cart;
            }
        }

        return Cart::where('session_id', session()->getId())
            ->where('status', 'open')
            ->firstOrFail();
    }
}