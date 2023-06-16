<?php
    include '../../layout/head.php';
    include '../../Controllers/users/users.php';
    include "../../MiddleWares/auth.php";
    // include "../../MiddleWares/user.php";
    // include "../../assets/homestyle.css";
    // include "Cafe_php_project/layout/CSS/homestyle.css";



    
    if (!isLoggedIn()) {
        header('Location:login.php');
    }

    $user = getCurrentUser();
?>




<?php include '../../layout/footer.php'; ?>