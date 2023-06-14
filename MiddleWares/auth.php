<?php 
if(!isset($_SESSION['user']))
{
    header('location:/Cafe_php_project/Views/register/login.php');
}

?>