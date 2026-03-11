@extends('home.layout')

@section('title', $product->title . ' - ShantoGiftShop')

@section('content')
@php
    $gallery = data_get($product, 'detail.gallery', []);
    $gallery = is_array($gallery) && count($gallery) ? $gallery : [$product->image_url];

    $colors = data_get($product, 'detail.colors', []);
    $colors = is_array($colors) ? $colors : [];

    $sizes = data_get($product, 'detail.sizes', []);
    $sizes = is_array($sizes) ? $sizes : [];

    $description = data_get($product, 'detail.description', $product->short_description);
    $mainImage = $gallery[0] ?? $product->image_url;

    $defaultColor = $colors[0] ?? '';
    $defaultSize = $sizes[0] ?? '';
@endphp

<div class="container breadcrumb-container" style="margin-top: 90px;">
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}">
            {{ $product->category->name }}
        </a>
        <span class="separator">/</span>
        <span class="current">{{ $product->title }}</span>
    </div>
</div>

<section class="container product-details-container">
    <div class="product-gallery">
        <div class="gallery-thumbnails">
            @foreach($gallery as $image)
                <div class="thumbnail {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ $image }}" alt="Thumb {{ $loop->iteration }}">
                </div>
            @endforeach
        </div>

        <div class="main-image">
            <img src="{{ $mainImage }}" alt="{{ $product->title }}">
        </div>
    </div>

    <div class="product-info-col">
        <h1 class="product-title">{{ $product->title }}</h1>

        <div class="rating-row">
            <div class="rating-stars">
                @for($i = 1; $i <= 5; $i++)
                    <i class="{{ $i <= round($product->rating) ? 'fas' : 'far' }} fa-star"></i>
                @endfor
            </div>
            <span>({{ $product->review_count }} Reviews)</span>
            <span class="stock-status">{{ $product->stock_qty > 0 ? 'In Stock' : 'Out of Stock' }}</span>
        </div>

        <div class="product-price-large">${{ number_format($product->price, 2) }}</div>

        <p class="product-description">
            {{ $description }}
        </p>

        <div class="product-options">
            @if(!empty($colors))
                <div class="option-row">
                    <span class="option-label">Colours:</span>
                    <div class="colour-options">
                        @foreach($colors as $color)
                            <div
                                class="colour-radio {{ $loop->first ? 'selected' : '' }}"
                                style="background-color: {{ $color }};"
                                data-color="{{ $color }}"
                                title="{{ $color }}"
                            ></div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($isClothsCategory && !empty($sizes))
                <div class="option-row">
                    <span class="option-label">Size:</span>
                    <div class="size-options">
                        @foreach($sizes as $size)
                            <div class="size-radio {{ $loop->first ? 'selected' : '' }}" data-size="{{ $size }}">
                                {{ $size }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="purchase-row">
            <form action="{{ route('cart.store') }}" method="POST" class="cart-purchase-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="selected_color" id="selected-color" value="{{ $defaultColor }}">
                <input type="hidden" name="selected_size" id="selected-size" value="{{ $defaultSize }}">

                <div class="purchase-actions">
                    <div class="quantity-control">
                        <button class="qty-btn" id="qty-minus" type="button">-</button>
                        <input
                            type="number"
                            name="quantity"
                            value="1"
                            min="1"
                            class="qty-input"
                            id="qty-input"
                        >
                        <button class="qty-btn qty-plus" id="qty-plus" type="button">+</button>
                    </div>

                    <div class="product-action-buttons">
                        <button class="btn-primary action-btn-block" type="submit">
                            Add To Cart
                        </button>

                        <button
                            class="btn-primary action-btn-block buy-now-btn"
                            type="submit"
                            name="buy_now"
                            value="1">
                            Buy Now
                        </button>
                    </div>
                </div>
            </form>

            @auth
                <form action="{{ route('wishlist.store') }}" method="POST" class="wishlist-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="wishlist-btn" type="submit" aria-label="Add to wishlist">
                        <i class="far fa-heart"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="wishlist-btn wishlist-link" aria-label="Login to add wishlist">
                    <i class="far fa-heart"></i>
                </a>
            @endauth
        </div>

        <div class="delivery-info">
            <div class="delivery-item">
                <div class="delivery-icon"><i class="fas fa-truck-moving"></i></div>
                <div class="delivery-text">
                    <h4>Free Delivery</h4>
                    <p>Enter your postal code for Delivery Availability</p>
                </div>
            </div>

            <div class="delivery-item">
                <div class="delivery-icon"><i class="fas fa-sync-alt"></i></div>
                <div class="delivery-text">
                    <h4>Return Delivery</h4>
                    <p>Free 30 Days Delivery Returns. Details</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container related-items-section">
    <div class="section-header-simple">
        <div class="red-block-small"></div>
        <h3>Related Item</h3>
    </div>

    <div class="product-grid">
        @foreach($relatedProducts as $relatedProduct)
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ $relatedProduct->image_url }}" alt="{{ $relatedProduct->title }}">

                    @if($relatedProduct->discount_percent)
                        <span class="discount-badge">-{{ $relatedProduct->discount_percent }}%</span>
                    @endif

                    <div class="card-actions">
                        @auth
                            <form action="{{ route('wishlist.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $relatedProduct->id }}">
                                <button type="submit" class="action-btn" aria-label="Add to wishlist">
                                    <i class="far fa-heart"></i>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="action-btn" aria-label="Login to add wishlist">
                                <i class="far fa-heart"></i>
                            </a>
                        @endauth

                        <a href="{{ route('products.show', $relatedProduct) }}" class="action-btn" aria-label="View product">
                            <i class="far fa-eye"></i>
                        </a>
                    </div>

                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $relatedProduct->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="add-to-cart-bar">Add To Cart</button>
                    </form>
                </div>

                <div class="product-info">
                    <h3>
                        <a href="{{ route('products.show', $relatedProduct) }}">{{ $relatedProduct->title }}</a>
                    </h3>

                    <div class="product-price">
                        ${{ number_format($relatedProduct->price, 0) }}
                        @if($relatedProduct->old_price)
                            <span class="old-price">${{ number_format($relatedProduct->old_price, 0) }}</span>
                        @endif
                    </div>

                    <div class="product-rating">
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="{{ $i <= round($relatedProduct->rating) ? 'fas' : 'far' }} fa-star"></i>
                            @endfor
                        </div>
                        <span>({{ $relatedProduct->review_count }})</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const qtyInput = document.getElementById('qty-input');
    const qtyMinus = document.getElementById('qty-minus');
    const qtyPlus = document.getElementById('qty-plus');

    if (qtyInput && qtyMinus && qtyPlus) {
        qtyMinus.addEventListener('click', () => {
            let val = parseInt(qtyInput.value || 1, 10);
            if (val > 1) qtyInput.value = val - 1;
        });

        qtyPlus.addEventListener('click', () => {
            let val = parseInt(qtyInput.value || 1, 10);
            qtyInput.value = val + 1;
        });

        qtyInput.addEventListener('input', () => {
            if (parseInt(qtyInput.value || 0, 10) < 1) {
                qtyInput.value = 1;
            }
        });
    }

    const sizeRadios = document.querySelectorAll('.size-radio');
    const selectedSizeInput = document.getElementById('selected-size');

    sizeRadios.forEach(radio => {
        radio.addEventListener('click', () => {
            sizeRadios.forEach(r => r.classList.remove('selected'));
            radio.classList.add('selected');

            if (selectedSizeInput) {
                selectedSizeInput.value = radio.dataset.size || radio.textContent.trim();
            }
        });
    });

    const colourRadios = document.querySelectorAll('.colour-radio');
    const selectedColorInput = document.getElementById('selected-color');

    colourRadios.forEach(radio => {
        radio.addEventListener('click', () => {
            colourRadios.forEach(r => r.classList.remove('selected'));
            radio.classList.add('selected');

            if (selectedColorInput) {
                selectedColorInput.value = radio.dataset.color || '';
            }
        });
    });

    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.querySelector('.main-image img');

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', () => {
            thumbnails.forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');

            const thumbImg = thumb.querySelector('img');
            if (thumbImg && mainImage) {
                mainImage.src = thumbImg.src;
            }
        });
    });
});
</script>

@push('styles')
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --primary-red: #DB4444;
    --text-black: #000000;
    --text-gray: #7D8184;
    --bg-gray: #F5F5F5;
    --white: #FFFFFF;
}

body {
    font-family: 'Poppins', sans-serif;
    color: var(--text-black);
    line-height: 1.6;
    background-color: #fff;
}

a {
    text-decoration: none;
    color: inherit;
    transition: color 0.3s;
}

img {
    max-width: 100%;
    height: auto;
    display: block;
}

.container {
    max-width: 1170px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Breadcrumb */
.breadcrumb-container {
    margin-bottom: 36px;
}

.breadcrumb {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    row-gap: 6px;
}

.breadcrumb a {
    color: var(--text-black);
    opacity: 0.5;
}

.breadcrumb .separator {
    margin: 0 10px;
    opacity: 0.5;
}

.breadcrumb .current {
    font-weight: 500;
}

/* Buttons */
.btn-primary {
    background-color: var(--primary-red);
    color: #fff;
    border: none;
    padding: 16px 48px;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
    white-space: nowrap;
    text-align: center;
    display: inline-block;
}

.btn-primary:hover {
    background-color: #E07575;
}

.btn-primary:active,
.action-btn:active,
.wishlist-btn:active,
.qty-btn:active {
    transform: translateY(1px);
}

/* Product Details */
.product-details-container {
    display: grid;
    grid-template-columns: minmax(0, 1.1fr) minmax(320px, 400px);
    gap: 56px;
    align-items: start;
    margin-top: 50px;
    margin-bottom: 120px;
}

/* Gallery */
.product-gallery {
    display: grid;
    grid-template-columns: 170px minmax(0, 1fr);
    gap: 24px;
    align-items: start;
}

.gallery-thumbnails {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.thumbnail {
    width: 100%;
    height: 138px;
    background-color: var(--bg-gray);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    cursor: pointer;
    transition: border-color 0.3s, transform 0.2s;
    border: 1px solid transparent;
    overflow: hidden;
}

.thumbnail img {
    max-width: 80%;
    max-height: 80%;
    object-fit: contain;
}

.thumbnail:hover,
.thumbnail.active {
    border-color: #000;
}

.main-image {
    width: 100%;
    min-height: 600px;
    background-color: var(--bg-gray);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    overflow: hidden;
    padding: 24px;
}

.main-image img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

/* Info */
.product-info-col {
    width: 100%;
    min-width: 0;
}

.product-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 16px;
    line-height: 1.35;
}

.rating-row {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px 16px;
    margin-bottom: 16px;
    font-size: 14px;
    color: var(--text-gray);
}

.rating-stars,
.stars {
    color: #FFAD33;
}

.stock-status {
    color: #00B85C;
    border-left: 1px solid rgba(0, 0, 0, 0.3);
    padding-left: 16px;
}

.product-price-large {
    font-size: 24px;
    font-weight: 400;
    margin-bottom: 20px;
}

.product-description {
    font-size: 14px;
    margin-bottom: 24px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.35);
    padding-bottom: 24px;
}

.product-options {
    margin-bottom: 28px;
}

.option-row {
    display: flex;
    align-items: center;
    gap: 24px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.option-label {
    font-size: 20px;
    font-weight: 400;
    min-width: 80px;
}

/* Colour */
.colour-options {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.colour-radio {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    cursor: pointer;
    position: relative;
    border: 1px solid transparent;
    flex: 0 0 auto;
}

.colour-radio.selected {
    outline: 2px solid #000;
    outline-offset: 2px;
}

/* Size */
.size-options {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.size-radio {
    min-width: 34px;
    height: 34px;
    padding: 0 10px;
    border: 1px solid rgba(0, 0, 0, 0.5);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
}

.size-radio:hover,
.size-radio.selected {
    background-color: var(--primary-red);
    color: #fff;
    border-color: var(--primary-red);
}

/* Purchase Area */
.purchase-row {
    display: flex;
    gap: 16px;
    align-items: flex-start;
    margin-bottom: 40px;
}

.cart-purchase-form {
    flex: 1;
    min-width: 0;
}

.purchase-actions {
    display: flex;
    gap: 16px;
    align-items: stretch;
}

.quantity-control {
    display: flex;
    border: 1px solid rgba(0, 0, 0, 0.5);
    border-radius: 4px;
    height: 48px;
    flex-shrink: 0;
    overflow: hidden;
}

.qty-btn {
    width: 42px;
    border: none;
    background: transparent;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s, color 0.3s;
}

.qty-btn:hover {
    background-color: var(--primary-red);
    color: #fff;
}

.qty-plus {
    background-color: var(--primary-red);
    color: #fff;
}

.qty-input {
    width: 74px;
    border: none;
    border-left: 1px solid rgba(0, 0, 0, 0.5);
    border-right: 1px solid rgba(0, 0, 0, 0.5);
    text-align: center;
    font-size: 18px;
    font-weight: 500;
    outline: none;
    -moz-appearance: textfield;
}

.qty-input::-webkit-outer-spin-button,
.qty-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.product-action-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
    min-width: 190px;
}

.action-btn-block {
    display: block;
    width: 100%;
    padding: 12px 20px;
    text-align: center;
}

.buy-now-btn {
    background-color: #000;
}

.buy-now-btn:hover {
    background-color: #333;
}

.wishlist-form,
.wishlist-link {
    flex-shrink: 0;
}

.wishlist-btn {
    width: 48px;
    height: 48px;
    border: 1px solid rgba(0, 0, 0, 0.5);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 20px;
    transition: all 0.3s;
    background: #fff;
}

.wishlist-btn:hover {
    background-color: var(--primary-red);
    color: #fff;
    border-color: var(--primary-red);
}

/* Delivery */
.delivery-info {
    border: 1px solid rgba(0, 0, 0, 0.5);
    border-radius: 4px;
    overflow: hidden;
}

.delivery-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 22px 24px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.5);
}

.delivery-item:last-child {
    border-bottom: none;
}

.delivery-icon {
    font-size: 24px;
    width: 40px;
    text-align: center;
    flex-shrink: 0;
}

.delivery-text h4 {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 6px;
}

.delivery-text p {
    font-size: 12px;
    font-weight: 500;
    text-decoration: underline;
}

/* Related */
.related-items-section {
    margin-top: 80px;
    margin-bottom: 120px;
}

.section-header-simple {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 48px;
}

.red-block-small {
    width: 20px;
    height: 40px;
    background-color: var(--primary-red);
    border-radius: 4px;
    flex-shrink: 0;
}

.section-header-simple h3 {
    font-size: 16px;
    color: var(--primary-red);
    font-weight: 600;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 30px;
}

.product-card {
    position: relative;
    background-color: #fff;
    min-width: 0;
}

.product-image {
    background-color: var(--bg-gray);
    height: 250px;
    border-radius: 4px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
    overflow: hidden;
    padding: 16px;
}

.product-image img {
    max-height: 80%;
    object-fit: contain;
}

.discount-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background-color: var(--primary-red);
    color: #fff;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 12px;
}

.card-actions {
    position: absolute;
    top: 12px;
    right: 12px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.action-btn {
    width: 34px;
    height: 34px;
    background-color: #fff;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.3s;
}

.action-btn:hover {
    background-color: var(--primary-red);
    color: #fff;
}

.add-to-cart-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #000;
    color: #fff;
    text-align: center;
    padding: 10px 0;
    font-weight: 500;
    cursor: pointer;
    opacity: 0;
    border: none;
    transition: opacity 0.3s;
}

.product-card:hover .add-to-cart-bar {
    opacity: 1;
}

.product-info h3 {
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 8px;
    line-height: 1.45;
}

.product-price {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
    margin-bottom: 8px;
    color: var(--primary-red);
    font-weight: 500;
}

.old-price {
    color: var(--text-gray);
    text-decoration: line-through;
    font-weight: 400;
}

.product-rating {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
    font-size: 14px;
    color: var(--text-gray);
}

/* Large tablet */
@media (max-width: 1199px) {
    .product-details-container {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .product-info-col {
        max-width: 100%;
    }

    .product-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }
}

/* Tablet */
@media (max-width: 991px) {
    .breadcrumb-container {
        margin-bottom: 28px;
    }

    .product-gallery {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .gallery-thumbnails {
        flex-direction: row;
        overflow-x: auto;
        padding-bottom: 4px;
    }

    .gallery-thumbnails::-webkit-scrollbar {
        height: 6px;
    }

    .thumbnail {
        min-width: 100px;
        width: 100px;
        height: 90px;
        flex: 0 0 auto;
    }

    .main-image {
        min-height: 420px;
    }

    .purchase-row {
        flex-direction: column;
        align-items: stretch;
    }

    .purchase-actions {
        flex-wrap: wrap;
    }

    .wishlist-form,
    .wishlist-link {
        width: 48px;
    }

    .product-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }
}

/* Mobile */
@media (max-width: 767px) {
    .container {
        padding: 0 12px;
    }

    .product-details-container {
        margin-top: 32px;
        margin-bottom: 80px;
        gap: 28px;
    }

    .product-title {
        font-size: 22px;
    }

    .product-price-large {
        font-size: 22px;
    }

    .option-label {
        min-width: auto;
        font-size: 18px;
    }

    .main-image {
        min-height: 320px;
        padding: 20px;
    }

    .purchase-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .quantity-control {
        width: 100%;
        justify-content: space-between;
    }

    .qty-btn {
        width: 48px;
    }

    .qty-input {
        flex: 1;
        width: auto;
    }

    .product-action-buttons {
        width: 100%;
        min-width: 0;
    }

    .action-btn-block {
        width: 100%;
    }

    .wishlist-form,
    .wishlist-link,
    .wishlist-btn {
        width: 100%;
    }

    .wishlist-btn {
        height: 48px;
    }

    .delivery-item {
        padding: 18px 16px;
        align-items: flex-start;
    }

    .related-items-section {
        margin-top: 60px;
        margin-bottom: 80px;
    }

    .section-header-simple {
        margin-bottom: 30px;
    }
}

/* Small mobile */
@media (max-width: 575px) {
    .breadcrumb {
        font-size: 14px;
    }

    .rating-row {
        font-size: 13px;
    }

    .stock-status {
        border-left: none;
        padding-left: 0;
        width: 100%;
    }

    .option-row {
        gap: 12px;
    }

    .main-image {
        min-height: 260px;
    }

    .product-grid {
        grid-template-columns: 1fr;
    }

    .product-image {
        height: 220px;
    }
}
</style>
@endpush
@endsection