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
    :root {
        --brown-dark: #4A2E17;
        --brown-primary: #5D3A1A;
        --brown-soft: #C89F74;
        --brown-light: #DCC4A1;
        --text-light: #F7F3EB;
    }

    body {
        background-color: var(--brown-light);
        font-family: "Poppins", sans-serif;
        color: var(--text-light);
    }

    .content-wrap {
        padding-top: 1.5rem;
        padding-bottom: 2.5rem;
    }

    .card {
        background: #efe7db !important;
        border: none;
        border-radius: 16px;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.3);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 25px rgba(0,0,0,0.35);
        cursor: pointer;
    }

    .card-img-top {
        height: 220px;
        object-fit: cover;
        border-bottom: 4px solid var(--brown-soft);
    }

    label {
        font-weight: 600;
        color: var(--brown-primary);
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 2px solid var(--brown-soft);
        background: #fff;
        color: #333;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--brown-primary);
        box-shadow: 0 0 8px rgba(93, 58, 26, .3);
    }

    .btn-primary,
    .btn-brown {
        background-color: var(--brown-primary) !important;
        border-color: var(--brown-primary) !important;
        border-radius: 10px;
        font-weight: 600;
        color: #fff;
    }
    .btn-primary:hover,
    .btn-brown:hover {
        background-color: var(--brown-soft) !important;
        border-color: var(--brown-soft) !important;
        color: #fff;
    }

    .btn-secondary {
        background-color: transparent;
        border: 2px solid var(--brown-primary);
        color: var(--brown-primary);
        border-radius: 10px;
        font-weight: 600;
    }
    .btn-secondary:hover {
        background-color: var(--brown-soft);
        color: #fff;
    }

    #map {
        border-radius: 12px;
        border: 4px solid var(--brown-soft);
        box-shadow: 0 3px 10px rgba(0,0,0,0.2);
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
