<?php
include 'product_cartModel.php';
//function to create order from carts
function createOrder()
{
    global $conn;

    $data = file_get_contents("php://input");
    $cart = json_decode($data, true);

    $userId= $cart['user_id'];
    
    $products=select_carts($userId);
    $usercarts = selectUserCarts($userId);


    try {

        $stmt = $conn->prepare("INSERT INTO `Cafe`.`orders` (`user_id`, `total_price`) VALUES (:user_id, :total_price)");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':total_price', $usercarts[0]['total_price']);
        $stmt->execute();

        $orderId = $conn->lastInsertId();

        $stmt = $conn->prepare("INSERT INTO order_product (order_id, product_id, price, quantity) VALUES (:order_id, :product_id, :price, :quantity)");

        foreach ($products as $product) {
            $stmt->bindParam(':order_id', $orderId);
            $stmt->bindParam(':product_id', $product['product_id']);
            $stmt->bindParam(':price', $product['price']);
            $stmt->bindParam(':quantity', $product['quantity']);
            $stmt->execute();
        }

        deleteAllCarts();   
        deleteUserCarts($userId); 
        
        // return $orderId;
    } catch (PDOException $e) {
        throw $e;
    }
}
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    createOrder();
    // header("Refresh:1");
}
