<?php

    // include('../../Controllers/users/users.php');

    session_start();
    session_unset();
    session_destroy();
    header('Location:login.php');
    exit();

    