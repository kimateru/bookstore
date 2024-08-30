<?php
require_once '../controllers/CartController.php';
require_once '../config/db.config.php';
require_once '../utils/utility.php';

$db = getDbConnection();
$cartController = new CartController($db);

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])){
    $productId = $_POST['productId'];
    $userId = $_POST['userId'];
    $cartController->addProductToCart($productId,$userId);
    header('Location: ../views/main.view.php');
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_from_cart'])) {
    $productId = $_POST['productId'];
    $userId = $_POST['userId'];
    print_r($productId);
    $cartController->deleteProductFromCart($productId,$userId);
    header('Location: ../views/main.view.php');
}




