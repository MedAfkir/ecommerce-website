<?php

  namespace App\Models\Admin;

  class Search extends Model {
    public function __construct() {}

    public function getUsers($query) {
      $clients = $this->requete("SELECT * FROM users
        INNER JOIN clients ON users.id = clients.id
        WHERE users.firstname LIKE '%$query%'
          OR users.lastname LIKE '%$query%'
          OR users.email LIKE '%$query%'
          OR clients.adresse LIKE '%$query%'")->fetchAll();

      $admins = $this->requete("SELECT * FROM users
        INNER JOIN admins ON users.id = admins.id
        WHERE users.firstname LIKE '%$query%'
          OR users.lastname LIKE '%$query%'
          OR users.email LIKE '%$query%'")->fetchAll();

      foreach($admins as $k => $admin) {
        $admins[$k]['is-admin'] = true;
        $admins[$k]['is-client'] = false;
      }

      foreach($clients as $k => $client) {
        $clients[$k]['is-client'] = true;
        $clients[$k]['is-admin'] = false;
      }

      return array_merge($clients, $admins);
    }

    public function getProducts($query) {
      $products = $this->requete("SELECT products.id, products.label, products.description, products.price, products.quantity, products.id_category, products.added_at, categories.label as `label_category`, categories.description as `description_ategories` FROM products
        INNER JOIN categories ON categories.id = products.id_category
        WHERE products.label LIKE '%$query%'
          OR products.description LIKE '%$query%'
          OR categories.label LIKE '%$query%'
          OR categories.description LIKE '%$query%'")->fetchAll();

      return $products;
    }

    public function getCategories($query) {
      $categories = $this->requete("SELECT * FROM categories
        WHERE categories.label LIKE '%$query%'
          OR categories.description LIKE '%$query%'")->fetchAll();

      return $categories;
    }
  }