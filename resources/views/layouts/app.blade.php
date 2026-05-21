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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        h1,h2,h3,h4,h5 {
            font-family: 'Poppins', sans-serif;
            letter-spacing: -0.5px;
        }

        /* navbar */
        #navbar {
            width: 250px;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            background-color: #212529;
        }

        /* Main content geser sesuai lebar navbar */
        #main-wrapper {
            display: flex;
            flex-direction: column;
        }

        #content {
            flex: 1;
            padding: 0px;
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- navbar --}}
    @include('components.navbar')

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
    {{-- Modal Register --}}
    @include('auth.register')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
