<?php 

function imageValid (){

    global $product_updated;

  //**To Sure That Input File Is Not Empty.
  //**If Input File Is Empty Set The The Old Image.
  
  if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // File was uploaded successfully
    $image = $_FILES['image']['name'];
    // var_dump(  $image);
    // var_dump( $product_updated['image'] );
    // Process the file
} else {
    // File upload error occurred
    $image =  substr( $product_updated['image'],13);
    
    // "../../uploads/icecream9.jpg" 
    // Handle the error
}

return $image;
}

//*Add Product
function AddProduct($name, $image, $price, $quantity, $category_id)
{
    $error = [];

  //Store the product information in the database
      $data=[
        'name' => $name,
        'image' => $image,
        'price' => $price,
        'quantity' => $quantity,
        'category_id' => $category_id,
      ];
        $error = validation($data);
      

    if(empty($error)){
        // AddCategoryQuery($data);
        AddProductQuery($name, $image, $price, $quantity, $category_id);
    }
    return $error; 
  
}

