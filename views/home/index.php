<!DOCTYPE html>
<html>
  <?php require(ROOT . 'views/templates/head.php'); ?>
  <body>
    <!-- Header -->
    <?php require(ROOT . 'views/templates/header.php'); ?>

    <main>
      <div class="container">
        <!-- SideBar -->
        <div class="sidebar">
          <div class="categories-list">
            <div class="list-title">
              <span>categories</span>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-chevron-down"
              >
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </div>
            <ul>
              <?php foreach($categories as $c): ?>
                <li>
                  <a href="<?= BASE_URL ?>/category/<?= $c['id'] ?>">
                    <?= $c['label'] ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="content">
          <div class="products-box">
            <h2 class="title">Produits trés demandés</h2>
            <div class="products">
              <?php foreach($topProducts as $p): ?>
                <div class="product">
                  <div class="product-bordered">
                    <!-- <div class="product-img">
                      <img
                        src="images/products/AMD-Ryzen-9-3900X-12-core.jpg"
                        width="100%"
                        alt="<?= $p['label'] ?>"
                      />
                    </div> -->
                    <div class="product-content">
                      <div class="product-title">
                        <a
                          href="<?= BASE_URL ?>/product/<?= $p['id'] ?>"
                          title="<?= $p['label'] ?>"
                        >
                          <?= $p['label'] ?>
                        </a>
                      </div>
                      <div class="product-price">
                        <span class="current-price"><?= $p['price'] ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="products-box">
            <h2 class="title">Produits récents</h2>
            <div class="products">
              <?php foreach($recentsProducts as $p): ?>
                <div class="product">
                  <div class="product-bordered">
                    <!-- <div class="product-img">
                      <img
                        src="images/products/AMD-Ryzen-9-3900X-12-core.jpg"
                        width="100%"
                      />
                    </div> -->
                    <div class="product-content">
                      <div class="product-title">
                        <a
                          href="<?= BASE_URL ?>/product/<?= $p['id'] ?>"
                          title="<?= $p['label'] ?>"
                        >
                          <?= $p['label'] ?>
                        </a>
                      </div>
                      <div class="product-price">
                        <span class="current-price"><?= $p['price'] ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <?php require(ROOT . 'views/templates/footer.php'); ?>

    <?php require(ROOT . 'views/templates/scripts.php'); ?>
  </body>
</html>
