<!DOCTYPE html>
<html lang="fr" class="light-style layout-menu-fixed">
  <?php require(ROOT . 'views/templates/admin/head.php'); ?>
  <body>
    <?php require(ROOT . 'views/templates/admin/scripts.php'); ?>
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        <div class="layout-page">
          <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <div>
                <a class="nav-link" href="<?= BASE_URL ?>">
                  Shop
                </a>
              </div>

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                  <li class="nav-item" title="S'inscrire">
                    <a class="nav-link" href="<?= BASE_URL . '/cart' ?>">
                      <i class="menu-icon tf-icons bx bx-cart"></i>
                      Panier
                    </a>
                  </li>
                <?php if(!isset($_SESSION['auth-client'])): ?>
                  <li class="nav-item" title="Se connecter">
                    <a class="nav-link" href="<?= BASE_URL . '/login' ?>">
                      <i class="menu-icon tf-icons bx bx-user"></i>
                      Se connecter
                    </a>
                  </li>
                  <li class="nav-item" title="S'inscrire">
                    <a class="nav-link" href="<?= BASE_URL . '/signup' ?>">
                      <i class="menu-icon tf-icons bx bx-user"></i>
                      S'inscrire
                    </a>
                  </li>
                <?php endif; ?> 
                <?php if(isset($_SESSION['auth-client'])): ?>
                  <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="" data-bs-toggle="dropdown">
                      <i class="bx bx-user me-2"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li>
                        <a class="dropdown-item" href="<?= BASE_URL . '/profil' ?>">
                          <i class="bx bx-user me-2"></i>
                          <span class="align-middle">Mon Profil</span>
                        </a>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                      </li>
                      <li>
                        <a class="dropdown-item" href="<?= BASE_URL . '/logout' ?>">
                          <i class="bx bx-power-off me-2"></i>
                          <span class="align-middle">Se déconnecter</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                <?php endif; ?>
              </ul>
            </div>
          </nav>
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
                          <p class="form-control">
                            <?= $user['firstname'] ?>  
                          </p>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">Nom</label>
                          <p class="form-control">
                            <?= $user['lastname'] ?>  
                          </p>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">E-mail</label>
                          <p class="form-control">
                            <?= $user['email'] ?>  
                          </p>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">
                            Date de naissance
                          </label>
                          <p class="form-control">
                            <?= $user['birthday'] ?>  
                          </p>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">
                            Numéro de téléphone
                          </label>
                          <p class="form-control"><?= $user['numTel'] ?></p>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">
                            Adresse
                          </label>
                          <p class="form-control"><?= $user['adresse'] ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="user-demandes" role="tabpanel">
                      <div class="table-responsive">
                        <table class="table table-striped table-borderless border-bottom">
                          <thead>
                            <tr>
                              <th class="text-nowrap"># ID demande</th>
                              <th class="text-nowrap text-center"># produit</th>
                              <th class="text-nowrap text-center">Quantité</th>
                              <th class="text-nowrap text-center">Prix total</th>
                              <th class="text-nowrap text-center">Demandé le</th>
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
                                <td>
                                  <div class="d-flex justify-content-center">
                                    $<?= ((float) $demande['price']) * ((int) $demande['quantity']); ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                    <?= (new DateTime($demande['requested_at']))->format('h:i d-m-Y'); ?>
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
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
