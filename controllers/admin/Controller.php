<?php

  namespace App\Admin\Controller;
  
  use \Exception;

  abstract class Controller {
    protected function __construct() {
      require_once(ROOT . 'Validations.php');
    }

    public function loadModel($model) {
      require_once(ROOT . 'models/admin/' . $model . '.php');
      $this->$model = new ("App\Models\Admin\\" . $model)();
    }

    public function render($filename, $variables = []) {
      extract($variables);
      require_once(ROOT . 'views/admin/' . strtolower(explode("\\", get_class($this))[3]) . '/' . $filename . '.php');
    }
  }