<?php
    session_start();
    include '../../layout/head.php';
    include '../../layout/navbar.php';
    include '../../Controllers/users/users.php';
    
    if (!isLoggedIn()) {
        header('Location:login.php');
    }

    $user = getCurrentUser();
?>

    Welcome <?php echo $user['username']; ?>

<?php include '../../layout/footer.php'; ?>