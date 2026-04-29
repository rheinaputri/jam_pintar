<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        /* Sidebar */
        #sidebar {
            width: 250px;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            background-color: #212529;
        }

        /* Main content geser sesuai lebar sidebar */
        #main-wrapper {
            margin-left: 250px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #content {
            flex: 1;
            padding: 24px;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Sidebar --}}
    @include('components.sidebar')

    <div id="main-wrapper">
        {{-- Header --}}
        @include('components.header')

        {{-- Konten Halaman --}}
        <main id="content">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('components.footer')
    </div>

    {{-- Modal Login --}}
    @include('auth.login')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>