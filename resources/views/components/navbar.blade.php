<nav class="navbar navbar-light bg-white border-bottom px-4 shadow p-3">
    <div class="d-flex align-items-center w-100">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('img/catt.png') }}" alt="Shamy Coffee" class="logo">
            <h2 class="mt-2" style="font-weight: 700;color:#493628">
                Shamy Coffee ‧₊˚ ⋅ ☕︎ 𓎩 ‧₊˚ ⋅
            </h2>
        </div>
        <div class="ms-auto dropdown">
            <a href="#" class="fw-bold text-decoration-none dropdown-toggle" id="menuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:black">Menu</a>

            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="menuDropdown">
                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('transactions.index') }}">Transaksi</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="dropdown-item text-danger"
                                onclick="return confirm('Kamu yakin ingin logout?')">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
