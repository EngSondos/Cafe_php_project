<?php 


ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);


function getAllUser()
{
    return getAllUserMakeOrder();

}

function filter($user_id){

   return filterorderByUserId($user_id);
}

function getDetalisOfOrder($order_id,$user_id){
    return getOrderDetalis($order_id,$user_id);
}

