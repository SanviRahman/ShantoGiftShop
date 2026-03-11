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

<div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <h3 style="margin-bottom: 15px;">Recent Activity</h3>
    <p>Welcome to the admin panel. Use the sidebar to navigate to Users or Orders to manage them.</p>
</div>
@endsection
