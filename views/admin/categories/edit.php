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
        class="alert alert-info alert-dismissible position-absolute"
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
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <h4 class="fw-bold py-3 mb-4">
                    <span class="text-muted fw-light">Catégorie/</span> Modifier
                  </h4>
                  <div class="card mb-4">
                    <div
                      class="card-header d-flex justify-content-between align-items-center"
                    >
                      <h5 class="mb-0">Modifier catégorie</h5>
                    </div>
                    <div class="card-body">
                      <form method="POST" action="<?= BASE_URL_ADMIN ?>/category/<?= $category['id'] ?>/edit">
                        <div class="mb-3">
                          <label class="form-label" for="category-id"># ID</label>
                          <input
                            type="text"
                            class="form-control"
                            id="category-id"
                            value="1"
                            disabled
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="libelle-categorie">Libellé</label>
                          <input
                            type="text"
                            class="form-control"
                            id="libelle-categorie"
                            placeholder="John Doe"
                            name="label"
                            value="<?= $category['label'] ?>"
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
                          <label class="form-label" for="description-category"
                            >Description</label
                          >
                          <textarea
                            id="description-category"
                            class="form-control"
                            placeholder="Description..."
                            name="description" 
                          ><?= $category['description'] ?></textarea>
                        </div>
                        <?php if (isset($errors['description'])): ?>
                          <ul>
                            <?php foreach ($errors['description'] as $value): ?>
                              <li class="form-text text-danger"><?= $value ?></li>
                            <?php endforeach; ?>
                          </ul>
                        <?php endif; ?>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">
                            couleur
                          </label>
                          <input
                            type="color"
                            class="form-control"
                            id="basic-default-company"
                            name="color"
                            value="<?= $category['color'] ?>"
                          />
                        </div>
                        <?php if (isset($errors['color'])): ?>
                          <ul>
                            <?php foreach ($errors['color'] as $value): ?>
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
