<?= $this->extend('./layouts/base_layout') ?>

<?= $this->section('content') ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Cart</li>
  </ol>
</nav>

<h3 class="mb-4">Keranjang kamu</h3>

<div class="row g-3">
  <div class="col-12 col-lg-8">
    <div class="d-flex flex-column gap-2">
      <?php if (empty($carts)): ?>
        <!-- Empty Cart State -->
        <div class="card p-3">
          <div class="d-flex flex-column justify-content-center align-items-center text-center">
            <h5>Keranjang Anda kosong. Harap tambahkan beberapa produk ke keranjang Anda.</h5>
          </div>
        </div>
      <?php else: ?>
        <!-- Render Cart Items -->
        <?php foreach ($carts as $c): ?>
          <div class="card d-flex justify-content-between p-3">
            <div class="d-flex align-items-center gap-0">
              <img src="<?= $c['file_path'] ?>" width="100px" alt="">
              <div class="d-flex flex-column">
                <h5><?= $c['product_name'] ?></h5>
                <span>Price: Rp <?= number_format($c['price'], 0, ',', '.') ?></span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <!-- Order Summary -->
  <div class="col">
    <form action="/payment" method="POST">
      <div class="card p-3 d-flex flex-column gap-3">
        <h5>Ringkasan Pesanan</h5>
        <div class="d-flex justify-content-between">
          <span>Total</span>
          <span>Rp <?= number_format($totalPrice, 0, ',', '.') ?></span>
        </div>

        <!-- Hidden input for total price -->
        <input type="hidden" name="total_price" value="<?= $totalPrice ?>">

        <!-- Payment Button -->
        <button type="submit" class="btn btn-primary" <?= empty($carts) ? 'disabled' : '' ?>>Pembayaran</button>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>