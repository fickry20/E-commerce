<?= $this->extend('./layouts/dashboard_layout') ?>

<?= $this->section('content') ?>
<section>
  <h1>Manage Product</h1>
  <a href="/admin/product/create" class="btn btn-primary mt-4">+ Tambah produk</a>
  <a href="/admin/product/edit/1" class="btn btn-primary mt-4"> Edit Produk</a>
  <div class="card-body py-3">
    <!-- begin::Table container -->
    <div class="table-responsive">
      <!-- begin::Table -->
      <table class="table table-bordered table-row-dashed table-row-gray-300 align-middle gs-0 gy-4" id="tabledtbuku">
        <!-- begin::Table head -->
        <thead">
          <tr class="fw-bold">
            <th>Kategori</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Rating</th>
            <th>Harga</th>
          </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $d): ?>
              <tr>
                <td><?= $d["category_name"] ?></td>
                <td><?= $d["product_name"] ?></td>
                <td><?= $d["description"] ?></td>
                <td><?= $d["rating"] ?></td>
                <td><?= $d["price"] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
      </table>
    </div>
  </div>
</section>

<?= $this->endSection() ?>