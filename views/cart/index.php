<!DOCTYPE html>
<html lang="en">
  <?php require(ROOT . 'views/templates/head.php'); ?>
  <body>
    <!-- Header -->
    <?php require(ROOT . 'views/templates/header.php'); ?>

    <section id="cart">
      <div class="container">
        <?php if(!isset($_SESSION['cart']) || (isset($_SESSION['cart']) && count($_SESSION['cart']) == 0)): ?>
          <div class="empty-cart">
            <div class="cart-icon">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="80"
                height="80"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-shopping-cart"
              >
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path
                  d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"
                ></path>
              </svg>
            </div>
            <h2>Votre panier est vide !</h2>
          </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
          <div class="shopping-cart">
            <h2 class="title">Shopping Cart</h2>
            <div class="products">
              <div class="products-head">
                <span class="product">Product</span>
                <span class="price">Price</span>
                <span class="quantity">Quantity</span>
                <span class="remove">remove</span>
                <span class="subtotal">Subtotal</span>
              </div>
              <ul class="products-body">
                <?php foreach ($products as $product): ?>
                  <li class="product"
                    data-product-id="<?= $product['id'] ?>"
                    data-product-price="<?= $product['price'] ?>"
                    data-product-quantity="<?= $product['quantity'] ?>"
                  >
                    <div class="product-content">
                      <a href="<?= BASE_URL ?>/product/<?= $product['id'] ?>" class="product-title">
                        <?= $product['label'] ?>
                      </a>
                    </div>
                    <div class="product-price">
                      <span class="current-price">
                        $<?= $product['price'] ?>
                      </span>
                    </div>
                    <div class="product-quantity">
                      <button type="button" class="decrement">-</button>
                      <input type="number" name="quantity.<?= $product['id'] ?>" value="<?= $product['quantity'] ?>" />
                      <button type="button" class="increment">+</button>
                    </div>
                    <div class="product-remove">
                      <a href="<?= BASE_URL ?>/product/<?= $product['id'] ?>/remove-from-cart" type="submit">x</a>
                    </div>
                    <div class="product-subtotal">
                      $<?= ((int) $product['quantity']) * $product['price'] ?></div>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="price-total">
              <h3>Sommaire</h3>
              <div class="subtotal">
                <span class="text">sans livraison</span>
                <span class="number"></span>
              </div>
              <div class="delivery">
                <span class="text">Livraison</span>
                <span class="number">
                  <span class="free">Gratuit</span>
                </span>
              </div>
              <div class="total">
                <span class="text">total</span>
                <span class="number">$</span>
              </div>
              <button class="checkout">Demander</button>
            </div>
            <div style="clear: both;"></div>
          </div>
          
        <?php endif; ?>
      </div>
    </section>

    <div class="modal fade">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Titre</h5>
          </div>
          <div class="modal-body">Message</div>
          <div class="modal-footer">
            <button class="close">Fermer</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php require(ROOT . 'views/templates/footer.php'); ?>

    <?php require(ROOT . 'views/templates/scripts.php'); ?>
  </body>
</html>
