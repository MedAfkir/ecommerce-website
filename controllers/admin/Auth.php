<?php

  namespace App\Admin\Controller;
  
  use \Exception;
  use \Validation;
  use \Validations;

  class Auth extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Auth");
    }

    public function login($params) {
      $this->render('login');
    }

    public function postLogin($params = []) {
      if (!isset($params['username']) || !isset($params['password']))
        throw new Exception("Username or password invalid!");

      $validation = new Validations([
        (new Validation('username', $params['username'], 'alphanum'))
        ->setLabel('Nom d\'utilisateur')
        ->setRequired(true)
        ->setMin(6),
        (new Validation('password', $params['password'], 'text'))
          ->setLabel('Mot de passe')
          ->setRequired(true)
          ->setRequired(10)
      ]);

      $errors = $validation->getErrors();

      $user = $this->Auth->login($params['username'], $params['password']);

      if ($validation->isSuccess()) {
        if ($user) {
          if (PHP_SESSION_NONE === session_status())
            session_start();
          $_SESSION['auth'] = $user['id'];

          header('Location: ' . BASE_URL_ADMIN . '/');
          die();  
        } else {
          $errors['auth'] = "Nom d'utilisateur ou mot de passe incorrecte";
        }
      }
      $this->render('login', compact('user', 'errors'));
    }

    public function signup($params) {
      $this->render('signup');
    }

    public function postSignup($params = []) {
      $validation = new Validations([
        (new Validation('firstname', $params['firstname'], 'words'))
          ->setLabel('Prénom')
          ->setRequired(true),
        (new Validation('lastname', $params['lastname'], 'words'))
          ->setLabel('Nom')
          ->setRequired(true),
        (new Validation('username', $params['username'], 'alphanum'))
          ->setLabel('Nom d\'utilisateur')
          ->setRequired(true)
          ->setMin(6),
        (new Validation('email', $params['email'], 'email'))
          ->setLabel('Email')
          ->setRequired(true),
        (new Validation('password', $params['password'], 'text'))
          ->setLabel('Mot de passe')
          ->setRequired(true)
          ->setRequired(10),
        (new Validation('birthday', $params['birthday'], 'date_ymd'))
            ->setLabel('Date de naissance')
            ->setRequired(true),
      ]);

      $errors = $validation->getErrors();
      $success = $validation->isSuccess();

      if ($success) {
        $this->Auth->create([
          'firstname' => $params['firstname'],
          'lastname' => $params['lastname'],
          'username' => $params['username'],
          'email' => $params['email'],
          'password' => password_hash($params['password'], null),
          'birthday' => $params['birthday']
        ]);
      }

      $this->render('signup', compact('errors', 'success'));
    }

    public function logout() {
      session_start();
      session_destroy();
      header('Location: ' . BASE_URL_ADMIN . '/');
      die();
    }
  }