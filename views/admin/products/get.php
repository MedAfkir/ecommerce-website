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
                <div class="col-md-12">
                  <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                      <button 
                        type="button"
                        class="nav-link active"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#product-infos"
                        aria-controls="product-infos"
                        aria-selected="true"
                      >
                        Informations
                      </button>
                    </li>
                    <li class="nav-item mx-3">
                      <button 
                        type="button"
                        class="nav-link"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#product-demandes"
                        aria-controls="product-demandes"
                        aria-selected="false"
                      >
                        Demandes
                      </button>
                    </li>
                  </ul>
                  <div class="tab-content card">
                    <div class="tab-pane fade show active" id="product-infos" role="tabpanel">
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label class="form-label">Libellé</label>
                          <p class="form-control">
                            <?= $product['label'] ?>
                          </p>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">Quantité</label>
                          <p class="form-control">
                            <?= $product['quantity'] ?>
                          </p>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">Catégorie</label>
                          <p class="form-control">
                            <a href="<?= BASE_URL_ADMIN ?>/category/<?= $product['id_category'] ?>">
                              <?= $product['id_category'] ?>
                            </a>
                          </p>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">Prix</label>
                          <p class="form-control">
                            <?= $product['price'] ?>
                          </p>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">Description</label>
                          <ul style="border: 1px solid #d9dee3; border-radius: 0.375rem; padding: 0.4375rem 0.875rem 0.4375rem 1.775rem;">
                            <?php foreach(explode("\n", $product['description']) as $line): ?>
                              <li><?= $line ?></li>
                            <?php endforeach; ?>
                          </ul>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">Ajouté le</label>
                          <p class="form-control">
                            <?= (new DateTime($product['added_at']))->format('h:m d-m-Y') ?>
                          </p>
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                          <a
                            title="Supprimer"
                            href="<?= BASE_URL_ADMIN ?>/product/<?= $product['id'] ?>/delete"
                            type="button"
                            class="btn btn-danger mx-3"
                          >
                            <i class="bx bx-trash"></i>
                            Supprimer
                          </a>
                          <a
                            title="Modifier"
                            href="<?= BASE_URL_ADMIN ?>/product/<?= $product['id'] ?>/edit"
                            type="button"
                            class="btn btn-warning"
                          >
                            <i class="bx bx-edit"></i>
                            Modifier
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="product-demandes" role="tabpanel">
                      <div class="table-responsive">
                        <table class="table table-striped table-borderless border-bottom">
                          <thead>
                            <tr>
                              <th class="text-nowrap"># ID demande</th>
                              <th class="text-nowrap text-center">Nom d'utilisateur</th>
                              <th class="text-nowrap text-center">Quantité</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($demandes as $demande): ?>
                              <tr>
                                <td class="text-nowrap">
                                  <strong><?= $demande['id'] ?></strong>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                    <a href="<?= BASE_URL_ADMIN ?>/user/<?= $demande['id_user'] ?>">
                                      <?= strtoupper($demande['lastname']) . ' ' . ucfirst($demande['firstname']); ?>
                                    </a>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                    <?= $demande['quantity']; ?>
                                  </div>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <?php require(ROOT . 'views/templates/admin/scripts.php'); ?>
  </body>
</html>
