@extends('home.layout')

@section('title', 'Contact Us - ShantoGiftShop')

@section('content')
<!-- Breadcrumb & Welcome -->
<div class="container breadcrumb-container" style="margin-top: 90px;">
    <div class="breadcrumb" style="font-family: 'Poppins', sans-serif;">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <span class="current">My Account</span>
    </div>
    <div class="welcome-user" style="font-family: 'Poppins', sans-serif;">
        Welcome! <span class="user-name">Md Rimel</span>
    </div>
</div>

<!-- Account Section -->
<section class="account-section" style="margin-top: 40px;">
    <div class="container account-container">
        <!-- Sidebar -->
        <aside class="account-sidebar">
            <div class="sidebar-group">
                <h4>Manage My Account</h4>
                <ul style="list-style: none; padding-left: 40px;">
                    <li><a href="#" class="{{ request()->is('profile') ? 'active' : ''}}">My Profile</a></li>
                    <li><a href="#" class="{{ request()->is('address-book') ? 'active' : ''}}">Address Book</a></li>
                    <li><a href="#" class="{{ request()->is('payment-options') ? 'active' : ''}}">My Payment Options</a></li>
                </ul>
            </div>
            <div class="sidebar-group" >
                <h4>My Orders</h4>
                <ul style="list-style: none; padding-left: 40px;">
                    <li><a href="#">My Returns</a></li>
                    <li><a href="#">My Cancellations</a></li>
                </ul>
            </div>
            <div class="sidebar-group">
                <h4><a href="{{ route('wishlist') }}">My WishList</a></h4>
            </div>
        </aside>

        <!-- Main Content: Edit Profile -->
        <div class="account-content">
            <div class="edit-profile-form">
                <h2 class="form-title">Edit Your Profile</h2>

                <form action="#" method="GET">
                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" placeholder="Md" value="Md">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" placeholder="Rimel" value="Rimel">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" placeholder="rimel1111@gmail.com" value="rimel1111@gmail.com">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" placeholder="Kingston, 5236, United State"
                                value="Kingston, 5236, United State">
                        </div>
                    </div>

                    <div class="password-changes">
                        <label>Password Changes</label>
                        <div class="form-group">
                            <input type="password" placeholder="Current Password">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Confirm New Password">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="cancel-btn">Cancel</button>
                        <button type="submit" class="save-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
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