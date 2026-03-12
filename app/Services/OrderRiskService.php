<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Carbon;

class OrderRiskService
{
    public function evaluate(Order $order): array
    {
        $score = 0;
        $reasons = [];

        if ($order->user_id === null) {
            $score += 25;
            $reasons[] = 'Guest order';
        }

        if ($order->payment_method === 'cash_on_delivery') {
            $score += 25;
            $reasons[] = 'Cash on delivery';
        }

        $total = (float) $order->total;

        if ($total >= 5000) {
            $score += 30;
            $reasons[] = 'High order amount';
        } elseif ($total >= 2000) {
            $score += 15;
            $reasons[] = 'Medium order amount';
        }

        $phone = trim((string) $order->phone);
        if ($phone !== '') {
            $recentCount = Order::where('phone', $phone)
                ->where('id', '!=', $order->id)
                ->where('created_at', '>=', Carbon::now()->subHours(24))
                ->count();

            if ($recentCount >= 5) {
                $score += 40;
                $reasons[] = 'Many orders from same phone in 24h';
            } elseif ($recentCount >= 2) {
                $score += 25;
                $reasons[] = 'Repeated orders from same phone in 24h';
            }
        }

        $address = trim((string) $order->address);
        if ($address !== '' && mb_strlen($address) < 8) {
            $score += 10;
            $reasons[] = 'Address looks too short';
        }

        if ($order->user_id !== null) {
            $verified = User::where('id', $order->user_id)->whereNotNull('email_verified_at')->exists();
            if (! $verified) {
                $score += 15;
                $reasons[] = 'User email not verified';
            }
        }

        $level = 'low';
        if ($score >= 60) {
            $level = 'high';
        } elseif ($score >= 30) {
            $level = 'medium';
        }

        return [
            'risk_score' => $score,
            'risk_level' => $level,
            'is_suspicious' => $level === 'high',
            'verification_notes' => $reasons ? implode("\n", $reasons) : null,
        ];
    }

    public function apply(Order $order): Order
    {
        $result = $this->evaluate($order);
        $order->fill($result);
        $order->save();

        return $order;
    }
}

