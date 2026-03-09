@extends('home.layout')

@section('title','Login - ShantoGiftShop')

@section('content')
<!-- Login Section -->
<div class="auth-container">
    <!-- Left Side Image -->
    <div class="auth-image">
        <img src="https://via.placeholder.com/805x781/CBE4E8/000000?text=Phone+Shopping+Cart+Image" alt="Side Image">
    </div>

    <!-- Right Side Form -->
    <div class="auth-form-wrapper">
        <h2 class="auth-heading">Log in to Exclusive</h2>
        <p class="auth-subheading">Enter your details below</p>

        <form class="auth-form">
            <div class="form-group">
                <input type="text" placeholder="Email or Phone Number" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" required>
            </div>

            <div class="login-actions">
                <button type="submit" class="btn-primary" style="padding: 16px 48px;">Log In</button>
                <a href="#" class="forgot-password">Forget Password?</a>
            </div>
        </form>
    </div>
</div>

@endsection