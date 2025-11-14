<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('landing') }}">
    <img src="{{ asset('images/favicon.png') }}" alt="Logo" height="40" class="me-2">
    Casa Kawi</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
      aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="#peta">Peta</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.statistik') ?? '#' }}">Statistik</a></li>
      </ul>

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Daftar</a></li>
        @endguest

        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown"
               aria-expanded="false">
              Halo, {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
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
                  <button type="submit" class="btn btn-link text-decoration-none">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
