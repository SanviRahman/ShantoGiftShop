@extends('home.layout')

@section('title', 'My Account - ShantoGiftShop')

@section('content')
<div class="container breadcrumb-container" style="margin-top: 90px;">
    <div class="breadcrumb" style="font-family: 'Poppins', sans-serif;">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <span class="current">My Account</span>
    </div>
    <div class="welcome-user" style="font-family: 'Poppins', sans-serif;">
        Welcome! <span class="user-name">{{ $user->name }}</span>
    </div>
</div>

<section class="account-section" style="margin-top: 40px;">
    <div class="container account-container">
        <aside class="account-sidebar">
            <div class="sidebar-group">
                <h4>Manage My Account</h4>
                <ul style="list-style: none; padding-left: 40px;">
                    <li><a href="{{ route('account.index', $user) }}" class="active">My Profile</a></li>
                    <li><a href="#">Address Book</a></li>
                    <li><a href="#">My Payment Options</a></li>
                </ul>
            </div>
            <div class="sidebar-group">
                <h4>My Orders</h4>
                <ul style="list-style: none; padding-left: 40px;">
                    <li><a href="#">My Returns</a></li>
                    <li><a href="#">My Cancellations</a></li>
                </ul>
            </div>
            <div class="sidebar-group">
                <h4><a href="{{ route('wishlist.index') }}">My WishList</a></h4>
            </div>
        </aside>

        <div class="account-content">
            @if(session('success'))
                <p style="color: green; margin-bottom: 15px;">{{ session('success') }}</p>
            @endif

            <div class="edit-profile-form">
                <h2 class="form-title">Edit Your Profile</h2>

                <form action="{{ route('account.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $user->profile->first_name ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $user->profile->last_name ?? '') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" value="{{ old('address', $user->profile->address ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" value="{{ old('city', $user->profile->city ?? '') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code', $user->profile->postal_code ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" name="country" value="{{ old('country', $user->profile->country ?? '') }}">
                        </div>
                    </div>

                    <div class="password-changes">
                        <label>Password Changes</label>
                        <div class="form-group">
                            <input type="password" name="current_password" placeholder="Current Password">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password_confirmation" placeholder="Confirm New Password">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="cancel-btn">Cancel</button>
                        <button type="submit" class="save-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@push('styles')
<style>
/* Breadcrumb */
.breadcrumb-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 80px;
    margin-bottom: 80px;
}

.breadcrumb a {
    color: #000;
    opacity: 0.5;
    text-decoration: none;
}

.breadcrumb .separator {
    margin: 0 10px;
    opacity: 0.5;
}

.breadcrumb .current {
    font-weight: 500;
}

.welcome-user {
    font-weight: 400;
}

.welcome-user .user-name {
    color: #DB4444;
}

/* Account Layout */
.account-container {
    display: grid;
    grid-template-columns: 250px 1fr;
    gap: 100px;
    margin-bottom: 140px;
}

/* Sidebar */
.account-sidebar .sidebar-group {
    margin-bottom: 24px;
}

.account-sidebar h4 {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 16px;
}

.account-sidebar ul {
    list-style: none;
    padding-left: 0;
    /* Align with heading if needed, image shows indentation? No, looks aligned */
}

.account-sidebar ul li {
    margin-bottom: 8px;
}

.account-sidebar ul li a {
    text-decoration: none;
    color: #000;
    opacity: 0.5;
    transition: all 0.3s;
}

.account-sidebar ul li a:hover,
.account-sidebar ul li a.active {
    color: #DB4444;
    opacity: 1;
}

.account-sidebar .sidebar-group h4 a {
    text-decoration: none;
    color: #000;
}

/* Edit Profile Form */
.account-content {
    background: #fff;
    padding: 40px 80px;
    box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.05);
    border-radius: 4px;
}

.form-title {
    color: #DB4444;
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 16px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 50px;
    margin-bottom: 24px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
    width: 100%;
}

.form-group label {
    font-size: 16px;
    font-weight: 400;
}

.form-group input {
    background-color: #F5F5F5;
    border: none;
    padding: 16px;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
    outline: none;
}

.password-changes {
    margin-top: 24px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.password-changes label {
    font-size: 16px;
    font-weight: 400;
    margin-bottom: 8px;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 32px;
    margin-top: 24px;
}

.cancel-btn {
    background: none;
    border: none;
    font-size: 16px;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
}

.save-btn {
    background-color: #DB4444;
    color: #fff;
    border: none;
    padding: 16px 48px;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
    transition: background-color 0.3s;
}

.save-btn:hover {
    background-color: #E07575;
}

/* Responsive Account Page */
@media (max-width: 991px) {
    .account-container {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .account-content {
        padding: 30px;
    }
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .form-actions {
        flex-direction: column;
        gap: 16px;
        width: 100%;
    }

    .save-btn,
    .cancel-btn {
        width: 100%;
    }
}
</style>
@endpush
@endsection