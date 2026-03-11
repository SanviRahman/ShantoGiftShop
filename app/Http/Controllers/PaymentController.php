<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(Order $order)
    {
        $this->authorizeOrderAccess($order);

        if ($order->payment_method === 'cash_on_delivery') {
            return redirect()->route('cart.index')->with('success', 'Order placed successfully.');
        }

        return view('payment', [
            'order' => $order,
        ]);
    }

    public function store(Request $request, Order $order)
    {
        $this->authorizeOrderAccess($order);

        if ($order->payment_method === 'cash_on_delivery') {
            return redirect()->route('cart.index')->with('success', 'Order placed successfully.');
        }

        if ($order->payment_status === 'paid') {
            return redirect()->route('cart.index')->with('success', 'Payment already completed.');
        }

        $request->validate([
            'status' => ['required', 'in:success,failed'],
        ]);

        if ($request->input('status') === 'success') {
            $order->update([
                'payment_status' => 'paid',
                'order_status' => 'confirmed',
            ]);

            session()->forget('recent_order_id');

            return redirect()->route('cart.index')->with('success', 'Payment completed successfully.');
        }

        $order->update([
            'payment_status' => 'failed',
            'order_status' => 'pending_payment',
        ]);

        return redirect()->route('orders.payments.create', $order)->with('error', 'Payment failed. Please try again.');
    }

    private function authorizeOrderAccess(Order $order): void
    {
        if (auth()->check()) {
            abort_unless($order->user_id === auth()->id(), 403);

            return;
        }

        abort_unless((int) session('recent_order_id') === (int) $order->id, 403);
    }
}
