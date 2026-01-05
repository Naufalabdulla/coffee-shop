<x-layout>
    <h4 class="mb-4">Update Product</h4>
    <form action="{{ route('product.update', $product) }}" method="POST" enctype="multipart/form-data" class="card p-4">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}">
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}">
        </div>
        <div class="mb-3">
            <label>Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>
        @if ($product->image_url)
            <div class="mb-3">
                <img src="{{ asset($product->image_url) }}" width="120" class="rounded">
            </div>
        @endif
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('product.index') }}" class="btn btn-secondary">Back</a>
    </form>
</x-layout>
