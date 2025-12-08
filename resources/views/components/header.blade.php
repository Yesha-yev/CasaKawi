<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm nav-custom">
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

                <li class="nav-item"><a class="nav-link" href="{{ url('/#peta') }}">Peta</a></li>

                @if (Route::has('statistik'))
                    <li class="nav-item"><a class="nav-link" href="{{ route('statistik') }}">Statistik</a></li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('karya.index') }}">Karya</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('budaya.index') }}">Budaya</a>
                </li>

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

                        {{-- ADMIN --}}
                        @if(auth()->user()->role === 'admin')
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.seniman.index') }}">Kelola Seniman</a></li>

                        {{-- SENIMAN --}}
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
    background: #efe7db !important;
    border-bottom: 2px solid #b89b72;
}

.nav-link {
    color: #4b3a24 !important;
}

.nav-link:hover {
    color: #6e4f2f !important;
}

.navbar-brand .brand-text {
    color: #4b3a24;
}

.navbar-brand:hover .brand-text {
    color: #6e4f2f;
}

.dropdown-menu {
    background: #f2e5d5;
    border-radius: 10px;
}

.dropdown-item:hover {
    background: #e3d3c5;
}

</style>
