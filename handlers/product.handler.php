<?php
require_once '../controllers/ProductController.php';
require_once '../config/db.config.php';
require_once '../utils/utility.php';

$db = getDbConnection();
$productControler = new ProductController($db);

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_product'])){
    $productId = $_POST['productId'];
    $productControler->deleteProduct($productId);
    header('Location: ../views/main.view.php');
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_product'])){ 
    $productId = $_POST['productId'];
    $product = $productControler->getProductById($productId);
    $_SESSION['product'] = $product;
    header('Location: ../views/updateProduct.view.php');
}



// 1) Adaugati functiile necesare in model si controller pentru redactarea produsului
// 2) In momenutl in care utilizator apasa pe add to cart, inregistrati in baza de date tabela cart formata din : id,user_id,product_id, qty, added_at(data adaugarii)

