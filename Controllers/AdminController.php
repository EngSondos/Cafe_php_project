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
    var_dump($error);
    if(!empty($error)){
        if(
            !empty($erorr['Date From'])&&
            !empty($erorr['Date To'])) {
            var_dump($error['Date From']);

            return getOrdersByDate($data['start_date'], $data['end_date']);
        }
        elseif(!empty($error['User'])){
            var_dump("Sssssssss");
              return filterorderByUserId($data['user']);
            }
        else
            return $error;
    }else
        return  getOrdersByDateandUserId($data['start_date'],$data['end_date'],$data['user'] );

}