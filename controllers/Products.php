<?php

  namespace App\Controller;

  class Products extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Demandes");
      $this->loadModel("Products");
    }
    
    public function index($params = []) {
      $product = $this->Products->find($params['id']);

      $this->render('index', compact('product'));
    }
    
    public function addToCart($params = []) {
      $product = $this->Products->find($params['id']);

      if (!$product)
        new Exception("Produit d'identifiant " . $params['id'] . " non trouvé");

      $productAlreadyAdded = false;
      
      if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $p) {
          if ($p['id'] == $product['id']) {
            $_SESSION['cart'][$key]['quantity']++;
            $productAlreadyAdded = true;
            break;
          }
        }
      } else {
        $_SESSION['cart'] = [];
      }

      if (!$productAlreadyAdded) {
        $_SESSION['cart'] = array_merge($_SESSION['cart'], [
          [
            'id' => $product['id'],
            'label' => $product['label'],
            'price' => $product['price'],
            'quantity' => 1
          ]
        ]);
      }

      header('Location: ' . BASE_URL . '/cart');
      die();
    }

    public function requestProducts($params = []) {
      
    }
  }