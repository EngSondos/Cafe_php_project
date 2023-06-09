<?php
include '../db_connection.php';

$db = dbconnect();

//function to select all products
function select_products()
{
    global $db;

    $select_query = "select * from `Cafe`.`products`";

    $select_stmt = $db->prepare($select_query);

    $select_stmt->execute();

    $products = $select_stmt->fetchAll();

    return $products;
}

//function to select all carts
function select_carts()
{
    global $db;

    $select_query = "select * from `Cafe`.`cart_product` where `user_id`= '1';";

    $select_stmt = $db->prepare($select_query);

    $select_stmt->execute();

    $carts = $select_stmt->fetchAll();

    return $carts;
}

//function to update quantity
function update_quantity($quantity,$productid,$userid)
{
    echo $quantity.''.$productid.''.$userid;
    global $db;

    $update_query = "update `Cafe`.`cart_product` set `quantity` = :stdquantity where `product_id` =:stdprodid and `user_id` =:stdusrid ";

    $update_stmt = $db->prepare($update_query);

    $update_stmt->bindParam(":stdquantity",$quantity);

    $update_stmt->bindParam(":stdprodid",$productid);

    $update_stmt->bindParam(":stdusrid",$userid);

    $update_stmt->execute();

    return $quantity;
}
