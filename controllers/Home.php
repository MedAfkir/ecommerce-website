<?php

  namespace App\Controller;

  class Home extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Home");
    }

    public function index() {
      $topProducts = $this->Home->getTopProducts(2);
      $recentsProducts = $this->Home->getRecentsProducts(2);

      $this->render('index', compact('topProducts', 'recentsProducts'));
    }
  }