<?php

function createOrder($userId,$products,$usercarts)
{
    global $conn;

    try {

        $stmt = $conn->prepare("INSERT INTO `Cafe`.`orders` (`user_id`, `total_price`,`notes`) VALUES (:user_id, :total_price,:notes)");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':total_price', $usercarts[0]['total_price']);
        $stmt->bindParam(':notes', $usercarts[0]['notes']);
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
        
    } catch (PDOException $e) {
        throw $e;
    }
}

