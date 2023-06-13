<?php

$table = 'products';

//**ADD CATEGORY 
function AddProductQuery($name, $image, $price, $quantity, $category_id)
{
    global $conn;
    global $table;

    $query = "INSERT INTO `products` (`name`,`image`, price, quantity, category_id) VALUES ( :productName, :productImage, :price, :quantity, :category_id)";

    $stmt = $conn->prepare($query);
    // $image = $_FILES['image']['name'];
    $target = "../../uploads/";
    $image_path =  $target . $image;
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path); // Upload the image with the unique name
    $stmt->bindParam(':productName', $name);
    $stmt->bindParam(':productImage', $image_path);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':category_id', $category_id);
    try {
        $stmt->execute();
    } catch (Exception $e) {

        echo $e->getMessage();
    }
}



// ----------------------------------------------------------------

//**DISPLAY ALL CATEGORY 
function DisplayAllProductsQuery()
{
    global $conn;
    global $table;

    try {
        $query = "SELECT * FROM  `products`";
        // var_dump($query);

        ### prepare query
        $stmt = $conn->prepare($query);
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
    global $conn;

    try {
        $query = "SELECT * FROM  `products` WHERE `quantity` > 0";
        // var_dump($query);

        ### prepare query
        $stmt = $conn->prepare($query);
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
    global $conn;

    try {
        $query = "SELECT * FROM  `products` WHERE  id =:id";;
        // var_dump($query);

        ### prepare query
        $stmt = $conn->prepare($query);
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
    global $conn;
    // try {
    // alert($id);
    $query = "DELETE FROM `products` WHERE id = :id";
    // var_dump($query);

    ### prepare query
    $stmt = $conn->prepare($query);
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
    global $conn;
    try {
        $query = "UPDATE  `products` SET name = :productName ,image=:productImage,price=:price,quantity=:quantity,category_id=:category_id  WHERE id = :id";

        $target = "../../uploads/";
        $image_path =  $target . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
        ### prepare query
        $stmt = $conn->prepare($query);
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
