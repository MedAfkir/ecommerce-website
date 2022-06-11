<!DOCTYPE html>
<html lang="fr" class="light-style layout-menu-fixed">
  <?php require(ROOT . 'views/templates/admin/head.php'); ?>
  <body>
    <?php if(isset($success)): if ($success): ?>
      <div
        class="alert alert-info alert-dismissible position-absolute"
        style="right: 20px; top: 20px"
        role="alert"
      >
        La modification a réussi
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="alert"
          aria-label="Close"
        ></button>
      </div>
    <?php endif; endif; if(isset($errors['state'])): ?>
      <div
        class="alert alert-danger alert-dismissible position-absolute"
        style="right: 20px; top: 20px"
        role="alert"
      >
        La modification a echoué
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="alert"
          aria-label="Close"
        ></button>
      </div>
    <?php endif; ?>
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
                    <span class="text-muted fw-light">Produit/</span> Modifier
                  </h4>
                  <div class="card mb-4">
                    <div
                      class="card-header d-flex justify-content-between align-items-center"
                    >
                      <h5 class="mb-0">Modifier produit</h5>
                    </div>
                    <div class="card-body">
                      <form action="<?= BASE_URL_ADMIN ?>/product/<?= $product['id'] ?>/edit" method="POST">
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname"
                            ># ID</label
                          >
                          <input
                            type="text"
                            class="form-control"
                            id="basic-default-fullname"
                            value="<?= $product['id'] ?>"
                            disabled
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname"
                            >Libellé</label
                          >
                          <input
                            type="text"
                            class="form-control"
                            id="basic-default-fullname"
                            name="label"
                            value="<?= $product['label'] ?>"
                          />
                        </div>
                        <?php if (isset($errors['label'])): ?>
                          <ul>
                            <?php foreach ($errors['label'] as $value): ?>
                              <li class="form-text text-danger"><?= $value ?></li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endif; ?>
                        <div class="mb-3">
                          <label class="form-label" for="categories-list">
                            Catégories</label
                          >
                          <select
                            name="category"
                            id="categories-list"
                            class="form-select"
                          >
                            <?php foreach ($categories as $category): ?>
                              <option <?php if($category['id'] == $product['id_category']): ?> selected <?php endif; ?> value="<?= $category['id'] ?>"><?= $category['label'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <?php if (isset($errors['category'])): ?>
                          <ul>
                            <?php foreach ($errors['category'] as $value): ?>
                              <li class="form-text text-danger"><?= $value ?></li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endif; ?>
                        <div class="mb-3">
                          <label class="form-label" for="price-product">
                            Prix
                          </label>
                          <input
                            type="text"
                            class="form-control"
                            id="price-product"
                            name="price"
                            value="<?= $product['price'] ?>"
                          />
                        </div>
                        <?php if (isset($errors['price'])): ?>
                          <ul>
                            <?php foreach ($errors['price'] as $value): ?>
                              <li class="form-text text-danger"><?= $value ?></li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endif; ?>
                        <div class="mb-3">
                          <label class="form-label" for="quantity-product"
                            >Quantité</label
                          >
                          <input
                            type="number"
                            class="form-control"
                            id="quantity-product"
                            name="quantity"
                            value="<?= $product['quantity'] ?>"
                          />
                        </div>
                        <?php if (isset($errors['quantity'])): ?>
                          <ul>
                            <?php foreach ($errors['quantity'] as $value): ?>
                              <li class="form-text text-danger"><?= $value ?></li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endif; ?>
                        <div class="mb-3">
                          <label class="form-label" for="desc-product">
                            Description
                          </label>
                          <textarea
                            id="desc-product"
                            class="form-control"
                            name="description"
                          ><?= $product['description'] ?></textarea>
                        </div>
                        <?php if (isset($errors['description'])): ?>
                          <ul>
                            <?php foreach ($errors['description'] as $value): ?>
                              <li class="form-text text-danger"><?= $value ?></li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endif; ?>
                        <button type="submit" class="btn btn-primary mt-3">
                          Modifier
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
