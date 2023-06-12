<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
session_start();

require_once 'config.php';
require_once 'Database.php';
require_once 'ProductType.php';
require_once 'Product.php';
require_once 'ProductModel.php';
require_once 'Controller.php';
require_once 'Cart.php';

$config = require 'config.php';
$db = new Database($config['database']);
$model = new ProductModel($db);
$controller = new Controller($model);
$cart = new Cart();

$action = $_GET['action'] ?? '';
$typeId = $_GET['typeId'] ?? null;
header('Content-Type: application/json');

switch ($action) {
    case 'listTypes':
        $productTypes = $controller->listTypes();
        echo json_encode($productTypes);
        break;
    case 'listProductsByTypeId':
        if ($typeId !== null) {
            $productsByTypeId = $controller->listProductsByTypeId($typeId);

            if (empty($productsByTypeId['products'])) {
                $error = [
                    "errors" => "No Products found"
                ];
                echo json_encode($error);
            } else {
                $productsByTypeId['products'] = array_map(function ($product) {
                    // Return the product id and name as an array
                    return ['id' => $product['id'], 'name' => $product['name']];
                }, $productsByTypeId['products']);
                echo json_encode($productsByTypeId);
            }

        } else {
            $error = [
                "errors" => "typeId is missing"
            ];
            echo json_encode($error);
        }
        break;
    case 'addArticle':
        $articleId = $_GET['articleId'] ?? null;
        if ($articleId !== null) {
            $cart->addArticle($articleId);
            echo json_encode(['state' => 'OK']);
        } else {
            echo json_encode(['state' => 'ERROR', 'message' => 'articleId is missing']);
        }
        break;
    case 'removeArticle':
        $articleId = $_GET['articleId'] ?? null;
        if ($articleId !== null) {
            $cart->removeArticle($articleId);
            echo json_encode(['state' => 'OK']);
        } else {
            echo json_encode(['state' => 'ERROR', 'message' => 'articleId is missing']);
        }
        break;
    case 'listCart':
        $cartItems = $cart->listCart($model);
        echo json_encode(['cart' => $cartItems]);
        break;
    default:
}
