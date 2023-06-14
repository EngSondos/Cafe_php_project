<?php
include '../connection_credits.php';
include '../connection.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// $conn = dbconnect();

//function to select all products
function select_products()
{
    global $conn;

    $select_query = "select * from `products`";

    $select_stmt = $conn->prepare($select_query);

    $select_stmt->execute();

    $products = $select_stmt->fetchAll();

    return $products;
}

//function to select all carts
function select_carts($userid)
{
    global $conn;

    $select_query = "select * from `cart_product` where `user_id`= :stdusrid order by `cartid`;";

    $stmt = $conn->prepare($select_query);

    $stmt->bindParam(':stdusrid',$userid);

    $stmt->execute();

    $carts = $stmt->fetchAll();

    return $carts;
}

//function to update quantity
function update_quantity()
{
    global $conn;
    $data = file_get_contents("php://input");
    $cart = json_decode($data, true);

    $quantity = $cart['quantity'];
    $product_id = $cart['product_id'];
    $user_id = $cart['user_id'];
    $productprice = $cart['price'];

    $update_query = "update `cart_product` set `quantity`=:stdquantity,`price`=:stdprdprice where `product_id`=:stdprdctid and `user_id` = :stduserid";

    $stmt = $conn->prepare($update_query);
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
    global $conn;
    $data = file_get_contents("php://input");
    $cart = json_decode($data, true);

    $cart_id = $cart['cartid'];

    $update_query = "delete from `cart_product` where `cartid`=:stdid";

    $stmt = $conn->prepare($update_query);  # send template to the server
    $stmt->bindParam(":stdid", $cart_id);
    $stmt->execute();  # true means that the query exectued by the database successfully

}

//function to save totalprice of all carts 
function deleteAllCarts()
{
    global $conn;

    $delete_query = "delete from `cart_product`";

    $stmt = $conn->prepare($delete_query);

    $stmt->execute();
}

//select usercarts
function selectUserCarts($userid )
{
    global $conn;

    $create_query = "select * from `carts` where `user_id` = :usrid";

    $stmt = $conn->prepare($create_query);

    $stmt->bindParam(':usrid', $userid);

    $stmt->execute();

    $res = $stmt->fetchAll();

    return $res;
}

//update usercarts
function updateUserCarts()
{
    global $conn;

    $data = file_get_contents("php://input");
    $carts = json_decode($data, true);

    $notes = $carts['notes'];
    $userid = $carts['userid'];

    $update_query = "update `carts` set `notes` = :note where `user_id`=:usrid" ;

    $stmt = $conn->prepare($update_query);

    $stmt->bindParam(':usrid', $userid);
    $stmt->bindParam(':note', $notes);


    $stmt->execute();
}

//delete usercarts
function deleteUserCarts($userid )
{
    global $conn;

    $delete_query = "delete from `carts` where `user_id` = :usrid";

    $stmt = $conn->prepare($delete_query);

    $stmt->bindParam(':usrid', $userid);

    $stmt->execute();
}

///////////////////////////// not used yet ///////////////////////////////////////////

//function to select all carts 
function create_cart()
{
    global $conn;

    $data = file_get_contents("php://input");
    $product = json_decode($data, true);

    $userid = $product['usrid'];
    $prodid = $product['productid'];
    $price = $product['price'];


    $create_query = "insert into `cart_product` (user_id,product_id,price) values (:usrid,:product_id,:price);";

    $stmt = $conn->prepare($create_query);

    $stmt->bindParam(':product_id', $prodid);
    $stmt->bindParam(':usrid', $userid);
    $stmt->bindParam(':price', $price);

    $stmt->execute();

    createUserCarts($userid);

    return $product;

}

//function to save totalprice of all carts 
function createUserCarts($userid )
{
    global $conn;

    $totalPrice = countTotalPrice($userid);

    $create_query = "insert into `carts` (total_price,user_id) values (:totalprice,:usrid)";

    $stmt = $conn->prepare($create_query);

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

var_dump($_SERVER["REQUEST_METHOD"]);
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    create_cart();
    // var_dump(   "kkkk");

}

if ($_SERVER["REQUEST_METHOD"] === 'DELETE') {
    delete_cart();
}

if ($_SERVER["REQUEST_METHOD"] === 'UPDATE') {
    updateUserCarts();
}