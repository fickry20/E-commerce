<?= $this->extend('./layouts/dashboard_layout') ?>

<?= $this->section('content') ?>
<section>
  <h3>Create Product</h3>
  <div class="card-body py-3">
    <form action="<?php echo base_url(); ?>/admin/product/create/submit" method="post" enctype="multipart/form-data">
      <div class="card p-4 rounded-lg">
        <div class="row row-cols-2">
          <div class="col form-group mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category_id" class="form-control form-select" id="category">
              <option value="">--please select--</option>
              <?php foreach ($categories as $c) : ?>
                <option value="<?= $c['category_id'] ?>">
                  <?= $c['category_name'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col form-group mb-3">
            <label for="brand" class="form-label">Brand</label>
            <select name="brand_id" class="form-control form-select" id="brand">
              <option value="">--please select--</option>
              <?php foreach ($brands as $b) : ?>
                <option value="<?= $b['brand_id'] ?>">
                  <?= $b['brand_name'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input class="form-control" name="product_name" id="product_name" placeholder="Input product name">
          </div>
          <div class="col mb-3">
            <label for="description" class="form-label">Description</label>
            <input class="form-control" name="description" id="description" placeholder="Input description">
          </div>
          <div class="col mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="text" inputmode="number" class="form-control" name="rating" id="rating" placeholder="Input rating">
          </div>
          <div class="col mb-3">
            <label for="price" class="form-label">Price</label>
            <input class="form-control" name="price" id="price" placeholder="Input price">
          </div>
          <div class="col mb-3">
            <label for="files" class="form-label">Files</label>
            <input type="file" multiple class="form-control" name="files[]" id="files">
          </div>

        </div>
      </div>

      <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
  </div>
</section>

<?= $this->endSection() ?>