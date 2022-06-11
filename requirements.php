<?php

// Global variables
require_once('variables.php');

// Utilities
require_once('./utils.php');

// Route
require_once('Route.php');
require_once('Router.php');

// Database
require_once('./db.php');
require_once('./Models/admin/Model.php');
require_once('./Models/Model.php');

// Controllers
require_once('./controllers/admin/Controller.php');
require_once('./controllers/admin/Auth.php');
require_once('./controllers/admin/Users.php');
require_once('./controllers/admin/Products.php');
require_once('./controllers/admin/Demandes.php');
require_once('./controllers/admin/Dashboard.php');
require_once('./controllers/admin/Categories.php');
require_once('./controllers/admin/Search.php');

require_once('./controllers/Controller.php');
require_once('./controllers/Home.php');
require_once('./controllers/Auth.php');
require_once('./controllers/Products.php');
require_once('./controllers/Categories.php');
require_once('./controllers/Cart.php');
require_once('./controllers/Profil.php');