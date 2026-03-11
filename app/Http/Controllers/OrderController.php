<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $cart = $this->resolveCart();
        $cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $requestedItemIds = collect($request->input('items', []))
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->values();

        $selectedItems = $requestedItemIds->isNotEmpty()
            ? $cart->items->whereIn('id', $requestedItemIds)->values()
            : $cart->items;

        if ($selectedItems->isEmpty()) {
            $selectedItems = $cart->items;
        }

        $subtotal = (float) $selectedItems->sum('subtotal');
        $couponSummary = $this->getCouponSummary($subtotal);

        $user = auth()->user()?->load('profile');

        return view('check-out', [
            'cart' => $cart,
            'selectedItems' => $selectedItems,
            'subtotal' => $subtotal,
            'discount' => $couponSummary['discount'],
            'total' => $couponSummary['total'],
            'appliedCoupon' => $couponSummary['coupon'],
            'prefill' => [
                'customer_name' => $user?->name,
                'email' => $user?->email,
                'phone' => $user?->phone ?? $user?->profile?->phone,
                'address' => $user?->profile?->address,
                'city' => $user?->profile?->city,
                'postal_code' => $user?->profile?->postal_code,
                'country' => $user?->profile?->country,
            ],
        ]);
    }

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
            'payment_method' => ['required', 'string', 'max:50', 'in:cash_on_delivery,bkash,nagad,bank,card'],
            'selected_item_ids' => ['nullable', 'array'],
            'selected_item_ids.*' => ['integer'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'apartment' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $selectedItemIds = collect($data['selected_item_ids'] ?? [])
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->values();

        $itemsToOrder = $selectedItemIds->isNotEmpty()
            ? $cart->items->whereIn('id', $selectedItemIds)->values()
            : $cart->items;

        if ($itemsToOrder->isEmpty()) {
            return back()->withErrors(['cart' => 'Selected items are not available in your cart.']);
        }

        $order = null;

        DB::transaction(function () use ($cart, $data, $itemsToOrder, &$order) {
            $subtotal = (float) $itemsToOrder->sum('subtotal');
            $couponSummary = $this->getCouponSummary($subtotal);

            $notesParts = [];

            if (! empty($data['company_name'])) {
                $notesParts[] = 'Company: '.$data['company_name'];
            }

            if (! empty($data['apartment'])) {
                $notesParts[] = 'Apartment: '.$data['apartment'];
            }

            if (! empty($data['notes'])) {
                $notesParts[] = $data['notes'];
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'cart_id' => $cart->id,
                'order_number' => 'SGS-'.now()->format('YmdHis').'-'.Str::upper(Str::random(4)),
                'public_token' => Str::lower(Str::random(40)),
                'customer_name' => $data['customer_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'],
                'postal_code' => $data['postal_code'] ?? null,
                'country' => $data['country'] ?? null,
                'subtotal' => $subtotal,
                'discount_amount' => $couponSummary['discount'],
                'shipping_amount' => 0,
                'total' => $couponSummary['total'],
                'payment_method' => $data['payment_method'],
                'payment_status' => $data['payment_method'] === 'cash_on_delivery' ? 'unpaid' : 'initiated',
                'order_status' => $data['payment_method'] === 'cash_on_delivery' ? 'pending' : 'pending_payment',
                'notes' => $notesParts ? implode("\n", $notesParts) : null,
            ]);

            foreach ($itemsToOrder as $item) {
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

            $cart->items()->whereIn('id', $itemsToOrder->pluck('id'))->delete();

            if ($cart->items()->count() === 0) {
                $cart->update(['status' => 'converted']);
                session()->forget('cart_coupon');
            }
        });

        if (! $order) {
            return redirect()->route('cart.index')->with('error', 'Failed to place order. Please try again.');
        }

        session()->put('recent_order_id', $order->id);
        session()->put('recent_order_token', $order->public_token);

        if ($order->payment_method !== 'cash_on_delivery') {
            return redirect()->route('orders.payments.create', [
                'order' => $order,
                'token' => $order->public_token,
            ]);
        }

        return redirect()->route('orders.show', [
            'order' => $order,
            'token' => $order->public_token,
        ])->with('success', 'Order placed successfully.');
    }

    public function show(Request $request, Order $order)
    {
        $this->authorizeInvoiceAccess($request, $order);

        $order->load('items');

        if ($request->boolean('download')) {
            $content = view('invoice-download', compact('order'))->render();

            return response($content)
                ->header('Content-Type', 'text/html; charset=UTF-8')
                ->header('Content-Disposition', 'attachment; filename="invoice-'.$order->order_number.'.html"');
        }

        return view('invoice', compact('order'));
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

            if ($guestCart && ! $userCart) {
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

    private function availableCoupons(): array
    {
        return [
            'SHANTO27' => [
                'type' => 'percent',
                'value' => 10,
                'label' => '10% OFF',
            ],
        ];
    }

    private function getCouponSummary(float $subtotal): array
    {
        if ($subtotal <= 0) {
            session()->forget('cart_coupon');

            return [
                'coupon' => null,
                'discount' => 0,
                'total' => 0,
            ];
        }

        $sessionCoupon = session('cart_coupon');

        if (! $sessionCoupon || empty($sessionCoupon['code'])) {
            return [
                'coupon' => null,
                'discount' => 0,
                'total' => $subtotal,
            ];
        }

        $code = strtoupper($sessionCoupon['code']);
        $coupon = $this->availableCoupons()[$code] ?? null;

        if (! $coupon) {
            session()->forget('cart_coupon');

            return [
                'coupon' => null,
                'discount' => 0,
                'total' => $subtotal,
            ];
        }

        if ($coupon['type'] === 'percent') {
            $discount = round(($subtotal * $coupon['value']) / 100);
        } else {
            $discount = (float) $coupon['value'];
        }

        $discount = min($discount, $subtotal);
        $total = max($subtotal - $discount, 0);

        return [
            'coupon' => [
                'code' => $code,
                'label' => $coupon['label'],
                'type' => $coupon['type'],
                'value' => $coupon['value'],
            ],
            'discount' => $discount,
            'total' => $total,
        ];
    }

    private function authorizeInvoiceAccess(Request $request, Order $order): void
    {
        if (auth()->check()) {
            abort_unless($order->user_id === auth()->id(), 403);

            return;
        }

        $token = (string) $request->query('token', '');

        if ($token !== '' && hash_equals((string) $order->public_token, $token)) {
            return;
        }

        abort_unless((int) session('recent_order_id') === (int) $order->id, 403);
    }
}
