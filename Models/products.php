<?php

$table = 'products';

//**ADD CATEGORY 
function AddProductQuery($name, $image, $price, $quantity, $category_id)
{
    global $db;
    global $table;

    $query = "INSERT INTO `products` (`name`,`image`, price, quantity, category_id) VALUES ( :productName, :productImage, :price, :quantity, :category_id)";

    $stmt = $db->prepare($query);
    // $image = $_FILES['image']['name'];
    $target = "../uploads/";
    $image_path =  $target . $image;
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path); // Upload the image with the unique name
    $stmt->bindParam(':productName', $name);
    $stmt->bindParam(':productImage', $image_path);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':category_id', $category_id);

    // if ($stmt->execute()) {
    //     return true; // Insert successful
    // } else {
    //     return false; // Insert failed
    // }

    // $stmt->execute(array(
    //     ':productName'    => $name,
    //     ':productImage' =>  $image_path,
    //     ':price' => $price,
    //     ':quantity'    => $quantity,
    //     ':category_id'    => $category_id
    // ));
    try {
        $stmt->execute();
        header('Location:Display products.php');
    } catch (Exception $e) {

        echo $e->getMessage();
    }
}



// ----------------------------------------------------------------

//**DISPLAY ALL CATEGORY 
function DisplayAllProductsQuery()
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



//**DISPLAY CATEGORY 
function DisplayAvailableProductsQuery()
{
    global $db;

    try {
        $query = "SELECT * FROM `cafe_project`. `products` WHERE `quantity` > 0";
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

// ----------------------------------------------------------------

//*SELECT PRODUCT BY ID 
function SelectProductByIdQuery($id)
{
    global $db;

    try {
        $query = "SELECT * FROM `cafe_project`. `products` WHERE  id =:id";;
        // var_dump($query);

        ### prepare query
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// ----------------------------------------------------------------

//*DELETE PRODUCT 
function DeleteProductQuery($id)
{
    global $db;
    // try {
    // alert($id);
    $query = "DELETE FROM `products` WHERE id = :id";
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

// ----------------------------------------------------------------

//**UPDATE PRODUCT 
function UpdateProductQuery($id, $name, $image, $price, $quantity, $category_id)
{
    global $db;
    try {
        $query = "UPDATE `cafe_project`. `products` SET name = :productName ,image=:productImage,price=:price,quantity=:quantity,category_id=:category_id  WHERE id = :id";

        $target = "../uploads/";
        $image_path =  $target . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
        ### prepare query
        $stmt = $db->prepare($query);
        $stmt->bindParam(':productName', $name);
        $stmt->bindParam(':productImage', $image_path);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(":id", $id);        # true --> query executed successfully
        return $stmt->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
