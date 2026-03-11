@php
    $roundedRating = round($product->rating);
    $showDiscount = $showDiscount ?? true;
@endphp

<div class="product-card">
    <div class="card-header">
        @if($showDiscount && $product->discount_percent)
            <span class="discount-badge">-{{ $product->discount_percent }}%</span>
        @endif

        <div class="card-icons">
            @auth
                <form action="{{ route('wishlist.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit"><i class="far fa-heart"></i></button>
                </form>
            @else
                <a href="{{ route('login') }}">
                    <button type="button"><i class="far fa-heart"></i></button>
                </a>
            @endauth

            <a href="{{ route('products.show', $product) }}">
                <button type="button"><i class="far fa-eye"></i></button>
            </a>
        </div>

        <img src="{{ $product->image_url }}" alt="{{ $product->title }}">

        <form action="{{ route('cart.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button class="add-to-cart-btn" type="submit">Add To Cart</button>
        </form>
    </div>

    <div class="card-details">
        <h3 class="product-name">
            <a href="{{ route('products.show', $product) }}">{{ $product->title }}</a>
        </h3>

        <div class="price">
            <span class="current-price">${{ number_format($product->price, 0) }}</span>
            @if($product->old_price)
                <span class="original-price">${{ number_format($product->old_price, 0) }}</span>
            @endif
        </div>

        <div class="rating">
            <div class="stars">
                @for($i = 1; $i <= 5; $i++)
                    <i class="{{ $i <= $roundedRating ? 'fas' : 'far' }} fa-star"></i>
                @endfor
            </div>
            <span class="review-count">({{ $product->review_count }})</span>
        </div>
    </div>
</div>