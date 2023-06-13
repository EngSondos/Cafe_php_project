<?php


# 1- set connection credits

## 2- construct connection


function connect_to_database($dbuser, $dbhost, $dbport, $dbname)
{
    $dsn = "mysql:host={$dbhost};dbname={$dbname};port={$dbport}";

    $conn= new PDO($dsn, $dbuser);
    try {
        if ($conn) {
            // echo "connection succeeded";
            return $conn;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    };
}

$conn = connect_to_database($dbuser, $dbhost, $dbport, $dbname);
// echo $db;
