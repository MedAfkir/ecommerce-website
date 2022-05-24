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
                        data-bs-target="#user-infos"
                        aria-controls="user-infos"
                        aria-selected="true"
                      >
                        Informations personnelles
                      </button>
                    </li>
                    <li class="nav-item mx-3">
                      <button 
                        type="button"
                        class="nav-link"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#user-demandes"
                        aria-controls="user-demandes"
                        aria-selected="false"
                      >
                        Demandes
                      </button>
                    </li>
                  </ul>
                  <div class="tab-content card">
                    <div class="tab-pane fade show active" id="user-infos" role="tabpanel">
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label class="form-label">Prénom</label>
                          <input
                            disabled
                            class="form-control"
                            type="text"
                            id="firstName"
                            value="<?= $user['firstname'] ?>"
                          />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">Nom</label>
                          <input
                            disabled
                            class="form-control"
                            type="text"
                            value="<?= $user['lastname'] ?>"
                          />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">E-mail</label>
                          <input
                            disabled
                            class="form-control"
                            type="text"
                            value="<?= $user['email'] ?>"
                          />
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">
                            Date de naissance
                          </label>
                          <input
                            disabled
                            type="date"
                            class="form-control"
                            value="<?= $user['birthday'] ?>"
                          />
                        </div>
                        <!-- Admin FORM -->
                        <?php if(isset($user['is-admin'])): if($user['is-admin']): ?>
                          <div class="mb-3 col-md-12">
                            <hr>
                            <h5 class="py-4">Informations administratives</h5>
                            <div class="row">
                              <div class="mb-3 col-md-6">
                                <label class="form-label">
                                  Grade
                                </label>
                                  <option value="1">Admin 1</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        <?php endif; endif; ?>
                        <!-- Client FORM -->
                        <?php if(isset($user['is-client'])): if($user['is-client']): ?>
                          <div class="mb-3 col-md-12">
                            <hr>
                            <h5 class="py-4">Informations clients</h5>
                            <div class="row">
                              <div class="mb-3 col-md-6">
                                <label class="form-label">
                                  Numéro de téléphone
                                </label>
                                <input
                                  disabled
                                  type="text"
                                  class="form-control"
                                  value="<?= $user['numTel'] ?>" />
                              </div>
                              <div class="mb-3 col-md-6">
                                <label class="form-label">
                                  Adresse
                                </label>
                                <input
                                  disabled
                                  type="text"
                                  class="form-control"
                                  value="<?= $user['adresse'] ?>" />
                              </div>
                            </div>
                          </div>
                        <?php endif; endif; ?>
                        <div class="d-flex justify-content-end mt-2">
                          <a
                            title="Supprimer"
                            href="<?= BASE_URL_ADMIN ?>/user/<?= $user['id'] ?>/delete"
                            type="button"
                            class="btn btn-danger mx-3"
                          >
                            <i class="bx bx-trash"></i>
                            Supprimer
                          </a>
                          <a
                            title="Modifier"
                            href="<?= BASE_URL_ADMIN ?>/user/<?= $user['id'] ?>/edit"
                            type="button"
                            class="btn btn-warning"
                          >
                            <i class="bx bx-edit"></i>
                            Modifier
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="user-demandes" role="tabpanel">
                      <div class="table-responsive">
                        <table class="table table-striped table-borderless border-bottom">
                          <thead>
                            <tr>
                              <th class="text-nowrap"># ID demande</th>
                              <th class="text-nowrap text-center"># ID produit</th>
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
                                    <a href="<?= BASE_URL_ADMIN ?>/product/<?= $demande['id_product'] ?>">
                                      <?= $demande['label']; ?>
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
