<?php

  namespace App\Models;

  class Auth extends Model {
    public function __construct() {
      $this->table = 'clients';
    }

    public function findAll() {
      $query = $this->requete('SELECT * FROM '. $this->table . ' INNER JOIN users ON users.id = ' . $this->table . '.id');
      return $query->fetchAll();
    }

    public function signup($params) {
      $existUser = $this
      ->requete('SELECT * FROM users WHERE username = ?', [$params['username']])
      ->fetch();
      
      if ($existUser)
        return false;
      
      $userAttr = [
        'firstname' => $params['firstname'],
        'lastname' => $params['lastname'],
        'username' => $params['username'],
        'email' => $params['email'],
        'password' => $params['password'],
        'birthday' => $params['birthday']
      ];
      $champs = [];
      $inter = [];
      $valeurs = [];
      foreach($userAttr as $champ => $valeur){
        $champs[] = $champ;
        $inter[] = "?";
        $valeurs[] = $valeur;
      }
      
      // On transforme le tableau "champs" en une chaine de caractères
      $liste_champs = implode(', ', $champs);
      $liste_inter = implode(', ', $inter);
      $this->requete(
        "INSERT INTO users(" . $liste_champs . ") VALUES(" .$liste_inter. ")",
        $valeurs
      );

      $user = $this->requete('SELECT id FROM users WHERE username = ?', [$params['username']])->fetch();

      $this->create([
        'id' => $user['id'],
        'numTel' => $params['numTel'],
        'adresse' => $params['adresse']
      ]);
      return true;
    }

    public function login(string $username, string $password) {
      $users = $this->findAll();

      if (!isset($users[0]))
        return false;

      if (password_verify($password, $users[0]['password']))
        return $users[0];

      return false;
    }
  }
