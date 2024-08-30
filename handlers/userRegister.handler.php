<?php 

require_once '../controllers/UserController.php';
require_once '../config/db.config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = trim(htmlspecialchars($_POST['username']));
    $email = trim(htmlspecialchars($_POST['email']));
    $pwd = trim(htmlspecialchars($_POST['pwd']));    
}
$db = getDbConnection();
$userControler = new UserController($db);
$userControler->registerUser($username, $email, $pwd);

