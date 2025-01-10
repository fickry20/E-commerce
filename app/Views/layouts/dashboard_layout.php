<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ANT STORE</title>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
  <link rel="icon" href="<?= base_url() ?>assets/images/logo_ant.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    :root {
      --bs-primary: #444444;
      --bs-light-primary: #444444;
      --bs-primary-rgb: 53, 47, 68;
      --bs-cream: #FAF0E6
    }

    a {
      text-decoration: none;
      color: black;
    }

    .btn-primary {
      background-color: var(--bs-primary);
      border-color: var(--bs-primary);
    }

    .btn-primary:hover,
    .btn-primary:active {
      background-color: var(--bs-light-primary) !important;
      border-color: var(--bs-light-primary);
    }

    .nav-link {
      color: black;
      opacity: 60%;
    }

    .nav-link:hover {
      color: var(--bs-primary);
      opacity: 100%;
    }

    .navbar-nav .nav-link.active,
    .navbar-nav .nav-link.show {
      color: var(--bs-primary);
      opacity: 100%;
    }

    .btn-outline-primary {
      color: var(--bs-primary) !important;
      border-color: var(--bs-primary) !important;
    }

    .btn-outline-primary:hover,
    .btn-outline-primary:active,
    .btn-check:checked+.btn,
    .btn.active,
    .btn.show,
    .btn:first-child:active,
    :not(.btn-check)+.btn:active {
      color: white !important;
      border-color: var(--bs-primary) !important;
      background-color: var(--bs-primary) !important;
    }

    .btn:disabled {
      border-color: grey;
      background-color: grey;
    }

    .navbar-dark .navbar-nav .nav-link.active,
    .navbar-dark .navbar-nav .nav-link:hover,
    .navbar-dark .navbar-nav .nav-link:focus {
      color: var(--bs-primary);
    }

    .border-primary {
      border-color: var(--bs-primary);
    }

    .alert-primary {
      background-color: var(--bs-primary);
      border-color: var(--bs-primary);
    }

    .form-control:focus {
      border-color: #4f4666;
      box-shadow: none;
    }
  </style>
</head>

<body>
  <div class="d-flex" style="width: 100%;">
    <!-- Sidebar -->
    <aside class="px-4 position-fixed d-flex flex-column" style="height: 100dvh; width: 16rem; background-color: var(--bs-primary)">
      <nav class="navbar navbar-expand-lg d-flex flex-column align-items-start gap-4">
        <!-- Brand -->
        <a class="navbar-brand text-white mt-3" style="font-weight: 700; font-size: 32px; text-decoration: none" href="#">
          ANT STORE
        </a>
        <!-- Toggler -->
        <button class="navbar-toggler mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Menu -->
        <div class="collapse navbar-collapse mt-3" id="navbarMenu">
          <ul class="navbar-nav d-flex flex-column gap-3 w-100">
            <li class="nav-item w-100">
              <a class="nav-link text-white d-flex align-items-center gap-2" href="/admin/manage-product">
                Manage Product
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="container-fluid" style="margin-left: 16rem; padding: 1.5rem;">
      <?= $this->renderSection('content') ?>
    </main>
  </div>


  <!-- SCRIPT -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/218d5eb4ba.js" crossorigin="anonymous"></script>
  <script>
    feather.replace();

    $(".success").fadeTo(2000, 500).slideUp(500, function() {
      $(".success").slideUp(500);
    });

    $(".failed").fadeTo(2000, 500).slideUp(500, function() {
      $(".failed").slideUp(500);
    });

    function checkDesktopAccess() {
      const isDesktop = window.innerWidth > 1024; // Lebar minimum untuk desktop

      if (!isDesktop && window.location.pathname !== '/unsupported') {
        window.location.href = '/unsupported';
      }
    }

    // Panggil fungsi saat halaman dimuat
    window.addEventListener('load', checkDesktopAccess);

    // Tambahkan listener jika pengguna mengubah ukuran jendela browser
    window.addEventListener('resize', checkDesktopAccess);
  </script>

  <?= $this->renderSection('scripts') ?>
</body>

</html>