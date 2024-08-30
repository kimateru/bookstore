<?php
require_once '../models/CartModel.php';
class CartController
{
    private $cartModel;

    public function __construct($db)
    {
        $this->cartModel = new CartModel($db);
    }

    public function addProductToCart($productId,$userId){
        $this->cartModel->addProductToCart($productId,$userId);
    }
    public function getProductsFromCart($userId){
        return $this->cartModel->getProductsFromCart($userId);
    }
    public function deleteProductFromCart($productId,$userId){
        return $this->cartModel->deleteProductFromCart($productId,$userId);
    }
    
}
