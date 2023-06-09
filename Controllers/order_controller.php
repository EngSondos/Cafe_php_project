<?php

include '../Models/order_model.php';






function all(){

  $orders = getAllOrders();


}





function create($userId, $products, $notes, $totalPrice, $status) {
  
    return createOrder($userId, $products, $notes, $totalPrice, $status);

 
}

// function show($userId){

//   return showorders($userId);
// }



