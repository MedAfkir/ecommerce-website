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
                      <form action="<?= BASE_URL_ADMIN ?>/product/add"
                        enctype="multipart/form-data" method="POST"
                      >
                        <div class="mb-3">
                          <label class="form-label" for="label">Libellé</label>
                          <input
                            type="text"
                            class="form-control"
                            id="label"
                            name="label"
                          />
                        </div>
                        <?php if(isset($errors['label'])): ?>
                          <ul>
                            <?php foreach($errors['label'] as $error): ?>
                              <li class="form-text text-danger"><?= $error ?></li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endif; ?>
                        <div class="mb-3">
                          <label for="product-img" class="form-label">Image</label>
                          <input class="form-control" type="file" id="product-img" name="image" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="categories-list">Catégories</label>
                          <select
                            name="category"
                            id="categories-list"
                            class="form-select"
                          >
                            <option value="-1">Tous</option>
                            <?php foreach ($categories as $category): ?>
                              <option value="<?= $category['id'] ?>"><?= $category['label'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <?php if(isset($errors['category'])): ?>
                          <ul>
                            <?php if(isset($errors['category']['exist'])): ?>
                              <li class="form-text text-danger"><?= $errors['category']['exist'] ?></li>
                            <?php endif; ?>
                          </ul>
                        <?php endif; ?>
                        <div class="mb-3">
                          <label class="form-label" for="price-product">Prix</label>
                          <input
                            type="text"
                            class="form-control"
                            id="price-product"
                            name="price"
                            placeholder="0.00"
                          />
                        </div>
                        <?php if(isset($errors['price'])): ?>
                          <ul>
                            <?php foreach($errors['price'] as $error): ?>
                              <li class="form-text text-danger"><?= $error ?></li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endif; ?>
                        <div class="mb-3">
                          <label class="form-label" for="quantity-product">Quantité</label>
                          <input
                            type="number"
                            class="form-control"
                            id="quantity-product"
                            name="quantity"
                            placeholder="1"
                          />
                        </div>
                        <?php if(isset($errors['quantity'])): ?>
                          <ul>
                            <?php foreach($errors['quantity'] as $error): ?>
                              <li class="form-text text-danger"><?= $error ?></li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endif; ?>
                        <div class="mb-3">
                          <label class="form-label" for="desc-product">
                            Description
                          </label>
                          <textarea id="desc-product" class="form-control" name="description"></textarea>
                        </div>
                        <?php if(isset($errors['description'])): ?>
                          <ul>
                            <?php foreach($errors['description'] as $error): ?>
                              <li class="form-text text-danger"><?= $error ?></li>
                            <?php endforeach; ?>
                          </ul>
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
