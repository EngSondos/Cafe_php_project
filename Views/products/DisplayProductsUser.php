<?php
$title = "Shopping List";

include "../../layout/head.php";

include "../../Controllers/categories.php";
include "../../Models/products.php";
include "../../Models/categories.php";
include "../../connection_credits.php";
include "../../connection.php";
include "../../Validation/validation.php";
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
// var_dump($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $ValueSearch = $_GET['search_term'] ?? "";
    // searchProductQuery($ValueSearch);
    // var_dump(searchProductQuery($ValueSearch));
}



?>
<!-- Main Css File -->
<link rel="stylesheet" href="../style_product.css">
<div class="container ">
    <h1 class="text-primary mx-auto text-center my-4">All Products</h1>
    <!-- <h2 class="my-4">Products</h2> -->
    <!-- <a class="btn btn-primary" href="Add Products.php">Add Product</a> -->


    <form action="" method="GET" id="search-form">
        <input type="text" name="search_term" id="search-input" placeholder="Enter search term..." value="<?php if (isset($_GET['search_term'])) {
                                                                                                                echo $_GET['search_term'];
                                                                                                            } ?>">
        <input type="submit" value="Search">
    </form>
    <div class="row ">
        <?php
        if (!empty($ValueSearch)) {
            $Products = searchProductQuery($ValueSearch) ?? "";
            $_GET['search_term'] = "";
            // var_dump($Products);
        } else {

            $Products = DisplayAvailableProductsQuery();
        }
        // var_dump(DisplayAvailableProductsQuery());
        // var_dump($ValueSearch);
        // var_dump(   $Products );
        foreach ($Products as $row) {
        ?>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="card_container">
                    <div class="img_card">
                        <img src="<?= $row['image'] ?>" alt="">
                    </div>
                    <div class="card-body">
                        <div class="card_top">
                            <h3><?= $row['price'] ?> EGP </h3>
                        </div>
                        <div class="card_bottom">
                            <h3><?= $row['name'] ?></h3>
                            <button class="btn_card">Add</button>
                        </div>

                        <!-- <div class="top d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-left "></h5>
                            <h5 class="card-title text-right btn-primary p-2 rounded ">Stock : <?= $row['quantity'] ?></h5>
                        </div>
                        <div class="bottom d-flex justify-content-between align-items-center ">
                            <p class="card-text m-0">Category :<b> <?= SelectCategoryByIdQuery($row['category_id'])   ?> </b>
                            </p>
                        </div> -->
                    </div>
                </div>
            </div>
        <?php     }   ?>
        //******************************************************* */
        <?php
        foreach ($Products as $row) {
        ?>
            <!-- <div class="col-3 mb-4">
                <div class="card h-100">
                    <img height="300" src="<?= $row['image'] ?>" class="card-img-top border border-secondary rounded" alt="...">
                    <div class="card-body">
                        <div class="top d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-left "><?= $row['name'] ?></h5>
                            <h5 class="card-title text-right btn-primary p-2 rounded ">Stock : <?= $row['quantity'] ?></h5>
                        </div>
                        <div class="bottom d-flex justify-content-between align-items-center ">
                            <p class="card-text m-0">Category :<b> <?= SelectCategoryByIdQuery($row['category_id'])   ?> </b>
                            </p>
                            <p class="card-text btn-warning p-2 rounded ">Price : <b><?= $row['price'] ?> EGP </b>
                            </p>

                        </div>
                        <a href="?delete_id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                    </div>
                </div>
            </div> -->
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

    //*Search on Product
    const searchInput = document.getElementById('search-input');
    const searchForm = document.getElementById('search-form');
    searchInput.addEventListener('input', function() {
        if (searchInput.value === '') {
            // Remove the query string from the URL
            window.history.replaceState({}, document.title, window.location.pathname);
            // searchForm.submit();
            // Set the focus to the input field if it has a value
            searchInput.focus();
            searchForm.submit();
        }
    });

    //**Click On Add Button */
    let addCarts = document.querySelectorAll(".card_bottom .btn_card");
    // console.log(addCart);
    for (let i = 0; i < addCarts.length; i++) {
        addCarts[i].addEventListener("click", function AddToCart() {
            addCarts[i].innerHTML = '<i class="fa-solid fa-check"></i>';
        });
    }
    // const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
</script>

<?php
include "../../layout/footer.php"
?>