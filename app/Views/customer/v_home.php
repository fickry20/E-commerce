<?= $this->extend('./layouts/base_layout') ?>

<?= $this->section('content') ?>
<section>
  <img src="/assets/images/img_ant_landscape.png" alt="img_ant_landscape" width="100%">

  <div class="row row-cols-2 row-cols-lg-4 mt-2 g-3" style="width: 100%;">
    <?php foreach ($topSelling as $p): ?>
      <div class="col">
        <div class="card-product">
          <img src="<?= $p['file_path'] ?>" alt="">
          <div class="d-flex flex-column text-center p-4" style="background-color: #F2F2F2;">
            <h5 style="font-weight: 700; color: var(--bs-primary);"><?= $p['product_name'] ?></h5>
            <span style="font-weight: 700; opacity: 80%">Rp <?= number_format($p['price'], 0, ',', '.') ?></span>
            <form action="<?= base_url() ?>add-to-cart/<?= $p['product_id'] ?>" method="POST">
              <button type="submit" class="btn">
                <i class="fa-solid fa-cart-shopping"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?= $this->endSection() ?>