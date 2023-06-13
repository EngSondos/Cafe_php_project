<?php 

    include '../../Controllers/users/users.php';

    function loginValidation($email, $password) {
        
        $errors = [];
        
        $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        
        if(empty($email)) {
            $errors[] = 'Email Is Required';
        }   elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Write a Valid Email';
        }
        // pssword Validtion
        if(empty($password)) {
            $errors[] = 'Password Is Required';
        } elseif (!preg_match($password_regex, $password)) {
            $errors[] = 'Password is Not Correct!';
        } 

        if(empty($errors)) {
            loginUser($email, $password);
            // session_start();
            echo '<span class="alert alert-success">Welcome You Will Redircet To Home Now</span>';
            if($_SESSION['user']['role'] === 0) {
                header("refresh:3;url=home.php");
            } elseif ($_SESSION['user']['role'] === 1) {
                header("refresh:3;url=../Admin/users/listAllUsers.php");
            }
            exit();
        } else {
            foreach($errors as $err) {
                echo '<span class="alert alert-danger">' . $err . '</span>';
            }
        }
    }
