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
    padding-top: 80px;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 30px;
    margin-bottom: 60px;
}

.footer-logo {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 24px;
}

.footer-heading {
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 24px;
}

.footer-text {
    font-size: 16px;
    margin-bottom: 16px;
}

.subscribe-input-group {
    display: flex;
    border: 1.5px solid #FAFAFA;
    border-radius: 4px;
    padding: 12px;
    align-items: center;
    max-width: 217px;
}

.subscribe-input-group input {
    background: transparent;
    border: none;
    color: #FAFAFA;
    outline: none;
    flex: 1;
    font-size: 16px;
    width: 100%;
}

.subscribe-input-group input::placeholder {
    color: #FAFAFA;
    opacity: 0.4;
}

.subscribe-input-group button {
    background: transparent;
    border: none;
    color: #FAFAFA;
    cursor: pointer;
    font-size: 20px;
}

.footer-links-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links-list li {
    margin-bottom: 16px;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
}

.footer-links-list li a {
    color: #FAFAFA;
    text-decoration: none;
    transition: color 0.3s;
}

.footer-links-list li a:hover {
    color: #DB4444;
}

.save-text {
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 8px;
    color: #FAFAFA;
    opacity: 0.7;
}

.app-download-area {
    display: flex;
    gap: 8px;
    margin-bottom: 24px;
}

.qr-code img {
    width: 80px;
    height: 80px;
    border: 2px solid #FAFAFA;
}

.app-stores {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.app-stores img {
    height: 40px;
    /* Adjusted height for better fit */
    width: auto;
    border: 1px solid #FAFAFA;
    /* Optional border for consistency */
    border-radius: 4px;
    padding: 4px;
    /* Padding inside the border */
    background-color: #000;
    /* Ensure background is black */
}

.social-icons {
    display: flex;
    gap: 24px;
}

.social-icons a {
    color: #FAFAFA;
    font-size: 24px;
    transition: color 0.3s;
}

.social-icons a:hover {
    color: #DB4444;
}

.footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    /* Dark line */
    padding: 24px 0;
    text-align: center;
    color: #3D3D3D;
    /* Darker text color */
    color: rgba(255, 255, 255, 0.3);
    /* Using opacity for consistency */
}




/* Footer Responsive Styles */

/* Large Desktop (1200px and above) */
@media screen and (min-width: 1200px) {
    .footer .container {
        max-width: 1170px;
    }
}

/* Desktop (992px to 1199px) */
@media screen and (max-width: 1199px) {
    .footer .container {
        max-width: 960px;
    }

    .footer-content {
        gap: 30px;
    }
}

/* Tablet Landscape (768px to 991px) */
@media screen and (max-width: 991px) {
    .footer .container {
        max-width: 720px;
    }

    .footer-content {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px 30px;
    }

    .footer-col:last-child {
        grid-column: span 3;
    }

    .app-download-area {
        justify-content: flex-start;
    }

    .social-icons {
        margin-top: 20px;
    }
}

/* Tablet Portrait (576px to 767px) */
@media screen and (max-width: 767px) {
    .footer .container {
        max-width: 540px;
    }

    .footer-content {
        grid-template-columns: repeat(2, 1fr);
        gap: 35px 25px;
    }

    .footer-col:first-child {
        grid-column: span 2;
    }

    .footer-col:last-child {
        grid-column: span 2;
    }

    .footer-logo {
        font-size: 24px;
        margin-bottom: 16px;
    }

    .subscribe-input-group {
        max-width: 100%;
    }

    .app-download-area {
        flex-direction: row;
        align-items: center;
    }

    .footer-links-list li {
        font-size: 14px;
    }

    .footer-links-list li a {
        font-size: 14px;
    }
}

/* Mobile Landscape (480px to 575px) */
@media screen and (max-width: 575px) {
    .footer .container {
        max-width: 100%;
        padding: 0 20px;
    }

    .footer-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .footer-col {
        text-align: center;
    }

    .footer-col:first-child {
        grid-column: span 1;
    }

    .footer-col:last-child {
        grid-column: span 1;
    }

    .subscribe-input-group {
        max-width: 300px;
        margin: 0 auto;
    }

    .app-download-area {
        justify-content: center;
        flex-direction: column;
        gap: 15px;
    }

    .app-stores {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .app-stores img {
        height: 35px;
        width: auto;
    }

    .social-icons {
        justify-content: center;
        margin-top: 20px;
    }

    .footer-links-list li {
        text-align: center;
    }

    .footer-bottom p {
        text-align: center;
        font-size: 14px;
    }
}

/* Mobile Portrait (320px to 479px) */
@media screen and (max-width: 479px) {
    .footer-content {
        gap: 25px;
    }

    .footer-logo {
        font-size: 22px;
    }

    .footer-heading {
        font-size: 18px;
        margin-bottom: 12px;
    }

    .footer-text {
        font-size: 14px;
        margin-bottom: 15px;
    }

    .subscribe-input-group {
        max-width: 260px;
    }

    .subscribe-input-group input {
        padding: 10px 14px;
        font-size: 13px;
    }

    .subscribe-input-group button {
        padding: 10px 15px;
    }

    .footer-links-list li {
        margin-bottom: 8px;
        font-size: 13px;
    }

    .footer-links-list li a {
        font-size: 13px;
    }

    .qr-code img {
        width: 70px;
        height: 70px;
    }

    .app-stores img {
        height: 30px;
    }

    .social-icons a {
        width: 32px;
        height: 32px;
        font-size: 14px;
    }

    .footer-bottom {
        padding: 20px 0 15px;
    }

    .footer-bottom p {
        font-size: 12px;
    }
}

/* Very Small Devices (up to 359px) */
@media screen and (max-width: 359px) {
    .footer-logo {
        font-size: 20px;
    }

    .footer-heading {
        font-size: 16px;
    }

    .subscribe-input-group {
        max-width: 220px;
    }

    .subscribe-input-group input {
        padding: 8px 12px;
        font-size: 12px;
    }

    .app-stores {
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .app-stores img {
        height: 28px;
    }

    .social-icons {
        gap: 10px;
    }

    .social-icons a {
        width: 28px;
        height: 28px;
        font-size: 12px;
    }
}

/* Print Styles */
@media print {
    .footer {
        display: none;
    }
}

/* Additional Footer Specific Styles for Better Responsive */
.footer-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 60px 0 40px;
    gap: 40px;
}

.footer-col {
    flex: 1 1 160px;
    min-width: 160px;
}

.footer-logo {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 24px;
    color: #fff;
}

.footer-heading {
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 24px;
    color: #fff;
}

.footer-text {
    font-size: 16px;
    color: #FAFAFA;
    margin-bottom: 16px;
    opacity: 0.9;
}

.footer-links-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links-list li {
    margin-bottom: 16px;
    font-size: 16px;
    color: #FAFAFA;
    opacity: 0.9;
    line-height: 1.5;
}

.footer-links-list li a {
    color: #FAFAFA;
    text-decoration: none;
    transition: color 0.3s;
    opacity: 0.9;
}

.footer-links-list li a:hover {
    color: #DB4444;
    opacity: 1;
}

/* Subscribe Input */
.subscribe-input-group {
    display: flex;
    align-items: center;
    border: 1.5px solid #fff;
    border-radius: 4px;
    overflow: hidden;
    max-width: 300px;
}

.subscribe-input-group input {
    flex: 1;
    background: transparent;
    border: none;
    padding: 12px 16px;
    color: #fff;
    font-size: 14px;
    outline: none;
}

.subscribe-input-group input::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.subscribe-input-group button {
    background: transparent;
    border: none;
    padding: 12px 20px;
    color: #fff;
    cursor: pointer;
    transition: color 0.3s;
}

.subscribe-input-group button:hover {
    color: #DB4444;
}

/* App Download Area */
.app-download-area {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
}

.qr-code img {
    display: block;
    width: 80px;
    height: 80px;
    border-radius: 8px;
}

.app-stores {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.app-stores img {
    height: 40px;
    width: auto;
    cursor: pointer;
    transition: opacity 0.3s;
}

.app-stores img:hover {
    opacity: 0.8;
}

.save-text {
    font-size: 12px;
    color: #FAFAFA;
    margin-bottom: 12px;
    opacity: 0.8;
}

/* Social Icons */
.social-icons {
    display: flex;
    gap: 24px;
    margin-top: 24px;
}

.social-icons a {
    color: #fff;
    font-size: 20px;
    transition: color 0.3s;
}

.social-icons a:hover {
    color: #DB4444;
}

/* Footer Bottom */
.footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding: 24px 0;
}

.footer-bottom p {
    text-align: center;
    color: #7D8184;
    font-size: 16px;
}

/* Footer Background */
.footer {
    background-color: #000;
    color: #fff;
    margin-top: 60px;
}
</style>