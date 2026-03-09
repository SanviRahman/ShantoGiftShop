 <!-- Top Header (Black Bar) -->
 <div class="top-header">
     <div class="container top-header-content">
         <div class="promo-text">
             Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%!
             <a href="#" class="shop-now-link">ShopNow</a>
         </div>
         <div class="language-selector">
             <span>English</span> <i class="fas fa-chevron-down"></i>
             <ul class="lang-dropdown">
                 <li>English</li>
                 <li>Bengali</li>
             </ul>
         </div>
     </div>
 </div>

 <!-- Main Navigation -->
 <nav class="navbar">
     <div class="container nav-content">
         <div class="logo">
             <h1>Shanto<span style="color: #e03939;">Gift</span>Shop</h1>
         </div>

         <ul class="nav-links">
             <li><a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : ''}}">Home</a></li>
             <li><a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'active' : ''}}">Contact</a></li>
             <li><a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : ''}}">About</a></li>
             @if(!Auth::check())
             <li><a href="{{ route('signup') }}" class="{{ request()->is('signup') ? 'active' : ''}}">Sign Up</a></li>
             @endif
         </ul>

         <div class="icons">
             <a href="#"><i class="far fa-heart"></i></a>
             <a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i></a>

             <!-- Profile Dropdown -->
             @if(Auth::check())
             <div class="profile-dropdown">
                 <a href="#" class="profile-toggle"><i class="fas fa-user"></i></a>
                 <div class="dropdown-menu">
                     <a href="{{ route('account') }}">
                         <i class="fas fa-user"></i>
                         <span>My Profile</span>
                     </a>
                     <a href="#">
                         <i class="fas fa-list"></i>
                         <span>My Orders</span>
                     </a>
                     <a href="#">
                         <i class="fas fa-cog"></i>
                         <span>Settings</span>
                     </a>
                     <div class="dropdown-divider"></div> <!-- Optional divider -->
                     <a href="#">
                         <i class="fas fa-sign-out-alt"></i>
                         <span>Logout</span>
                     </a>
                 </div>
             </div>
             @endif
         </div>
     </div>
 </nav>



 <!-- Dropdown Menu keep with Responsive Support -->
 <script>
document.addEventListener('DOMContentLoaded', function() {
    const profileDropdown = document.querySelector('.profile-dropdown');

    if (profileDropdown) {
        const dropdownMenu = profileDropdown.querySelector('.dropdown-menu');
        const profileToggle = profileDropdown.querySelector('.profile-toggle');

        // Remove hover CSS effect
        profileDropdown.classList.add('click-mode');

        // Click event for both desktop and mobile
        profileToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            // Close any other open dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu !== dropdownMenu) {
                    menu.style.display = 'none';
                }
            });

            // Toggle current dropdown
            const isVisible = dropdownMenu.style.display === 'block';
            dropdownMenu.style.display = isVisible ? 'none' : 'block';
        });

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!profileDropdown.contains(e.target)) {
                dropdownMenu.style.display = 'none';
            }
        });

        // Prevent closing when clicking inside dropdown
        dropdownMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
});
 </script>
 <script>
(function() {
    // Language Selector Logic
    const langSelector = document.querySelector('.language-selector');
    if (langSelector) {
        const langSpan = langSelector.querySelector('span');
        const langOptions = langSelector.querySelectorAll('.lang-dropdown li');

        langOptions.forEach(option => {
            option.addEventListener('click', () => {
                langSpan.textContent = option.textContent;
            });
        });
    }
})();
 </script>
 <style>
/* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    color: #000;
}

a {
    text-decoration: none;
    color: inherit;
}

ul {
    list-style: none;
}

.container {
    max-width: 1170px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Top Header */
.top-header {
    background-color: #000;
    color: #FAFAFA;
    font-size: 14px;
    padding: 12px 0;
}

.top-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
}

.promo-text {
    flex: 1;
    text-align: center;
}

.shop-now-link {
    font-weight: 600;
    text-decoration: underline;
    margin-left: 8px;
    color: #FAFAFA;
}

.language-selector {
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
    position: relative;
}

.lang-dropdown {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background-color: #000;
    color: #FAFAFA;
    padding: 10px;
    border: 1px solid #333;
    z-index: 1000;
    min-width: 120px;
    border-radius: 4px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}

.language-selector:hover .lang-dropdown {
    display: block;
}

.lang-dropdown li {
    padding: 8px 12px;
    transition: background-color 0.3s;
}

.lang-dropdown li:hover {
    background-color: #333;
}







/* Navbar */
.navbar {
    border-bottom: 1px solid #D9D9D9;
    padding-top: 40px;
    padding-bottom: 16px;
}

.nav-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo h1 {
    font-size: 24px;
    font-weight: 700;
    letter-spacing: 0.03em;
    /* Slightly wider letter spacing */
}

.nav-links {
    display: flex;
    gap: 48px;
    /* Space between links */
}

.nav-links a {
    font-size: 16px;
    color: #000;
    position: relative;
    padding-bottom: 4px;
}

.nav-links a.active {
    border-bottom: 1px solid #000;
}

.nav-links a:hover {
    color: #DB4444;
    /* Red hover color */
}

.nav-actions {
    display: flex;
    align-items: center;
    gap: 24px;
}

.search-box {
    background-color: #F5F5F5;
    border-radius: 4px;
    padding: 7px 12px;
    display: flex;
    align-items: center;
    width: 243px;
    /* Fixed width as per design */
}

.search-box input {
    border: none;
    background: transparent;
    outline: none;
    font-size: 12px;
    width: 100%;
    color: #000;
}

.search-box input::placeholder {
    color: #7D8184;
}

.search-box button {
    border: none;
    background: transparent;
    cursor: pointer;
}

.icons {
    display: flex;
    gap: 16px;
    font-size: 20px;
    /* Icon size */
}


/* Profile Dropdown Styles */
.profile-dropdown {
    position: relative;
    display: inline-block;
}

.profile-dropdown.click-mode .dropdown-menu {
    /* Hover effect disabled, only JS will control display */
}

.profile-toggle {
    display: flex;
    align-items: center;
    cursor: pointer;
    color: #000;
    transition: color 0.3s;
    padding: 5px;
    /* Better click area */
}

.profile-toggle i {
    font-size: 20px;
}

.profile-toggle:hover {
    color: #DB4444;
}

/* Dropdown Menu */
.dropdown-menu {
    display: none;
    position: absolute;
    right: 0;
    top: 40px;
    background-color: #fff;
    min-width: 200px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    border-radius: 8px;
    z-index: 1000;
    overflow: hidden;
    animation: dropdownFade 0.3s ease;
}

/* Dropdown Menu Items */
.dropdown-menu a {
    display: flex;
    align-items: center;
    padding: 14px 20px;
    text-decoration: none;
    color: #333;
    transition: all 0.3s ease;
    border-bottom: 1px solid #f0f0f0;
}

.dropdown-menu a:last-child {
    border-bottom: none;
}

/* Dropdown Icons */
.dropdown-menu a i {
    width: 24px;
    text-align: center;
    font-size: 16px;
    color: #666;
    margin-right: 12px;
    transition: color 0.3s ease;
}

/* Dropdown Text */
.dropdown-menu a span {
    font-size: 14px;
    font-weight: 500;
    color: #333;
    transition: color 0.3s ease;
}

/* Hover Effects */
.dropdown-menu a:hover {
    background-color: #f8f8f8;
    padding-left: 24px;
}

.dropdown-menu a:hover i,
.dropdown-menu a:hover span {
    color: #DB4444;
}

/* Dropdown Arrow */
.dropdown-menu::before {
    content: '';
    position: absolute;
    top: -6px;
    right: 15px;
    width: 12px;
    height: 12px;
    background-color: #fff;
    transform: rotate(45deg);
    box-shadow: -2px -2px 5px rgba(0, 0, 0, 0.04);
}

/* Animation */
@keyframes dropdownFade {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Active State */
.dropdown-menu a.active {
    background-color: #f0f0f0;
}

.dropdown-menu a.active i,
.dropdown-menu a.active span {
    color: #DB4444;
    font-weight: 600;
}

/* Divider */
.dropdown-divider {
    height: 1px;
    background-color: #f0f0f0;
    margin: 8px 0;
}

/* Logout button special style */
.dropdown-menu a:last-child:hover i,
.dropdown-menu a:last-child:hover span {
    color: #dc3545;
}

/* Smooth Transition */
.profile-dropdown .dropdown-menu {
    transition: all 0.3s ease;
}



/* Responsive Navbar & Header */
/* Tablet & Smaller Desktop (max-width: 1024px) */
@media screen and (max-width: 1024px) {
    .container {
        padding: 0 20px;
    }

    .nav-links {
        gap: 24px;
        font-size: 14px;
    }

    .search-box {
        width: 180px;
    }

    .nav-actions {
        gap: 16px;
    }
}

/* Tablet Portrait (max-width: 768px) */
@media screen and (max-width: 768px) {

    /* Top Header Adjustments */
    .top-header-content {
        flex-direction: column;
        gap: 8px;
        text-align: center;
    }

    .promo-text {
        font-size: 12px;
    }

    .language-selector {
        align-self: center;
    }

    /* Navbar Adjustments */
    .navbar {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .nav-content {
        flex-direction: column;
        gap: 20px;
    }

    .logo {
        margin-bottom: 10px;
    }

    .nav-links {
        width: 100%;
        justify-content: center;
        gap: 20px;
        order: 2;
    }

    .nav-actions {
        width: 100%;
        justify-content: center;
        gap: 20px;
        order: 3;
    }

    .search-box {
        width: 100%;
        max-width: 300px;
    }
}

/* Mobile (max-width: 480px) */
@media screen and (max-width: 480px) {
    .top-header {
        display: none;
    }

    .nav-links {
        flex-direction: column;
        gap: 12px;
        align-items: center;
        padding: 10px 0;
        background-color: #f9f9f9;
        width: 100%;
        border-radius: 4px;
    }

    .nav-actions {
        flex-direction: column;
        gap: 16px;
    }

    .search-box {
        width: 100%;
    }

    .icons {
        justify-content: center;
        width: 100%;
        gap: 24px;
    }
}
 </style>