<?php
include '../db_connection.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
function select_carts($userid)
{
    global $db;

    $select_query = "select * from `Cafe`.`cart_product` where `user_id`= :stdusrid order by `cartid`;";

    $stmt = $db->prepare($select_query);

    $stmt->bindParam(':stdusrid',$userid);

    $stmt->execute();

    $carts = $stmt->fetchAll();

    return $carts;
}

//function to update quantity
function update_quantity()
{
    global $db;
    $data = file_get_contents("php://input");
    $cart = json_decode($data, true);

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
    // return $cart;
}

//function to delete cart
function delete_cart()
{
    global $db;
    $data = file_get_contents("php://input");
    $cart = json_decode($data, true);

    $cart_id = $cart['cartid'];

    $update_query = "delete from `Cafe`.`cart_product` where `cartid`=:stdid";

    $stmt = $db->prepare($update_query);  # send template to the server
    $stmt->bindParam(":stdid", $cart_id);
    $stmt->execute();  # true means that the query exectued by the database successfully

}

//function to save totalprice of all carts 
function deleteAllCarts()
{
    global $db;

    $delete_query = "delete from `Cafe`.`cart_product`";

    $stmt = $db->prepare($delete_query);

    $stmt->execute();
}

//select usercarts
function selectUserCarts($userid )
{
    global $db;

    $create_query = "select * from `Cafe`.`carts` where `user_id` = :usrid";

    $stmt = $db->prepare($create_query);

    $stmt->bindParam(':usrid', $userid);

    $stmt->execute();

    $res = $stmt->fetchAll();

    return $res;
}

///////////////////////////// not used yet ///////////////////////////////////////////

//function to select all carts 
function create_cart()
{
    global $db;

    $data = file_get_contents("php://input");
    $product = json_decode($data, true);

    $userid = $product['usrid'];
    $prodid = $product['productid'];
    $price = $product['price'];

    $create_query = "insert into `Cafe`.`cart_product` (user_id,product_id,price) values (:usrid,:product_id,:price);";

    $stmt = $db->prepare($create_query);

    $stmt->bindParam(':product_id', $prodid);
    $stmt->bindParam(':usrid', $userid);
    $stmt->bindParam(':price', $price);

    $stmt->execute();

    createUserCarts($userid);
}

//function to save totalprice of all carts 
function createUserCarts($userid )
{
    global $db;

    $totalPrice = countTotalPrice($userid);

    $create_query = "insert into `Cafe`.`carts` (total_price,user_id) values (:totalprice,:usrid)";

    $stmt = $db->prepare($create_query);

    $stmt->bindParam(':totalprice', $totalPrice);
    $stmt->bindParam(':usrid', $userid);

    $stmt->execute();
}

//function to count totalprice
function countTotalPrice($userid){

    $allcarts = select_carts($userid);
    $totalPrice = 0;

    for($i=0;$i<sizeof($allcarts);$i++){
        $totalPrice+= $allcarts[$i]['price'];
    }

    return $totalPrice;
}

//update usercarts
function updateUserCarts()
{
    // global $db;

    // $delete_query = "delete from `Cafe`.`carts` where `user_id` = :usrid";

    // $stmt = $db->prepare($delete_query);

    // $stmt->bindParam(':usrid', $userid);

    // $stmt->execute();
}

//delete usercarts
function deleteUserCarts($userid )
{
    global $db;

    $delete_query = "delete from `Cafe`.`carts` where `user_id` = :usrid";

    $stmt = $db->prepare($delete_query);

    $stmt->bindParam(':usrid', $userid);

    $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    update_quantity();
}

if ($_SERVER["REQUEST_METHOD"] === 'DELETE') {
    delete_cart();
    header("Refresh:1");
}
