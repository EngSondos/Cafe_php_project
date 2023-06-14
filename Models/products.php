<?php

$table = 'products';

//**ADD Product 
function AddProductQuery($name, $image, $price, $quantity, $category_id)
{
    global $conn;
    global $table;

    $query = "INSERT INTO `products` (`name`,`image`, price, quantity, category_id) VALUES ( :productName, :productImage, :price, :quantity, :category_id)";

    $stmt = $conn->prepare($query);
    // $image = $_FILES['image']['name'];
    $target = "../../";
    $image_path =  $target . $image;
    var_dump($_FILES['image']['tmp_name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path); // Upload the image with the unique name
    $stmt->bindParam(':productName', $name);
    $stmt->bindParam(':productImage', $image);
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

//**DISPLAY ALL Products 
function DisplayAllProductsQuery()
{
    global $conn;
    global $table;

    try {
        $query = "SELECT * FROM  `products`";
        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

//**DISPLAY ALL Products With Pagination
function DisplayAllProductsQueryWithPagination()
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
        //Retrieve the total number of records in the database table 
        $total_records = $stmt->rowCount();
        //Set the number of records to display per page and calculate the total number of pages
        $records_per_page = 8;
        $total_pages = ceil($total_records / $records_per_page);
        return $row;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

//**DISPLAY Available Product 
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

//*Select Image From DataBase */
function selectImageQuery($id)
{
    global $conn;
    // Get the image name from the database
    $query = "SELECT `image` FROM `products` WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $imageName = $stmt->fetchColumn();
    return $imageName;
}


// ----------------------------------------------------------------
//*DELETE PRODUCT 
function DeleteProductQuery($id)
{
    global $conn;
    // try {
    //Select Image From DataBase
    $imageName = selectImageQuery($id);
    $imagePath = '../../' . $imageName;
    // var_dump($imagePath);
    $query = "DELETE FROM `products` WHERE id = :id";
    // var_dump($query);

    ### prepare query
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    // Delete the image file from the server
    if (file_exists($imagePath)) {
        unlink($imagePath);
    } else {
        echo "Image file not found";
    }
    // var_dump($id);
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

function searchProductQuery($ValueSearch)
{
    global $conn;
    try {
        // Query the database with the search term
        $query = "SELECT * FROM `products` WHERE `name` LIKE '%$ValueSearch%'";
        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
            return $row;
        } else {
            echo "<h2 class='my-4' >  No results found for: " . $ValueSearch   . "</h2>";
            return $row;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
