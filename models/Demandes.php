<?php

  namespace App\Models;

  class Demandes extends Model {
      protected $id;

      protected $id_product;

      protected $id_client;

      protected $quantity;

      public function __construct() {
        $this->table = 'demandes';
      }

      public function findAll() {
        return $this->requete('SELECT users.firstname, users.lastname, ' . $this->table . '.id_user, ' . $this->table . '.id, ' . $this->table . '.id_product, ' . $this->table . '.quantity, products.label FROM users
          INNER JOIN ' . $this->table . ' ON ' . $this->table . '.id_user = users.id
          INNER JOIN products ON products.id = ' . $this->table . '.id_product')->fetchAll();
      }

      /**
       * Obtenir la valeur de id
       */
      public function getId() : int {
        return $this->id;
      }

      /**
       * Définir la valeur de id
       *
       * @return  self
       */ 
      public function setId(int $id) : self {
        $this->id = $id;

        return $this;
      }

      /**
       * Obtenir la valeur d'id de client
       */ 
      public function getIdClient() : string {
        return $this->id_client;
      }

      /**
       * Définir la valeur d'id de client
       *
       * @return  self
       */ 
      public function setIdClient(string $id) : self {
        $this->id_client = $id;

        return $this;
      }

      /**
       * Obtenir la valeur d'id de produit
       */ 
      public function getIdProduct() : string {
        return $this->id_product;
      }

      /**
       * Définir la valeur d'id de produit
       *
       * @return self
       */ 
      public function setIdProduct(string $id_product) : self {
        $this->id_product = $id_product;

        return $this;
      }

      /**
       * Obtenir la valeur de quantité
       */ 
      public function getQuantity() {
        return $this->quantity;
      }

      /**
       * Définir la valeur de quantité
       *
       * @return  self
       */ 
      public function setQuantity($quantity) : self {
        $this->quantity = $quantity;
        return $this;
      }
  }
