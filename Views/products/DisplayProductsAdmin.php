<?php
$title = "Admin Panel";
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
<!-- Main Css File For Product For Admin-->
<link rel="stylesheet" href="../../assets/style_product_Admin.css">
<!-- <div class="header_menu">

</div> -->
<main style="width:80%;margin-left:auto">
    <div class="container_admin_product text-center mx-auto ">
        <div class="container p-50">
            <div class="title_container">
                <h1 class="text-primary mx-auto text-center my-4 title_product"> our Products </h1>
                <a class="my-3 btn_product" href="Add Products.php">Add Product</a>
            </div>
            .
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
                    // $Products = DisplayAllProductsQuery();
                    $Products = Display_All_Products_Query_With_Pagination();
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
                                        echo  '<p class="bold" style="color:red;font-weight:700" >UnAvailable </p> ';
                                    } else {
                                        echo '<p class="bold" style="color:green;font-weight:700" >Available </p> ';
                                    }

                                    ?> </td>
                            <td> <img height="70" width="70" src="../../<?= $row['image'] ?>" alt=""> </td>

                            <td><a href="UpdateProducts.php?product_id=<?= $row['id'] ?>" class="btn_edit"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td><a href="?delete_id=<?= $row['id'] ?>" class="btn_delete" onclick="return confirm('Are you sure you want to delete this category?')"><i class="fa-solid fa-circle-xmark"></i></a></td>
                        <?php     }   ?>
                        </tr>
                </tbody>
            </table>
            <?php list(
                $currentPage,
                $total_pages,
            ) = pagination();
            printPages($total_pages, $currentPage, null);

            ?>
        </div>
    </div>
</main>
<!-- Optional: Place to the bottom of scripts -->
</body>

</html>



<?php
include "../../layout/footer.php"
?>