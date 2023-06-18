<?php

use Fhtechnikum\Uebung34\Controller\ProductsListController;

error_reporting(E_ERROR);
ini_set("display_errors", 1);
include 'src/config/config.php';
require 'vendor/autoload.php';

$controller = new ProductsListController();

// Route Warenkorb Aktionen
if (isset($_GET['cartAction'])) {
    switch ($_GET['cartAction']) {
        case 'add':
            $controller->addProductToCart($_GET['productId'], $_GET['quantity']);
            break;
        case 'remove':
            $controller->removeProductFromCart($_GET['productId']);
            break;
        case 'list':
            echo json_encode($controller->listCart());
            break;
    }
} else {
    // Route normale Produktaktionen
    $controller->route();
}
