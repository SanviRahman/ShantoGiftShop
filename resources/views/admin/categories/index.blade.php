@extends('admin.layout')

@section('title', 'Categories')
@section('header', 'Categories')

@section('content')
<div class="card" style="background: #fff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
    <div style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
        <h3 style="margin: 0;">All Categories</h3>
        <a href="{{ route('admin.categories.create') }}" class="btn-primary" style="background: var(--primary-color); color: #fff; text-decoration: none; padding: 8px 16px; border-radius: 4px; font-size: 0.9rem;">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; text-align: left;">
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Name</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Slug</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Parent</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Products</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Status</th>
                    <th style="padding: 12px 20px; border-bottom: 2px solid #dee2e6;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 12px 20px;">
                        @if($category->icon_class)
                            <i class="{{ $category->icon_class }}" style="margin-right: 8px; color: #666;"></i>
                        @endif
                        <span style="font-weight: 500;">{{ $category->name }}</span>
                    </td>
                    <td style="padding: 12px 20px; color: #666;">{{ $category->slug }}</td>
                    <td style="padding: 12px 20px;">
                        @if($category->parent)
                            <span style="background: #e9ecef; padding: 2px 6px; border-radius: 4px; font-size: 0.85rem;">{{ $category->parent->name }}</span>
                        @else
                            <span style="color: #aaa;">-</span>
                        @endif
                    </td>
                    <td style="padding: 12px 20px;">{{ $category->products_count }}</td>
                    <td style="padding: 12px 20px;">
                        @if($category->is_active)
                            <span style="color: #28a745; font-size: 0.85rem;"><i class="fas fa-check-circle"></i> Active</span>
                        @else
                            <span style="color: #dc3545; font-size: 0.85rem;"><i class="fas fa-times-circle"></i> Inactive</span>
                        @endif
                    </td>
                    <td style="padding: 12px 20px;">
                        <a href="{{ route('admin.categories.edit', $category) }}" style="color: #ffc107; margin-right: 10px; font-size: 1.1rem;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #dc3545; cursor: pointer; font-size: 1.1rem;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div style="padding: 20px;">
        {{ $categories->links() }}
    </div>
</div>
@endsection
