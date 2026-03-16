<!-- Footer Section -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <!-- Column 1: Exclusive -->
            <div class="footer-col">
                <h3 class="footer-logo">Exclusive</h3>
                <h4 class="footer-heading">Subscribe</h4>
                <p class="footer-text">Get 10% off your first order</p>

                <form action="{{ route('subscribe') }}" method="POST">
                    @csrf
                    <div class="subscribe-input-group">
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <button type="submit"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>

            <!-- Column 2: Support -->
            <div class="footer-col">
                <h4 class="footer-heading">Support</h4>
                <ul class="footer-links-list">
                    <li>Dhaka,Bangladesh.</li>
                    <li>sheikh15-3700@diu.edu.bd</li>
                    <li>+88017-06940942</li>
                </ul>
            </div>

            <!-- Column 3: Account -->
            <div class="footer-col">
                <h4 class="footer-heading">Account</h4>
                <ul class="footer-links-list">
                    <li><a href="{{ route('account.index') }}">My Account</a></li>
                    <li><a href="{{ route('register') }}">Login / Register</a></li>
                    <li><a href="{{ route('cart.index') }}">Cart</a></li>
                    <li><a href="{{ route('wishlist.index') }}">Wishlist</a></li>
                    <li><a href="{{ route('products.index') }}">Shop</a></li>
                </ul>
            </div>

            <!-- Column 4: Quick Link -->
            <div class="footer-col">
                <h4 class="footer-heading">Quick Link</h4>
                <ul class="footer-links-list">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms Of Use</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="{{ route('contact.index') }}">Contact</a></li>
                </ul>
            </div>

            <!-- Column 5: Download App -->
            <div class="footer-col">
                <h4 class="footer-heading">Download App</h4>
                <p class="save-text">Save $3 with App New User Only</p>
                <div class="app-download-area">
                    <div class="qr-code">
                        <!-- Placeholder for QR -->
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=Example" alt="QR Code">
                    </div>
                    <div class="app-stores">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                            alt="Google Play">
                        <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                            alt="App Store">
                    </div>
                </div>
                <div class="social-icons">
                    <a href="https://www.facebook.com/SFAShanto"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://wa.me/message/ABMBRACOIP5WL1"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://github.com/SanviRahman"><i class="fab fa-github"></i></a>
                    <a href="https://www.linkedin.com/in/sheikh-forid-ahmed-shanto-03919424a/"><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p>&copy; Copyright 2026.All rights reserved.This website developed by
                <i class="icon-heart color-danger" aria-hidden="true">
                </i>
                <a href="https://sfashanto.netlify.app/" target="_blank">
                    <b style="color: #ffbd39;"> SFA Shanto
                    </b>
                </a>
            </p>
        </div>
    </div>
</footer>
<style>
/* Footer Section */
.footer {
    background-color: #000;
    color: #FAFAFA;
    margin-top: 60px;
    padding-top: 72px;
    overflow-x: hidden;
}

.footer .container {
    width: 100%;
    max-width: 1170px;
    margin: 0 auto;
    padding-left: 16px;
    padding-right: 16px;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 36px 28px;
    padding-bottom: 48px;
}

.footer-col {
    min-width: 0;
}

.footer-logo {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #fff;
    line-height: 1.2;
}

.footer-heading {
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 18px;
    color: #fff;
    line-height: 1.3;
}

.footer-text {
    font-size: 15px;
    color: #FAFAFA;
    margin-bottom: 16px;
    opacity: 0.9;
    line-height: 1.6;
}

.footer-links-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links-list li {
    margin-bottom: 12px;
    font-size: 15px;
    color: #FAFAFA;
    opacity: 0.9;
    line-height: 1.7;
    word-break: break-word;
}

.footer-links-list li a {
    color: #FAFAFA;
    text-decoration: none;
    transition: color 0.3s ease, opacity 0.3s ease;
    opacity: 0.9;
}

.footer-links-list li a:hover {
    color: #DB4444;
    opacity: 1;
}

.subscribe-input-group {
    display: flex;
    align-items: center;
    border: 1.5px solid #FAFAFA;
    border-radius: 6px;
    overflow: hidden;
    width: 100%;
    max-width: 280px;
    min-height: 50px;
}

.subscribe-input-group input {
    flex: 1;
    min-width: 0;
    background: transparent;
    border: none;
    padding: 12px 14px;
    color: #FAFAFA;
    font-size: 14px;
    outline: none;
    width: 100%;
}

.subscribe-input-group input::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.subscribe-input-group button {
    background: transparent;
    border: none;
    padding: 12px 16px;
    color: #FAFAFA;
    cursor: pointer;
    transition: color 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.subscribe-input-group button:hover {
    color: #DB4444;
}

.save-text {
    font-size: 12px;
    color: #FAFAFA;
    margin-bottom: 12px;
    opacity: 0.8;
    line-height: 1.6;
}

.app-download-area {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    margin-bottom: 22px;
}

.qr-code {
    flex-shrink: 0;
}

.qr-code img {
    display: block;
    width: 84px;
    height: 84px;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.18);
    background: #111;
}

.app-stores {
    display: flex;
    flex-direction: column;
    gap: 10px;
    min-width: 0;
}

.app-stores img {
    height: 40px;
    width: auto;
    max-width: 140px;
    display: block;
    cursor: pointer;
    transition: opacity 0.3s ease;
}

.app-stores img:hover {
    opacity: 0.85;
}

.social-icons {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 18px;
    margin-top: 20px;
}

.social-icons a {
    color: #fff;
    font-size: 20px;
    transition: color 0.3s ease, transform 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.social-icons a:hover {
    color: #DB4444;
    transform: translateY(-2px);
}

.footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.12);
    padding: 22px 0;
}

.footer-bottom p {
    text-align: center;
    color: rgba(255, 255, 255, 0.65);
    font-size: 15px;
    line-height: 1.7;
    margin: 0;
    word-break: break-word;
}

.footer-bottom a {
    text-decoration: none;
}

/* Large desktop */
@media (max-width: 1199px) {
    .footer-content {
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 34px 24px;
    }

    .footer-col:last-child {
        grid-column: span 2;
    }
}

/* Laptop / tablet */
@media (max-width: 991px) {
    .footer {
        padding-top: 60px;
    }

    .footer-content {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 32px 24px;
        padding-bottom: 40px;
    }

    .footer-col {
        min-width: 0;
    }

    .footer-col:first-child,
    .footer-col:last-child {
        grid-column: span 2;
    }

    .subscribe-input-group {
        max-width: 360px;
    }

    .app-download-area {
        align-items: center;
    }
}

/* Mobile */
@media (max-width: 767px) {
    .footer {
        padding-top: 48px;
        margin-top: 48px;
    }

    .footer .container {
        padding-left: 14px;
        padding-right: 14px;
    }

    .footer-content {
        grid-template-columns: 1fr;
        gap: 28px;
        padding-bottom: 32px;
    }

    .footer-col:first-child,
    .footer-col:last-child {
        grid-column: span 1;
    }

    .footer-col {
        text-align: left;
    }

    .footer-logo {
        font-size: 22px;
        margin-bottom: 14px;
    }

    .footer-heading {
        font-size: 18px;
        margin-bottom: 14px;
    }

    .footer-text,
    .footer-links-list li {
        font-size: 14px;
    }

    .subscribe-input-group {
        max-width: 100%;
    }

    .app-download-area {
        flex-direction: row;
        align-items: center;
        gap: 12px;
    }

    .app-stores img {
        height: 36px;
        max-width: 130px;
    }

    .social-icons {
        gap: 16px;
        margin-top: 18px;
    }

    .social-icons a {
        font-size: 18px;
    }

    .footer-bottom {
        padding: 18px 0;
    }

    .footer-bottom p {
        font-size: 14px;
    }
}

/* Small mobile */
@media (max-width: 575px) {
    .footer {
        padding-top: 42px;
    }

    .footer-content {
        gap: 24px;
    }

    .footer-col {
        text-align: center;
    }

    .subscribe-input-group {
        margin: 0 auto;
        max-width: 320px;
    }

    .app-download-area {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 14px;
    }

    .app-stores {
        align-items: center;
    }

    .social-icons {
        justify-content: center;
    }

    .footer-links-list li {
        text-align: center;
    }

    .footer-bottom p {
        font-size: 13px;
    }
}

/* Extra small mobile */
@media (max-width: 420px) {
    .footer .container {
        padding-left: 12px;
        padding-right: 12px;
    }

    .footer-logo {
        font-size: 20px;
    }

    .footer-heading {
        font-size: 17px;
    }

    .footer-text,
    .footer-links-list li {
        font-size: 13px;
    }

    .subscribe-input-group {
        min-height: 46px;
        max-width: 100%;
    }

    .subscribe-input-group input {
        padding: 10px 12px;
        font-size: 13px;
    }

    .subscribe-input-group button {
        padding: 10px 12px;
    }

    .qr-code img {
        width: 74px;
        height: 74px;
    }

    .app-stores img {
        height: 32px;
        max-width: 120px;
    }

    .social-icons {
        gap: 14px;
    }

    .social-icons a {
        font-size: 17px;
    }

    .footer-bottom {
        padding: 16px 0;
    }

    .footer-bottom p {
        font-size: 12px;
    }
}

/* Very small devices */
@media (max-width: 359px) {
    .footer-content {
        gap: 20px;
    }

    .footer-logo {
        font-size: 18px;
    }

    .footer-heading {
        font-size: 16px;
    }

    .subscribe-input-group input {
        font-size: 12px;
    }

    .app-stores img {
        height: 28px;
        max-width: 110px;
    }

    .social-icons {
        gap: 12px;
    }

    .social-icons a {
        font-size: 16px;
    }
}

@media print {
    .footer {
        display: none;
    }
}
</style>