<?php

class UserModel
{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function registerUser($username, $email, $pwd) {
        $stmt = $this->db->prepare("INSERT INTO users (username, email, pwd) VALUES (:username, :email, :pwd)");
        $hashedPassword = password_hash($pwd, PASSWORD_BCRYPT);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pwd', $hashedPassword);
        return $stmt->execute();
    }
    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUserProfile($username, $email, $phone, $country) {
        $stmt = $this->db->prepare("UPDATE users SET username = :username, phone = :phone, country = :country WHERE email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':country', $country);
        return $stmt->execute();
    }
    public function updateUserProfileWithPic($username, $email, $phone, $country, $profile_pic) {
        $stmt = $this->db->prepare("UPDATE users SET username = :username, phone = :phone, country = :country, profile_pic = :profile_pic WHERE email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone',$phone);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':profile_pic', $profile_pic);
        return $stmt->execute();
    }
}
