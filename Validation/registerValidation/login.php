<?php 

include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Controllers/users/users.php';

    function loginValidation($email, $password,&$errors) {
        
        $errors=[];

        $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        
        if(empty($email)) {
            $errors['email'] = 'Email Is Required';
        }   elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Write a Valid Email';
        }
        // pssword Validtion
        if(empty($password)) {
            $errors[] = 'Password Is Required';
        } elseif (!preg_match($password_regex, $password)) {
            $errors[] = 'Password is Not Correct!';
        } 

        if(empty($errors)) {

            $userLogin = loginUser($email, $password);
            if($userLogin) {
                echo '<span class="alert alert-success">Welcome You Will Redircet To Home Now</span>';
            
                if($_SESSION['user']['role'] === 0) {
    
                    header("refresh:3;url=home.php");
    
                } elseif ($_SESSION['user']['role'] === 1) {
    
                    header("refresh:3;url=../Admin/users/listAllUsers.php");
                
                }
                exit();
            } else {
                echo '<span class="alert alert-danger">faild to login with wrong email or password!</span>';
            }
        } else {
            foreach($errors as $err) {
                echo '<span class="alert alert-danger">' . $err . '</span>';
            }
        }
    }
