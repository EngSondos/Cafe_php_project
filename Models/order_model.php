<?php



// include 'db_connection.php';
include '../db_connection.php';






function getAllOrders()
{
  global $pdo;

  try {
    $stmt = $pdo->prepare('SELECT * FROM orders ORDER BY created_at DESC');
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($orders as &$order) {
      $stmt = $pdo->prepare('SELECT * FROM order_product WHERE order_id = :order_id');
      $stmt->bindParam(':order_id', $order['id']);
      $stmt->execute();
      $orderProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $totalPrice =0;
      foreach ($orderProducts as $product){
        $totalPrice += $product['quantity'] * $product['price'];
      }
      $order['total_price'] = $totalPrice;
    }

    return $orders;
  } catch(PDOException $e) {
    throw $e;
  }
}





function getUserOrders($userId)
{
  global $pdo;

  try {
    $stmt = $pdo->prepare('SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC');
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($orders as &$order) {
      $stmt = $pdo->prepare('SELECT * FROM order_product WHERE order_id = :order_id');
      $stmt->bindParam(':order_id', $order['id']);
      $stmt->execute();
      $orderProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $totalPrice =0;
      foreach ($orderProducts as $product){
        $totalPrice += $product['quantity'] * $product['price'];
      }
      $order['total_price'] = $totalPrice;
    }

    return $orders;
  } catch(PDOException $e) {
    throw $e;
  }
}












function createOrder($userId, $products, $notes, $totalPrice, $status) {
  global $pdo;

  try {

    $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price, notes, status) VALUES (:user_id, :total_price, :notes, :status)");
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':total_price', $totalPrice);
    $stmt->bindParam(':notes', $notes);
    $stmt->bindParam(':status', $status);
    $stmt->execute();

    $orderId = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO order_product (order_id, product_id, price, quantity) VALUES (:order_id, :product_id, :price, :quantity)");

    foreach ($products as $product) {
      $stmt->bindParam(':order_id', $orderId);
      $stmt->bindParam(':product_id', $product['product_id']);
      $stmt->bindParam(':price', $product['price']);
      $stmt->bindParam(':quantity', $product['quantity']);
      $stmt->execute();
    }


    return $orderId;
  } catch(PDOException $e) {
    throw $e;
  }
}

function getOrderProducts($orderId) {
  global $pdo;

  try {
    $stmt = $pdo->prepare('SELECT op.quantity, p.name, p.image, op.price FROM order_product op JOIN products p ON op.product_id = p.id WHERE order_id = :order_id');
    $stmt->bindParam(':order_id', $orderId);
    $stmt->execute();
    $orderProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $orderProducts;
  } catch(PDOException $e) {
    throw $e;
  }
}


function filterOrdersByDate($start_date, $end_date)
{
  global $pdo;

  try {
    $stmt = $pdo->prepare('SELECT * FROM orders WHERE created_at BETWEEN :start_date AND :end_date ORDER BY created_at DESC');
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($orders as &$order) {
      $stmt = $pdo->prepare('SELECT * FROM order_product WHERE order_id = :order_id');
      $stmt->bindParam(':order_id', $order['id']);
      $stmt->execute();
      $orderProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $totalPrice =0;
      foreach ($orderProducts as $product){
        $totalPrice += $product['quantity'] * $product['price'];
      }
      $order['total_price'] = $totalPrice;
    }

    return $orders;
  } catch(PDOException $e) {
    throw $e;
  }
}

function getOrderById($orderId) {
  global $pdo;

  try {
    $stmt = $pdo->prepare('SELECT * FROM orders WHERE id = :order_id');
    $stmt->bindParam(':order_id', $orderId);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
      return false;
    }
    return $order;
  } catch(PDOException $e) {
    throw $e;
  }
}
