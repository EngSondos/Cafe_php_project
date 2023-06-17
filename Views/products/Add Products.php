<?php
$title = "Add Product";

include "../../layout/head.php";

include "../../Controllers/categories.php";
include "../../Models/products.php";
include "../../Models/categories.php";
include "../../connection_credits.php";
include "../../connection.php";
include "../../Validation/validation.php";
include "../../MiddleWares/auth.php";
include "../../MiddleWares/admin.php";

$error_add;
$error_update;
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    DeleteCategory($_GET['delete_id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && !empty($_POST)) {

    $image = "assets/products/" . $_FILES['image']['name'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category_id = $_POST['category_id'];

    if ($_GET['action'] === 'add') {
        // Handle add form data here
        AddProductQuery($name, $image, $price, $quantity, $category_id);
        var_dump($_POST);
        // header('Location:DisplayProductsAdmin.php');

        //   $error_add= $error['name'];

        header('Location:DisplayProductsAdmin.php');
    }
}
?>

<div class="container w-50">
    <h1 class="text-primary mx-auto w-50 my-5">Add Products</h1>
    <form method="post" action="?action=add" enctype="multipart/form-data">
        <!--  Name Input  -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
            <?= $error['name'] ?? "" ?> <!--  Name is required -->
        </div>
        <!--  price Input  -->
        <div class="form-group">
            <label for="name">price:</label>
            <input type="number" class="form-control" id="price" name="price">
            <?= $error['price'] ?? "" ?> <!--  price is required -->

        </div>
        <!--  category_id Input  -->
        <div class="form-group">
            <label for="name">category_id:</label>
            <select name="category_id" id="">
                <?php
                $rows = DisplayCategory();
                var_dump($rows);
                foreach ($rows as $row) {  ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php    }
                ?>
            </select>
            <?= $error['category_id'] ?? "" ?> <!--  category_id is required -->

        </div>
        <!--  quantity Input  -->
        <div class="form-group">
            <label for="name">quantity:</label>
            <input type="text" class="form-control" id="quantity" name="quantity">
            <?= $error['quantity'] ?? "" ?> <!--  quantity is required -->
        </div>
        <!--  image Input  -->
        <div class="form-group">
            <label for="name">image:</label>
            <input type="file" class="form-control" id="image" name="image">
            <?= $error['image'] ?? "" ?> <!--  image is required -->
        </div>
        <button type="submit" class="btn btn-primary my-3">Submit</button>
        <button type="reset" class="btn btn-danger  my-3">Reset</button>
    </form>
</div>

<?php
include "../../layout/footer.php";
ob_end_flush();

?>