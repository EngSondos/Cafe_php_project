<?php

include '../Models/order_model.php';



function allorders(){

  $orders = getAllOrders();


  foreach ($orders as &$order) {
    $orderProducts = getOrderProducts($order['id']);
    $order['products'] = $orderProducts;
  }

  return $orders;
}



function usersorder($userId){
  $orders = getUserOrders($userId);

  foreach ($orders as &$order) {
    $orderProducts = getOrderProducts($order['id']);
    $order['products'] = $orderProducts;
  }

  return $orders;
}



function create($userId, $products, $notes, $totalPrice, $status) {
  
    return createOrder($userId, $products, $notes, $totalPrice, $status);

 
}


function filterorder($start_date, $end_date){

  $orders = filterOrdersByDate($start_date, $end_date);

  foreach ($orders as &$order) {
    $orderProducts = getOrderProducts($order['id']);
    $order['products'] = $orderProducts;
  }

  return $orders;
}


function getById($orderId) {
  $order = getOrderById($orderId);

  if (!$order) {
    return false;
  }

  return $order;
}


