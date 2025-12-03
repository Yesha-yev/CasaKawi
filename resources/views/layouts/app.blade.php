<!doctype html>
<html lang="id">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>@yield('title', 'Casa Kawi')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    @yield('head')

    <style>
        body {
            background: #f8f9fa;
        }

        .content-wrap {
            padding-top: 1.5rem;
            padding-bottom: 2.5rem;
        }
        .card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            border-radius: 14px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 25px rgba(0,0,0,0.18);
            cursor: pointer;
        }

        .card-img-top {
            height: 220px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    @include('components.header')

    <main class="content-wrap container">
        @yield('content')
    </main>

    @if (session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    @yield('scripts')

</body>
</html>
