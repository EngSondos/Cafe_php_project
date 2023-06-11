<?php

$table = 'products';

//ADD CATEGORY 
// function AddProductQuery($data)
// {
//     global $db;
//     global $table;

//     $query = "INSERT INTO `cafe_project`. `$table` (`name`, `image`, `price`, `quantity`, `category_id`) VALUES (:name, :image, :price, :quantity, :category_id)";

//     $stmt = $db->prepare($query);
//     $image = $_FILES['image']['name'];
//     $target = "../uploads/";
//     $image_path =  $target . $image;
//     move_uploaded_file($_FILES['image']['tmp_name'], $image_path); // Upload the image with the unique name

//     $stmt->bindParam(':name', $data['name']);
//     $stmt->bindParam(':image', $image_path);
//     $stmt->bindParam(':price', $data['price']);
//     $stmt->bindParam(':quantity', $data['quantity']);
//     $stmt->bindParam(':category_id', $data['category_id']);

//     if ($stmt->execute()) {
//         return true; // Insert successful
//     } else {
//         return false; // Insert failed
//     }
// }

function AddProductQuery($image, $price, $quantity, $category_id)
{
    global $db;
    global $table;

    $query = "INSERT INTO `cafe_project`.`{$table}` (image, price, quantity, category_id) VALUES ( :productImage :price, :quantity, :category_id)";

    $stmt = $db->prepare($query);
    // $image = $_FILES['image']['name'];
    $target = "../uploads/";
    $image_path =  $target . $image;
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path); // Upload the image with the unique name
    // $stmt->bindParam(':productName', $name);
    // $stmt->bindParam(':productImage', $image);
    // $stmt->bindParam(':price', $price);
    // $stmt->bindParam(':quantity', $quantity);
    // $stmt->bindParam(':category_id', $category_id);

    // if ($stmt->execute()) {
    //     return true; // Insert successful
    // } else {
    //     return false; // Insert failed
    // }

    $stmt->execute(array(
        // ':productName'    => $name,
        ':productImage' =>  $image_path,
        ':price' => $price,
        ':quantity'    => $quantity,
        ':category_id'    => $category_id
    ));

    // try {
    //     $stmt->execute();

    // } catch (Exception $e) {

    // echo $e->getMessage();
    // }


}



// ----------------------------------------------------------------

//DISPLAY CATEGORY 

function DisplayProductsQuery()
{
    global $db;
    global $table;

    try {
        $query = "SELECT * FROM `cafe_project`. `products`";
        // var_dump($query);

        ### prepare query
        $stmt = $db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


// // ----------------------------------------------------------------

// //SELECT CATEGORY BY ID 
// function SelectCategoryByIdQuery($id)
// {
//     global $db;
//     global $table;

//     try {
//         $query = "SELECT * FROM `cafe_project`. $table WHERE  id =:id";;
//         // var_dump($query);

//         ### prepare query
//         $stmt = $db->prepare($query);
//         $stmt->bindParam(":id", $id);
//         $stmt->execute();
//         $row = $stmt->fetchObject(PDO::FETCH_ASSOC);
//         return $row;
//     } catch (Exception $e) {
//         echo $e->getMessage();
//     }
// }

// ----------------------------------------------------------------

//DELETE CATEGORY 
function DeleteProductQuery($id)
{
    global $db;
    global $table;
    // try {
    // alert($id);
    $query = "DELETE FROM $table WHERE id = :id";
    // var_dump($query);

    ### prepare query
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    var_dump($id);
    return $stmt->rowCount();
    // } catch (Exception $e) {
    //     echo $e->getMessage();
    // }
}

// // ----------------------------------------------------------------

// //UPDATE CATEGORY 
// function UpdateCategoryQuery($id, $data)
// {
//     global $db;
//     global $table;
//     try {
//         $query = "UPDATE `cafe_project`. $table SET name = :cateName WHERE id = :id";
//         // var_dump($query);

//         ### prepare query
//         $stmt = $db->prepare($query);
//         $stmt->bindParam(":id", $id);
//         $stmt->bindParam(":cateName", $data['name']);
//         # true --> query executed successfully
//         session_destroy();
//         return $stmt->execute();

//     } catch (Exception $e) {
//         echo $e->getMessage();
//     }
// }
