<?php

  namespace App\Models;

  class Products extends Model {
    public function __construct() {
      $this->table = 'products';
    }
    
    public function findAll() {
      return $this->requete('SELECT products.id, products.label, products.description, products.price, products.quantity, products.id_category, categories.label
        FROM products ' . $this->table .
        ' INNER JOIN categories
        ON categories.id = products.id_category')->fetchAll();
    }
    
    public function find(int $id) {
      return $this->requete('SELECT products.id, products.label, products.description, products.price, products.quantity, products.id_category, categories.label as `category_label`
        FROM products ' . $this->table .
        ' INNER JOIN categories
        ON categories.id = products.id_category
        WHERE products.id = ?', [$id])->fetch();
    }
  }
