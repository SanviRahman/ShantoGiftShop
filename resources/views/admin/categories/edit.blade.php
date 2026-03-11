@extends('admin.layout')

@section('title', 'Edit Category')
@section('header', 'Edit Category')

@section('content')
<div class="card" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); max-width: 600px; margin: 0 auto;">
    <div style="padding: 20px; border-bottom: 1px solid #eee;">
        <h3 style="margin: 0;">Edit Category: {{ $category->name }}</h3>
    </div>
    
    <div style="padding: 20px;">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 20px;">
                <label for="name" style="display: block; margin-bottom: 8px; font-weight: 500;">Category Name</label>
                <input type="text" name="name" id="name" required
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('name', $category->name) }}">
                @error('name')
                    <div style="color: #dc3545; font-size: 0.85rem; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="parent_id" style="display: block; margin-bottom: 8px; font-weight: 500;">Parent Category</label>
                <select name="parent_id" id="parent_id" 
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; background: #fff;">
                    <option value="">None</option>
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label for="icon_class" style="display: block; margin-bottom: 8px; font-weight: 500;">Icon Class (FontAwesome)</label>
                <input type="text" name="icon_class" id="icon_class"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"
                    value="{{ old('icon_class', $category->icon_class) }}">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                        style="width: 18px; height: 18px; margin-right: 10px;">
                    <span style="font-weight: 500;">Active</span>
                </label>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" 
                    style="background: var(--primary-color); color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 1rem;">
                    Update Category
                </button>
                <a href="{{ route('admin.categories.index') }}" 
                    style="background: #f8f9fa; color: #333; border: 1px solid #ddd; padding: 10px 20px; border-radius: 4px; text-decoration: none; display: inline-block;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
