<header class="navbar navbar-expand navbar-light bg-white border-bottom px-4 py-2 sticky-top">
    <span class="navbar-brand fw-semibold text-muted">Ini Header</span>

    <div class="ms-auto d-flex align-items-center gap-2">
        @auth
            {{-- Sudah login: tampilkan nama & logout --}}
            <span class="text-muted small">Halo, {{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        @else
            {{-- Belum login: tampilkan tombol login --}}
            <button
                class="btn btn-primary btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#modalLogin"
            >
                <i class="bi bi-person me-1"></i> Login
            </button>
        @endauth
    </div>
</header>