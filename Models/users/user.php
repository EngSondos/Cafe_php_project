<?php  

include '../../config/connectToDB.php';

// Create User To Database

function createNewUser($email, $password, $username, $image) {

    $conn = connect();

    $stmt = $conn->prepare('INSERT INTO 
                users (email, password, username, image) 
                VALUES(:email, :password, :username, :image);');
    $stmt->execute(array(
        ':email'    => $email,
        ':password' => password_hash($password, PASSWORD_DEFAULT),
        ':username' => $username,
        ':image'    => $image
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



// function GetAllUsers() {
    
//     $conn = connect();

//     $stmt = $conn->prepare("SELECT * FROM users;");
//     $stmt->execute();
//     $user = $stmt->fetch();

//     var_dump($user);
// }

// GetAllUsers();