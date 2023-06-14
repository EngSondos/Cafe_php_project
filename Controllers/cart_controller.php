<?php
include '../connection_credits.php';
include '../connection.php';
include '../Models/product_cartModel.php';
include '../Models/userCartModel.php';
include '../Models/ordersModel.php';
include '../Views/carts/cart_view.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$userid = 1;

if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    $carts = selectCarts($userid);
    $products = selectProducts();
    $comboBox = selectUserCarts($userid);
} else if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $reqbody = file_get_contents("php://input");
    $data = json_decode($reqbody, true);

    if ($data['usrid'] and $data['productid'] and $data['price']) {
        createCart($data['usrid'], $data['productid'], $data['price']);
        $res = selectUserCarts($data['usrid']);
        if (sizeof($res) == 0) {
            createUserCarts($data['usrid']);
        } else {
            if ($data['notes']) {
                updateUserCarts($data['usrid'], '');
            } else {
                updateUserCarts($data['usrid'], $data['notes']);
            }
        }
    }else{
        $products = selectCarts($data['user_id']);
        $usercarts = selectUserCarts($data['user_id']);
        if(sizeof($products) and sizeof($usercarts)){
            createOrder($data['user_id'],$products,$usercarts);
            deleteAllCarts();   
            deleteUserCarts($data['user_id']); 
        }
    }

} else if ($_SERVER["REQUEST_METHOD"] === 'UPDATE') {
    $reqbody = file_get_contents("php://input");
    $data = json_decode($reqbody, true);
    if ($data['quantity']) {
        updateCart($data['quantity'], $data['product_id'], $data['user_id'], $data['price']);
        updateUserCarts($data['user_id'], '');
    } else {
        updateUserCarts($data['user_id'], $data['notes']);
    }
} else if ($_SERVER["REQUEST_METHOD"] === 'DELETE') {
    $reqbody = file_get_contents("php://input");
    $data = json_decode($reqbody, true);
    updateUserCarts($userid, '');
    deleteCart($data['cartid']);
   
}

//last step send those data to the view to be rendered
render_carts($products, $carts, $comboBox);



