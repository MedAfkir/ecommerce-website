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
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);">
                        <i class="bx bx-user me-1"></i>
                        Compte
                      </a>
                    </li>
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Informations personnelles</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form action="<?= BASE_URL_ADMIN ?>/user/<?= $user['id'] ?>/edit" method="POST">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Prénom</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="firstname"
                              value="<?= $user['firstname'] ?>"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Nom</label>
                            <input
                              class="form-control"
                              type="text"
                              name="lastname"
                              id="lastName"
                              value="<?= $user['lastname'] ?>"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="<?= $user['email'] ?>"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="birthday" class="form-label">
                              Date de naissance
                            </label>
                            <input
                              type="date"
                              class="form-control"
                              id="birthday"
                              name="birthday"
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
                                  <label for="grade" class="form-label">
                                    Grade
                                  </label>
                                  <select name="grade" id="grade-list" class="form-select">
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
                                  <label for="numTel" class="form-label">
                                    Numéro de téléphone
                                  </label>
                                  <input
                                    type="text"
                                    class="form-control"
                                    id="numTel"
                                    name="numTel"
                                    value="<?= $user['numTel'] ?>" />
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label for="adresse" class="form-label">
                                    Adresse
                                  </label>
                                  <input
                                    type="text"
                                    class="form-control"
                                    id="adresse"
                                    name="adresse"
                                    value="<?= $user['adresse'] ?>" />
                                </div>
                              </div>
                            </div>
                          <?php endif; endif; ?>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">
                            Enregistrer
                          </button>
                        </div>
                      </form>
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
