<?php

$dbuser = 'root';
$dbpassword = '';
$dbname = 'Cafe';
$dbhost = 'localhost';
$dbport = 3306;




try {

$dsn = "mysql:host=$dbhost;port=$dbport;dbname=$dbname";

  $pdo = new PDO($dsn, $dbuser, $dbpassword);
  if($pdo){
    echo "connection succeeded";
    return $pdo;
}
return false;
} catch (PDOException $e) {
echo 'Connection failed: ' . $e->getMessage();
}


// include 'layout.php';
function dbconnect()
{
    try {
        //write the credintials
        $dbuser = 'root';
        $dbpassword = '';
        $dbname = 'Cafe';
        $dbhost = 'localhost';
        $dbport = '3306';
        
        //datanamesource 
        $dns = "mysql:dbname=$dbname;host=$dbhost;port=$dbport";

        //connect to the database
        $db = new PDO($dns, $dbuser, $dbpassword);

        if($db){
            // echo "the connection to the database is successded";
            return $db;
        }
        else{
            echo "the connection is failed";
        }
    } catch (Exception $e) {
        echo $e;
    }
}
