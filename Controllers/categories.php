<?php 

function AddCategory($data)
{
    $error = [];

    // if (empty($data)) {

        $error = validation($data);
      
    // }

    if(empty($error)){
        AddCategoryQuery($data);
    }
    return $error; 
  
}


function DisplayCategory(){
 return DisplayCategoryQuery();

}

function DeleteCategory($id){
            DeleteCategoryQuery($id);
}

function UpdateCategory($id, $data){
    if (!empty($data)) {
        $error = [];
        $error = validation($data);
        if(empty($error)){
            UpdateCategoryQuery($id,$data);
        }
    }
    return $error; 

}


?>