<?php

  namespace App\Models\Admin;

  class Users extends Model {
      protected $id;

      protected $firstname;

      protected $lastname;

      protected $birthday;

      protected $username;

      protected $password;

      protected $email;

      public function __construct() {
        $this->table = 'users';
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
       * Obtenir la valeur de prénom
       */ 
      public function getFirstname() : string {
        return $this->firstname;
      }

      /**
       * Définir la valeur de prénom
       *
       * @return  self
       */ 
      public function setFirstname(string $firstname) : self {
        $this->firstname = $firstname;

        return $this;
      }

      /**
       * Obtenir la valeur de nom
       */ 
      public function getLastname() : string {
        return $this->lastname;
      }

      /**
       * Définir la valeur de nom
       *
       * @return self
       */ 
      public function setLastname(string $lastname) : self {
        $this->lastname = $lastname;

        return $this;
      }

      /**
       * Obtenir la valeur de birthday
       */ 
      public function getBirthday() {
        return $this->birthday;
      }

      /**
       * Définir la valeur de birthday
       *
       * @return  self
       */ 
      public function setBirthday(string $birthday) : self {
        $this->birthday = $birthday;
        return $this;
      }

      /**
       * Obtenir la valeur de nom d'utilisateur
       */ 
      public function getUsername() {
        return $this->username;
      }

      /**
       * Définir la valeur de nom d'utilisateur
       *
       * @return  self
       */ 
      public function setUsername(string $username) : self {
        $this->username = $username;
        return $this;
      }

      /**
       * Obtenir la valeur de mot de passe
       */ 
      public function getPassword() {
        return $this->password;
      }

      /**
       * Définir la valeur de mot de passe
       *
       * @return  self
       */ 
      public function setPassword(string $password) : self {
        $this->password = $password;
        return $this;
      }

      /**
       * Obtenir la valeur d'email
       */ 
      public function getEmail() {
        return $this->email;
      }

      /**
       * Définir la valeur d'email
       *
       * @return  self
       */ 
      public function setEmail(string $email) : self {
        $this->email = $email;
        return $this;
      }
  }