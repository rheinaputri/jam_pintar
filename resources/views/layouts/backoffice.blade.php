<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Backoffice')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        #sidebar-admin {
            width: 250px;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            background-color: #0d6efd;
        }

        #main-wrapper {
            margin-left: 250px;
            min-height: 100vh;
        }

        #content {
            padding: 24px;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Sidebar Admin --}}
    <nav id="sidebar-admin" class="d-flex flex-column p-3">
        <div class="text-white fw-bold fs-5 mb-4 px-2">
            <i class="bi bi-grid-fill me-2"></i> Backoffice
        </div>
        <ul class="nav flex-column gap-1">
            <li class="nav-item">
                <a href="{{ route('backoffice.index') }}" class="nav-link text-white">
                    <i class="bi bi-house me-2"></i> Dashboard
                </a>
            </li>
            {{-- Tambah menu lain di sini nanti --}}
        </ul>

        <div class="mt-auto">
            <form method="POST" action="{{ route('auth.logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">
                    <i class="bi bi-box-arrow-left me-2"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    {{-- Konten --}}
    <div id="main-wrapper">
        <div id="content">
            @yield('content')
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>