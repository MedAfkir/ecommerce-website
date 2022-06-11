<?php

  namespace App\Models\Admin;

  class Demandes extends Model {
    public function __construct() {
      $this->table = 'demandes';
    }

    public function findAll() {
      return $this->requete('SELECT users.firstname, users.lastname, demandes.id_user, demandes.id, demandes.id_product, demandes.quantity, demandes.requested_at, products.label FROM users
        INNER JOIN demandes ON demandes.id_user = users.id
        INNER JOIN products ON products.id = demandes.id_product')->fetchAll();
    }

    public function find(int $id) {
      return $this->requete(
        'SELECT
          demandes.id,
          demandes.id_product,
          demandes.quantity,
          demandes.id_user,
          demandes.requested_at,
          products.label,
          users.firstname,
          users.lastname
        FROM demandes
        INNER JOIN users ON demandes.id_user = users.id
        INNER JOIN products ON demandes.id_product = products.id
        WHERE demandes.id = ?', [$id])->fetch();
    }
  }
