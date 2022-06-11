<?php

  namespace App\Admin\Controller;
  
  use \Exception;
  use \Validation;
  use \Validations;

  class Categories extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Categories");
    }
    
    public function index() {
      $categories = $this->Categories->findAll();
      $this->render('index', compact('categories'));
    }
    
    public function add($params = []) {
      $this->render('add');
    }
    
    public function postAdd($params = []) {
      $validation = new Validations([
        (new Validation('label', $params['label'], 'text'))
          ->setLabel('Libellé')
          ->setRequired(true),
        (new Validation('description', $params['description'], 'text'))
          ->setLabel('Description')
          ->setRequired(true),
        (new Validation('color', $params['color'], 'text'))
          ->setLabel('Couleur')
          ->setRequired(true)
      ]);

      $errors = $validation->getErrors();
      $success = $validation->isSuccess();

      if ($success) {
        $state = $this->Categories->create([
          'label' => htmlspecialchars(trim($params['label'])),
          'description' => htmlspecialchars(trim($params['description'])),
          'color' => htmlspecialchars(trim($params['color'])),
          'added_at' => date('Y-m-d h:i:s')
        ]);

        if (!$state) {
          $success = false;
          $errors['state'] = 'La modification a echoué';
        }
      }
      $this->render('add', compact('errors', 'success'));
    }

    public function get($params = []) {
      $category = $this->Categories->find($params['id']);

      if (!$category) {
        throw new Exception("Catégorie d'identifiant " . $params['id'] . " non trouvée");
      }
      
      $this->render('get', compact('category'));
    }

    public function edit($params = []) {
      $category = $this->Categories->find($params['id']);

      if (!$category) {
        throw new Exception("Catégorie d'identifiant " . $params['id'] . " non trouvée");
      }

      $errors = null;
      if (isset($params['errors']))
        $errors = $params['errors'];

      $success = null;
      if (isset($params['success']))
        $success = $params['success'];

      $this->render('edit', compact('category', 'errors', 'success'));
    }

    public function postEdit($params = []) {
      $params['id'] = (int) $params['id'];
      $category = $this->Categories->find($params['id']);
      
      if (!$category) {
        throw new Exception("Catégorie d'identifiant " . $params['id'] . " non trouvée");
      }

      $validation = new Validations([
        (new Validation('label', $params['label'], 'text'))
          ->setLabel('Libellé')
          ->setRequired(true),
        (new Validation('description', $params['description'], 'text'))
          ->setLabel('Description')
          ->setRequired(true),
        (new Validation('color', $params['color'], 'text'))
          ->setLabel('Couleur')
          ->setRequired(true)
      ]);

      $hasErrors = $validation->hasErrors();
      $errors = $validation->getErrors();
      $success = $validation->isSuccess();
        
      if ($success) {
        $state = $this->Categories->update($params['id'], [
          'label' => htmlspecialchars(trim($params['label'])),
          'description' => htmlspecialchars(trim($params['description'])),
          'color' => htmlspecialchars(trim($params['color']))
        ]);

        if ($state) {
          $category = $this->Categories->find($params['id']);
        } else {
          $success = false;
          $errors['state'] = 'La modification a echoué';
        }
      }

      $this->edit([
        'id' => $category['id'],
        'errors' => $errors,
        'success' => $success
      ]);
    }

    public function delete($params) {
      $category = $this->Categories->find($params['id']);

      if (!$category)
        throw new Exception("Categorie d'id " . $params['id'] . ' non trouvé');

      $id = $params['id'];
      $this->render('delete', compact('id'));
    }

    public function postDelete($params) {
      $category = $this->Categories->find($params['id']);

      if (!$category)
        throw new Exception("Categorie d'id " . $params['id'] . ' non trouvé');

      $this->Categories->delete($params['id']);
      
      header('Location: ' . BASE_URL_ADMIN . '/categories/');
      die();
    }
  }