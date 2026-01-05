<x-layout>
    <div class="pos-container">
        <div class="menu-section">
            <h3 class="fw-bold mt-2">Hi Admin, Welcome to Coffee Lab</h3>
            <p class="text-muted">Which section would you like to manage?</p>
            <div class="d-flex justify-content-center gap-3 mb-4">
                <a href="{{ route('product.index') }}" class="btn btn-outline-dark px-4">Product</a>
                <a href="{{ route('user.index') }}" class="btn btn-outline-dark px-4">User </a>
            </div>
            <hr class="my-4">
            <div class="d-flex gap-2 mb-4">
                <a href="{{ route('product.create') }}" class="btn btn-brown">
                    + Add Product
                </a>
            </div>
            <div class="row g-3">
                @foreach ($products as $product)
                    <div class="col-md-4 col-lg-3">
                        <div class="product-card h-100 d-flex flex-column">
                            <div class="product-img">
                                <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="p-2">
                                <strong>{{ $product->name }}</strong>
                                <div class="price">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="mt-auto d-flex justify-content-end gap-2 p-2">
                                <a href="{{ route('product.edit', $product) }}" class="btn btn-sm btn-outline-primary">Update</a>

                                <form action="{{ route('product.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>