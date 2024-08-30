<?php
require_once '../controllers/ProductController.php';
require_once '../config/db.config.php';
require_once '../utils/utility.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = trim(htmlspecialchars($_POST['name']));
    $author = trim(htmlspecialchars($_POST['author']));
    $price = trim(htmlspecialchars($_POST['price']));    
    $description = trim(htmlspecialchars($_POST['description']));    
    $qty = trim(htmlspecialchars($_POST['qty']));   

    $product_img = $_FILES['img'];
}   
$db = getDbConnection();
$productControler = new ProductController($db);
$arr = validateUserFile($product_img,"products");
$product_pic_path = $arr[0];
if (empty($arr[1])) {
    if($product_pic_path) {
        $productControler->addProduct($name, $author, $price, $description, $qty, $product_pic_path);
    }
} else {
    $_SESSION['errors'] = $errors;
    header('Location:../views/addProduct.view.php');
    die();
}

