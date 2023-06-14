<?php
    include '../../layout/head.php';
    include '../../Controllers/users/users.php';
    include "../../MiddleWares/auth.php";
    // include "../../MiddleWares/user.php";

    
    // if (!isLoggedIn()) {
        
    //     header('Location: login.php');
        
    //     exit();
    // }

    $user = getCurrentUser();
?>

    Welcome <?php echo $user['username']; ?>

<?php include '../../layout/footer.php'; ?>