<?php
include "../layout/head.php";

include "../Controllers/categories.php";
include "../Models/products.php";
include "../Models/categories.php";
include "../connection_credits.php";
include "../connection.php";
include "../validation.php";
$error_add;
$error_update;
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    DeleteCategory($_GET['delete_id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && !empty($_POST)) {
    $image = $_FILES['image']['name'];
    
    // $name=$_POST['name'];
   
$price=$_POST['price'];
    $quantity=$_POST['quantity'];
    $category_id=$_POST ['category_id'];




    if ($_GET['action'] === 'add') {
        // Handle add form data here
        AddProductQuery($image,$price,$quantity,$category_id);
    //   $target = "../uploads/";
    //   $image_path =  $target . $image;
    //   move_uploaded_file($_FILES['image']['tmp_name'], $image_path); // Upload the image with the unique name
//   var_dump($image);
      var_dump($_POST);
    //   $error_add= $error['name'];

    } else if ($_GET['action'] === 'update') {
        $category_id = $_GET['category_id'];
        UpdateCategory($category_id, $_POST);
    }
  }
  //name`,`image`, `price`, `quantity`, `category_id`
//   $data=[
//     'name'=>"khaled",
//     'image'=>'',
//     'price'=>50,
//     'quantity'=>50,
//     'category_id'=>8

//   ];

//   AddProductQuery($data,$image)



?>

<div class="container w-50">
    <h1 class="text-primary mx-auto w-50">Products</h1>
    <form method="post" action="?action=add" enctype="multipart/form-data">
        <!-- <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div> -->
        <div class="form-group">
            <label for="name">price:</label>
            <input type="number" class="form-control" id="price" name="price">
        </div>
        <div class="form-group">
            <label for="name">category_id:</label>
            <select name="category_id" id="">
                <?php
                $rows = DisplayCategory();
                var_dump( $rows); 
               foreach ($rows as $row){  ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php    }
           
?>
            </select>
        </div>
        <div class="form-group">
            <label for="name">quantity:</label>
            <input type="text" class="form-control" id="quantity" name="quantity">
        </div>
        <div class="form-group">
            <label for="name">image:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary my-3">Submit</button>
        <button type="reset" class="btn btn-danger  my-3">Reset</button>

    </form>
</div>




<?php
include "../layout/footer.php"
?>