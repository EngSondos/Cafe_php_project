<?php
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