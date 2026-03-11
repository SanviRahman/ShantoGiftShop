@extends('home.layout')

@section('title', 'Verify Email - ShantoGiftShop')

@section('content')
<section class="verify-section container" style="margin-top: 140px; margin-bottom: 140px;">
    <div class="verify-card">
        <h2 class="verify-title">Verify your email</h2>
        <p class="verify-text">
            We have sent a verification link to
            <strong>{{ $email }}</strong>.
            Please check your inbox and click the link.
        </p>

        <form action="{{ route('verification.send') }}" method="POST" class="verify-actions">
            @csrf
            <button type="submit" class="btn-primary">Resend Verification Email</button>
        </form>

        <div class="verify-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-secondary">Logout</button>
            </form>
            <a href="{{ route('home') }}" class="btn-link">Back to Home</a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    color: #000;
    line-height: 1.6;
    background-color: #fff;
}

:root {
    --primary-red: #DB4444;
    --text-black: #000000;
    --bg-gray: #F5F5F5;
}

.container {
    max-width: 1170px;
    margin: 0 auto;
    padding: 0 15px;
}

.verify-card {
    max-width: 640px;
    margin: 0 auto;
    padding: 40px;
    border-radius: 8px;
    background: #fff;
    box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.05);
}

.verify-title {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 12px;
}

.verify-text {
    color: rgba(0, 0, 0, 0.75);
    margin-bottom: 22px;
}

.verify-actions {
    margin-bottom: 18px;
}

.btn-primary {
    background-color: var(--primary-red);
    color: #fff;
    border: none;
    padding: 14px 22px;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #E07575;
}

.btn-secondary {
    padding: 14px 22px;
    border: 1px solid rgba(0, 0, 0, 0.5);
    background-color: transparent;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-secondary:hover {
    background-color: #000;
    color: #fff;
    border-color: #000;
}

.verify-footer {
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
}

.btn-link {
    color: var(--primary-red);
    text-decoration: none;
    font-weight: 500;
}
</style>
@endpush
