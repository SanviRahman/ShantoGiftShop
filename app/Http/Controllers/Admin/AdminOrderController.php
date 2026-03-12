<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderRiskService;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $orders = Order::with('user')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($q1) use ($q) {
                    $q1->where('order_number', 'like', '%'.$q.'%')
                        ->orWhere('customer_name', 'like', '%'.$q.'%')
                        ->orWhere('email', 'like', '%'.$q.'%')
                        ->orWhere('phone', 'like', '%'.$q.'%')
                        ->orWhere('order_status', 'like', '%'.$q.'%')
                        ->orWhere('payment_status', 'like', '%'.$q.'%')
                        ->orWhere('payment_method', 'like', '%'.$q.'%');
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.orders.index', compact('orders', 'q'));
    }

    public function show(Order $order)
    {
        $order->load(['items', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'customer_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:50'],
            'country' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
            'order_status' => ['nullable', 'string', 'max:50'],
            'payment_status' => ['nullable', 'string', 'max:50'],
        ]);

        $updates = collect($data)
            ->filter(fn ($v) => $v !== null)
            ->all();

        if (! empty($updates)) {
            $order->update($updates);
        }

        (new OrderRiskService())->apply($order);

        return back()->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|string',
            'payment_status' => 'required|string',
        ]);

        $order->update([
            'order_status' => $request->order_status,
            'payment_status' => $request->payment_status,
        ]);

        (new OrderRiskService())->apply($order);

        return back()->with('success', 'Order status updated successfully.');
    }

    public function verify(Order $order)
    {
        (new OrderRiskService())->apply($order);

        return back()->with('success', 'Order verification updated successfully.');
    }
}
