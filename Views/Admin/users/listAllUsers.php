<?php 
    // include '../../Models/Admin/getUsers.php';
    try{
        include '../../../Models/Admin/getUsers.php';
        $users  = getAllUsers();
    }catch(Exception $e){
        echo $e;
    }
    // foreach($users as $user) {
    //     echo $user;
    // }
?>