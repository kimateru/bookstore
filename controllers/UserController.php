<?php
require_once '../models/UserModel.php';
session_start();
class UserController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
    }

    public function registerUser($username, $email, $pwd)
    {
        $errors = $this->validateUserRegister($username, $email, $pwd);
        if (empty($errors)) {
            $this->userModel->registerUser($username, $email, $pwd);
            $user = $this->userModel->getUserByUsername($username);
            $_SESSION['loggedInUser'] = $user;
            header('Location: ../views/main.view.php');
            die();
        } else {
            $_SESSION['errors'] = $errors;
            header('Location: ../views/register.view.php');
            die();
        }
    }

    public function loginUser($username, $pwd)
    {
        $user = $this->userModel->getUserByUsername($username);
        if ($user && password_verify($pwd, $user['pwd'])) {
            $_SESSION['loggedInUser'] = $user;
            header('Location: ../views/main.view.php');
            die();
        } else {
            $errors['login'] = "Invalid username or password";
            $_SESSION['errors_login'] = $errors;
            header('Location:../views/login.view.php');
            die();
        }
    }
    public function updateProfile($username, $email, $phone, $country)
    {
        $errors = $this->validateUserUpdate($username, $phone, $country);
        if (empty($errors)) {
            $this->userModel->updateUserProfile($username, $email, $phone, $country);
            $_SESSION['loggedInUser']['username'] = $username;
            $_SESSION['loggedInUser']['phone'] = $phone;
            $_SESSION['loggedInUser']['country'] = $country;
            header('Location:../views/profile.view.php');
            die();
        } else {
            $_SESSION['errors_update'] = $errors;
            header('Location:../views/profile.view.php');
            die();
        }
    }
    public function validateUserUpdate($username, $phone, $country)
    {
        $errors = [];
        // validate usernames 
        if (empty($username)) {
            $errors['username'] = "Username is required";
        } elseif (!preg_match("/^[a-zA-Z0-9_]{5,15}$/", $username)) {
            $errors['username'] = "Username must be at least 5 and maximum 15 characters long and contain only alphanumeric characters and underscores";
        }
        // validate phone 
        if (empty($phone)) {
            $errors['phone'] = "Phone is required for update";
        }
        if (!preg_match("/^\+\d{1,3}[\s\d]+$/", $phone)) {
            $errors['phone'] = "Phone must start with + and only contain spaces and numbers";
        }
        // validate country
        if (empty($country)) {
            $errors['country'] = "Country is required";
        } elseif (!preg_match("/^[A-Za-z\s-]+$/", $country)) {
            $errors['country'] = "Country must start with capital and contain only alphabetical symbols";
        }

        return $errors;
    }
    public function updateProfileWithPic($username, $email, $phone, $country, $profile_pic)
    {
        $errors = $this->validateUserUpdate($username, $phone, $country);

        if (empty($errors)) {
            $this->userModel->updateUserProfileWithPic($username, $email, $phone, $country, $profile_pic);
            $_SESSION['loggedInUser']['username'] = $username;
            $_SESSION['loggedInUser']['phone'] = $phone;
            $_SESSION['loggedInUser']['country'] = $country;
            $_SESSION['loggedInUser']['profile_pic'] = $profile_pic;
            header('Location:../views/profile.view.php');
            die();
        } else {
            $_SESSION['errors_update'] = $errors;
            header('Location:../views/profile.view.php');
            die();
        }
    }
    public function validateUserRegister($username, $email, $pwd)
    {
        $errors = [];

        // validate username 
        if (empty($username)) {
            $errors['username'] = "Username is required";
        } elseif (!preg_match("/^[a-zA-Z0-9_]{5,15}$/", $username)) {
            $errors['username'] = "Username must be at least 5 and maximum 15 characters long and contain only alphanumeric characters and underscores";
        }
        // validate password
        if (empty($pwd)) {
            $errors['pwd'] = "Password is required";
        } elseif (strlen($pwd) < 6) {
            $errors['pwd'] = "Password must be at least 6 characters";
        }
        // validate email
        if (empty($email)) {
            $errors['email'] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        }

        return $errors;
    }
}
