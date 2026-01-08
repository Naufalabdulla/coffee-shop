<x-layout>
    <div class="pos-container">
        <!-- KIRI: MENU -->
        <div class="menu-section">
            <h3 class="fw-bold mt-2">Hi Admin, Welcome to Coffee Lab</h3>
            <p class="text-muted">Which section would you like to manage?</p>
            <div class="d-flex justify-content-center gap-3 mb-4">
                <a href="{{ route('product.index') }}" class="btn btn-outline-dark px-4">Product</a>
                <a href="{{ route('user.index') }}" class="btn btn-outline-dark px-4">User</a>
            </div>
            
            <hr class="my-4">

            <div class="d-flex gap-2 mb-4">
                <a href="{{ route('user.create') }}" class="btn btn-brown">+ Add User</a>
            </div>
            <div class="row g-3">
                @foreach ($users as $user)
                    <div class="col-md-4 col-lg-3">
                        <div class="product-card h-100 d-flex flex-column" style="background-color: beige;">
                            <!-- INFO -->
                            <div class="p-2">
                                <strong>{{ $user->name }}</strong>
                                <div class="price">
                                    {{ $user->email }}
                                </div>
                            </div>

                            <!-- ACTION BUTTON -->
                            <div class="mt-auto d-flex justify-content-end gap-2 p-2">
                                {{-- <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-outline-primary">Update</a> --}}

                                <form action="{{ route('user.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
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
</x-layout>