<?php

$dbuser = 'sallyz';
$dbpassword = '123';
$dbname = 'cafe';
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


