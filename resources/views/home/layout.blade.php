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