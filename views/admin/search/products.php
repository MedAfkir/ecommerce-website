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
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <div class="d-flex align-items-center">
                        <h5 class="m-0"><?= count($products) ?> Produits trouvés pour la requête:</h5>
                        <span class="mx-3 badge bg-label-primary"><?= $query ?></span>
                      </div>
                      <div>
                        <form class="d-flex mx-4" id="search-products">
                          <div class="input-group">
                            <span class="input-group-text"><i class="tf-icons bx bx-search"></i></span>
                            <input type="text" class="form-control" placeholder="Chercher produits...">
                          </div>
                        </form>
                      </div>
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
                                👩🏻‍💻 Prix
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
                                    <a href="<?= BASE_URL_ADMIN ?>/category/<?= $product['id_category'] ?>">
                                      <?= $product['label_category'] ?>
                                    </a>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                    <?= $product['price'] ?>
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
    <script>
      document.querySelector('#search-products').addEventListener('submit', (e) => {
        e.preventDefault();
        const query = e.target[0].value;
        if (query != "")
          window.location = `<?= BASE_URL_ADMIN . '/search/products/' ?>${query}`;
      })
    </script>
  </body>
</html>
