<?php
    include '../../Controllers/users/users.php';

    if (!isLoggedIn()) {
        
        header('Location: login.php');
        
        exit();
    }
    $user = getCurrentUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Welcome <?php echo $user['username']; ?>
<form method="post" action="login.php">
    <button type="submit">Logout</button>
</form>
</body>
</html>