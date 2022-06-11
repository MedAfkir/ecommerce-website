<?php

  namespace App\Models;

  class Home extends Model {
    public function __construct() {
      $this->table = 'products';
    }

    public function getTopProducts($limit = 10) {
      return $this->requestWithSpecificTypes("SELECT products.id, products.label, products.description, products.quantity, products.id_category, products.price, COUNT(products.id) as `nbr` FROM products
        INNER JOIN demandes ON demandes.id_product = products.id
        GROUP BY products.id
        ORDER BY nbr DESC
        LIMIT :limit",
        [':limit' => [ 'value' => intval($limit), 'type' => \PDO::PARAM_INT]]
      )->fetchAll();
    }

    public function getRecentsProducts($limit = 10) {
      return $this->requestWithSpecificTypes("SELECT * FROM products
        ORDER BY id DESC
        LIMIT :limit",
        [':limit' => [ 'value' => intval($limit), 'type' => \PDO::PARAM_INT]]
      )->fetchAll();
    }
  }
