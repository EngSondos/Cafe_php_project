<?php


# 1- set connection credits

## 2- construct connection


function connect_to_database($dbuser, $dbhost, $dbport, $dbname)
{
    $dsn = "mysql:host={$dbhost};dbname={$dbname};port={$dbport}";

    $db = new PDO($dsn, $dbuser);
    try {
        if ($db) {
            // echo "connection succeeded";
            return $db;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    };
}

$db = connect_to_database($dbuser, $dbhost, $dbport, $dbname);
// echo $db;
