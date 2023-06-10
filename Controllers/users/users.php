<?php

include '../../Validation/registerValidation/signup.php';

// Create a new User (Sign up)
function userController($data, $imageFile) {
    try{
        userValidation($data, $imageFile);
    }
    catch(ErrorException $err) {
        echo $err;
    }
};

// this function accept two parameters from validation file
// when aleardy clean without errors any from user inputs
function loginUser($email, $password) {

    $user = getUserByEmail($email);
    if($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user'] = $user;
        return true;
    } else {
        return 'Your Are Not User Please try to signup';
    }
}

// if logout destroy the session
// function logout() {

// }

// if User Login Start Session
function isLoggedIn() {
    session_start();
    return isset($_SESSION['user']);
}
// to Get The Data Of User who already login
function getCurrentUser() {
    return $_SESSION['user'];
}
