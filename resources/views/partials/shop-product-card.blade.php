@php
    $roundedRating = round($product->rating ?? 0);
@endphp

<div class="product-card">
    <div class="product-image">
        <img src="{{ $product->image_url }}" alt="{{ $product->title }}">

        @if(!empty($product->discount_percent))
            <span class="discount-badge">-{{ $product->discount_percent }}%</span>
        @elseif(!empty($product->is_featured) && empty($product->old_price))
            <span class="new-badge">NEW</span>
        @endif

        <div class="card-actions">
            @auth
                <form action="{{ route('wishlist.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button type="submit" class="action-btn" title="Add to wishlist">
                        <i class="far fa-heart"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="action-btn" title="Login to wishlist">
                    <i class="far fa-heart"></i>
                </a>
            @endauth

            <a href="{{ route('products.show', $product) }}" class="action-btn" title="View details">
                <i class="far fa-eye"></i>
            </a>
        </div>

        <form action="{{ route('cart.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="add-to-cart-btn">Add To Cart</button>
        </form>
    </div>

    <div class="product-info">
        <h3>
            <a href="{{ route('products.show', $product) }}">{{ $product->title }}</a>
        </h3>

        <div class="product-price">
            ${{ number_format($product->price, 0) }}

            @if(!empty($product->old_price))
                <span class="old-price">${{ number_format($product->old_price, 0) }}</span>
            @endif
        </div>

        <div class="product-rating">
            <div class="stars">
                @for($i = 1; $i <= 5; $i++)
                    <i class="{{ $i <= $roundedRating ? 'fas' : ($i - 0.5 <= ($product->rating ?? 0) ? 'fas fa-star-half-alt' : 'far') }} fa-star"></i>
                @endfor
            </div>
            <span>({{ $product->review_count ?? 0 }})</span>
        </div>
    </div>
</div>