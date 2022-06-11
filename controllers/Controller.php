<?php

  namespace App\Controller;

  use \Exception;

  abstract class Controller {
    protected function __construct() {
      $this->loadModel("Categories");
      require_once(ROOT . 'Validations.php');
    }

    public function loadModel($model) {
      require_once(ROOT . 'models/' . $model . '.php');
      $this->$model = new ("App\Models\\" . $model)();
    }

    public function render($filename, $variables = []) {
      extract($variables);
      $categories = $this->Categories->findAll();
      require_once(ROOT . 'views/' . strtolower(explode("\\", get_class($this))[2]) . '/' . $filename . '.php');
    }
  }