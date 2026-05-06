<div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="modalRegisterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header border-0">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{-- Header custom: judul + deskripsi --}}
                <div class="text-start mb-3">
                    <h3 class="fw-bold mb-1">Halo!</h3>
                    <p class="text-muted mb-2">Yuk, buat akunmu sekarang dan mulai jelajahi keseruan di dalamnya.</p>
                </div>

                {{-- Tampilkan error umum jika ada --}}
                @if ($errors->any() && !$errors->has('email') && !$errors->has('password') && !$errors->has('name'))
                    <div class="alert alert-danger py-2 small">
                        Ada kesalahan, silakan cek kembali data Anda.
                    </div>
                @endif

                <form method="POST" action="{{ route('auth.register') }}" novalidate>
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan Nama Lengkap"
                                required
                                autofocus
                            >
                            @error('name')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 position-relative">
                            <label for="city_name" class="form-label">Asal Kota</label>
                            <input
                                type="text"
                                class="form-control"
                                id="city_name"
                                name="city_name"
                                value="{{ old('city_name') }}"
                                placeholder="Ketik 2-3 huruf untuk mencari kota"
                                autocomplete="off"
                            >
                            <input type="hidden" name="city_id" id="city_id" value="{{ old('city_id') }}">
                            <div id="city_suggestions" class="list-group position-absolute" style="z-index: 2000; width: 100%; display: none;
                                max-height: 240px; overflow:auto;
                                top: calc(100% + .25rem); left: 0;">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Masukkan Email"
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Jenis Kelamin</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_m" value="LakiLaki" {{ old('gender')=='LakiLaki' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender_m">Laki-Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender_f" value="Perempuan" {{ old('gender')=='Perempuan' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="gender_f">Perempuan</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                                placeholder="Minimal 8 karakter"
                                minlength="8"
                                required
                                aria-describedby="passwordHelp"
                            >
                            <div id="passwordHelp" class="form-text small text-muted">Minimal 8 karakter, gunakan kombinasi huruf besar/kecil, angka, dan simbol.</div>
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                            <ul id="passwordRules" class="ps-0 mt-2 mb-0 small">
                                <li id="rule-length" class="text-danger">Minimal 8 karakter</li>
                                <li id="rule-case" class="text-danger">Memiliki huruf besar dan kecil</li>
                                <li id="rule-number" class="text-danger">Memiliki angka</li>
                                <li id="rule-symbol" class="text-danger">Memiliki simbol (mis. @#$%&*)</li>
                            </ul>
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Ulangi Password"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="birth_date" class="form-label">Tanggal Lahir</label>
                            <input
                                type="date"
                                class="form-control"
                                id="birth_date"
                                name="birth_date"
                                value="{{ old('birth_date') }}"
                                placeholder="mm/dd/yyyy"
                            >
                        </div>

                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark">
                                    Daftar
                                </button>
                            </div>
                        </div>

                        <div class="col-12 text-center mt-2">
                            Sudah punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#modalLogin" data-bs-dismiss="modal">Masuk</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- Modal Sukses Registrasi --}}
<div class="modal fade" id="modalRegisterSuccess" tabindex="-1" aria-labelledby="modalRegisterSuccessLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-body text-center py-5">
                <div class="mb-4">
                    <div style="width: 80px; height: 80px; margin: 0 auto; background: #28a745; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                </div>
                <h4 class="fw-bold mb-2">Berhasil!</h4>
                <p class="text-muted mb-0">
                    Pendaftaran berhasil! Akun anda telah terdaftar. Silahkan masuk.
                </p>
                <div class="d-grid mt-4">
                    <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalLogin" data-bs-dismiss="modal">Masuk Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Buka modal otomatis jika ada error validasi registrasi (gunakan old input sebagai indikator) --}}
@if ($errors->any() && old('name'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('modalRegister'));
        modal.show();
    });
</script>
@endif

<style>
/* Modal Register and Success styling */
#modalRegister .modal-content,
#modalRegisterSuccess .modal-content {
    border-radius: 40px;
    border: none;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
}

#modalRegister .modal-dialog,
#modalRegisterSuccess .modal-dialog {
    max-width: 550px;
}

/* Input fields styling */
#modalRegister .form-control,
#modalRegister .form-check-input,
#modalRegister button.btn {
    border-radius: 18px;
}

#modalRegister .form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Password rules animation - collapse space when hidden */
#passwordRules{
    opacity: 0;
    max-height: 0;
    overflow: hidden;
    transition: opacity 0.18s ease, max-height 0.18s ease;
    margin-top: .25rem;
    list-style: none;
    padding-left: 0 !important;
}
#passwordRules.show{
    opacity: 1;
    max-height: 240px;
}
#passwordRules li{ 
    display: block; 
    padding: 4px 0;
    font-size: 13px;
    font-weight: 500;
}
#passwordRules li.text-danger {
    color: #dc3545 !important;
}
#passwordRules li.text-success {
    color: #28a745 !important;
}
</style>

<script>
// Autocomplete for city_name using Nominatim (OpenStreetMap)
;(function (){
    const input = document.getElementById('city_name');
    const list = document.getElementById('city_suggestions');
    if (!input) return;

    let timer = null;

    function clearList(){ list.innerHTML = ''; list.style.display = 'none'; }

    function renderSuggestions(items){
        clearList();
        if (!items.length) return;
        items.forEach(i=>{
            const a = document.createElement('button');
            a.type = 'button';
            a.className = 'list-group-item list-group-item-action';
            a.innerHTML = '<div class="fw-semibold">' + (i.name || i.city_name || i.display_name || '') + '</div>' +
                          '<div class="small text-muted">' + (i.province ? i.province : '') + '</div>';
            a.addEventListener('click', function(){
                input.value = i.name || i.city_name || i.display_name || '';
                const hid = document.getElementById('city_id');
                if (hid) hid.value = i.id || '';
                clearList();
            });
            list.appendChild(a);
        });
        list.style.display = 'block';
    }

    async function fetchPlaces(q){
        const url = '/api/cities/search?q=' + encodeURIComponent(q);
        try{
            const res = await fetch(url, {headers:{'Accept':'application/json'}});
            if (!res.ok) {
                console.error('City API error', res.status, res.statusText);
                return [];
            }
            const data = await res.json();
            return data || [];
        }catch(e){ console.error('City API fetch failed', e); return []; }
    }

    input.addEventListener('input', function(e){
        const q = e.target.value.trim();
        clearTimeout(timer);
        // clear selected city_id if user edits text
        const hid = document.getElementById('city_id'); if (hid) hid.value = '';
        if (q.length < 2) { clearList(); return; }
        timer = setTimeout(async ()=>{
            const items = await fetchPlaces(q);
            renderSuggestions(items);
        }, 300);
    });

    // close when clicking outside
    document.addEventListener('click', function(e){
        if (!input.contains(e.target) && !list.contains(e.target)){
            clearList();
        }
    });
})();
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pwdInput = document.getElementById('password');
    const ruleLength = document.getElementById('rule-length');
    const ruleCase = document.getElementById('rule-case');
    const ruleNumber = document.getElementById('rule-number');
    const ruleSymbol = document.getElementById('rule-symbol');
    const rulesList = document.getElementById('passwordRules');
    
    if (!pwdInput) return;

    function validate() {
        const pwd = pwdInput.value;
        
        // Check rules
        const len = pwd.length >= 8;
        const hasCase = /[a-z]/.test(pwd) && /[A-Z]/.test(pwd);
        const hasNum = /[0-9]/.test(pwd);
        const hasSym = /[!@#\$%\^&*()_+\-=[\]{};':"\\|,.<>\/?]/.test(pwd);
        
        // Update display
        ruleLength.innerHTML = len ? '✔ Minimal 8 karakter' : '✖ Minimal 8 karakter';
        ruleLength.className = len ? 'text-success' : 'text-danger';
        
        ruleCase.innerHTML = hasCase ? '✔ Memiliki huruf besar dan kecil' : '✖ Memiliki huruf besar dan kecil';
        ruleCase.className = hasCase ? 'text-success' : 'text-danger';
        
        ruleNumber.innerHTML = hasNum ? '✔ Memiliki angka' : '✖ Memiliki angka';
        ruleNumber.className = hasNum ? 'text-success' : 'text-danger';
        
        ruleSymbol.innerHTML = hasSym ? '✔ Memiliki simbol (mis. @#$%&*)' : '✖ Memiliki simbol (mis. @#$%&*)';
        ruleSymbol.className = hasSym ? 'text-success' : 'text-danger';
        
        // Show rules if password has content
        if (pwd.length > 0) {
            rulesList.classList.add('show');
        } else {
            rulesList.classList.remove('show');
        }
    }
    
    pwdInput.addEventListener('input', validate);
    pwdInput.addEventListener('focus', validate);
});
</script>

<script>
// Handle registration form submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('#modalRegister form');
    if (!form) return;
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        
        // Get CSRF token
        const token = document.querySelector('meta[name="csrf-token"]')?.content || 
                      form.querySelector('input[name="_token"]')?.value;
        
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token,
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (response.ok && data.success) {
                // Registration successful
                const registerModal = bootstrap.Modal.getInstance(document.getElementById('modalRegister'));
                if (registerModal) registerModal.hide();
                
                // Show success modal
                const successModal = new bootstrap.Modal(document.getElementById('modalRegisterSuccess'));
                successModal.show();
                
                // Reset form
                form.reset();
                // Clear any validation classes
                form.querySelectorAll('.form-control').forEach(input => {
                    input.classList.remove('is-invalid');
                });
            } else {
                // Server returned error
                if (data.errors) {
                    // Handle validation errors
                    Object.keys(data.errors).forEach(field => {
                        const input = form.querySelector(`[name="${field}"]`);
                        if (input) {
                            input.classList.add('is-invalid');
                        }
                    });
                }
            }
        } catch (error) {
            console.error('Registration error:', error);
        }
    });
});
</script>
