<x-layout>

<div class="pos-container">
    <!-- KIRI: MENU -->
    <div class="menu-section">
        <h3 style="font-weight:700">Coffee Lab</h3>
        <p class="text-muted">Discover your favorite coffee</p>

        <input type="text" class="form-control mb-3" placeholder="Search...">

        <div class="d-flex gap-2 mb-4">
            <button class="btn btn-brown active">All</button>
            <button class="btn btn-outline-secondary">Coffe</button>
            <button class="btn btn-outline-secondary">Non-Coffee</button>
        </div>

        <div class="row g-3">
            @foreach($products as $product)
                <div class="col-md-4 col-lg-3">
                    <div class="product-card">
                        <div class="product-img">
                            <img src="{{ asset($product->image_url) }}"
                                 alt="{{ $product->name }}">
                        </div>
                        <div class="p-2">
                            <strong>{{ $product->name }}</strong>
                            <div class="price">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- KANAN: ORDER -->
    <div class="order-section">
        <h3 class="mt-3" style="font-weight:700">My Order</h3>
        <small class="text-muted">Guest</small>

        <div class="empty-order">
            Silakan pilih menu
        </div>
    </div>

</div>

</x-layout>
