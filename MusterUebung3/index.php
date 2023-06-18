<?php

use MusterUebung3\src\Controller\ProductsListController;
use MusterUebung3\src\Controller\CartController;

error_reporting(E_ERROR);
ini_set("display_errors", 1);
include 'src/config/config.php';
require 'vendor/autoload.php';

$productsController = new ProductsListController();
$cartController = new CartController();

// Route Warenkorb Aktionen
if (isset($_GET['cartAction'])) {
    switch ($_GET['cartAction']) {
        case 'add':
            $cartController->addProductToCart($_GET['productId'], $_GET['quantity']);
            break;
        case 'remove':
            $cartController->removeProductFromCart($_GET['productId']);
            break;
        case 'list':
            echo json_encode($cartController->listCart());
            break;
    }
} else {
    // Route normale Produktaktionen
    $productsController->route();
}
