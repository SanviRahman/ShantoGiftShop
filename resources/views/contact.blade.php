@extends('home.layout')

@section('title','Contact US - ShantoGiftShop')

@section('content')
<!-- Breadcrumb -->
<div class="container breadcrumb-container" style="margin-top: 90px;">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <span class="current">Contact</span>
    </div>
</div>

<!-- Contact Section -->
<section class="contact-section" style="margin-top: 60px;">
    <div class="container contact-container">
        <!-- Left Column: Contact Info -->
        <div class="contact-info">
            <!-- Call To Us -->
            <div class="info-block">
                <div class="info-header">
                    <div class="icon-circle">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h3>Call To Us</h3>
                </div>
                <p>We are available 24/7, 7 days a week.</p>
                <p>Phone: +8801611112222</p>
            </div>

            <hr class="divider">

            <!-- Write To US -->
            <div class="info-block">
                <div class="info-header">
                    <div class="icon-circle">
                        <i class="far fa-envelope"></i>
                    </div>
                    <h3>Write To US</h3>
                </div>
                <p>Fill out our form and we will contact you within 24 hours.</p>
                <p>Emails: customer@exclusive.com</p>
                <p>Emails: support@exclusive.com</p>
            </div>
        </div>

        <!-- Right Column: Contact Form -->
        <div class="contact-form-wrapper">
            <form class="contact-form">
                <div class="form-row">
                    <input type="text" placeholder="Your Name *" required>
                    <input type="email" placeholder="Your Email *" required>
                    <input type="tel" placeholder="Your Phone *" required>
                </div>
                <div class="form-row">
                    <textarea placeholder="Your Massage" rows="8" required></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-submit">Send Massage</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection


@push('styles')
<style>
    /* Breadcrumb */
.breadcrumb-container {
    margin-top: 80px;
    margin-bottom: 80px;
}

.breadcrumb a {
    color: #000;
    opacity: 0.5;
}

.breadcrumb .separator {
    margin: 0 10px;
    opacity: 0.5;
}

.breadcrumb .current {
    font-weight: 500;
}

/* Contact Page Styles */
.contact-section {
    padding-bottom: 140px;
}

.contact-container {
    display: flex;
    gap: 30px;
}

/* Left Column: Contact Info */
.contact-info {
    flex: 0 0 340px; /* Adjust width as needed */
    padding: 40px 35px;
    box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.05);
    border-radius: 4px;
    background-color: #fff;
}

.info-block {
    margin-bottom: 32px;
}

.info-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 24px;
}

.icon-circle {
    width: 40px;
    height: 40px;
    background-color: #DB4444;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 20px;
}

.info-header h3 {
    font-size: 16px;
    font-weight: 500;
}

.info-block p {
    font-size: 14px;
    line-height: 21px;
    margin-bottom: 16px;
    color: #000;
}

.info-block p:last-child {
    margin-bottom: 0;
}

.divider {
    border: 0;
    border-top: 1px solid #000;
    opacity: 0.5;
    margin: 32px 0;
}

/* Right Column: Contact Form */
.contact-form-wrapper {
    flex: 1;
    padding: 40px 32px;
    box-shadow: 0px 1px 13px rgba(0, 0, 0, 0.05);
    border-radius: 4px;
    background-color: #fff;
}

.form-row {
    display: flex;
    gap: 16px;
    margin-bottom: 32px;
}

.form-row input {
    flex: 1;
    background-color: #F5F5F5;
    border: none;
    border-radius: 4px;
    height: 50px;
    padding: 0 16px;
    outline: none;
    font-family: 'Poppins', sans-serif;
    color: #000;
}

.form-row textarea {
    width: 100%;
    background-color: #F5F5F5;
    border: none;
    border-radius: 4px;
    padding: 16px;
    outline: none;
    font-family: 'Poppins', sans-serif;
    resize: none;
    height: 207px;
    color: #000;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
}

.btn-submit {
    background-color: #DB4444;
    color: #FAFAFA;
    border: none;
    border-radius: 4px;
    padding: 16px 48px;
    font-family: 'Poppins', sans-serif;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-submit:hover {
    background-color: #E07575;
}








/* Responsive Styles for Contact Page & Layout */
@media (max-width: 1024px) {
    /* Tablet / Small Desktop */
    .container {
        padding: 0 20px;
    }

    .contact-container {
        flex-direction: column;
    }
    
    .contact-info {
        flex: auto;
        width: 100%;
        margin-bottom: 0;
    }

    .contact-form-wrapper {
        width: 100%;
    }
    
}

@media (max-width: 768px) {
    /* Mobile Devices */
    .breadcrumb-container {
        margin-top: 40px;
        margin-bottom: 40px;
    }

    .contact-section {
        padding-bottom: 60px;
    }

    .contact-info {
        padding: 30px 20px;
    }

    .contact-form-wrapper {
        padding: 30px 20px;
    }

    .form-row {
        flex-direction: column;
        gap: 16px;
        margin-bottom: 20px;
    }

    .form-row input {
        width: 100%;
    }
    
    .btn-submit {
        width: 100%;
        padding: 14px;
    }

}

@media (max-width: 480px) {
    /* Small Mobile Devices */
    .breadcrumb-container {
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .contact-info .info-header {
        gap: 12px;
    }

    .contact-info .icon-circle {
        width: 35px;
        height: 35px;
        font-size: 16px;
    }

    .contact-form-wrapper {
        padding: 20px 15px;
    }
    
    .form-row textarea {
        height: 150px;
    }
}
</style>
@endpush