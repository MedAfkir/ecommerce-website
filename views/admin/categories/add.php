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
                    <span class="text-muted fw-light">Catégorie/</span> Ajouter
                  </h4>
                  <div class="card mb-4">
                    <div
                      class="card-header d-flex justify-content-between align-items-center"
                    >
                      <h5 class="mb-0">Ajouter catégorie</h5>
                    </div>
                    <div class="card-body">
                      <form method="POST" action="<?= BASE_URL_ADMIN ?>/category/add">
                        <div class="mb-3">
                          <label class="form-label" for="libelle-categorie">
                            Libellé</label
                          >
                          <input
                            type="text"
                            class="form-control"
                            id="libelle-categorie"
                            name="label"
                          />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="description-category">Description</label>
                          <textarea id="description-category" class="form-control" placeholder="Description..." name="description" ></textarea>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-company">
                            couleur
                          </label>
                          <input
                            type="color"
                            class="form-control"
                            id="basic-default-company"
                            name="color"
                          />
                        </div>
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
