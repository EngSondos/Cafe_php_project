<?php

$table = 'categories';

//ADD CATEGORY 
function AddCategoryQuery($data)
{
    global $conn;
    global $table;

    try {
        $query = "INSERT INTO  $table (`id`, `name`) VALUES (:cateId,:cateName)";
        // var_dump($query);

        ### prepare query
        $stmt = $conn->prepare($query);

        $stmt->bindParam(":cateId", $data['id']);
        $stmt->bindParam(":cateName", $data['name']);

        # true --> query executed successfully
        return $stmt->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// ----------------------------------------------------------------

//DISPLAY CATEGORY 

function DisplayCategoryQuery()
{
    global $conn;
    global $table;

    try {
        $query = "SELECT * FROM  $table";
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

// function DisplayCategoryNameByIdQuery($category_id){
//     global $conn;
//     global $table;

//     try {
//         $query = "SELECT `name` FROM  $table WHERE `id` = :category_id ";
//         // var_dump($query);

//         ### prepare query
//         $stmt = $conn->prepare($query);
//         $stmt->execute();
//         $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
//         return $row;
//     } catch (Exception $e) {
//         echo $e->getMessage();
//     }
// }











// ----------------------------------------------------------------

//SELECT CATEGORY BY ID 
function SelectCategoryByIdQuery($category_id)
{
    global $conn;
    global $table;

    try {
        $query = "SELECT `name` FROM  $table WHERE  id =:category_id";;
        // var_dump($query);

        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["name"];
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// ----------------------------------------------------------------

//DELETE CATEGORY 
function DeleteCategoryQuery($id)
{
    global $conn;
    global $table;
    // try {
    // alert($id);
    $query = "DELETE FROM  $table WHERE id = :id";
    // var_dump($query);

    ### prepare query
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->rowCount();
    // } catch (Exception $e) {
    //     echo $e->getMessage();
    // }
}

// ----------------------------------------------------------------

//UPDATE CATEGORY 
function UpdateCategoryQuery($id, $data)
{
    global $conn;
    global $table;
    try {
        $query = "UPDATE  $table SET name = :cateName WHERE id = :id";
        // var_dump($query);

        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":cateName", $data['name']);
        # true --> query executed successfully
        return $stmt->execute();

    } catch (Exception $e) {
        echo $e->getMessage();
    }





}
