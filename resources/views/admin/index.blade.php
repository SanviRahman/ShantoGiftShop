@extends('admin.layout')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-info h3 {
        font-size: 2rem;
        margin-bottom: 5px;
    }

    .stat-info p {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .stat-icon {
        font-size: 2.5rem;
        color: var(--primary-color);
        opacity: 0.2;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-top: 20px;
    }

    .card-box {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .charts-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .chart-wrap {
        height: 320px;
    }

    .chart-wrap canvas {
        width: 100% !important;
        height: 100% !important;
    }

    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 12px;
    }

    .activity-item {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        padding: 10px 12px;
        border: 1px solid #eee;
        border-radius: 8px;
        background: #fafafa;
    }

    .activity-left {
        min-width: 0;
    }

    .activity-title {
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .activity-sub {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 2px;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 0.8rem;
        border: 1px solid #eee;
        background: #fff;
        color: #333;
        white-space: nowrap;
    }

    .badge-success { color: #155724; background: #d4edda; border-color: #c3e6cb; }
    .badge-warn { color: #856404; background: #fff3cd; border-color: #ffeeba; }
    .badge-muted { color: #383d41; background: #e2e3e5; border-color: #d6d8db; }

    @media (max-width: 1100px) {
        .dashboard-grid { grid-template-columns: 1fr; }
        .charts-row { grid-template-columns: 1fr; }
    }
</style>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $totalOrders }}</h3>
            <p>Total Orders</p>
        </div>
        <div class="stat-icon">
            <i class="fas fa-shopping-bag"></i>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $totalProducts }}</h3>
            <p>Products</p>
        </div>
        <div class="stat-icon">
            <i class="fas fa-box-open"></i>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $totalUsers }}</h3>
            <p>Users</p>
        </div>
        <div class="stat-icon">
            <i class="fas fa-user-plus"></i>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3>${{ number_format($totalRevenue) }}</h3>
            <p>Total Revenue</p>
        </div>
        <div class="stat-icon">
            <i class="fas fa-dollar-sign"></i>
        </div>
    </div>
</div>

<div class="dashboard-grid">
    <div class="card-box">
        <h3 style="margin-bottom: 15px;">Recent Activity</h3>

        <div class="activity-list">
            @forelse($recentOrders as $o)
                <div class="activity-item">
                    <div class="activity-left">
                        <div class="activity-title">{{ $o->order_number }} — {{ $o->customer_name }}</div>
                        <div class="activity-sub">{{ $o->created_at->diffForHumans() }} • ${{ number_format((float) $o->total, 2) }}</div>
                    </div>
                    <div style="display:flex; flex-direction:column; align-items:flex-end; gap:6px;">
                        <span class="badge {{ $o->payment_status === 'paid' ? 'badge-success' : 'badge-warn' }}">
                            {{ ucfirst($o->payment_status) }}
                        </span>
                        <span class="badge badge-muted">{{ ucfirst($o->order_status) }}</span>
                        <a href="{{ route('admin.orders.show', $o) }}" style="font-size:0.85rem; color:#1aa6d9; text-decoration:none;">View</a>
                    </div>
                </div>
            @empty
                <div style="color:#888;">No recent orders found.</div>
            @endforelse
        </div>
    </div>

    <div class="card-box">
        <h3 style="margin-bottom: 15px;">Charts</h3>

        <div class="charts-row">
            <div>
                <div style="font-weight:600; margin-bottom:10px;">Orders (Last 14 Days)</div>
                <div class="chart-wrap">
                    <canvas id="ordersBar"></canvas>
                </div>
            </div>
            <div>
                <div style="font-weight:600; margin-bottom:10px;">Revenue (Last 14 Days)</div>
                <div class="chart-wrap">
                    <canvas id="revenueLine"></canvas>
                </div>
            </div>
            <div>
                <div style="font-weight:600; margin-bottom:10px;">Payment Methods (Last 30 Days)</div>
                <div class="chart-wrap">
                    <canvas id="paymentPie"></canvas>
                </div>
            </div>
            <div>
                <div style="font-weight:600; margin-bottom:10px;">Order Status Distribution</div>
                <div class="chart-wrap">
                    <canvas id="statusBar"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    const chartLabels = @json($chartLabels);
    const chartOrderCounts = @json($chartOrderCounts);
    const chartRevenue = @json($chartRevenue);
    const paymentMethodData = @json($paymentMethodData);
    const statusData = @json($statusData);

    const colorPrimary = getComputedStyle(document.documentElement).getPropertyValue('--primary-color').trim() || '#DB4444';

    const ordersBarCtx = document.getElementById('ordersBar');
    if (ordersBarCtx) {
        new Chart(ordersBarCtx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Orders',
                    data: chartOrderCounts,
                    backgroundColor: colorPrimary + '55',
                    borderColor: colorPrimary,
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });
    }

    const revenueLineCtx = document.getElementById('revenueLine');
    if (revenueLineCtx) {
        new Chart(revenueLineCtx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Revenue',
                    data: chartRevenue,
                    borderColor: colorPrimary,
                    backgroundColor: colorPrimary + '22',
                    fill: true,
                    tension: 0.35,
                    pointRadius: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    const paymentPieCtx = document.getElementById('paymentPie');
    if (paymentPieCtx) {
        const labels = Object.keys(paymentMethodData).map(k => k.replaceAll('_', ' '));
        const values = Object.values(paymentMethodData);
        new Chart(paymentPieCtx, {
            type: 'pie',
            data: {
                labels,
                datasets: [{
                    data: values,
                    backgroundColor: [
                        colorPrimary,
                        '#1aa6d9',
                        '#28a745',
                        '#ffc107',
                        '#6f42c1',
                        '#20c997'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    const statusBarCtx = document.getElementById('statusBar');
    if (statusBarCtx) {
        const labels = Object.keys(statusData).map(k => k.replaceAll('_', ' '));
        const values = Object.values(statusData);
        new Chart(statusBarCtx, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'Orders',
                    data: values,
                    backgroundColor: '#1aa6d955',
                    borderColor: '#1aa6d9',
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
            }
        });
    }
</script>
@endpush
@endsection
