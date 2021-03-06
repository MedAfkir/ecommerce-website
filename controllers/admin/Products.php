<?php

  namespace App\Admin\Controller;
  
  use \Exception;
  use \Validation;
  use \Validations;

  class Products extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Products");
      $this->loadModel("Categories");
      $this->loadModel("Demandes");
    }
    
    public function index() {
      $products = $this->Products->findAll();
      $this->render('index', compact('products'));
    }
    
    public function get($params = []) {
      $product = $this->Products->find($params['id']);
      if (!$product) {
        throw new Exception("Produit d'identifiant " . $params['id'] . " non trouvé");
      }

      $demandes = $this->Demandes->requete(
        'SELECT
          demandes.id,
          demandes.id_product,
          demandes.quantity,
          demandes.id_user,
          users.firstname,
          users.lastname
        FROM demandes
        INNER JOIN users ON demandes.id_user = users.id
        WHERE demandes.id_product = ?', [$params['id']])
        ->fetchAll();

      $this->render('get', compact('product', 'demandes'));
    }
    
    public function add($params = []) {
      $categories = $this->Categories->findAll();
      $this->render('add', compact('categories'));
    }
    
    public function postAdd($params = []) {
      $validation = new Validations([
        (new Validation('label', $params['label'], 'text'))
          ->setLabel('Libellé')
          ->setRequired(true)
          ->setMin(1),
        (new Validation('category', $params['category'], 'int'))
          ->setLabel('Catégorie')
          ->setRequired(true)
          ->setMin(1),
        (new Validation('price', $params['price'], 'float'))
          ->setLabel('Prix')
          ->setRequired(true),
        (new Validation('description', $params['description'], 'text'))
          ->setLabel('Description')
          ->setRequired(true),
        (new Validation('quantity', $params['quantity'], 'int'))
          ->setLabel('Quantité')
          ->setRequired(true)
          ->setMin(1)
      ]);

      $hasErrors = $validation->hasErrors();
      $errors = $validation->getErrors();
      $success = $validation->isSuccess();

      $categorie = $this->Categories->find($params['category']);
      
      if (!$categorie) {
        if (isset($errors['category']))
          $errors['category']['exist'] = 'Catégorie non trouvé';
        else
          $errors['category'] = ['exist' => 'Catégorie n\'existe pas'];
        $success = false;
      }

      if ($success) {
        $this->Products->create([   
          'label' => htmlspecialchars(trim($params['label'])),
          'description' => htmlspecialchars(trim($params['description'])),
          'image' => uniqid() . '.png',
          'price' => htmlspecialchars(trim($params['price'])),
          'quantity' => htmlspecialchars(trim($params['quantity'])),
          'id_category' => htmlspecialchars(trim($params['category'])),
          'added_at	' => date('Y-m-d h:i:s')
        ]);
      }
        
      $categories = $this->Categories->findAll();
      $this->render('add', compact('errors', 'success', 'categories'));
    }

    public function edit($params = []) {
      $product = $this->Products->find($params['id']);
      if (!$product) {
        throw new Exception("Produit d'identifiant " . $params['id'] . " non trouvé");
      }
      $categories = $this->Categories->findAll();
      $this->render('edit', compact('product', 'categories'));
    }

    public function postEdit($params = []) {
      $product = $this->Products->find($params['id']);
      
      if (!$product) {
        throw new Exception("Produit d'identifiant " . $params['id'] . " non trouvé");
      }

      $category = $this->Categories->find($params['category']);

      if (!$category) {
        throw new Exception("Catégorie d'identifiant " . $params['category'] . " non trouvé");
      }

      $validation = new Validations([
        (new Validation('label', $params['label'], 'text'))
          ->setLabel('Libellé')
          ->setRequired(true),
        (new Validation('price', $params['price'], 'float'))
          ->setLabel('Prix')
          ->setRequired(true),
        (new Validation('description', $params['description'], 'text'))
          ->setLabel('Description')
          ->setRequired(true),
        (new Validation('quantity', $params['quantity'], 'int'))
          ->setLabel('Quantité')
          ->setRequired(true)
          ->setMin(1)
      ]);

      $hasErrors = $validation->hasErrors();
      $errors = $validation->getErrors();
      $success = $validation->isSuccess();

      if ($validation->isSuccess()) {
        $state = $this->Products->update($params['id'], [
          'label' => htmlspecialchars(trim($params['label'])),
          'price' => htmlspecialchars(trim($params['price'])),
          'quantity' => htmlspecialchars(trim($params['quantity'])),
          'description' => htmlspecialchars(trim($params['description'])),
          'id_category' => htmlspecialchars(trim($params['category']))
        ]);

        if ($state) {
          $success = true;
          $product = $this->Products->find($params['id']);
        } else {
          $errors['state'] = 'La modification a echoué';
          $success = false;
        }
      }

      $categories = $this->Categories->findAll();
      $this->render('edit', compact('product', 'errors', 'success', 'categories'));
    }

    public function delete($params) {
      $product = $this->Products->find($params['id']);

      if (!$product)
        throw new Exception("Produits d'id " . $params['id'] . ' non trouvé');

      $id = $params['id'];
      $this->render('delete', compact('id'));
    }

    public function postDelete($params) {
      $product = $this->Products->find($params['id']);

      if (!$product)
        throw new Exception("Produits d'id " . $params['id'] . ' non trouvé');

      $this->Products->delete($params['id']);
      
      header('Location: ' . BASE_URL_ADMIN . '/products/');
      die();
    }
  }