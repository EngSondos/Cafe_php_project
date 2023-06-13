<?php
include '../Models/product_cartModel.php';
include '../Models/userCartModel.php';
include '../Views/carts/cart_view.php';


//first we need to get all carts from the model
$carts = select_carts(1);

// second we need to get all products from the model
$products = select_products();

//
$comboBox = selectUserCarts(1);


//last step send those data to the view to be rendered
render_carts($products,$carts,$comboBox);

//
// if (isset($_POST)) {
//     update_quantity();
// }
