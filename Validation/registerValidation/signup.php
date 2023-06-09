<?php

include('../../Models/users/user.php');
    function userValidation($data, $imageFile) {
        
        $errors = [];

        $username = $data['username'];
        $password = $data['password'];
        $email = $data['email'];

        // Password Regx
        $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";

        // Handle image upload
        $image = $imageFile['image'];

        $image_name = $image['name'];
    
        $image_tmp_name = $image['tmp_name'];
    
        $image_error = $image['error'];
    
        if ($image_error === UPLOAD_ERR_OK) {
    
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
    
        $allowed_exts = array('jpg', 'jpeg', 'png', 'gif');
    
        if (in_array($image_ext, $allowed_exts)) {
    
            $image_dest = '../../uploads/users/' . uniqid('', true) . '.' . $image_ext;
           
            move_uploaded_file($image_tmp_name, $image_dest);

        } else {
    
            $errors[] = 'Invalid image file type';
       
        }
        
        } else {
    
            $errors[] = 'Failed to upload image';
        }
        
        // Email Validation

        if(empty($email)) {
            $errors[] = 'Email Is Required';
        }   elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Write a Valid Email';
        }

        // pssword Validtion
        if(empty($password)) {
            $errors[] = 'Password Is Required';
        } elseif (!preg_match($password_regex, $password)) {
            $errors[] = 'Write Strong Password';
        }
        // Username Validation
        if(empty($username)) {
            $errors[] = 'Username Is Required';
        } elseif (strlen($username) < 3) {
            $errors[] = 'Username Not Match';
        }

        if (empty($errors)) {

            createNewUser($email, $password, $username, $image_dest);
            echo '<span class="alert alert-success">Sign Up Successfully</span>';
            header("refresh:3;url=login.php");
            exit();
        } 
        else {
            foreach ($errors as $err) {
                echo '<span class="alert alert-danger">' . $err . '</span>';
            };
        }
    }

