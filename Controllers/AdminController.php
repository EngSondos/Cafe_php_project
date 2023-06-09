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

function filterOrderByUserAndDate($data)
{
    $error = validation($data);
    if(!empty($error)){
         if(!empty($erorr['end_date'])&& !empty($erorr['start_date'])){
          if(!empty($error['User'])){
           //get the order with date and user

        }else {
            return getOrdersByDate($data['start_date'],$data['end_date']);

        }
    }
    else{
        return $error;
    }

    }

}