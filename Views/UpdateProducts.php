<?php
$title="Update Product";

include "../layout/head.php";

include "../Controllers/products.php";
include "../Controllers/categories.php";
include "../Models/products.php";
include "../Models/categories.php";
include "../connection_credits.php";
include "../connection.php";
include "../validation.php";
$error_add;
$error_update;
$product_updated = SelectProductByIdQuery($_GET['product_id']);
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    DeleteCategory($_GET['delete_id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && !empty($_POST)) {

  
    $image=imageValid();
    var_dump( $image );
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category_id = $_POST['category_id'];
    if ($_GET['action'] === 'update') {
        $product_id = $_GET['product_id'];
        UpdateProductQuery($product_id, $name, $image, $price, $quantity, $category_id);
       header('Location:DisplayProductsAdmin.php');
        // $error_update= $error['name'];
        // Handle update form data here
    }
}


// var_dump($product_updated );
?>

<div class="container w-50">
    <h1 class="text-primary mx-auto w-50">Update Products <?= $_GET['product_id'] ?></h1>
    <form method="post" action="?action=update&product_id=<?= $_GET['product_id'] ?>" enctype="multipart/form-data"
        name="addForm">
        <!--Name Input -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $product_updated['name'] ?>">
        </div>
        <!--Price Input -->
        <div class="form-group">
            <label for="name">price:</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= $product_updated['price'] ?>">
        </div>
        <!--Category_id Input -->
        <div class="form-group">
            <label for="name">category_id:</label>
            <select name="category_id" id="category_id"
                value="<?= SelectCategoryByIdQuery($product_updated['category_id'])     ?>"> //*
                <?php
                $rows = DisplayCategory();
                var_dump($rows);
                foreach ($rows as $row) {  ?>
                <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php    }

                ?>
            </select>
        </div>
        <!--Quantity Input -->
        <div class="form-group">
            <label for="name">quantity:</label>
            <input type="text" class="form-control" id="quantity" name="quantity"
                value="<?= $product_updated['quantity'] ?>">
        </div>
        <!--Image Input -->
        <div class="form-group">
            <label for="name">image:</label>
            <input type="file" class="form-control" id="image" accept="image/*" name="image">


        </div>
        <button type="submit" class="btn btn-primary my-3">Submit</button>
        <button type="reset" class="btn btn-danger  my-3">Reset</button>

    </form>
    <br>

</div>
<!-- Optional: Place to the bottom of scripts -->
<script>
    //**Set Old Value For Category Id
    let category_id = document.querySelectorAll('#category_id option');
    for (let i = 0; i < category_id.length; i++) {
        if (category_id[i].value == < ? = $product_updated['category_id'] ? > ) {
            let selected = category_id[i].setAttribute('selected', true); //**Set Selected Attribute 
        }
    }
</script>

<?php
include "../layout/footer.php"
?>