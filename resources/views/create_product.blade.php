@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')
    <div>
        <h2>Create Product</h2>

        @if ($errors->any())
            <div style="color:#b71c1c;background:#ffebee;padding:10px;border-radius:4px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input class="form-control" type="number" step="0.01" name="price" value="{{ old('price') }}" required>
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input class="form-control" type="number" name="amount" value="{{ old('amount', 0) }}" required>
            </div>
            <div class="form-group">
                <label>Image</label>
                <div>
                    <img id="previewImage" src="" alt="" style="max-width:160px;display:none;margin-bottom:8px;" />
                </div>
                <input class="form-control" id="imageInput" type="file" name="image" accept="image/*">
            </div>
            <div class="form-group">
                <label><input type="checkbox" name="is_active" {{ old('is_active') ? 'checked' : '' }}> Active</label>
            </div>
            <div style="margin-top:10px;">
                <button type="submit" class="btn">Create</button>
                <a href="{{ route('products.index') }}" class="btn">Cancel</a>
            </div>
        </form>
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
    </div>
@endsection
