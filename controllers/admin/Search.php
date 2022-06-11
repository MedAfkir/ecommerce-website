<?php

  namespace App\Admin\Controller;
  
  use \Exception;
  use \Validation;
  use \Validations;

  class Search extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Search");
    }

    public function getUsers($params = []) {
      $query = $params['query'];
      $users = $this->Search->getUsers($query);

      $this->render('users', compact('users', 'query'));
    }

    public function getProducts($params = []) {
      $query = $params['query'];
      $products = $this->Search->getProducts($query);

      $this->render('products', compact('products', 'query'));
    }

    public function getCategories($params = []) {
      $query = $params['query'];
      $categories = $this->Search->getCategories($query);

      $this->render('categories', compact('categories', 'query'));
    }
  }