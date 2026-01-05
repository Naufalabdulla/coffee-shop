<x-layout>

    <div class="pos-container">
        <!-- KIRI: MENU -->
        <div class="menu-section">
            <h3 style="font-weight:700">Coffee Lab</h3>
            <p class="text-muted">Discover your favorite coffee</p>

            <input type="text" class="form-control mb-3" placeholder="Search...">

            <div class="d-flex gap-2 mb-4">
                <button class="btn btn-brown active">All</button>
                <button class="btn btn-outline-dark">Coffee</button>
                <button class="btn btn-outline-dark">Non-Coffee</button>
            </div>

            <div class="row g-3">
                @foreach($products as $product)
                    <div class="col-md-4 col-lg-3">
                        <form action="{{ route('cart.add', $product->id) }}"
                            method="POST"
                            style="cursor:pointer">
                            @csrf

                            <div class="product-card"
                                onclick="this.closest('form').submit()">

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
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- KANAN: ORDER -->
        <div class="order-section">
            <h3 class="mt-3 fw-bold">My Order</h3>
            <small class="text-muted">Guest</small>

            @if(empty($cart))
                {{-- JIKA CART KOSONG --}}
                <div class="empty-order mt-4">
                    Silakan pilih menu
                </div>
            @else
                {{-- JIKA CART ADA --}}
                @foreach($cart as $id => $item)
                    <div class="order-item d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <strong>{{ $item['name'] }}</strong><br>
                            <small>Rp {{ number_format($item['price'], 0, ',', '.') }}</small>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <form action="{{ route('cart.decrease', $id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-outline-dark">-</button>
                            </form>

                            <span class="fw-bold">{{ $item['qty'] }}</span>

                            <form action="{{ route('cart.increase', $id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-dark">+</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <hr class="my-4">

                {{-- TOTAL --}}
                <p>Subtotal: Rp {{ number_format($subtotal) }}</p>
                <p>Tax (10%): Rp {{ number_format($tax) }}</p>
                <p class="fw-bold fs-5">Total: Rp {{ number_format($total) }}</p>

                {{-- STATUS --}}
                <p class="mt-3 text-muted">Status Pembayaran</p>

                {{-- BUTTON --}}
                <form method="POST" action="{{ route('cart.cancel') }}" class="mt-2">
                    @csrf
                    <button class="w-full text-white py-2 rounded" style="background-color:maroon" onclick="return confirm('Yakin ingin membatalkan pesanan?')">
                        Cancel Order
                    </button>
                </form>

                <form method="POST" action="/pay" class="mt-2">
                    @csrf
                    <button class="w-full text-white py-2 rounded" style="background-color:green">
                        Pay Now
                    </button>
                </form>
            @endif
        </div>
    </div>
    
</x-layout>