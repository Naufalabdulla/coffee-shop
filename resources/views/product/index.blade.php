<x-layout>
    <div class="pos-container">
        <!-- KIRI: MENU -->
        <div class="menu-section">
            <h3 class="fw-bold">Coffee Lab</h3>
            <p class="text-muted">Discover your favorite coffee</p>

            <!-- search -->
            <input type="text" class="form-control mb-3" placeholder="Search...">

            <div class="d-flex gap-2 mb-4">
                <a href="{{ route('product.create') }}" class="btn btn-brown">
                    + Add Product
                </a>
            </div>

            <div class="row g-3">
                @foreach ($products as $product)
                    <div class="col-md-4 col-lg-3">
                        <div class="product-card h-100 d-flex flex-column">
                            <!-- IMAGE -->
                            <div class="product-img">
                                <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
                            </div>

                            <!-- INFO -->
                            <div class="p-2">
                                <strong>{{ $product->name }}</strong>
                                <div class="price">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                            </div>

                            <!-- ACTION BUTTON -->
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
