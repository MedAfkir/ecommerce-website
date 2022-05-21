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
                  <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5>Produits</h5>
                      <a href="<?= BASE_URL_ADMIN ?>/product/add" class="menu-link btn btn-primary">
                        <i class="menu-icon tf-icons bx bx-plus"></i>
                        <span>Ajouter</span>
                      </a>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table
                          class="table table-striped table-borderless border-bottom"
                        >
                          <thead>
                            <tr>
                              <th class="text-nowrap"># ID</th>
                              <th class="text-nowrap text-center">
                                👩🏻‍💻 Libellé
                              </th>
                              <th class="text-nowrap text-center">
                                # ID catégorie
                              </th>
                              <th class="text-nowrap text-center">
                                👩🏻‍💻 Quantité
                              </th>
                              <th class="text-nowrap text-center">🖥 Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($products as $product): ?>
                              <tr>
                                <td class="text-nowrap"><?= $product['id'] ?></td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                    <?= strToTitle($product['label']) ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                    <?= $product['id_category'] ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                    <?= $product['quantity'] ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-around">
                                    <a
                                      href="<?= BASE_URL_ADMIN ?>/product/<?= $product['id'] ?>/"
                                      title="Voir"
                                      type="button"
                                      class="btn btn-icon btn-outline-success"
                                    >
                                      <i class="bx bx-show"></i>
                                    </a>
                                    <a
                                      title="Modifier"
                                      href="<?= BASE_URL_ADMIN ?>/product/<?= $product['id'] ?>/edit"
                                      type="button"
                                      class="btn btn-icon btn-outline-warning"
                                    >
                                      <i class="bx bx-edit"></i>
                                    </a>
                                    <a
                                      href="<?= BASE_URL_ADMIN ?>/product/<?= $product['id'] ?>/delete"
                                      title="Supprimer"
                                      type="button"
                                      class="btn btn-icon btn-outline-danger"
                                    >
                                      <i class="bx bx-trash"></i>
                                    </a>
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
