<?php

  require_once('requirements.php');

  date_default_timezone_set('GMT');

  // Admin controllers namespaces
  use \App\Admin\Controller\Auth;
  use \App\Admin\Controller\Users;
  use \App\Admin\Controller\Demandes;
  use \App\Admin\Controller\Products;
  use \App\Admin\Controller\Dashboard;
  use \App\Admin\Controller\Categories;
  use \App\Admin\Controller\Search;

  use \App\Controller\Home as HomeController;
  use \App\Controller\Auth as AuthController;
  use \App\Controller\Products as ProductsController;
  use \App\Controller\Categories as CategoriesController;
  use \App\Controller\Profil as ProfilController;
  use \App\Controller\Cart as CartController;

  if (PHP_SESSION_NONE === session_status())
    session_start();

  $router = new Router([
    new Route('/', [HomeController::class, 'index'], ['GET']),
    new Route('/login', [AuthController::class, 'login'], ['GET']),
    new Route('/signup', [AuthController::class, 'signup'], ['GET']),
    new Route('/login', [AuthController::class, 'postLogin'], ['POST']),
    new Route('/signup', [AuthController::class, 'postSignup'], ['POST']),
    new Route('/logout', [AuthController::class, 'logout'], ['GET']),
    
    new Route('/profil', [ProfilController::class, 'index'], ['GET']),
    
    new Route('/cart', [CartController::class, 'index'], ['GET']),
    new Route('/cart/{idProduct}/{quantity}', [CartController::class, 'editQuantity'], ['GET'], ['id' => 'int', 'quantity' => 'int']),
    new Route('/cart/request', [CartController::class, 'requestProducts'], ['GET']),
    
    new Route('/category/{id}', [CategoriesController::class, 'index'], ['GET'], ['id' => 'int']),
    
    new Route('/product/{id}', [ProductsController::class, 'index'], ['GET'], ['id' => 'int']),
    new Route('/product/{id}/add-to-cart', [ProductsController::class, 'addToCart'], ['GET'], ['id' => 'int']),
    new Route('/product/{id}/remove-from-cart', [CartController::class, 'removeFromCart'], ['GET'], ['id' => 'int']),
    
    
    new Route('/admin/profil', [Users::class, 'profil'], ['GET']),

    new Route('/admin/login', [Auth::class, 'login'], ['GET']),
    new Route('/admin/signup', [Auth::class, 'signup'], ['GET']),
    new Route('/admin/logout', [Auth::class, 'logout'], ['GET']),

    new Route('/admin/login', [Auth::class, 'postLogin'], ['POST']),
    new Route('/admin/signup', [Auth::class, 'postSignup'], ['POST']),

    new Route('/admin', [Dashboard::class, 'index'], ['GET']),
    new Route('/admin/home', [Dashboard::class, 'index'], ['GET']),
    new Route('/admin/dashboard', [Dashboard::class, 'index'], ['GET']),
    
    new Route('/admin/users', [Users::class, 'index'], ['GET']),
    new Route('/admin/demandes', [Demandes::class, 'index'], ['GET']),
    new Route('/admin/products', [Products::class, 'index'], ['GET']),
    new Route('/admin/categories', [Categories::class, 'index'], ['GET']),

    new Route('/admin/demande/add', [Demandes::class, 'add'], ['GET']),
    new Route('/admin/product/add', [Products::class, 'add'], ['GET']),
    new Route('/admin/category/add', [Categories::class, 'add'], ['GET']),

    new Route('/admin/demande/add', [Demandes::class, 'postAdd'], ['POST']),
    new Route('/admin/product/add', [Products::class, 'postAdd'], ['POST']),
    new Route('/admin/category/add', [Categories::class, 'postAdd'], ['POST']),
    
    new Route('/admin/user/{id}', [Users::class, 'get'], ['GET'], ['id' => 'int']),
    new Route('/admin/demande/{id}', [Demandes::class, 'get'], ['GET'], ['id' => 'int']),
    new Route('/admin/product/{id}', [Products::class, 'get'], ['GET'], ['id' => 'int']),
    new Route('/admin/category/{id}', [Categories::class, 'get'], ['GET'], ['id' => 'int']),

    new Route('/admin/user/{id}/edit', [Users::class, 'edit'], ['GET'], ['id' => 'int']),
    new Route('/admin/demande/{id}/edit', [Demandes::class, 'edit'], ['GET'], ['id' => 'int']),
    new Route('/admin/product/{id}/edit', [Products::class, 'edit'], ['GET'], ['id' => 'int']),
    new Route('/admin/category/{id}/edit', [Categories::class, 'edit'], ['GET'], ['id' => 'int']),

    new Route('/admin/user/{id}/edit', [Users::class, 'postEdit'], ['POST'], ['id' => 'int']),
    new Route('/admin/demande/{id}/edit', [Demandes::class, 'postEdit'], ['POST'], ['id' => 'int']),
    new Route('/admin/product/{id}/edit', [Products::class, 'postEdit'], ['POST'], ['id' => 'int']),
    new Route('/admin/category/{id}/edit', [Categories::class, 'postEdit'], ['POST'], ['id' => 'int']),
    
    new Route('/admin/user/{id}/delete', [Users::class, 'delete'], ['GET'], ['id' => 'int']),
    new Route('/admin/demande/{id}/delete', [Demandes::class, 'delete'], ['GET'], ['id' => 'int']),
    new Route('/admin/product/{id}/delete', [Products::class, 'delete'], ['GET'], ['id' => 'int']),
    new Route('/admin/category/{id}/delete', [Categories::class, 'delete'], ['GET'], ['id' => 'int']),
    
    new Route('/admin/user/{id}/delete', [Users::class, 'postDelete'], ['POST'], ['id' => 'int']),
    new Route('/admin/demande/{id}/delete', [Demandes::class, 'postDelete'], ['POST'], ['id' => 'int']),
    new Route('/admin/product/{id}/delete', [Products::class, 'postDelete'], ['POST'], ['id' => 'int']),
    new Route('/admin/category/{id}/delete', [Categories::class, 'postDelete'], ['POST'], ['id' => 'int']),
    
    new Route('/admin/search/users/{query}', [Search::class, 'getUsers'], ['GET'], ['query' => 'alphanum']),
    new Route('/admin/search/products/{query}', [Search::class, 'getProducts'], ['GET'], ['query' => 'alphanum']),
    new Route('/admin/search/categories/{query}', [Search::class, 'getCategories'], ['GET'], ['query' => 'alphanum']),
  ]);

  try {
    $route = $router->matchFromPath($_GET['p'], $_SERVER['REQUEST_METHOD']);

    if (explode("/", trim($route->getPath(), "/"))[0] == 'admin') {
      switch ($route->getPath()) {
        case '/admin/login':
        case '/admin/signup':
          if (isset($_SESSION['auth-admin'])) {
            header('Location: ' . BASE_URL_ADMIN . '/');
            die();
          }
          break;
        
        default:
          if (!isset($_SESSION['auth-admin'])) {
            header('Location: ' . BASE_URL_ADMIN . '/login');
            die();
          }
          break;
      }
    } else {

    }

    $vars = $route->getVars();
    
    $parameters = $route->getParameters();
    $controllerName = $parameters[0];
  
    $method = $parameters[1];
    $controller = new $controllerName();

    switch ($_SERVER['REQUEST_METHOD']) {
      case 'GET':
        $controller->$method(array_merge($vars, $_SESSION));
        break;
      case 'POST':
        $controller->$method(array_merge($_POST, $_FILES, $vars, $_SESSION));
        break;
    }
  } catch(Exception $e) {
    $msgError = $e->getMessage();
    require('views/admin/404/index.php');
  }