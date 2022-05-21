<?php

  namespace App\Admin\Controller;
  
  use \Exception;
  
  class Dashboard extends Controller {
    public function __construct() {
      parent::__construct();
    }

    public function index() {
      $this->render('index');
    }
  }