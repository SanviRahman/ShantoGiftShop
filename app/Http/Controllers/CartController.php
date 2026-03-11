<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->resolveCart();
        $cart->load('items.product');

        return view('cart', [
            'cart' => $cart,
            'cartItems' => $cart->items,
            'subtotal' => $cart->items->sum('subtotal'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $product = Product::where('is_active', true)->findOrFail($data['product_id']);
        $cart = $this->resolveCart();
        $quantity = $data['quantity'] ?? 1;

        if ($product->stock_qty < $quantity) {
            return back()->with('error', 'Requested quantity is not available in stock.');
        }

        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $newQty = $item->quantity + $quantity;

            if ($product->stock_qty < $newQty) {
                return back()->with('error', 'You cannot add more than available stock.');
            }

            $item->quantity = $newQty;
            $item->subtotal = $item->quantity * $item->unit_price;
            $item->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $product->price,
                'subtotal' => $product->price * $quantity,
            ]);
        }

        return back()->with('success', 'Product added to cart successfully.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $cart = $this->resolveCart();

        abort_unless($cartItem->cart_id === $cart->id, 403);

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($cartItem->product && $data['quantity'] > $cartItem->product->stock_qty) {
            return back()->with('error', 'Requested quantity exceeds available stock.');
        }

        $cartItem->update([
            'quantity' => $data['quantity'],
            'subtotal' => $cartItem->unit_price * $data['quantity'],
        ]);

        return back()->with('success', 'Cart updated successfully.');
    }

    public function destroy(CartItem $cartItem)
    {
        $cart = $this->resolveCart();

        abort_unless($cartItem->cart_id === $cart->id, 403);

        $cartItem->delete();

        return back()->with('success', 'Item removed from cart.');
    }

    public function sync(Request $request)
    {
        $cart = $this->resolveCart();
        $cart->load('items.product');

        $data = $request->validate([
            'items' => ['nullable', 'array'],
            'items.*' => ['nullable', 'integer', 'min:1'],
        ]);

        foreach ($cart->items as $item) {
            if (isset($data['items'][$item->id])) {
                $qty = (int) $data['items'][$item->id];

                if ($item->product && $qty > $item->product->stock_qty) {
                    return back()->with('error', $item->product->title . ' stock is limited.');
                }

                $item->update([
                    'quantity' => $qty,
                    'subtotal' => $item->unit_price * $qty,
                ]);
            }
        }

        return back()->with('success', 'Cart synced successfully.');
    }

    private function resolveCart(): Cart
    {
        $sessionId = session()->getId();

        if (auth()->check()) {
            $guestCart = Cart::whereNull('user_id')
                ->where('session_id', $sessionId)
                ->where('status', 'open')
                ->first();

            $userCart = Cart::where('user_id', auth()->id())
                ->where('status', 'open')
                ->first();

            if ($guestCart && !$userCart) {
                $guestCart->update(['user_id' => auth()->id()]);
                return $guestCart;
            }

            if ($guestCart && $userCart && $guestCart->id !== $userCart->id) {
                foreach ($guestCart->items as $guestItem) {
                    $existing = $userCart->items()->where('product_id', $guestItem->product_id)->first();

                    if ($existing) {
                        $existing->quantity += $guestItem->quantity;
                        $existing->subtotal = $existing->quantity * $existing->unit_price;
                        $existing->save();
                    } else {
                        $guestItem->update(['cart_id' => $userCart->id]);
                    }
                }

                $guestCart->delete();
                return $userCart;
            }

            return $userCart ?: Cart::create([
                'user_id' => auth()->id(),
                'session_id' => $sessionId,
                'status' => 'open',
            ]);
        }

        return Cart::firstOrCreate([
            'session_id' => $sessionId,
            'status' => 'open',
        ], [
            'user_id' => null,
        ]);
    }
}