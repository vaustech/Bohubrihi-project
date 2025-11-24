@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <div>
        <h2>Edit Product</h2>

        @if ($errors->any())
            <div style="color:#b71c1c;background:#ffebee;padding:10px;border-radius:4px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" value="{{ old('name', $product->name) }}" required>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input class="form-control" type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input class="form-control" type="number" name="amount" value="{{ old('amount', $product->amount) }}" required>
            </div>
            <div class="form-group">
                <label>Image</label>
                <div>
                    @if($product->image)
                        <img id="previewImage" src="{{ asset('storage/' . $product->image) }}" alt="" style="max-width:160px;margin-bottom:8px;display:block;" />
                    @else
                        <img id="previewImage" src="" alt="" style="max-width:160px;margin-bottom:8px;display:none;" />
                    @endif
                </div>
                <input class="form-control" id="imageInput" type="file" name="image" accept="image/*">
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="is_active" {{ old('is_active', $product->is_active) ? 'checked' : '' }}> Active</label>
            </div>
            <div style="margin-top:10px;">
                <button type="submit" class="btn">Update</button>
                <a href="{{ route('products.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
    <script>
        (function(){
            var input = document.getElementById('imageInput');
            var preview = document.getElementById('previewImage');
            if(!input) return;
            input.addEventListener('change', function(e){
                var f = this.files && this.files[0];
                if(!f){ preview.style.display='none'; preview.src=''; return; }
                preview.src = URL.createObjectURL(f);
                preview.style.display = 'block';
            });
        })();
    </script>
@endsection
