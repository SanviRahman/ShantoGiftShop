<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Request $request, Order $order)
    {
        $this->authorizeOrderAccess($request, $order);

        if ($order->payment_method === 'cash_on_delivery') {
            return redirect()->route('orders.show', [
                'order' => $order,
                'token' => $order->public_token,
            ])->with('success', 'Order placed successfully.');
        }

        return view('payment', [
            'order' => $order,
            'token' => (string) $request->query('token', ''),
        ]);
    }

    public function store(Request $request, Order $order)
    {
        $this->authorizeOrderAccess($request, $order);

        if ($order->payment_method === 'cash_on_delivery') {
            return redirect()->route('orders.show', [
                'order' => $order,
                'token' => $order->public_token,
            ])->with('success', 'Order placed successfully.');
        }

        if ($order->payment_status === 'paid') {
            return redirect()->route('orders.show', [
                'order' => $order,
                'token' => $order->public_token,
            ])->with('success', 'Payment already completed.');
        }

        if ($request->has('cancel')) {
            $order->update([
                'payment_status' => 'cancelled',
                'order_status' => 'pending_payment',
            ]);

            return redirect()->route('orders.create', [
                'order' => $order,
                'token' => $order->public_token,
            ])->with('error', 'Payment cancelled.');
        }

        $gateway = $order->payment_method;
        $rules = $this->gatewayRules($gateway);

        $request->validate($rules);

        $order->update([
            'payment_status' => 'paid',
            'order_status' => 'confirmed',
        ]);

        session()->forget('recent_order_id');
        session()->forget('recent_order_token');

        return redirect()->route('orders.show', [
            'order' => $order,
            'token' => $order->public_token,
        ])->with('success', 'Payment completed successfully.');
    }

    private function authorizeOrderAccess(Request $request, Order $order): void
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

    private function gatewayRules(string $gateway): array
    {
        return match ($gateway) {
            'bkash' => [
                'bkash_mobile' => ['required', 'string', 'max:20'],
                'bkash_otp' => ['required', 'string', 'max:10'],
                'bkash_pin' => ['required', 'string', 'max:10'],
            ],
            'nagad' => [
                'nagad_mobile' => ['required', 'string', 'max:20'],
                'nagad_otp' => ['required', 'string', 'max:10'],
            ],
            'card' => [
                'card_name' => ['required', 'string', 'max:100'],
                'card_number' => ['required', 'string', 'max:25'],
                'card_expiry' => ['required', 'string', 'max:7'],
                'card_cvv' => ['required', 'string', 'max:4'],
            ],
            'bank' => [
                'bank_name' => ['required', 'string', 'max:100'],
                'account_name' => ['required', 'string', 'max:100'],
                'account_number' => ['required', 'string', 'max:40'],
                'routing_number' => ['nullable', 'string', 'max:40'],
            ],
            default => [],
        };
    }
}
