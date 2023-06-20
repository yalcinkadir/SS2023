<?php

spl_autoload_register(function ($class) {

  $classPath = str_replace('\\', '/', $class) . '.php';


  $classPath = 'api/src/Controller/' . $classPath;
  if (file_exists($classPath)) {
    require_once $classPath;
  }
});

use SS2023\Controller\ProductsListController;

error_reporting(E_ERROR);
ini_set("display_errors", 1);
include 'src/config/config.php';
require 'vendor/autoload.php';

$controller = new ProductsListController();
$controller->route();