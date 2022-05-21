<?php

  namespace App\Admin\Controller;
  
  use \Exception;
  use \Validation;
  use \Validations;
  
  class Demandes extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Demandes");
      $this->loadModel("Users");
      $this->loadModel("Products");
    }
    
    public function index() {
      $demandes = $this->Demandes->findAll();
      $this->render('index', compact('demandes'));
    }
    
    public function get($params = []) {
      $demande = $this->Demandes->find($params['id']);
      
      if (!$demande)
        throw new Exception("Demande d'identifiant " . $params['id'] . " non trouvée");

      $this->render('demande', compact('demande'));
    }
    
    public function add($params = []) {
      $users = $this->Users->findAll();
      $products = $this->Products->findAll();
      $this->render('add', compact('products', 'users'));
    }
    
    public function postAdd($params = []) {
      $user = $this->Users->find($params['user']);
      $product = $this->Products->find($params['product']);

      if (!$user)
        throw new Exception("Utilisateur non trouvé");

      if (!$product)
        throw new Exception("Produit non trouvé");
  
      $validation = new Validations([
        (new Validation('product', $params['product'], 'int'))
          ->setLabel('ID de produit')
          ->setRequired(true)
          ->setMin(1),
        (new Validation('user', $params['user'], 'int'))
          ->setLabel('ID d\'utilisateur')
          ->setRequired(true)
          ->setMin(1),
        (new Validation('quantity', $params['quantity'], 'int'))
          ->setLabel('Quantité')
          ->setRequired(true)
          ->setMin(1)
          ->setMax($product['quantity']),
      ]);

      $hasErrors = $validation->hasErrors();
      $errors = $validation->getErrors();
      $success = $validation->isSuccess();
        
      if ($success) {
        $this->Demandes->create([
          'id_user' => htmlspecialchars(trim($params['user'])),
          'id_product' => htmlspecialchars(trim($params['product'])),
          'quantity' => htmlspecialchars(trim($params['quantity']))
        ]);

        $this->Products->update($product['id'], [
          'quantity' => $product['quantity'] - ((int) $params['quantity'])
        ]);
      }
      
      $users = $this->Users->findAll();
      $products = $this->Products->findAll();
      $this->render('add', compact('errors', 'success', 'users', 'products'));
    }

    public function edit($params = []) {
      $demande = $this->Demandes->find($params['id']);
      
      if (!$demande)
        throw new Exception("Demande d'identifiant " . $params['id'] . " non trouvée");

      $this->render('edit', compact('demande'));
    }

    public function postEdit($params = []) {
      $params['id'] = (int) $params['id'];
      $demande = $this->Demandes->find($params['id']);

      if (!$demande)
        throw new Exception("Demande d'identifiant " . $params['id'] . " non trouvée");

      $validation = new Validations([
        (new Validation('quantity', $params['quantity'], 'int'))
          ->setLabel('Quantité')
          ->setRequired(true)
          ->setMin(1)
      ]);

      $hasErrors = $validation->hasErrors();
      $errors = $validation->getErrors();
      $success = $validation->isSuccess();

      if ($success) {
        $state = $this->Demandes->update($params['id'], [
          'quantity' => htmlspecialchars(trim($params['quantity']))
        ]);

        if ($state) {
          $success = true;
          $demande = $this->Demandes->find($params['id']);
        } else {
          $errors['state'] = 'La modification a echoué';
          $success = false;
        }
      }

      $this->render('edit', compact('demande', 'errors', 'success'));
    }

    public function delete($params) {
      $demande = $this->Demandes->find($params['id']);

      if (!$demande)
        throw new Exception("Demande d'id " . $params['id'] . ' non trouvé');

      $id = $params['id'];
      $this->render('delete', compact('id'));
    }

    public function postDelete($params) {
      $demande = $this->Demandes->find($params['id']);

      if (!$demande)
        throw new Exception("Demande d'id " . $params['id'] . ' non trouvé');

      $this->Demandes->delete($params['id']);
      
      header('Location: ' . BASE_URL_ADMIN . '/demandes/');
      die();
    }
  }