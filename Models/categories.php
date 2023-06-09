<?php

$table = 'categories';

//ADD CATEGORY 
function AddCategory($data)
{
    global $db;
    global $table;

    try {
        $query = "INSERT INTO `cafe_project`. $table (`id`, `name`) VALUES (:cateId,:cateName)";
        // var_dump($query);

        ### prepare query
        $stmt = $db->prepare($query);
        var_dump($stmt);

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

function DisplayCategory()
{
    global $db;
    global $table;

    try {
        $query = "SELECT * FROM `cafe_project`. $table";
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

//SELECT CATEGORY BY ID 
function SelectCategoryByID($id)
{
    global $db;
    global $table;

    try {
        $query = "SELECT * FROM `cafe_project`. $table WHERE  id =:id";;
        // var_dump($query);

        ### prepare query
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $row = $stmt->fetchObject(PDO::FETCH_ASSOC);
        return $row;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// ----------------------------------------------------------------

//DELETE CATEGORY 
function DeleteCategory($id)
{
    global $db;
    global $table;
    // try {
    // alert($id);
    $query = "DELETE FROM `cafe_project`. $table WHERE id = :id";
    // var_dump($query);

    ### prepare query
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->rowCount();
    // } catch (Exception $e) {
    //     echo $e->getMessage();
    // }
}

// ----------------------------------------------------------------

//UPDATE CATEGORY 
function UpdateCategory($id, $data)
{
    global $db;
    global $table;
    try {
        $query = "UPDATE `cafe_project`. $table SET name = :cateName WHERE id = :id";
        // var_dump($query);

        ### prepare query
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":cateName", $data['name']);
        # true --> query executed successfully
        session_destroy();
        return $stmt->execute();

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
