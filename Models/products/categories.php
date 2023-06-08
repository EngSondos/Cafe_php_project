<?php

$table = 'categories';
function AddCategory($data)
{
    global $db;
    global $table;


    $query = "INSERT INTO `cafe_project`. $table (`id`, `name`) VALUES (:cateId,:cateName)";
    var_dump($query);

    ### prepare query

    $stmt = $db->prepare($query);
    var_dump($stmt);

    $stmt->bindParam(":cateId", $data['id']);
    $stmt->bindParam(":cateName", $data['name']);

    # true --> query executed successfully
    return $stmt->execute();
}
