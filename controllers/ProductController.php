<?php
require_once '../models/ProductModel.php';
session_start();
class ProductController
{
    private $productModel;

    public function __construct($db)
    {
        $this->productModel = new ProductModel($db);
    }

    public function addProduct($name, $author, $price, $description, $qty, $product_img)
    {
        $errors = $this->validateProduct($name,$author, $price, $description, $qty);
        if (empty($errors)) {
            $this->productModel->createProduct($name, $author, $price, $description, $qty, $product_img);
            header('Location: ../views/main.view.php');
            die();
        } else {
            $_SESSION['errors'] = $errors;
            header('Location: ../views/addProduct.view.php');
            die();
        }
    }

    public function getAllProducts() {
        return $this->productModel->getAllProducts();
    }
    public function getProductById($id) {
        return $this->productModel->getProductById($id);
    }
    public function validateProduct($name, $author, $price, $description, $qty)
    {
        $errorsProduct = [];

        // validate name 
        if (empty($name)) {
            $errorsProduct['username'] = "Name is required";
        } elseif (!preg_match('/^[\w !"?.]{5,45}$/', $name)) {
            $errorsProduct['username'] = "Name must be at least 5 and maximum 45 characters";
        }
        // Author validation
        if (empty($author)) {
            $errorsProduct['author'] = "Author is required";
        } elseif (!preg_match('/^[\w ".]{5,45}$/', $author)) {
            $errorsProduct['author'] = "Author must be at least 5 and maximum 45 characters";
        }
        /// Price validation
        if (empty($price)) {
            $errorsProduct['price'] = "Price is required";
        }
        else if (!preg_match('/^(?!0(\.0+)?$)([1-9][0-9]{0,3})(\.[0-9]{1,2})?$/', $price)) {
            $errorsProduct['price'] = "Price must be a number with up to 2 decimal places and greater than 0";
        } 

        // Description validation
        if(empty($description)) { 
            $errorsProduct['description'] = "Description is required";
        } else if (!preg_match('/^.{10,130}$/', $description)) {
            $errorsProduct['description'] = "Description must be between 10 and 130 characters long";
        } 

        // Quantity validation
        if (empty($qty)) {
            $errorsProduct['qty'] = "Quantity is required";
        } else if (!preg_match('/^(0|[1-9][0-9]?|100)$/', $qty)) {
            $errorsProduct['qty'] = "Quantity must be a positive integer";
        } 


        return $errorsProduct;
    }
    public function deleteProduct($productId) {
        $this->productModel->deleteProduct($productId);
        header('Location:../views/main.view.php');
        die();
    }

    
}
