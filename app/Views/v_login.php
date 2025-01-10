<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ANT STORE</title>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    :root {
      --bs-primary: #444444;
      --bs-light-primary: #444444;
      --bs-primary-rgb: 53, 47, 68;
      --bs-cream: #FAF0E6
    }

    body {
      margin: 0;
    }

    a {
      text-decoration: none;
      color: black;
    }

    a:hover {
      text-decoration: underline;
    }

    .btn-primary {
      background-color: var(--bs-primary);
      border-color: var(--bs-primary);
    }

    .btn-primary:hover,
    .btn-primary:active {
      background-color: #4f4666 !important;
      border-color: #4f4666;
    }


    .btn-outline-primary {
      color: var(--bs-primary);
      border-color: var(--bs-primary);
    }

    .btn-outline-primary:hover {
      color: white;
      border-color: var(--bs-primary);
      background-color: var(--bs-primary);
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
  <main>
    <div class="row" style="width: 100%; height: 100dvh; margin: 0">
      <div class="col d-flex justify-content-start align-items-center">
        <form action="<?php echo base_url(); ?>/login/submit?redirectTo=<?php echo esc($_GET['redirectTo'] ?? ''); ?>" method="post" style="width: 100%">
          <div class="d-flex flex-column justify-content-start align-items-center gap-4">
            <img src="/assets/images/logo_ant.png" alt="" width="100px" height="100px">
            <h3>Selamat datang di Toko ANT</h3>

            <h5>Login</h5>
            <?php if (session()->getFlashData('failed')) : ?>
              <div class="alert alert-danger" role="alert">
                <?php echo session("failed") ?>
              </div>
            <?php endif; ?>

            <?php if (session()->getFlashData('success')) : ?>
              <div class="alert success alert-success" role="alert">
                <?php echo session("success") ?>
              </div>
            <?php endif; ?>

            <div class="card p-4 rounded-lg card-auth">
              <div class="mb-3">
                <label for="username" class="form-label">Alamat Email</label>
                <input class="form-control" name="username" id="username" placeholder="Input your username">
              </div>
              <div>
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="••••••">
              </div>
            </div>

            <div>
              <button type="submit" class="btn btn-primary px-5" style="width: 100%">Login</button>
              <p class="text-primary mt-2">Belum punya akun? <a style="font-weight: 700; text-decoration: underline" href="/register">Daftar sekarang</a></p>
            </div>
        </form>
      </div>
    </div>
    <div class="col d-none d-lg-block" style="height: 100%; padding: 0">
      <img src="/assets/images/img_ant.png" alt="" width="100%" height="100%">
    </div>
    </div>
  </main>

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
  </script>
</body>

</html>