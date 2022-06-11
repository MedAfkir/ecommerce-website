<?php

  namespace App\Models\Admin;

  class Categories extends Model {
    public function __construct() {
      $this->table = 'categories';
    }

    public function findAll() {
      return $this->requete("SELECT categories.id, categories.label, categories.color, categories.added_at, COUNT(*) as `nbr_products` FROM categories
        INNER JOIN products ON products.id_category = categories.id
        GROUP BY categories.id
                
        UNION

        SELECT categories.id, categories.label, categories.color, categories.added_at, 0 as `nbr_products` FROM categories
        WHERE categories.id NOT IN (SELECT products.id_category FROM products)")->fetchAll();
    }
  }
