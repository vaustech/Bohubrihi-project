@extends('layouts.admin')

@section('title', 'Products')

@section('content')
    <div class="small-container">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
            <h2>All Products</h2>
            <div style="display:flex;gap:12px;align-items:center;">
                <form method="GET" action="{{ route('products.index') }}" style="display:flex;gap:8px;align-items:center;">
                    <label for="per_page" style="margin:0">Per page</label>
                    <select id="per_page" name="per_page" onchange="this.form.submit()" class="form-control" style="width:auto;padding:6px;">
                        @php $sizes = [6,12,24,48]; @endphp
                        @foreach($sizes as $s)
                            <option value="{{ $s }}" {{ isset($perPage) && $perPage == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </form>
                <a href="{{ route('products.create') }}" class="btn">Create Product</a>
            </div>
        </div>

        @if(session('success'))
            <div style="padding:10px;background:#d4edda;color:#155724;border-radius:4px;margin-bottom:12px;">{{ session('success') }}</div>
        @endif

        <div class="row">
            @forelse($products as $product)
                <div class="col-4">
                    <a href="{{ route('products.show', $product->id) }}">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:100%;height:auto;">
                        @else
                            <img src="{{ asset('images/product-1.jpg') }}" alt="{{ $product->name }}" style="width:100%;height:auto;">
                        @endif
                    </a>
                    <h4>{{ $product->name }}</h4>
                    <p>${{ number_format($product->price, 2) }}</p>
                    <div style="margin-top:8px;display:flex;gap:8px;">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger btn-delete">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>No products found.</p>
            @endforelse
        </div>

        <div class="pagination">
            {!! $products->links() !!}
        </div>
    </div>

    <script>
        function confirmDelete(form){
            if(!confirm('Are you sure you want to delete this product? This action cannot be undone.')){
                return false;
            }
            return true;
        }
    </script>
@endsection
