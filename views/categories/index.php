<!DOCTYPE html>
<html>
  <?php require(ROOT . 'views/templates/head.php'); ?>
  <body>
    <!-- Header -->
    <?php require(ROOT . 'views/templates/header.php'); ?>

    <div id="breadcrumb">
      <div class="container">
        <ul class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?= BASE_URL ?>/">Home</a>
          </li>
          <li class="breadcrumb-item">
            <a>
              <?= $category['label'] ?>
            </a>
          </li>
        </ul>
      </div>
    </div>

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
            <div class="title">
              <h2>
                <?= $category['label'] ?>
              </h2>
              <span>
                <?= count($products); ?>
                <?= count($products) != 1 ? 'produits trouvés' : 'produit trouvé' ?>
              </span>
            </div>
            <div class="products">
              <?php foreach($products as $p): ?>
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
