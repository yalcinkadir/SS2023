<?php

require_once 'config.php';
require_once 'database/Database.php';
require_once 'ProductType.php';
require_once 'Product.php';
require_once 'models/ProductModel.php';
require_once 'Controller.php';
require_once 'Cart.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

session_start();

$config = require 'config.php';
$db = new Database($config['database']);
$model = new ProductModel($db);
$cart = new Cart();
$controller = new Controller($model, $cart);

$action = $_GET['action'] ?? '';
$typeId = $_GET['typeId'] ?? null;

header('Content-Type: application/json');

$result = $controller->handleRequest($action, $typeId);
echo json_encode($result);