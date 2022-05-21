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
                    <span class="text-muted fw-light">Demande/</span> Modifier
                  </h4>
                  <div class="card mb-4">
                    <div
                      class="card-header d-flex justify-content-between align-items-center"
                    >
                      <h5 class="mb-0">Modifier demande</h5>
                    </div>
                    <div class="card-body">
                      <form action="<?= BASE_URL_ADMIN ?>/demande/<?= $demande['id'] ?>/edit" method="POST">
                        <div class="mb-3">
                          <label class="form-label" for="demande-id"
                            ># ID</label
                          >
                          <input
                            type="text"
                            class="form-control"
                            id="demande-id"
                            value="<?= $demande['id'] ?>"
                            disabled
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">
                            # ID produit
                          </label>
                          <input
                            type="text"
                            class="form-control"
                            id="basic-default-company"
                            value="<?= $demande['id_product'] ?>"
                            disabled
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="client-id-demande"
                            ># ID client</label
                          >
                          <input
                            type="text"
                            class="form-control"
                            id="client-id-demande"
                            value="<?= $demande['id_user'] ?>"
                            disabled
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="quantity-demande"
                            >Quantité</label
                          >
                          <input
                            type="number"
                            class="form-control"
                            id="quantity-demande"
                            name="quantity"
                            value="<?= $demande['quantity'] ?>"
                          />
                        </div>
                        <?php if (isset($errors['quantity'])): ?>
                          <ul>
                            <?php foreach ($errors['quantity'] as $value): ?>
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
