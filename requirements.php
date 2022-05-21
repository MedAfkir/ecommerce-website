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
require_once('./Models/Model.php');

// Controllers
require_once('./controllers/admin/Controller.php');
require_once('./controllers/admin/Auth.php');
require_once('./controllers/admin/Users.php');
require_once('./controllers/admin/Products.php');
require_once('./controllers/admin/Demandes.php');
require_once('./controllers/admin/Dashboard.php');
require_once('./controllers/admin/Categories.php');