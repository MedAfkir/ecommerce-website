<!DOCTYPE html>
<html lang="en">
  <?php require(ROOT . 'views/templates/head.php'); ?>
  <body>
    <?php require(ROOT . 'views/templates/header.php'); ?>

    <div id="breadcrumb">
      <div class="container">
        <ul class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?= BASE_URL ?>/">Home</a>
          </li>
          <li class="breadcrumb-item">
            <a href="<?= BASE_URL ?>/category/<?= $product['id_category'] ?>">
              <?= $product['category_label'] ?>
            </a>
          </li>
          <li class="breadcrumb-item">
            <a>
              <?= $product['label'] ?>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <section id="product">
      <div class="container">
        <div class="product">
          <div class="product-info">
            <h2 class="title">
              <?= $product['label'] ?>
            </h2>
            <div class="tags">
              <a class="tag" href="<?= BASE_URL ?>/category/<?= $product['id_category'] ?>"><?= $product['category_label'] ?></a>
            </div>
            <div class="price">
              <span class="current-price"><?= $product['price'] ?></span>
            </div>
            <a id="add-to-cart" href="<?= BASE_URL ?>/product/<?= $product['id'] ?>/add-to-cart">
              Ajouter à la carte
            </a>
            <ul class="description">
              <span>Description</span>
              <?php foreach (explode("\n", $product['description']) as $l): ?>
                <li><?= $l; ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="similar-products"></section>

    <!-- Footer -->
    <?php require(ROOT . 'views/templates/footer.php'); ?>

    <?php require(ROOT . 'views/templates/scripts.php'); ?>
  </body>
</html>
