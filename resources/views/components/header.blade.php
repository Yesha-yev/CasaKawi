<nav class="navbar navbar-expand-lg shadow-sm nav-custom">
    <div class="container">

        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('landing') }}">
            <img src="{{ asset('images/favicon.png') }}" alt="Logo" height="40" class="me-2">
            <span class="brand-text">Casa Kawi</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-links">

                <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}">Beranda</a></li>

                <li class="nav-item"><a class="nav-link" href="{{ url('/#map') }}">Peta</a></li>

                @if (Route::has('statistik'))
                    <li class="nav-item"><a class="nav-link" href="{{ route('statistik') }}">Statistik</a></li>
                @endif

                @auth
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.laporan') }}">Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.karya.review') }}">Tinjau Karya</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/#form-laporan') }}">Laporan</a>
                        </li>
                    @endif
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#form-laporan') }}">Laporan</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('karya.index') }}">Karya</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('budaya.index') }}">Budaya</a>
                </li>


            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 nav-links">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Daftar</a></li>
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" id="userMenu" role="button" data-bs-toggle="dropdown">
                        Halo, {{ auth()->user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                        @if(auth()->user()->role === 'admin')
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.seniman.index') }}">Kelola Seniman</a></li>

                        @elseif(auth()->user()->role === 'seniman')
                            <li><a class="dropdown-item" href="{{ route('seniman.dashboard') }}">Dashboard Seniman</a></li>
                            <li><a class="dropdown-item" href="{{ route('seniman.karya.index') }}">Karya Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('seniman.karya.create') }}">Tambah Karya</a></li>
                            <li><a class="dropdown-item" href="{{ route('seniman.profil.edit') }}">Edit Profil</a></li>
                        @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="px-3 py-1">
                                @csrf
                                <button type="submit" class="btn btn-link text-decoration-none text-start w-100">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
.navbar {
    background-image: url('/images/batik.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;

    border-bottom: 2px solid #b89b72;
}
.navbar::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(56, 41, 17, 0.75);
    z-index: 0;
}
.nav-link {
    color: #ffe8c9 !important;
}

.nav-link:hover {
    color: #928171 !important;
}
.navbar .container {
    position: relative;
    z-index: 1;
}
.navbar-brand .brand-text {
    color: #ceba9f;
}

.navbar-brand:hover .brand-text {
    color: #4e4134;
}

.dropdown-menu {
    background: #f2e5d5;
    border-radius: 10px;
}

.dropdown-item:hover {
    background: #e3d3c5;
}
.navbar-toggler {
    border-color: #998c6e !important;
    background: transparent !important;
    box-shadow: none !important;
    padding: 6px;
}
.navbar-light .navbar-toggler-icon {
    background-image: none;
}
.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba(255,232,201,1)' stroke-width='2.5' stroke-linecap='round' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
}
.card {
    background: rgba(255, 255, 255, 0.15) !important; /* transparan */
    backdrop-filter: blur(6px); /* efek kaca (opsional tapi cakep) */
    -webkit-backdrop-filter: blur(6px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
    border-radius: 16px;
    color: #f3e5b6;
}
</style>
