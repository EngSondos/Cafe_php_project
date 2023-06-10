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

    $select_query = "select * from `Cafe`.`cart_product` where `user_id`= '1' order by `cartid`;";

    $select_stmt = $db->prepare($select_query);

    $select_stmt->execute();

    $carts = $select_stmt->fetchAll();

    return $carts;
}

//function to update quantity
function update_quantity(){
    global $db;
    $data = file_get_contents("php://input");
    $cart = json_decode($data,true);

    $quantity = $cart['quantity'];
    $product_id = $cart['product_id'];
    $user_id = $cart['user_id'];
    $productprice = $cart['price'];

    $update_query = "update `Cafe`.`cart_product` set `quantity`=:stdquantity,`price`=:stdprdprice where `product_id`=:stdprdctid and `user_id` = :stduserid";

    $stmt = $db->prepare($update_query);
    $stmt->bindParam(":stdquantity", $quantity);
    $stmt->bindParam(":stdprdprice", $productprice);
    $stmt->bindParam(":stdprdctid", $product_id);
    $stmt->bindParam(":stduserid", $user_id);
    $stmt->execute();

    echo json_encode($cart);
}

///////////////need for cart id
//function to delete cart
function delete_cart(){
    global $db;
    $data = file_get_contents("php://input");
    $cart = json_decode($data,true);

    $quantity = $cart['quantity'];
    $product_id = $cart['product_id'];
    $user_id = $cart['user_id'];


    $update_query = "delete from table `Cafe`.`cart_product` set `quantity`=:stdquantity where `product_id`=:stdid";

    $stmt = $db->prepare($update_query);  # send template to the server
    $stmt->bindParam(":stdquantity", $quantity);
    $stmt->bindParam(":stdid", $product_id);
    $stmt->execute();  # true means that the query exectued by the database successfully
    echo json_encode($cart['quantity']);
}
/////////////////
//
if (isset($_POST)) {
    update_quantity();
}
