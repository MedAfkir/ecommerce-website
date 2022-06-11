<?php

  namespace App\Models;

  class Categories extends Model {
    public function __construct() {
      $this->table = 'categories';
    }

    public function findProductsByCategory(int $id) {
      return $this->requete('SELECT products.id, products.label, products.description, products.price, products.quantity, products.id_category, categories.label as `category_label`
        FROM products
        INNER JOIN categories ON products.id_category = categories.id
        WHERE products.id_category = ?', [$id])->fetchAll();
    }
  }
