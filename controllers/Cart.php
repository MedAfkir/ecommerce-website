<?php

  namespace App\Controller;
  
  class Cart extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Demandes");
      $this->loadModel("Products");
    }

    public function index($params = []) {
      $products = $params['cart'] ?? [];
      $this->render('index', compact('products'));
    }

    public function removeFromCart($params = []) {
      if (isset($_SESSION['cart'])) {
        $cartProducts = [];
        foreach($_SESSION['cart'] as $p) {
          if ($p['id'] != $params['id'])
            $cartProducts[] = $p;
        }

        $_SESSION['cart'] = $cartProducts;
      }
      
      header('Location: ' . BASE_URL . '/cart');
      die();
    }

    public function requestProducts($params = []) {
      if (!isset($params['auth-client'])) {
        echo json_encode([
          'success' => false,
          'message' => "Vous devez se connecter pour demander ta commande"
        ]);
        die();
      }

      foreach($params['cart'] as $p) {
        $this->Demandes->create([
          'id_user' => $params['auth-client'],
          'id_product' => $p['id'],
          'quantity' => $p['quantity'],
          'requested_at	' => date('Y-m-d h:i:s')
        ]);

        $product = $this->Products->find($p['id']);
        $this->Products->update($p['id'], [
          'quantity' => $product['quantity'] - $p['quantity']
        ]);
      }

      echo json_encode([
        'success' => true,
        'message' => "Votre commande a été traitée avec succées"
      ]);
      die();
    }

    public function editQuantity($params = []) {
      $product = $this->Products->find($params['idProduct']);

      if (!$product) {
        echo json_encode(false);
        die();
      }

      if ((int) $params['quantity'] > (int) $product['quantity'] ||
        (int) $params['quantity'] < 1) {
        echo json_encode(false);
        die();
      }

      echo json_encode(+$params['quantity']);
      foreach($_SESSION['cart'] as $k => $p) {
        if ($p['id'] == $product['id'])
          $_SESSION['cart'][$k]['quantity'] = +$params['quantity'];
      }
      die();
    }
  }