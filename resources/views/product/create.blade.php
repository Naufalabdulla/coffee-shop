<x-layout>
    <h4 class="mb-4">Add Product</h4>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="card p-4">
        @csrf
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Product Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-brown">Save</button>
            <a href="{{ route('product.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</x-layout>
