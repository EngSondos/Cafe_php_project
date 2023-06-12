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
    var_dump($_GET['delete_id']);
    DeleteProductQuery($_GET['delete_id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && !empty($_POST)) {

    if ($_GET['action'] === 'add') {
        // AddProductQuery($_POST);
        // Handle add form data here
        $error_add = $error['name'];
    } else if ($_GET['action'] === 'update') {
        $category_id = $_GET['category_id'];
        UpdateCategory($category_id, $_POST);
        // $error_update= $error['name'];
        // Handle update form data here
    }
}
?>

<div class="container ">
    <h1 class="text-primary mx-auto w-50">Products</h1>
    <div class="row ">
        <h2 class="my-4">Products</h2>
        <a class="btn btn-primary" href="Add Products.php">Add Product</a>
        <?php
        $Products = DisplayAvailableProductsQuery();
        // var_dump(   $Products );
        foreach ($Products as $row) {
        ?>
            <div class="col-3 mb-4">
                <div class="card h-100">
                    <img height="300" src="../uploads/<?= $row['image'] ?>" class="card-img-top border border-secondary rounded" alt="...">
                    <div class="card-body">
                        <div class="top d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-left "><?= $row['name'] ?></h5>
                            <h5 class="card-title text-right btn-primary p-2 rounded ">Stock : <?= $row['quantity'] ?></h5>
                        </div>
                        <div class="bottom d-flex justify-content-between align-items-center ">
                            <p class="card-text m-0">Category :<b> <?= SelectCategoryByIdQuery($row['category_id'])   ?> </b>
                            </p>
                            <p class="card-text btn-warning p-2 rounded ">Price : <b><?= $row['price'] ?> </b>
                            </p>

                        </div>
                        <a href="?delete_id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                    </div>
                </div>
            </div>
        <?php     }   ?>

    </div>
</div>





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

<?php
include "../layout/footer.php"
?>