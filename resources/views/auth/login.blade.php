<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalLoginLabel">
                    <i class="bi bi-person-circle me-2"></i> Login
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{-- Tampilkan error jika ada --}}
                @if ($errors->any())
                    <div class="alert alert-danger py-2 small">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- Tampilkan success message (setelah register) --}}
                @if (session('success'))
                    <div class="alert alert-success py-2 small">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('auth.login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            required
                        >
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                        </button>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalRegister" data-bs-dismiss="modal">
                            Belum punya akun? <b>Daftar</b>
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- Buka modal otomatis jika ada error atau success message (setelah redirect) --}}
@if ($errors->any() || session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('modalLogin'));
        modal.show();
    });
</script>
@endif