@extends('home.layout')

@section('title', 'Reset Password - ShantoGiftShop')

@section('content')
<div class="auth-container" style="margin-top: 90px;">
    <div class="auth-image">
        <img src="{{ asset('images/Frame-2.png') }}" alt="Side Image">
    </div>

    <div class="auth-form-wrapper">
        <h2 class="auth-heading">Reset Password</h2>
        <p class="auth-subheading">Set a new password for your account</p>

        <form class="auth-form" method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required value="{{ old('email', $email ?? '') }}">
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="New Password" required>
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Confirm New Password" required>
            </div>

            <div class="auth-actions">
                <button type="submit" class="btn-primary">Reset Password</button>
            </div>
        </form>

        <div class="auth-footer">
            <span>Remembered your password?</span>
            <a href="{{ route('login') }}">Log in</a>
        </div>
    </div>
</div>
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

a {
    text-decoration: none;
    color: inherit;
    transition: color 0.3s;
}

:root {
    --primary-red: #DB4444;
    --text-black: #000000;
}

.auth-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 100px;
    padding: 100px 0;
    max-width: 1170px;
    margin: 0 auto;
}

.auth-image {
    width: 500px;
    height: 600px;
    overflow: hidden;
    border-radius: 4px;
}

.auth-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.auth-form-wrapper {
    flex: 1;
    max-width: 370px;
}

.auth-heading {
    font-size: 32px;
    font-weight: 500;
    letter-spacing: 0.04em;
    margin-bottom: 18px;
}

.auth-subheading {
    font-size: 16px;
    font-weight: 400;
    margin-bottom: 48px;
}

.auth-form .form-group {
    margin-bottom: 40px;
    position: relative;
}

.auth-form input {
    width: 100%;
    border: none;
    border-bottom: 1px solid rgba(0, 0, 0, 0.5);
    padding: 8px 0;
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    outline: none;
    transition: border-color 0.3s;
}

.auth-form input:focus {
    border-bottom-color: #000;
}

.auth-actions {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.btn-primary {
    background-color: var(--primary-red);
    color: #fff;
    border: none;
    padding: 16px 48px;
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

.auth-footer {
    margin-top: 32px;
    text-align: center;
    color: rgba(0, 0, 0, 0.7);
}

.auth-footer a {
    font-weight: 500;
    color: #000;
    border-bottom: 1px solid #000;
    margin-left: 4px;
}

@media (max-width: 1024px) {
    .auth-container {
        flex-direction: column;
        gap: 60px;
    }

    .auth-image {
        width: 100%;
        height: 400px;
    }

    .auth-form-wrapper {
        max-width: 100%;
        padding: 0 20px;
    }
}
</style>
@endpush
@endsection
