<?php
$title = "Shopping List";

include "../../layout/head.php";

include "../../Controllers/categories.php";
include "../../Models/products.php";
include "../../Models/categories.php";
include "../../connection_credits.php";
include "../../connection.php";
include "../../Validation/validation.php";
include "../../Models/product_cartModel.php";

$error_add;
$error_update;
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    var_dump($_GET['delete_id']);
    DeleteProductQuery($_GET['delete_id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
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

// SEARCH for PRODUCT
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $ValueSearch = $_GET['search_term'] ?? "";
}

//Pagination for products
$productPagination = DisplayAvailableProductsQueryWithPagination();



?>
<!-- Main Css File For Product For User-->
<link rel="stylesheet" href="../../assets/style_product.css">
<!-- ----------------------------------------------------------------------------------------- -->
<div class="container p-50 ">
    <h1 class="text-primary mx-auto text-center my-4">All Products</h1>
    <!-- <h2 class="my-4">Products</h2> -->
    <!-- <a class="btn btn-primary" href="Add Products.php">Add Product</a> -->
    <form action="" method="GET" id="search-form">
        <input type="text" name="search_term" id="search-input" placeholder="Enter search term..." value="<?php if (isset($_GET['search_term'])) {
                                                                                                                echo $_GET['search_term'];
                                                                                                            } ?>">
        <input type="submit" value="Search">
    </form>
    <div class="row container_products">
        <?php
        if (!empty($ValueSearch)) {
            $Products =  search_Product_With_Pagination_Query($ValueSearch) ?? "";
            // $Products = searchProductQuery($ValueSearch) ?? "";
            $_GET['search_term'] = "";
            // var_dump($Products);
        } else {
            // $Products = DisplayAvailableProductsQuery();
            $Products = $productPagination ?? "";
        }
        // var_dump(   $Products );
        foreach ($Products as $row) {
        ?>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="card_container">
                    <div class="img_card">
                        <img src="../../<?= $row['image'] ?>" alt="">
                    </div>
                    <div class="card_body_product">
                        <div class="card_top">
                            <h3>
                                <?= $row['quantity'] ?> EGP
                            </h3>
                            <?php

                            if ($row['quantity'] <= 0) {
                                echo "  <p class='UnAvailable container_avi' ><i class='fa-solid fa-circle'></i> UnAvailable </p>";
                            } else {
                                echo "  <p class='Available container_avi'><i class='fa-solid fa-circle'></i>Available  </p>";
                            }
                            ?>
                        </div>
                        <div class="card_bottom">
                            <h3>
                                <?= $row['name'] ?>
                            </h3>
                            <button class="btn_card" <?php echo ($row['quantity'] <= 0) ? 'disabled="true"' : ''; ?> onclick="addToCart(event,<?= $row['id'] ?>,<?= $row['price'] ?>,1 )">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php list(
        $currentPage,
        $total_pages,
    ) = pagination();
    printPages($total_pages, $currentPage, $ValueSearch);

    ?>

</div>

<!-- Optional: Place to the bottom of scripts -->
<script src="../../Controllers/productScript.js"></script>
<script src="../../Controllers/script.js"></script>
<?php
include "../../layout/footer.php"
?>