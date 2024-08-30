<?php

require_once '../controllers/UserController.php';
require_once '../utils/utility.php';
require_once '../config/db.config.php';

$db = getDbConnection();
$userControler = new UserController($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_update'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $email = trim(htmlspecialchars($_POST['email']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $country = trim(htmlspecialchars($_POST['country']));

    $profile_pic = $_FILES['profile_pic'];

    $arr = validateUserFile($profile_pic,"users");
    $profile_pic_path = $arr[0];
    
    if (empty($arr[1])) {
        if ($profile_pic_path) {
            $userControler->updateProfileWithPic($username, $email, $phone, $country, $profile_pic_path);
        } else {
            $userControler->updateProfile($username, $email, $phone, $country);
        }
    } else {
        $_SESSION['errors_update'] = $errors;
        header('Location:../views/profile.view.php');
        die();
    } 
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    session_unset();
    header('Location:../views/login.view.php');
} 

