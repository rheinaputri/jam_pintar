<nav class="navbar navbar-expand-lg px-3" style="background-color:#ffffff; box-shadow:0 2px 10px rgba(0,0,0,0.05);">

    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand fw-bold" href="#" style="color:#2A3141;">
            <i class="bi bi-moon-stars-fill me-2"></i> SmartPeak
        </a>

        <!-- Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

            <!-- NAV MENU -->
            <ul class="navbar-nav nav-underline align-items-center me-3">

                <!-- Home (ACTIVE) -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}" style="color:#2A3141;">
                        Home
                    </a>
                </li>

                <!-- About (NOT active) -->
                <li class="nav-item">
                    <a class="nav-link" href="#about" style="color:#2A3141;">
                        About
                    </a>
                </li>

            </ul>

            <!-- LOGIN BUTTON -->
<button type="button" class="btn btn-login-custom rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#modalLogin"> Login</button>

        </div>

    </div>
</nav>

<style>
    

    /* Login Button - hover jadi putih dengan outline gelap */
    .btn-login-custom {
        background-color: #212529;
        color: #ffffff;
        border: 1.5px solid #212529;
        font-weight: 500;
        transition: all 0.25s ease;
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
    }

    .btn-login-custom:hover {
        background-color: #ffffff !important;
        color: #1f2a3e !important;
        border: 1.5px solid #1f2a3e !important;
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
    }

    .btn-login-custom:focus {
        box-shadow: 0 0 0 3px rgba(33,37,41,0.25);
        outline: none;
    }

    /* Responsive adjustment */
    @media (max-width: 992px) {
        .btn-login-custom {
            margin-top: 0.5rem;
            width: fit-content;
        }
    }
</style>