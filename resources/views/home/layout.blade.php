<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    @stack('styles')
    <script>
    (function() {
        try {
            var stored = localStorage.getItem('sgs-theme');
            var theme = stored === 'dark' || stored === 'light' ? stored : null;
            if (!theme) {
                theme = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' :
                    'light';
            }
            document.documentElement.setAttribute('data-theme', theme);
        } catch (e) {}
    })();
    </script>
</head>
{{-- Global Toast Message --}}
@if (session('success') || session('error') || $errors->any())
<div id="global-toast-wrapper">
    @if (session('success'))
    <div class="global-toast toast-success">
        <span>{{ session('success') }}</span>
        <button type="button" class="toast-close">&times;</button>
    </div>
    @endif

    @if (session('error'))
    <div class="global-toast toast-error">
        <span>{{ session('error') }}</span>
        <button type="button" class="toast-close">&times;</button>
    </div>
    @endif

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="global-toast toast-error">
        <span>{{ $error }}</span>
        <button type="button" class="toast-close">&times;</button>
    </div>
    @endforeach
    @endif
</div>
@endif

<body>

    <!-- Navigation -->
    @include('partials.nav')

    <!-- Main Content -->
    @yield('content')


    <!-- Footer -->
    @include('partials.footer')


    @stack('scripts')
    <script>
    (function() {
        function getTheme() {
            var t = document.documentElement.getAttribute('data-theme');
            return t === 'dark' ? 'dark' : 'light';
        }

        function setTheme(next) {
            var theme = next === 'dark' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', theme);
            try {
                localStorage.setItem('sgs-theme', theme);
            } catch (e) {}
            updateThemeToggleIcon(theme);
        }

        function updateThemeToggleIcon(theme) {
            var btn = document.getElementById('userThemeToggle');
            if (!btn) return;
            var icon = btn.querySelector('i');
            if (!icon) return;
            icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateThemeToggleIcon(getTheme());
            var btn = document.getElementById('userThemeToggle');
            if (!btn) return;
            btn.addEventListener('click', function() {
                setTheme(getTheme() === 'dark' ? 'light' : 'dark');
            });
        });
    })();
    </script>
    <style id="user-theme-vars">
    :root {
        --app-bg: #ffffff;
        --app-surface: #ffffff;
        --app-surface-2: #f5f5f5;
        --app-text: #000000;
        --app-muted: rgba(0, 0, 0, 0.65);
        --app-border: rgba(0, 0, 0, 0.12);
        --app-link: #000000;
    }

    html[data-theme="dark"] {
        color-scheme: dark;
        --app-bg: #0f1216;
        --app-surface: #141922;
        --app-surface-2: #1b2230;
        --app-text: #f3f5f7;
        --app-muted: rgba(243, 245, 247, 0.72);
        --app-border: rgba(255, 255, 255, 0.14);
        --app-link: #f3f5f7;

        --text-black: var(--app-text);
        --text-gray: var(--app-muted);
        --bg-gray: var(--app-surface-2);
        --white: var(--app-surface);
    }

    html[data-theme="dark"] body {
        background-color: var(--app-bg);
        color: var(--app-text);
    }

    html[data-theme="dark"] a {
        color: var(--app-link);
    }

    html[data-theme="dark"] .navbar {
        border-bottom-color: var(--app-border) !important;
        background: var(--app-surface);
    }

    html[data-theme="dark"] .dropdown-menu {
        background-color: var(--app-surface);
        border: 1px solid var(--app-border);
    }

    html[data-theme="dark"] .dropdown-menu a {
        color: var(--app-text);
    }

    html[data-theme="dark"] .nav-links {
        background-color: var(--app-surface) !important;
    }

    html[data-theme="dark"] .nav-links a {
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .nav-links a.active {
        border-bottom-color: var(--app-text) !important;
    }

    html[data-theme="dark"] .search-box {
        background-color: var(--app-surface-2);
    }

    html[data-theme="dark"] .search-box input {
        color: var(--app-text);
    }

    html[data-theme="dark"] .search-box input::placeholder {
        color: var(--app-muted);
    }

    html[data-theme="dark"] .theme-toggle {
        background: var(--app-surface-2);
        color: var(--app-text);
        border-color: var(--app-border);
    }

    html[data-theme="dark"] .contact-info,
    html[data-theme="dark"] .contact-form-wrapper,
    html[data-theme="dark"] .invoice-card,
    html[data-theme="dark"] .card,
    html[data-theme="dark"] .product-card {
        background-color: var(--app-surface) !important;
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .contact-info h1,
    html[data-theme="dark"] .contact-info h2,
    html[data-theme="dark"] .contact-info h3,
    html[data-theme="dark"] .contact-info p,
    html[data-theme="dark"] .contact-form-wrapper h1,
    html[data-theme="dark"] .contact-form-wrapper h2,
    html[data-theme="dark"] .contact-form-wrapper h3,
    html[data-theme="dark"] .contact-form-wrapper p,
    html[data-theme="dark"] .contact-form-wrapper label {
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .contact-form-wrapper input,
    html[data-theme="dark"] .contact-form-wrapper textarea {
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .contact-form-wrapper input::placeholder,
    html[data-theme="dark"] .contact-form-wrapper textarea::placeholder {
        color: var(--app-muted) !important;
    }



    html[data-theme="dark"] .breadcrumb a {
        color: var(--app-muted) !important;
        transition: color 0.3s ease;
    }

    html[data-theme="dark"] .breadcrumb .separator {
        color: var(--app-muted) !important;
    }

    html[data-theme="dark"] .breadcrumb .current {
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .breadcrumb a:hover {
        color: #DB4444 !important;
    }




    html[data-theme="dark"] .sidebar ul li a {
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .sidebar {
        border-right-color: var(--app-border) !important;
    }

    html[data-theme="dark"] .sidebar ul li a:hover {
        color: #DB4444 !important;
    }



    html[data-theme="dark"] .info-block p {
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .divider {
        border-top-color: var(--app-border) !important;
    }

    html[data-theme="dark"] .story-text {
        color: var(--app-muted) !important;
    }

    html[data-theme="dark"] .team-role {
        color: var(--app-muted) !important;
    }

    html[data-theme="dark"] .team-socials a {
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .welcome-user {
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .account-sidebar ul li a,
    html[data-theme="dark"] .account-sidebar .sidebar-group h4 a {
        color: var(--app-muted) !important;
    }



    html[data-theme="dark"] .navbar .nav-links a:hover {
        color: #DB4444 !important;
    }

    html[data-theme="dark"] .navbar .nav-links a.active {
        border-bottom: 1px solid #000;
    }




    html[data-theme="dark"] .account-content {
        background-color: var(--app-surface) !important;
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .account-content label {
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .invoice-meta-row {
        background: var(--app-surface) !important;
    }

    html[data-theme="dark"] .btn-secondary {
        border-color: var(--app-border) !important;
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .btn-secondary:hover {
        background-color: var(--app-surface-2) !important;
        border-color: var(--app-border) !important;
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .move-all-btn,
    html[data-theme="dark"] .see-all-btn {
        background-color: var(--app-surface-2) !important;
        color: var(--app-text) !important;
        border: 1px solid var(--app-border) !important;
    }

    html[data-theme="dark"] .move-all-btn:hover,
    html[data-theme="dark"] .see-all-btn:hover {
        background-color: #DB4444 !important;
        color: #fff !important;
        border-color: #DB4444 !important;
    }

    html[data-theme="dark"] .dropdown-menu {
        background-color: #141922 !important;
        border: 1px solid rgba(255, 255, 255, 0.14) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.45) !important;
    }

    html[data-theme="dark"] .dropdown-menu a,
    html[data-theme="dark"] .dropdown-menu button,
    html[data-theme="dark"] .dropdown-menu .dropdown-item,
    html[data-theme="dark"] .dropdown-menu span,
    html[data-theme="dark"] .dropdown-menu p,
    html[data-theme="dark"] .dropdown-menu li {
        color: #ffffff !important;
        opacity: 1 !important;
        background-color: transparent !important;
        font-weight: 500 !important;
    }

    html[data-theme="dark"] .dropdown-menu a *,
    html[data-theme="dark"] .dropdown-menu button *,
    html[data-theme="dark"] .dropdown-menu .dropdown-item * {
        color: #ffffff !important;
        opacity: 1 !important;
    }

    html[data-theme="dark"] .dropdown-menu a i,
    html[data-theme="dark"] .dropdown-menu button i,
    html[data-theme="dark"] .dropdown-menu .dropdown-item i,
    html[data-theme="dark"] .dropdown-menu a svg,
    html[data-theme="dark"] .dropdown-menu button svg,
    html[data-theme="dark"] .dropdown-menu .dropdown-item svg {
        color: #ffffff !important;
        fill: currentColor !important;
        opacity: 1 !important;
    }

    html[data-theme="dark"] .dropdown-menu a:hover,
    html[data-theme="dark"] .dropdown-menu button:hover,
    html[data-theme="dark"] .dropdown-menu .dropdown-item:hover {
        background-color: #1f2937 !important;
        color: #DB4444 !important;
    }

    html[data-theme="dark"] .dropdown-menu a:hover *,
    html[data-theme="dark"] .dropdown-menu button:hover *,
    html[data-theme="dark"] .dropdown-menu .dropdown-item:hover * {
        color: #DB4444 !important;
        opacity: 1 !important;
    }

    html[data-theme="dark"] .dropdown-menu a:hover i,
    html[data-theme="dark"] .dropdown-menu button:hover i,
    html[data-theme="dark"] .dropdown-menu .dropdown-item:hover i,
    html[data-theme="dark"] .dropdown-menu a:hover svg,
    html[data-theme="dark"] .dropdown-menu button:hover svg,
    html[data-theme="dark"] .dropdown-menu .dropdown-item:hover svg {
        color: #DB4444 !important;
        fill: currentColor !important;
    }

    html[data-theme="dark"] .dropdown-menu form button {
        width: 100%;
        border: none !important;
        outline: none !important;
        text-align: left;
        background: transparent !important;
    }


    html[data-theme="dark"] .cart-header,
    html[data-theme="dark"] .cart-item,
    html[data-theme="dark"] .cart-total-box,
    html[data-theme="dark"] .applied-coupon-box {
        background-color: var(--app-surface) !important;
        color: var(--app-text) !important;
        box-shadow: none !important;
    }

    html[data-theme="dark"] .quantity-input,
    html[data-theme="dark"] .coupon-input {
        background-color: var(--app-surface-2) !important;
        color: var(--app-text) !important;
        border-color: var(--app-border) !important;
    }

    html[data-theme="dark"] .payment-card,
    html[data-theme="dark"] .gateway-box {
        background: var(--app-surface) !important;
        color: var(--app-text) !important;
        box-shadow: none !important;
    }

    html[data-theme="dark"] .payment-meta {
        background: var(--app-surface-2) !important;
    }

    html[data-theme="dark"] .method-pill {
        background: var(--app-surface) !important;
        border-color: var(--app-border) !important;
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .gateway-sub,
    html[data-theme="dark"] .gateway-note {
        color: var(--app-muted) !important;
    }

    html[data-theme="dark"] .gateway-form input {
        background: var(--app-surface-2) !important;
        border-color: var(--app-border) !important;
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .invoice-card {
        background: var(--app-surface) !important;
        color: var(--app-text) !important;
        box-shadow: none !important;
    }

    html[data-theme="dark"] .invoice-header,
    html[data-theme="dark"] .invoice-meta-row {
        border-bottom-color: var(--app-border) !important;
    }

    html[data-theme="dark"] .brand-sub,
    html[data-theme="dark"] .msg-text,
    html[data-theme="dark"] .msg-notes-body {
        color: var(--app-muted) !important;
    }

    html[data-theme="dark"] .invoice-table-head,
    html[data-theme="dark"] .invoice-table-row {
        border-left-color: var(--app-border) !important;
        border-right-color: var(--app-border) !important;
    }

    html[data-theme="dark"] .invoice-table-head {
        border-top-color: var(--app-border) !important;
    }

    html[data-theme="dark"] .invoice-table-row {
        border-bottom-color: var(--app-border) !important;
    }

    html[data-theme="dark"] .invoice-table-row .td {
        border-right-color: var(--app-border) !important;
    }

    html[data-theme="dark"] .invoice-table-row .td.title div[style] {
        color: var(--app-muted) !important;
    }

    html[data-theme="dark"] .services-section .service-item {
        background: var(--app-surface) !important;
        border-color: var(--app-border) !important;
        color: var(--app-text) !important;
        box-shadow: none !important;
    }

    html[data-theme="dark"] .services-section .service-item h3 {
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .services-section .service-item p {
        color: var(--app-muted) !important;
    }

    html[data-theme="dark"] .services-section .service-icon-outer {
        background-color: rgba(255, 255, 255, 0.12) !important;
    }

    html[data-theme="dark"] .services-section .service-icon-inner {
        background-color: var(--app-surface-2) !important;
        color: var(--app-text) !important;
        border: 1px solid var(--app-border) !important;
    }

    html[data-theme="dark"] .scroll-to-top {
        background-color: var(--app-surface-2) !important;
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .arrow-btn {
        background-color: var(--app-surface-2) !important;
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .arrow-btn:hover {
        background-color: var(--app-surface) !important;
    }

    html[data-theme="dark"] .card-icons button {
        background-color: var(--app-surface-2) !important;
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .card-icons button:hover {
        background-color: #DB4444 !important;
        color: #fff !important;
    }

    html[data-theme="dark"] .action-btn,
    html[data-theme="dark"] .trash-btn,

    html[data-theme="dark"] .eye-btn {
        background-color: var(--app-surface-2) !important;
        color: var(--app-text) !important;
        border: 1px solid var(--app-border) !important;
    }

    html[data-theme="dark"] input,
    html[data-theme="dark"] textarea,
    html[data-theme="dark"] select {
        background-color: var(--app-surface-2);
        color: var(--app-text);
        border-color: var(--app-border);
    }


    html[data-theme="dark"] .stats-section .stat-card {
        background-color: var(--app-surface) !important;
        border: 1px solid var(--app-border) !important;
        color: var(--app-text) !important;
        box-shadow: none !important;
    }

    html[data-theme="dark"] .stats-section .stat-number,
    html[data-theme="dark"] .stats-section .stat-desc {
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .stats-section .stat-icon-wrapper {
        background-color: rgba(255, 255, 255, 0.12) !important;
        border-color: rgba(255, 255, 255, 0.18) !important;
    }

    html[data-theme="dark"] .stats-section .stat-icon {
        background-color: var(--app-surface-2) !important;
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .stats-section .stat-card:hover,
    html[data-theme="dark"] .stats-section .stat-card.active,
    html[data-theme="dark"] .stats-section .stat-card:active {
        background-color: #DB4444 !important;
        border-color: #DB4444 !important;
        color: #ffffff !important;
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.28) !important;
    }

    html[data-theme="dark"] .stats-section .stat-card:hover .stat-number,
    html[data-theme="dark"] .stats-section .stat-card:hover .stat-desc,
    html[data-theme="dark"] .stats-section .stat-card.active .stat-number,
    html[data-theme="dark"] .stats-section .stat-card.active .stat-desc,
    html[data-theme="dark"] .stats-section .stat-card:active .stat-number,
    html[data-theme="dark"] .stats-section .stat-card:active .stat-desc {
        color: #ffffff !important;
    }

    html[data-theme="dark"] .stats-section .stat-card:hover .stat-icon-wrapper,
    html[data-theme="dark"] .stats-section .stat-card.active .stat-icon-wrapper,
    html[data-theme="dark"] .stats-section .stat-card:active .stat-icon-wrapper {
        background-color: rgba(255, 255, 255, 0.18) !important;
        border-color: rgba(255, 255, 255, 0.28) !important;
    }

    html[data-theme="dark"] .stats-section .stat-card:hover .stat-icon,
    html[data-theme="dark"] .stats-section .stat-card.active .stat-icon,
    html[data-theme="dark"] .stats-section .stat-card:active .stat-icon {
        background-color: #ffffff !important;
        color: #DB4444 !important;
    }

    html[data-theme="dark"] .team-section .team-card {
        background-color: var(--app-surface) !important;
        color: var(--app-text) !important;
        border: 1px solid var(--app-border) !important;
        border-radius: 8px !important;
        box-shadow: none !important;
    }

    html[data-theme="dark"] .team-section .team-name {
        color: var(--app-text) !important;
    }

    html[data-theme="dark"] .team-section .team-role {
        color: var(--app-muted) !important;
    }

    html[data-theme="dark"] .team-section .team-socials a,
    html[data-theme="dark"] .team-section .team-socials a i {
        color: var(--app-text) !important;
        opacity: 1 !important;
    }

    html[data-theme="dark"] .team-section .team-socials a:hover,
    html[data-theme="dark"] .team-section .team-socials a:hover i {
        color: #DB4444 !important;
    }

    html[data-theme="dark"] .team-section .team-image {
        background-color: var(--app-surface-2) !important;
    }

    html[data-theme="dark"] .team-section .team-image img {
        background-color: transparent !important;
    }

    html[data-theme="dark"] .team-section .team-pagination .dot {
        background-color: rgba(255, 255, 255, 0.28) !important;
        border-color: transparent !important;
    }

    html[data-theme="dark"] .team-section .team-pagination .dot.active {
        background-color: #DB4444 !important;
        border-color: var(--app-surface) !important;
        box-shadow: 0 0 0 2px #DB4444 !important;
    }

    html[data-theme="dark"] .categories-section .category-card {
        background-color: var(--app-surface) !important;
        border: 1px solid var(--app-border) !important;
        color: var(--app-text) !important;
        box-shadow: none !important;
    }

    html[data-theme="dark"] .categories-section .category-card i,
    html[data-theme="dark"] .categories-section .category-card span {
        color: var(--app-text) !important;
        opacity: 1 !important;
    }

    html[data-theme="dark"] .categories-section .category-card:hover,
    html[data-theme="dark"] .categories-section .category-card.active {
        background-color: #DB4444 !important;
        border-color: #DB4444 !important;
        color: #ffffff !important;
    }

    html[data-theme="dark"] .categories-section .category-card:hover i,
    html[data-theme="dark"] .categories-section .category-card:hover span,
    html[data-theme="dark"] .categories-section .category-card.active i,
    html[data-theme="dark"] .categories-section .category-card.active span {
        color: #ffffff !important;
    }

    html[data-theme="dark"] .categories-section .section-divider {
        border-top-color: var(--app-border) !important;
        opacity: 1 !important;
    }
    </style>
</body>

</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toasts = document.querySelectorAll('.global-toast');

    toasts.forEach((toast, index) => {
        setTimeout(() => {
            toast.classList.add('show');
        }, index * 150);

        const closeBtn = toast.querySelector('.toast-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                hideToast(toast);
            });
        }

        setTimeout(() => {
            hideToast(toast);
        }, 4000 + (index * 300));
    });

    function hideToast(toast) {
        toast.classList.remove('show');
        toast.classList.add('hide');

        setTimeout(() => {
            toast.remove();
        }, 400);
    }
});
</script>

<style>
#global-toast-wrapper {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 99999;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.global-toast {
    min-width: 280px;
    max-width: 380px;
    padding: 14px 16px;
    border-radius: 8px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    font-size: 14px;
    font-weight: 500;
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.18);
    transform: translateX(120%);
    opacity: 0;
    transition: all 0.4s ease;
}

.global-toast.show {
    transform: translateX(0);
    opacity: 1;
}

.global-toast.hide {
    transform: translateX(120%);
    opacity: 0;
}

.toast-success {
    background: #16a34a;
}

.toast-error {
    background: #dc2626;
}

.toast-close {
    background: transparent;
    border: none;
    color: #fff;
    font-size: 18px;
    line-height: 1;
    cursor: pointer;
    padding: 0;
}

@media (max-width: 576px) {
    #global-toast-wrapper {
        top: 15px;
        right: 12px;
        left: 12px;
    }

    .global-toast {
        min-width: 100%;
        max-width: 100%;
    }
}
</style>