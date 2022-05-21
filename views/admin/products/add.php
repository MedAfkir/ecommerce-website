<!DOCTYPE html>
<html lang="fr" class="light-style layout-menu-fixed">
  <?php require(ROOT . 'views/templates/admin/head.php'); ?>
  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <?php require(ROOT . 'views/templates/admin/aside.php'); ?>
        <div class="layout-page">
          <?php require(ROOT . 'views/templates/admin/navbar.php'); ?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <h4 class="fw-bold py-3 mb-4">
                    <span class="text-muted fw-light">Produit/</span> Ajouter
                  </h4>
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Ajouter produit</h5>
                    </div>
                    <div class="card-body">
                      <form action="<?= BASE_URL_ADMIN ?>/product/add" method="POST">
                        <div class="mb-3">
                          <label class="form-label" for="label">Libellé</label>
                          <input
                            type="text"
                            class="form-control"
                            id="label"
                            name="label"
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="categories-list">Catégories</label>
                          <select
                            name="category"
                            id="categories-list"
                            class="form-select"
                          >
                            <option value="-1">All</option>
                            <?php foreach ($categories as $category): ?>
                              <option value="<?= $category['id'] ?>"><?= $category['label'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="quantity-product">Quantité</label>
                          <input
                            type="number"
                            class="form-control"
                            id="quantity-product"
                            name="quantity"
                            value="1"
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="desc-product">
                            Description
                          </label>
                          <textarea id="desc-product" class="form-control" name="description"></textarea>
                        </div>
                        <?php if (isset($errors['length'])): ?>
                          <div class="mb-2 text text-danger d-flex align-items-center">
                            <i class="menu-icon tf-icons bx bx-error"></i>
                            <?= $errors['length'] ?>
                          </div>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary mt-3">
                          Ajouter
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-md-3"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <?php require(ROOT . 'views/templates/admin/scripts.php'); ?>
  </body>
</html>
