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
        <li class="nav-item"><a class="nav-link" href="#peta">Peta</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('statistik') ?? '#' }}">Statistik</a></li>
        <li class="nav-item">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a class="nav-link" href="{{ route('admin.laporan') }}">Laporan</a>
                @else
                    <a class="nav-link" href="{{ url('/#form-laporan') }}">Laporan</a>
                @endif
            @else
                <a class="nav-link" href="{{ url('/#form-laporan') }}">Laporan</a>
            @endauth
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
  .nav-custom .nav-link {
    position: relative;
    margin-right: 12px;
    font-weight: 500;
    transition: 0.25s;
  }

  .nav-custom .nav-link:hover {
    color: #694d28;
  }

  .nav-custom .nav-link::after {
    content: "";
    position: absolute;
    width: 0%;
    height: 2px;
    left: 0;
    bottom: 0;
    background: #694d28;
    transition: 0.3s;
  }

  .nav-custom .nav-link:hover::after {
    width: 100%;
  }

  .brand-text {
    transition: 0.3s;
  }

  .navbar-brand:hover .brand-text {
    color: #694d28;
  }
</style>
