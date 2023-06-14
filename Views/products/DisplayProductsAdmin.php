<?php
$title="Admin Panel";
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

//*Delete the Product
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    var_dump($_GET['delete_id']);
    DeleteProductQuery($_GET['delete_id']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
table {
  border-collapse: collapse;
}

td {
  padding: 30px;
  border: 1px solid #ccc;
  vertical-align: middle !important;
}
</style>
</head>
<body>
<div class="container ">
    <h1 class="text-primary mx-auto text-center my-4">Add Product</h1>
    <a class="btn btn-primary my-3"  href="Add Products.php">Add Product</a>

    <table class="table table-striped table-hover table-Secondary border-dark  text-center table-bordered align-vertical">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>price</th>
                <th>Category Name</th>
                <th>quantity</th>
                <th>Status</th>
                <th>image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $Products = DisplayAllProductsQuery();
            foreach ($Products as $row) {
            ?>
                <tr>

                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['price'] ?> EGP</td>
                    <td><?= SelectCategoryByIdQuery($row['category_id'])   ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td> <?php
                            if ($row['quantity'] <= 0) {
                                echo  '<p class="bold" style="color:red;font-weight:700" >Not Available </p> ';
                            } else {
                                echo '<p class="bold" style="color:green;font-weight:700" >Available </p> ';
                            }

                            ?> </td>
                    <td> <img height="70" width="70" src="<?= $row['image'] ?>" alt=""> </td>

                    <td><a href="UpdateProducts.php?product_id=<?= $row['id'] ?>" class="btn btn-warning edit-category">Edit</a></td>
                    <td><a href="?delete_id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a></td>
                <?php     }   ?>
                </tr>
        </tbody>
    </table>
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

    // const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
</script>
</body>
</html>



<?php
include "../../layout/footer.php"
?>