<?php

  namespace App\Controller;
  
  class Categories extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Categories");
    }

    public function index($params = []) {
      $products = $this->Categories->findProductsByCategory($params['id']);
      $category = $this->Categories->find($params['id']);
      $this->render('index', compact('products', 'category'));
    }
  }