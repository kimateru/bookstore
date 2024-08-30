<?php

class CartModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addProductToCart($productId,$userId) {
        $stmt = $this->db->prepare("INSERT INTO cart (user_id, product_id) VALUES (:user_id, :product_id)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':product_id', $productId);
            return $stmt->execute();
    }
    public function getProductsFromCart($userId) {
        $stmt = $this->db->prepare("SELECT * from cart where user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteProductFromCart($productId,$userId){
        $stmt = $this->db->prepare("DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':product_id', $productId);
        return $stmt->execute();
    }

}
