<?php if(PHP_SESSION_NONE == session_status()) session_start(); ?>
<header class="header">
  <div class="container">
    <!-- Logo / Left -->
    <div class="logo">
      <a href="<?= BASE_URL ?>/">Shop</a>
    </div>
    <!-- Search Bar / Center -->
    <form id="search-form">
      <input type="hidden" name="category" />
      <div class="categories-dropdown">
        <button type="button" class="select-category">All</button>
        <ul class="categories-values">
          <li>Tous</li>
          <?php foreach($categories as $c): ?>
            <li><?= $c['label'] ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <input
        type="text"
        placeholder="Cherchez un produit ..."
        autocomplete="off"
        name="query"
      />
      <button class="search-btn">Search</button>
    </form>
    <!-- Navbar / Right -->
    <div class="nav-right">
      <div id="cart-button">
        <a href="<?= BASE_URL ?>/cart" data-items="<?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>">
          <svg
            viewBox="0 0 24 24"
            width="20"
            height="20"
            stroke="currentColor"
            stroke-width="1.5"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path
              d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"
            ></path>
          </svg>
        </a>
      </div>
      <?php if(!isset($_SESSION['auth-client'])): ?>
        <div class="login-button">
          <a href="<?= BASE_URL ?>/login">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="feather feather-user"
            >
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
            Se connecter
          </a>
        </div>
      <?php endif; ?>
      <?php if(isset($_SESSION['auth-client'])): ?>
        <div class="login-button" style="margin-right: 10px">
          <a href="<?= BASE_URL ?>/profil">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="feather feather-user"
            >
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
            Profil
          </a>
        </div>
        <div class="login-button">
          <a href="<?= BASE_URL ?>/logout">
          <svg xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="feather feather-log-out"
          >
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
          </svg>
            Se déconnecter
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</header>