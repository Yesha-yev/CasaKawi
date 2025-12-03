<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1 0 auto;
    }

    footer {
        flex-shrink: 0;
        margin-top: auto;
    }

    .footer-icon {
        font-size: 26px;
        margin-right: 12px;
        animation: bounce 2s infinite ease-in-out;
        color: #444;
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-6px);
        }
    }
</style>

<main>
</main>

<footer class="bg-light text-muted py-4 border-top">
  <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">

    <div class="d-flex align-items-center mb-3 mb-md-0">
      <i class="fa-solid fa-landmark footer-icon"></i>
      <div>
        <strong>Casa Kawi</strong> — Galeri Digital Budaya Jawa Timur<br>
        &copy; {{ date('Y') }} Casa Kawi. All rights reserved.
      </div>
    </div>

    <div class="text-end">
      <small>Kontak: <a href="mailto:info@casakawi.com">info@casakawi.com</a></small><br>
      <small><a href="#" class="text-muted">Kebijakan Privasi</a> · <a href="#" class="text-muted">Syarat & Ketentuan</a></small>
    </div>

  </div>
</footer>
