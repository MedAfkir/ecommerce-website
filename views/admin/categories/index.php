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
                      <h5>Catégories</h5>
                      <div class="d-flex align-items-center">
                        <form class="d-flex mx-4" id="search-categories">
                          <div class="input-group">
                            <span class="input-group-text"><i class="tf-icons bx bx-search"></i></span>
                            <input type="text" class="form-control" placeholder="Chercher categories...">
                          </div>
                        </form>
                        <a href="<?= BASE_URL_ADMIN ?>/category/add" class="menu-link btn btn-primary">
                          <i class="menu-icon tf-icons bx bx-plus"></i>
                          <span>Ajouter</span>
                        </a>
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
                              <th class="text-nowrap text-center">🖥 Couleur</th>
                              <th class="text-nowrap text-center">🖥 Ajouté le</th>
                              <th class="text-nowrap text-center">🖥 nbr de produits</th>
                              <th class="text-nowrap text-center">🖥 Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($categories as $category): ?>
                              <tr>
                                <td class="text-nowrap">
                                  <strong><?= $category['id'] ?></strong>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                  <?= $category['label'] ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                    <div
                                      class="badge"
                                      style="background: <?= $category['color'] ?>"
                                    >
                                      <?= $category['color'] ?>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                    <?= (new DateTime($category['added_at']))->format('h:i d-m-Y') ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                    <?= $category['nbr_products'] ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-around">
                                    <a
                                      title="Voir"
                                      href="<?= BASE_URL_ADMIN ?>/category/<?= $category['id'] ?>"
                                      class="btn btn-icon btn-outline-success"
                                    >
                                      <i class="bx bx-show"></i>
                                    </a>
                                    <a
                                      title="Modifier"
                                      href="<?= BASE_URL_ADMIN ?>/category/<?= $category['id'] ?>/edit"
                                      class="btn btn-icon btn-outline-warning"
                                    >
                                      <i class="bx bx-edit"></i>
                                    </a>
                                    <a
                                      title="Supprimer"
                                      href="<?= BASE_URL_ADMIN ?>/category/<?= $category['id'] ?>/delete"
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
      document.querySelector('#search-categories').addEventListener('submit', (e) => {
        e.preventDefault();
        const query = e.target[0].value;
        if (query != "")
          window.location = `<?= BASE_URL_ADMIN . '/search/categories/' ?>${query}`;
      })
    </script>
  </body>
</html>
