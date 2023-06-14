<?php  

include "../../config/connectToDB.php";

// Create User To Database

function createNewUser($email, $password, $username, $image, $role) {

    $conn = connect();

    $stmt = $conn->prepare('INSERT INTO 
                users (email, password, username, image, role) 
                VALUES(:email, :password, :username, :image, :role);');
    $stmt->execute(array(
        ':email'    => $email,
        ':password' => password_hash($password, PASSWORD_DEFAULT),
        ':username' => $username,
        ':image'    => $image,
        ':role'     => $role
    ));
}

function getUserByEmail($email) {
    
    $conn = connect();

    $query = "SELECT * FROM users WHERE email=:email";

    $stmt = $conn->prepare($query);

    $stmt->execute(array( ':email' => $email ));

    $user = $stmt->fetch();

    $conn = null;

    return $user;
}
