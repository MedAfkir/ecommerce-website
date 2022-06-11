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
                    <h5 class="card-header d-flex align-items-center">
                     <?= count($users) ?> Résulats pour la requête: <span class="mx-3 badge bg-label-primary"><?= $query ?></span>
                    </h5>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-borderless border-bottom">
                          <thead>
                            <tr>
                              <th class="text-nowrap"># ID</th>
                              <th class="text-nowrap text-center">👩🏻‍💻 Nom</th>
                              <th class="text-nowrap text-center">👩🏻‍💻 Etat</th>
                              <th class="text-nowrap text-center">✉️ Mail</th>
                              <th class="text-nowrap text-center">🖥 Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($users as $user): ?>
                              <tr>
                                <td class="text-nowrap">
                                  <strong><?= $user['id'] ?></strong>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                    <?= strtoupper($user['lastname']) . ' ' . ucfirst($user['firstname']); ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-around">
                                    <?php if ($user['is-client'] && !$user['is-admin']): ?>
                                      <span class="badge bg-label-primary">
                                        Client
                                      </span>
                                      <?php endif; ?>
                                    <?php if (!$user['is-client'] && $user['is-admin']): ?>
                                      <span class="badge bg-label-info">
                                        Admin
                                      </span>
                                    <?php endif; ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                  <?= $user['email']; ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-around">
                                    <a
                                    title="Voir"
                                      href="<?= BASE_URL_ADMIN ?>/user/<?= $user['id'] ?>"
                                      type="button"
                                      class="btn btn-icon btn-outline-success"
                                    >
                                      <i class="bx bx-show"></i>
                                    </a>
                                    <a
                                      title="Modifier"
                                      href="<?= BASE_URL_ADMIN ?>/user/<?= $user['id'] ?>/edit"
                                      type="button"
                                      class="btn btn-icon btn-outline-warning"
                                    >
                                      <i class="bx bx-edit"></i>
                                    </a>
                                    <a
                                      title="Supprimer"
                                      href="<?= BASE_URL_ADMIN ?>/user/<?= $user['id'] ?>/delete"
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
