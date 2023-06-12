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
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category_id = $_POST['category_id'];
    var_dump($_POST);
    if ($_GET['action'] === 'update') {
        $product_id = $_GET['product_id'];
        var_dump($product_id);
        UpdateProductQuery($product_id, $name, $image, $price, $quantity, $category_id);
    //    header('Location:DisplayProductsAdmin.php');
        // $error_update= $error['name'];
        // Handle update form data here
    }
}
?>

<div class="container w-50">
    <h1 class="text-primary mx-auto w-50">Update Products <?= $_GET['product_id'] ?></h1>
    <form method="post" action="?action=update&product_id=<?= $_GET['product_id'] ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="name">price:</label>
            <input type="number" class="form-control" id="price" name="price">
        </div>
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
    <br>

</div>
<!-- Optional: Place to the bottom of scripts -->
<script>
    const editButtons = document.querySelectorAll('.edit-category');
    editButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const categoryId = event.target.dataset.categoryId;
            const editUrl = `?action=update&category_id=${categoryId}`;
            document.querySelector('#modelId form').setAttribute('action', editUrl);
        });
    });
</script>

<?php
include "../layout/footer.php"
?>