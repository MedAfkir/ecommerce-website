<?php

  namespace App\Models;

  class Products extends Model {
      protected $id;

      protected $label;

      protected $description;

      protected $id_category;

      protected $quantity;


      public function __construct() {
        $this->table = 'products';
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
       * Obtenir la valeur de libellé
       */ 
      public function getLabel() : string {
        return $this->label;
      }

      /**
       * Définir la valeur de libellé
       *
       * @return  self
       */ 
      public function setLabel(string $label) : self {
        $this->label = $label;

        return $this;
      }

      /**
       * Obtenir la valeur de description
       */ 
      public function getDescription() : string {
        return $this->description;
      }

      /**
       * Définir la valeur de description
       *
       * @return self
       */ 
      public function setDescription(string $description) : self {
        $this->description = $description;

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
