<?php

  namespace App\Models;

  class Profil extends Model {
    public function __construct() {
      $this->table = 'users';
    }
    
    public function find(int $id) {
      return $this->requete('SELECT users.id, users.firstname, users.lastname, users.birthday, users.email, users.created_at, clients.numTel, clients.adresse, COUNT(*) as `nbr_demandes` FROM users
        INNER JOIN clients ON clients.id = users.id
        INNER JOIN demandes ON demandes.id_user = users.id

        UNION

        SELECT users.id, users.firstname, users.lastname, users.birthday, users.email, users.created_at, clients.numTel, clients.adresse, 0 as `nbr_demandes` FROM users
        INNER JOIN clients ON clients.id = users.id
        WHERE users.id NOT IN (SELECT demandes.id_user FROM demandes)
          AND users.id = ?', [$id])->fetch();
    }

    public function findDemandes(int $id) {
      return $this->requete('SELECT demandes.id, demandes.quantity, demandes.id_product, demandes.requested_at, products.label, products.price
        FROM demandes
        INNER JOIN users
          ON users.id = demandes.id_user
        INNER JOIN products
          ON products.id = demandes.id_product
        WHERE users.id = ?', [$id])->fetchAll();
    }
  }
