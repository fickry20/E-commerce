<?= $this->extend('./layouts/dashboard_layout') ?>

<?= $this->section('content') ?>
<section>
  <h3>Edit Produk</h3>
  <div class="card-body py-3">
    <form action="<?= base_url('/admin/product/edit/update') ?>" method="post" enctype="multipart/form-data">
      <!-- CSRF Protection -->
      <?= csrf_field() ?>

      <div class="card p-4 rounded-lg">
        <div class="row row-cols-2">
          <!-- Kategori -->
          <div class="col form-group mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select name="category_id" class="form-control form-select" id="category">
              <option value="">-- Pilih Kategori --</option>
              <?php foreach ($categories as $c): ?>
                <option value="<?= $c['category_id'] ?>" <?= $c['category_id'] == old('category_id', $product['category_id']) ? 'selected' : '' ?>>
                  <?= esc($c['category_name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
            <?php if (isset($validation) && $validation->hasError('category_id')): ?>
              <small class="text-danger"><?= $validation->getError('category_id') ?></small>
            <?php endif; ?>
          </div>
          <!-- Hapus -->
          <div class="col form-group mb-3">
            <label for="category" class="form-label">Hapus Produk</label>
            <select name="category_id" class="form-control form-select" id="category">
              <option value="">-- Hapus produk? --</option>
              <?php foreach ($categories as $c): ?>
                <option value="<?= $c['category_id'] ?>" <?= $c['category_id'] == old('category_id', $product['category_id']) ? 'selected' : '' ?>>
                  <?= esc($c['category_name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
            <?php if (isset($validation) && $validation->hasError('category_id')): ?>
              <small class="text-danger"><?= $validation->getError('category_id') ?></small>
            <?php endif; ?>
          </div>

          <!-- Brand -->
          <div class="col form-group mb-3">
            <label for="brand" class="form-label">Brand</label>
            <select name="brand_id" class="form-control form-select" id="brand">
              <option value="">-- Pilih Brand --</option>
              <?php foreach ($brands as $b): ?>
                <option value="<?= $b['brand_id'] ?>" <?= $b['brand_id'] == old('brand_id', $product['brand_id']) ? 'selected' : '' ?>>
                  <?= esc($b['brand_name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
            <?php if (isset($validation) && $validation->hasError('brand_id')): ?>
              <small class="text-danger"><?= $validation->getError('brand_id') ?></small>
            <?php endif; ?>
          </div>

          <!-- Nama Produk -->
          <div class="col mb-3">
            <label for="product_name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" name="product_name" id="product_name"
              placeholder="Masukkan nama produk" value="<?= old('product_name', $product['product_name']) ?>">
            <?php if (isset($validation) && $validation->hasError('product_name')): ?>
              <small class="text-danger"><?= $validation->getError('product_name') ?></small>
            <?php endif; ?>
          </div>

          <!-- Deskripsi -->
          <div class="col mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" name="description" id="description"
              placeholder="Masukkan deskripsi produk"><?= old('description', $product['description']) ?></textarea>
            <?php if (isset($validation) && $validation->hasError('description')): ?>
              <small class="text-danger"><?= $validation->getError('description') ?></small>
            <?php endif; ?>
          </div>

          <!-- Rating -->
          <div class="col mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" step="0.1" class="form-control" name="rating" id="rating" placeholder="Masukkan rating"
              value="<?= old('rating', $product['rating']) ?>">
            <?php if (isset($validation) && $validation->hasError('rating')): ?>
              <small class="text-danger"><?= $validation->getError('rating') ?></small>
            <?php endif; ?>
          </div>

          <!-- Harga -->
          <div class="col mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" name="price" id="price" placeholder="Masukkan harga"
              value="<?= old('price', $product['price']) ?>">
            <?php if (isset($validation) && $validation->hasError('price')): ?>
              <small class="text-danger"><?= $validation->getError('price') ?></small>
            <?php endif; ?>
          </div>

          <!-- Files -->
          <div class="col mb-3">
            <label for="files" class="form-label">Upload Gambar</label>
            <input type="file" multiple class="form-control" name="files[]" id="files">
            <?php if (isset($validation) && $validation->hasError('files')): ?>
              <small class="text-danger"><?= $validation->getError('files') ?></small>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Tombol Submit -->
      <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
  </div>
</section>
<?= $this->endSection() ?>