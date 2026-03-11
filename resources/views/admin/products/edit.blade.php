@extends('admin.layout')

@section('title', 'Edit Product')
@section('header', 'Edit Product')

@section('content')
<div class="card" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); max-width: 800px; margin: 0 auto;">
    <div style="padding: 20px; border-bottom: 1px solid #eee;">
        <h3 style="margin: 0;">Edit Product: {{ $product->title }}</h3>
    </div>
    
    <div style="padding: 20px;">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div style="grid-column: span 2;">
                    <label for="title" style="display: block; margin-bottom: 8px; font-weight: 500;">Product Title</label>
                    <input type="text" name="title" id="title" required
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                        value="{{ old('title', $product->title) }}">
                    @error('title')
                        <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="category_id" style="display: block; margin-bottom: 8px; font-weight: 500;">Category</label>
                    <select name="category_id" id="category_id" required
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; background: #fff;">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="sku" style="display: block; margin-bottom: 8px; font-weight: 500;">SKU (Optional)</label>
                    <input type="text" name="sku" id="sku"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                        value="{{ old('sku', $product->sku) }}">
                    @error('sku')
                        <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="price" style="display: block; margin-bottom: 8px; font-weight: 500;">Price ($)</label>
                    <input type="number" name="price" id="price" step="0.01" min="0" required
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                        value="{{ old('price', $product->price) }}">
                    @error('price')
                        <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="old_price" style="display: block; margin-bottom: 8px; font-weight: 500;">Old Price ($) (Optional)</label>
                    <input type="number" name="old_price" id="old_price" step="0.01" min="0"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                        value="{{ old('old_price', $product->old_price) }}">
                </div>

                <div>
                    <label for="stock_qty" style="display: block; margin-bottom: 8px; font-weight: 500;">Stock Quantity</label>
                    <input type="number" name="stock_qty" id="stock_qty" min="0" required
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                        value="{{ old('stock_qty', $product->stock_qty) }}">
                    @error('stock_qty')
                        <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="featured_image" style="display: block; margin-bottom: 8px; font-weight: 500;">Featured Image</label>
                    <input type="file" name="featured_image" id="featured_image" accept="image/*"
                        style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    
                    @if($product->featured_image)
                        <div style="margin-top: 10px;">
                            <img src="{{ $product->image_url }}" alt="Current Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px;">
                            <div style="font-size: 0.8rem; color: #666;">Current Image</div>
                        </div>
                    @endif

                    @error('featured_image')
                        <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="grid-column: span 2;">
                    <label for="short_description" style="display: block; margin-bottom: 8px; font-weight: 500;">Short Description</label>
                    <textarea name="short_description" id="short_description" rows="3"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">{{ old('short_description', $product->short_description) }}</textarea>
                </div>

                <div style="grid-column: span 2; display: flex; gap: 20px; flex-wrap: wrap;">
                    <label style="display: flex; align-items: center; cursor: pointer;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                            style="width: 18px; height: 18px; margin-right: 8px;">
                        <span style="font-weight: 500;">Active</span>
                    </label>

                    <label style="display: flex; align-items: center; cursor: pointer;">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                            style="width: 18px; height: 18px; margin-right: 8px;">
                        <span style="font-weight: 500;">Featured</span>
                    </label>

                    <label style="display: flex; align-items: center; cursor: pointer;">
                        <input type="checkbox" name="is_best_seller" value="1" {{ old('is_best_seller', $product->is_best_seller) ? 'checked' : '' }}
                            style="width: 18px; height: 18px; margin-right: 8px;">
                        <span style="font-weight: 500;">Best Seller</span>
                    </label>

                    <label style="display: flex; align-items: center; cursor: pointer;">
                        <input type="checkbox" name="is_flash_sale" value="1" {{ old('is_flash_sale', $product->is_flash_sale) ? 'checked' : '' }}
                            style="width: 18px; height: 18px; margin-right: 8px;">
                        <span style="font-weight: 500;">Flash Sale</span>
                    </label>
                </div>
            </div>

            <div style="margin-top: 30px; display: flex; gap: 10px;">
                <button type="submit" 
                    style="background: var(--primary-color); color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 1rem;">
                    Update Product
                </button>
                <a href="{{ route('admin.products.index') }}" 
                    style="background: #f8f9fa; color: #333; border: 1px solid #ddd; padding: 10px 20px; border-radius: 4px; text-decoration: none; display: inline-block;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
