<?php

  namespace App\Controller;

  class Profil extends Controller {
    public function __construct() {
      parent::__construct();
      $this->loadModel("Profil");
    }
    
    public function index($params = []) {
      $user = $this->Profil->find($params['auth-client']);
      $demandes = [];

      if (!$user)
        throw new Exception("Utilisateur non trouvé");

      if ($user['nbr_demandes'] > 0) {
        $demandes = $this->Profil->findDemandes($params['auth-client']);
      }

      $this->render('index', compact('user', 'demandes'));
    }
  }