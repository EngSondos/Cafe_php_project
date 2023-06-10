<?php 

function getAllUserMakeOrder()
{
    global $conn ;
    $query= "SELECT `id`,`username` FROM users"; 
   $result = $conn->query($query);
    return  $result->fetchAll();
}

function filterorderByUserId($user_id)
{
global  $conn ;
$query = "select * from orders where user_id =$user_id";
$result = $conn->query($query);
 return $result->fetchAll(PDO::FETCH_ASSOC);

}


function getOrderDetalis($order_id,$user_id)
{
    global  $conn;
      $query = "Select * from orders_products where  orders_products.`order_id` = :order_id and `user_id` = :user_id";
      $result1 = $conn->prepare($query);
      $result1->bindParam(':order_id',$order_id);
      $result1->bindParam(':user_id',$user_id);
      $result1->execute();
        return $result1->fetchAll() ;
}

function getOrdersByDate($start_date,$end_date)
{
  global  $conn;
  $query = "Select * from orders where  orders.`created_at` between :start_date and :end_date ";
  $result1 = $conn->prepare($query);
  $result1->bindParam(':start_date',$start_date);
  $result1->bindParam(':end_date',$end_date);
  $result1->execute();
    return $result1->fetchAll() ;
}

function getOrdersByDateandUserId($start_date,$end_date,$user_id)
{
//    echo ($start_date+$end_date+$user_id);
    var_dump($start_date);
    global  $conn;
    $query = "Select * from orders where   orders.`created_at` between :start_date and :end_date and user_id = :user_id ";
    $result1 = $conn->prepare($query);

    $result1->bindParam(':user_id',$user_id);
    $result1->bindParam(':start_date',$start_date);
    $result1->bindParam(':end_date',$end_date);
    $result1->execute();
    return $result1->fetchAll() ;
}