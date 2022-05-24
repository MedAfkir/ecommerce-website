<?php

  namespace App\Admin\Controller;
  
  use \Exception;
  use \Validation;
  use \Validations;

  class Users extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Users");
      $this->loadModel("Admins");
      $this->loadModel("Clients");
      $this->loadModel("Demandes");
    }
    
    public function index() {
      $users = $this->Users->requete('SELECT users.id, users.firstname, users.lastname, users.email, admins.id as `id_admin`, clients.id as `id_client`, COUNT(users.id) as `nbr_demande` from users
        LEFT JOIN admins ON admins.id = users.id
        LEFT JOIN clients ON clients.id = users.id
        INNER JOIN demandes ON demandes.id_user = users.id
        GROUP BY users.id
        
        UNION
        
        SELECT users.id, users.firstname, users.lastname, users.email, admins.id as `id_admin`, clients.id as `id_client`, 0 as `nbr_demande` from users
        LEFT JOIN admins ON admins.id = users.id
        LEFT JOIN clients ON clients.id = users.id
        WHERE users.id NOT IN (SELECT demandes.id_user FROM demandes)')->fetchAll();

      $this->render('index', compact('users'));
    }
    
    public function get($params = []) {
      $user = $this->Users->find($params['id']);
      
      if (!$user)
      throw new Exception("Utilisateur d'identifiant " . $params['id'] . " non trouvé");
      
      $demandes = $this->Demandes->requete(
        'SELECT
          demandes.id,
          demandes.id_product,
          demandes.quantity,
          demandes.id_user,
          products.label
        FROM demandes
        INNER JOIN products ON demandes.id_product = products.id
        WHERE demandes.id_user = ?', [$params['id']])
        ->fetchAll();

      $this->render('get', compact('user', 'demandes'));
    }

    public function edit($params = []) {
      $user = $this->Users->find($params['id']);
      
      if (!$user)
        throw new Exception("Utilisateur d'identifiant " . $params['id'] . " non trouvé");
      
      $admin = $this->Admins->find($params['id']);
      $client = $this->Clients->find($params['id']);

      $user = array_merge(
        $user,
        $client ? array_merge($client, ['is-client' => true]) : [],
        $admin ? array_merge($admin, ['is-admin' => true]) : []
      );


      $errors = null;
      if (isset($params['errors']))
        $errors = $params['errors'];

      $success = null;
      if (isset($params['success']))
        $success = $params['success'];

      $this->render('edit', compact('user', 'errors', 'success'));
    }

    public function postEdit($params = []) {
      $admin = $this->Admins->find($params['id']);
      $client = $this->Clients->find($params['id']);
      $user = $this->Users->find($params['id']);

      if (!$user) {
        throw new Exception("Utilisateur d'identifiant " . $params['id'] . " non trouvé");
      }

      if ($client) {
        $user['is-client'] = true;
        $user = array_merge($user, $client);
      } else {
        $user['is-client'] = false;
      }

      if ($admin) {
        $user['is-admin'] = true;
        $user = array_merge($user, $admin);
      } else {
        $user['is-admin'] = false;
      }

      $userValidation = [
        (new Validation('firstname', $params['firstname'], 'words'))
          ->setLabel('Prénom')
          ->setRequired(true),
        (new Validation('lastname', $params['lastname'], 'words'))
          ->setLabel('Nom')
          ->setRequired(true),
        (new Validation('email', $params['email'], 'email'))
          ->setLabel('Email')
          ->setRequired(true),
        (new Validation('birthday', $params['birthday'], 'date_ymd'))
          ->setLabel('Date de naissance')
          ->setRequired(true),
      ];

      $adminValidation = [];
      if ($user['is-admin']) {
        $adminValidation = [
          (new Validation('grade', $params['grade'], 'int'))
            ->setLabel('Grade')
            ->setRequired(true)
        ];
      }

      $clientValidation = [];
      if ($user['is-client']) {
        $clientValidation = [
          (new Validation('adresse', $params['adresse'], 'text'))
            ->setLabel('Adresse')
            ->setRequired(true),
          (new Validation('numTel', $params['numTel'], 'tel'))
            ->setLabel('Numéro de téléphone')
            ->setRequired(true)
        ];
      }

      $validation = new Validations(array_merge($userValidation, $adminValidation, $clientValidation));
      $errors = $validation->getErrors();
      $success = $validation->isSuccess();

      if ($success) {
        $this->Users->update($params['id'], [
          'firstname' => htmlspecialchars(trim($params['firstname'])),
          'lastname' => htmlspecialchars(trim($params['lastname'])),
          'birthday' => htmlspecialchars(trim($params['birthday'])),
          'email' => htmlspecialchars(trim($params['email'])),
          'birthday' => htmlspecialchars(trim($params['birthday']))
        ]);

        if (isset($user['is-admin'])) if ($user['is-admin'])
          $this->Admins->update($params['id'], [
            'grade' => htmlspecialchars(trim($params['grade'])),
          ]);

        if (isset($user['is-client'])) if ($user['is-client'])
          $this->Clients->update($params['id'], [
            'adresse' => htmlspecialchars(trim($params['adresse'])),
            'numTel' => htmlspecialchars(trim($params['numTel']))
          ]);
        
        if ($admin) {
          $user = array_merge($user, $admin);
          $user['is-admin'] = true;
        } else {
          $user['is-admin'] = false;
        }
        if ($client) {
          $user = array_merge($user, $client);
          $user['is-client'] = true;
        } else {
          $user['is-client'] = false;
        }
      } else {
        $this->render('edit', compact('user', 'errors', 'success'));
      }

      header('Location: ' . BASE_URL_ADMIN . "/user/" . $user['id']);
      die();
    }

    public function delete($params = []) {
      $user = $this->Users->find($params['id']);

      if (!$user)
        throw new Exception("Utilisateur d'id " . $params['id'] . ' non trouvé');

      $id = $params['id'];
      $this->render('delete', compact('id'));
    }

    public function postDelete($params = []) {
      $user = $this->Users->find($params['id']);

      if (!$user)
        throw new Exception("Utilisateur d'id " . $params['id'] . ' non trouvé');

      $admin = $this->Admins->find($params['id']);
      if ($admin)
        $this->Admins->delete($params['id']);

      $client = $this->Clients->find($params['id']);
      if ($client)
        $this->Clients->delete($params['id']);

      $this->Users->delete($params['id']);

      header('Location: ' . BASE_URL_ADMIN . '/users/');
      die();
    }

    public function profil($params = []) {
      $this->get(['id' => $params['auth']]);
    }
  }