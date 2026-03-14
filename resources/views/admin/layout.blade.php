<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - ShantoGiftShop</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #DB4444;
            --sidebar-width: 250px;
            --header-height: 60px;
            --bg-color: #f4f6f9;
            --text-color: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            display: flex;
        }

        body[data-theme="dark"] {
            filter: invert(1) hue-rotate(180deg);
        }

        body[data-theme="dark"] img,
        body[data-theme="dark"] canvas {
            filter: invert(1) hue-rotate(180deg);
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #212529;
            font-size: 1.2rem;
            font-weight: bold;
            border-bottom: 1px solid #4b545c;
        }

        .sidebar-menu {
            flex: 1;
            padding: 20px 0;
            list-style: none;
            overflow-y: auto;
        }

        .sidebar-menu li {
            padding: 0 15px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            color: #c2c7d0;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: var(--primary-color);
            color: #fff;
        }

        .sidebar-menu i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .header {
            height: var(--header-height);
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .header-title {
            font-size: 1.2rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .sidebar-toggle {
            display: none;
            background: none;
            border: 1px solid #ddd;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            color: #666;
            font-size: 0.9rem;
            transition: all 0.2s;
            align-items: center;
            gap: 8px;
        }

        .sidebar-toggle:hover {
            background-color: #f8f9fa;
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 998;
        }

        .logout-btn {
            background: none;
            border: 1px solid #ddd;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            color: #666;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background-color: #f8f9fa;
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .theme-btn {
            background: none;
            border: 1px solid #ddd;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            color: #666;
            font-size: 0.9rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .theme-btn:hover {
            background-color: #f8f9fa;
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Content */
        .content {
            padding: 20px;
        }

        @media (max-width: 768px) {
            .sidebar-toggle {
                display: inline-flex;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            body.sidebar-open .sidebar {
                transform: translateX(0);
            }

            body.sidebar-open .sidebar-overlay {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }

            .content {
                padding: 14px;
            }

            .user-menu > span {
                display: none;
            }

            .header {
                padding: 0 12px;
            }

            .sidebar-header {
                justify-content: flex-start;
                padding-left: 16px;
            }

            .sidebar-menu a {
                padding: 12px 12px;
            }
        }

        @media (max-width: 420px) {
            .theme-btn, .logout-btn {
                padding: 6px 10px;
            }
        }

        @media (max-width: 900px) {
            .content table th,
            .content table td {
                padding: 10px 12px !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            Shanto<span style="color: #e03939;">Gift</span>Shop  Admin
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <pre></pre>
            <li>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i> Products
                </a>
            </li>
            <pre></pre>
            <li>
                <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i> Orders
                </a>
            </li>
            <pre></pre>
            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Users
                </a>
            </li>
            <pre></pre>
            <li>
                <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <i class="fas fa-address-book"></i> Contacts
                </a>
            </li>
            <pre></pre>
             <li>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fas fa-list"></i> Categories
                </a>
            </li>
            <pre></pre>
            <li>
                <a href="{{ route('admin.coupons.index') }}" class="{{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i> Coupons
                </a>
            </li>
            <pre></pre>
            <li>
                <a href="{{ route('admin.subscribes.index') }}" class="{{ request()->routeIs('admin.subscribes.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> Subscribers
                </a>
            </li>
            <pre></pre>
            <li>
                <a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i> Reports
                </a>
            </li>
        </ul>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <button type="button" class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="header-title">@yield('header', 'Dashboard')</div>
            </div>
            <div class="user-menu">
                <span>{{ Auth::user()->name }}</span>
                <button type="button" class="theme-btn" id="themeToggle">
                    <i class="fas fa-moon"></i> Theme
                </button>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Content -->
        <main class="content">
            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        (function () {
            const STORAGE_KEY = 'admin_theme';
            const body = document.body;
            const btn = document.getElementById('themeToggle');

            const applyTheme = (theme) => {
                if (theme === 'dark') {
                    body.setAttribute('data-theme', 'dark');
                    if (btn) {
                        btn.innerHTML = '<i class="fas fa-sun"></i> Light';
                    }
                } else {
                    body.removeAttribute('data-theme');
                    if (btn) {
                        btn.innerHTML = '<i class="fas fa-moon"></i> Dark';
                    }
                }
            };

            const saved = localStorage.getItem(STORAGE_KEY);
            applyTheme(saved === 'dark' ? 'dark' : 'light');

            if (btn) {
                btn.addEventListener('click', () => {
                    const current = body.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
                    const next = current === 'dark' ? 'light' : 'dark';
                    localStorage.setItem(STORAGE_KEY, next);
                    applyTheme(next);
                });
            }

            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            const closeSidebar = () => body.classList.remove('sidebar-open');
            const openSidebar = () => body.classList.add('sidebar-open');
            const isMobile = () => window.matchMedia('(max-width: 768px)').matches;

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', () => {
                    if (!isMobile()) return;
                    if (body.classList.contains('sidebar-open')) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', closeSidebar);
            }

            document.querySelectorAll('.sidebar a').forEach((link) => {
                link.addEventListener('click', () => {
                    if (isMobile()) closeSidebar();
                });
            });

            window.addEventListener('resize', () => {
                if (!isMobile()) closeSidebar();
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
